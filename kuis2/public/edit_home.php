<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] !== 'pengguna') {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['username'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "UPDATE users SET username='$new_username', password='$new_password' WHERE id=$id";
    mysqli_query($conn, $sql);
    $_SESSION['username'] = $new_username;
    header("Location: profile.php");
}
?>
<form method="post">
    Username baru: <input name="username"><br>
    Password baru: <input name="password" type="password"><br>
    <button type="submit">Simpan</button>
</form>
