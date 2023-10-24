<?php
$koneksi = mysqli_connect("sql109.infinityfree.com", "if0_35295262", "2J5oguklsoq4TTj", "if0_35295262_restoran");

$id = $_POST['id'];

$query = "DELETE FROM menu WHERE idmenu = $id";
mysqli_query($koneksi, $query);

mysqli_close($koneksi);

header("Location: crudadmin.php");
