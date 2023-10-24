<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Leblanc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Cabin|Herr+Von+Muellerhoff|Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="css/menu.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
                        <a class="nav-link" href="aboutUs.php">About Us</a>
                    </li>
                </ul>
                <form action="mycart.php">
                    <button type="submit" class="kart">
                    <span class="button_icon"><i class="fas fa-shopping-cart"></i></span>
                </button>
                </form>
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
        <div class="row filter-btn-row">
        <div class="col-lg-12 mb-5">
            <a href="menu.php" class="btn filter-btn">All</a>
            <a href="menu1.php" class="btn filter-btn">Seasonal Menu</a>
            <a href="menu2.php" class="btn filter-btn">Waffle</a>
            <a href="menu3.php" class="btn filter-btn">Dessert</a>
            <a href="menu4.php" class="btn filter-btn">Lunch</a>
            <a href="menu5.php" class="btn filter-btn">Food</a>
            <a href="menu6.php" class="btn filter-btn">Morning</a>
            <a href="menu7.php" class="btn filter-btn">Coffee</a>
            <a href="menu8.php" class="btn filter-btn">Tea</a>
            <a href="menu9.php" class="btn filter-btn">Softdrink</a>
            <a href="menu10.php" class="btn filter-btn active">Alcohol</a>
        </div>
    </div>
    
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
                echo '<a href="detail.php?id=' . $row['idmenu'] . '">';
                echo '<div class="card text-center ' . $colorClass . ' bg-card" style="width: 18rem;" data-filter="' . $kategori . '">';
                echo '<div class="card-image-container">';
                echo '<img src="' . $row['foto'] . '" class="card-img-top" alt="">';
                echo '</div>';
                echo '<div class="card-body">';echo '</a>';
                echo '<p class="card-text">' . $row['namamenu'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                
            }            
            echo '</div>';
            echo '</div>';
        }
        $kategoriArray = ["alcohol"];
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
</body>
</html>
