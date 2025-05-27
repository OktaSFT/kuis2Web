<?php
include '../auth.php';
include '../koneksi.php';

$id = $_SESSION['id'];
$row = $conn->query("SELECT profile_picture FROM users WHERE id = $id")->fetch_assoc();

if ($row['profile_picture']) {
  $path = "../uploads/{$row['profile_picture']}";
  if (file_exists($path)) unlink($path);
  $conn->query("UPDATE users SET profile_picture=NULL WHERE id=$id");
}

header("Location: dashboard.php");
exit;
?>
