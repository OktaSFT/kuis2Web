<?php
session_start();
include 'koneksi.php';

$pesanError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameInput = $_POST['username'] ?? '';
    $passwordInput = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $usernameInput);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($passwordInput, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] === 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: pengguna/dashboard.php");
            }
            exit;
        } else {
            $pesanError = 'Password yang dimasukkan salah.';
        }
    } else {
        $pesanError = 'Username tidak terdaftar.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {background:#f8f9fa}
        .login-box{max-width:400px;margin:90px auto;padding:2rem;border-radius:1rem;
                   box-shadow:0 0 15px rgba(0,0,0,.1);background:#fff}
    </style>
</head>
<body>
<div class="login-box">
    <h4 class="text-center mb-4">Masuk ke Aplikasi</h4>
    <?php if ($pesanError): ?>
        <div class="alert alert-danger"><?= $pesanError ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label>Username</label>
            <input name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100">Login</button>
    </form>
    <p class="text-center mt-3">Belum punya akun? <a href="register.php">Daftar</a></p>
</div>
</body>
</html>
