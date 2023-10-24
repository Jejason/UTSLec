<?php
session_start();
if (!isset($_SESSION['iduser'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['idmenu'];

    if (isset($_SESSION['cart'][$itemId])) {
        $_SESSION['cart'][$itemId]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$itemId] = array(
            'namamenu' => $_POST['namamenu'],
            'harga' => $_POST['harga'],
            'quantity' => 1,
        );
    }
}

function deleteItemFromCart($itemId) {
    if (isset($_SESSION['cart'][$itemId])) {
        unset($_SESSION['cart'][$itemId]);
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $itemId = $_GET['id'];
    deleteItemFromCart($itemId);
}
if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
    header('Location: menu.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Cart = Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top  bg-dark bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#title"><img src="img/logo1.png" class="leblanc" alt="Leblanc Logo"></a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutUs.php">About Us</a>
                    </li>
                </ul>
                <?php
                    session_start();
                    if(!isset($_SESSION['iduser'])){
                        echo "<form action='login.php'>";
                            echo "<button type='submit' class='btn btn-outline-success'>Login</button>";
                        echo "</form>";
                    }else{
                        echo "<form action='logout.php'>";
                            echo "<button type='submit' class='btn btn-outline-danger'>Logout</button>";
                        echo "</form>";
                    }
                ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="header">
            Receipt
        </div>
        <div class="item-list">
            <div class="item">
                <div class="item-name"><strong>Name</strong></div>
                <div class="item-price"><strong>Price</strong></div>
                <div class="item-quantity"><strong>Quantity</strong></div>
                <div class="item-subtotal"><strong>Subtotal</strong></div>
                <div class="item-actions"><strong></strong></div>
                <div class="item-back"><strong></strong></div>
            </div>
            <?php
            $totalHarga = 0;

            foreach ($_SESSION['cart'] as $itemId => $itemData) {
                $subtotal = $itemData['harga'] * $itemData['quantity'];
                $totalHarga += $subtotal;
            ?>
            <div class="item">
                <div class="item-name"><?php echo $itemData['namamenu']; ?></div>
                <div class="item-price">Rp. <?php echo number_format($itemData['harga']); ?></div>
                <div class="item-quantity"><?php echo $itemData['quantity']; ?></div>
                <div class="item-subtotal">Rp. <?php echo number_format($subtotal); ?></div>
                <div class="item-actions">
                    <a class="deletebutton" href="mycart.php?action=delete&id=<?php echo $itemId; ?>">
                        <svg viewBox="0 0 448 512" class="svgIcon">
                            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                        </svg>
                    </a>
                </div>
                <div class="item-back">
                    <a class="button1" href="detail.php?id=<?php echo $itemId; ?>">
                        Back
                    </a>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="total">
            Total Price: Rp. <?php echo number_format($totalHarga); ?>
        </div>
        
        <button type="submit" data-bs-toggle="modal" data-bs-target="#paymentModal" class="confirm">Confirm Payment</button>
        
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Total Price: Rp. <b><?php echo number_format($totalHarga); ?></b></h3> <br>
                    Thank you for ordering. <br>
                    Payment is being processed. Please wait until your order is being prepared.
                </div>
                <div class="modal-footer">
                <form method="post" action="mycart.php">
                    <button type="submit" name="clear_cart" id='closeModalButton' class="confirm" data-bs-dismiss="modal">Confirm</button>
                </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-wTc5zqs8NXHtP3heM/O82ScwzX4oWr0NpsQaQKfEoGT5ckz/1g8k6L7qhi1eCk3aM" crossorigin="anonymous"></script>

</body>
</html>
