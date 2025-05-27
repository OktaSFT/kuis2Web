<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

echo "Selamat datang Admin!<br>";
echo "<a href='logout.php'>Logout</a>";
?>
