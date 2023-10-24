<?php
$koneksi = mysqli_connect("localhost", "root", "", "restoran", 3306);

$id = $_POST['id'];

$query = "DELETE FROM menu WHERE idmenu = $id";
mysqli_query($koneksi, $query);

mysqli_close($koneksi);

header("Location: crudadmin.php");
?>