<?php
include '../auth.php';
include '../koneksi.php';

$id = $_GET['id'] ?? 0;

// Hapus foto kalau ada
$cek = $conn->prepare("SELECT profile_picture FROM users WHERE id=?");
$cek->bind_param("i", $id);
$cek->execute();
$res = $cek->get_result();
$row = $res->fetch_assoc();

if ($row && $row['profile_picture'] && file_exists("../uploads/{$row['profile_picture']}")) {
  unlink("../uploads/{$row['profile_picture']}");
}

$conn->query("DELETE FROM users WHERE id=$id");
header("Location: dashboard.php");
exit;
?>
