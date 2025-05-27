<?php
session_start();
if ($_SESSION['role'] != 'pengguna') header("Location: login.php");
?>
<h2>Welcome, Customer (<?= $_SESSION['email']; ?>)</h2>
<a href="logout.php">Logout</a>
