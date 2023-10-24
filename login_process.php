<?php
session_start();
require_once('db.php');

$kategori = $_POST['kategori'];
$username = $_POST['username'];
$password = $_POST['password'];
$captcha = $_POST['captcha'];
$captchaCode = $_POST['captcha-code'];


if ($captcha !== $captchaCode) {
    header('Location: login.php?error=CaptchaIncorrect');
    exit();
}

$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$username]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    if (password_verify($password, $row['password'])) {
        $_SESSION['iduser'] = $row['iduser'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['kategori'] = $row['kategori'];

        if($username === 'adminGanteng'){
            $kategori = 'admin';
        }

        if ($kategori === 'admin' || $row['kategori'] === 'admin') {
            header('Location: crudadmin.php');
        } 
        else {
            header('Location: menu.php');
        }
    } else {
        header('Location: login.php?error=PasswordisIncorrect');
    }
} else {
    header('Location: login.php?error=UsernameisIncorrect');
}
?>
