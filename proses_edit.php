<?php
    $koneksi = mysqli_connect("sql109.infinityfree.com", "if0_35295262", "2J5oguklsoq4TTj", "if0_35295262_restoran");

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    $foto = "img/" . $kategori . "/" . $_FILES['foto']['name'];

    $query = "UPDATE menu SET namamenu = '$nama', harga = '$harga', deskripsi = '$deskripsi', foto = '$foto' WHERE idmenu = $id";
    mysqli_query($koneksi, $query);

    move_uploaded_file($_FILES['foto']['tmp_name'], "img/" . $kategori . "/" . $_FILES['foto']['name']);

    mysqli_close($koneksi);

    header("Location: crudadmin.php");
