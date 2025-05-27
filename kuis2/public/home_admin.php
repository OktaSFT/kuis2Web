<?php
session_start();
if ($_SESSION['role'] != 'admin') header("Location: login.php");
?>
<h2>Welcome, Admin (<?= $_SESSION['email']; ?>)</h2>
<a href="logout.php">Logout</a>
