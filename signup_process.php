<?php
    $koneksi = mysqli_connect("sql109.infinityfree.com", "if0_35295262", "2J5oguklsoq4TTj", "if0_35295262_restoran");

    $id = $_POST['id'];
    $namaDepan = $_POST['namadepan'];
    $namaBelakang = $_POST['namabelakang'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $tanggalLahir = $_POST['tanggallahir'];
    $password = $_POST['password'];

    $en_pass = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO user (namadepan, namabelakang, username, password, tanggallahir, jeniskelamin) VALUES 
            (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($koneksi, $query);

    mysqli_stmt_bind_param($stmt, "ssssss", $namaDepan, $namaBelakang, $username, $en_pass, $tanggalLahir, $gender);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);

    header("Location: login.php");
