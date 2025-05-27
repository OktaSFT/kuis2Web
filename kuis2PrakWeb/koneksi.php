<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'data_pengguna';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_errno) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
