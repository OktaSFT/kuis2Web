<?php
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'pengguna') header("Location: home_pengguna.php");
    if ($_SESSION['role'] == 'admin') header("Location: home_admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login GudangNET</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('bg.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex; justify-content: center; align-items: center;
            height: 100vh; margin: 0;
        }
        .login-container {
            background: white; padding: 30px; border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            width: 300px; text-align: center;
        }
        .switch-btn {
            display: flex; margin-bottom: 20px;
        }
        .switch-btn button {
            flex: 1; padding: 10px; cursor: pointer; border: none;
            background: lightgray; font-weight: bold;
        }
        .switch-btn .active {
            background: #5A67D8; color: white;
        }
        input {
            width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid gray;
        }
        .login-btn {
            width: 100%; padding: 10px; background: #5A67D8; color: white; border: none; border-radius: 5px;
            cursor: pointer;
        }
        .signup {
            margin-top: 10px; font-size: 12px;
        }
    </style>
    <script>
        function switchRole(role) {
            document.getElementById('role').value = role;
            document.getElementById('btnPengguna').classList.remove('active');
            document.getElementById('btnAdmin').classList.remove('active');
            if (role == 'pengguna') document.getElementById('btnPengguna').classList.add('active');
            else document.getElementById('btnAdmin').classList.add('active');
        }
    </script>
</head>
<body>
<div class="login-container">
    <h3>LOGIN</h3>
    <div class="switch-btn">
        <button id="btnPengguna" class="active" onclick="switchRole('pengguna')">Customer</button>
        <button id="btnAdmin" onclick="switchRole('admin')">Admin</button>
    </div>
    <form action="proses_login.php" method="post">
        <input type="hidden" name="role" id="role" value="pengguna">
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter password" required>
        <button type="submit" class="login-btn">LOGIN</button>
    </form>
    <div class="signup">
        Don't have an account? <a href="#">Sign Up</a>
    </div>
</div>
</body>
</html>
