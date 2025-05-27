<?php
include 'db.php';

$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role = 'pengguna';

$query = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', '$role')";
$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: login.php");
} else {
    echo "Registration failed: " . mysqli_error($conn);
}
?>
