<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Leblanc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Cabin|Herr+Von+Muellerhoff|Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/menu.css">
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
                        <a class="nav-link active" aria-current="page" href="#">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#title">About Us</a>
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
        <h1 class="title mt-4 mb-1" id="title">Menu</h1>
        <?php
        if (!isset($_SESSION['iduser'])) {
            header('Location: login.php');
            exit();
        }
        
        $kategori = ($_SESSION['kategori'] === 'admin') ? 'admin' : 'user';

        if ($kategori !== 'admin') {
            header('Location: menu.php');
            exit();
        }

        ?>
        <div class="row filter-btn-row">
			<div class="col-lg-12 mb-5">
				<a data-filter="all" class="btn btn-outline-warning filter-btn active">All</a>
				<a data-filter="seasonalMenu" class="btn btn-outline-warning filter-btn">Seasonal Menu</a>
				<a data-filter="waffle" class="btn btn-outline-warning filter-btn">Waffle</a>
				<a data-filter="dessert" class="btn btn-outline-warning filter-btn">Dessert</a>
				<a data-filter="lunch" class="btn btn-outline-warning filter-btn">Lunch</a>
				<a data-filter="food" class="btn btn-outline-warning filter-btn">Food</a>
				<a data-filter="morning" class="btn btn-outline-warning filter-btn">Morning</a>
				<a data-filter="coffee" class="btn btn-outline-warning filter-btn">Coffee</a>
				<a data-filter="tea" class="btn btn-outline-warning filter-btn">Tea</a>
				<a data-filter="softdrink" class="btn btn-outline-warning filter-btn">Softdrink</a>
                <a data-filter="alcohol" class="btn btn-outline-warning filter-btn">Alcohol</a>
			</div>
		</div>

        <form action="add.php">
            <button class="btn btn-success" type="submit">Add New Menu</button>
        </form>
        <?php
            $koneksi = mysqli_connect("localhost", "root", "", "restoran", 3306);
            function getRandomColorClass() {
                $colorClasses = ["bg-color-1", "bg-color-2", "bg-color-3", "bg-color-4", "bg-color-5"]; 
                return $colorClasses[array_rand($colorClasses)];
            }
            $query = "SELECT * FROM menu";
            $result = mysqli_query($koneksi, $query);
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$row['kategori']][] = $row;
            }
            mysqli_close($koneksi);
            function generateCategoryContainer($data, $kategori) {
                echo '<div id="' . $kategori . '" class="category-container" data-aos="fade-up">';
                echo '<h2 class="menuTitle text-center mt-5 mb-5">' . ucfirst($kategori) . '</h2>'; 
                echo '<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-md-center">';
                foreach ($data[$kategori] as $row){
                    $colorClass = getRandomColorClass();
                    echo '<div class="col">';
                    echo '<div class="card text-center ' . $colorClass . ' bg-card" style="width: 18rem; height: 400px" data-filter="' . $kategori . '">';
                    echo '<div class="card-image-container">';
                    echo '<img src="' . $row['foto'] . '" class="card-img-top" alt="">';
                    echo '</div>';
                    echo '<div class="card-body">';
                    echo '<p class="card-text">' . $row['namamenu'] . '</p>';
                    echo "<form action='edit.php' method='POST'>";
                        echo "<input type='hidden' name='id' value='" . $row['idmenu'] . "'>";
                        echo "<button type='submit' class='btn btn-primary'>Edit</button>";
                    echo '</form>';
                    echo "<form action='delete.php' method='POST'>";
                        echo "<input type='hidden' name='id' value='" . $row['idmenu'] . "'>";
                        echo "<button type='submit' class='btn btn-danger' style='width: 90px;'>Delete</button>";
                    echo "</form>";
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }            
                echo '</div>';
                echo '</div>';
            }
            $kategoriArray = ["seasonalMenu", "waffle", "dessert", "lunch", "food", "morning", "coffee", "tea", "softdrink", "alcohol"];
            foreach ($kategoriArray as $kategori) {
                generateCategoryContainer($data, $kategori);
            }
            ?>
        </div>
    
        <script src="js/menu.js"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 2000,
            });
            AOS.refresh();
        </script>

    <script src="js/menu.js"></script>
</body>
</html>