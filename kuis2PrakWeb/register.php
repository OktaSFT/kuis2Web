<?php
include 'koneksi.php';

$err = $ok = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';
    $c = $_POST['confirm']  ?? '';

    if ($u === '' || $p === '') {
        $err = 'Semua field wajib diisi.';
    } elseif ($p !== $c) {
        $err = 'Password & konfirmasi tidak sama.';
    } else {
        $cek = $conn->prepare("SELECT id FROM users WHERE username=?");
        $cek->bind_param("s", $u);
        $cek->execute();
        $cek->store_result();

        if ($cek->num_rows) {
            $err = 'Username sudah digunakan.';
        } else {
            $hash = password_hash($p, PASSWORD_DEFAULT);
            $role = 'pengguna';
            $ins  = $conn->prepare("INSERT INTO users (username,password,role) VALUES (?,?,?)");
            $ins->bind_param("sss", $u, $hash, $role);
            $ins->execute();
            $ok  = 'Berhasil! Silakan login.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{background:#f0f2f5}
        .register-box{max-width:450px;margin:90px auto;padding:2rem;background:#fff;
                      border-radius:1rem;box-shadow:0 0 15px rgba(0,0,0,.1)}
    </style>
</head>
<body>
<div class="register-box">
    <h4 class="text-center mb-4">Buat Akun Baru</h4>
    <?php if ($err): ?><div class="alert alert-danger"><?= $err ?></div><?php endif; ?>
    <?php if ($ok ): ?><div class="alert alert-success"><?= $ok  ?></div><?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label>Username</label>
            <input name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="confirm" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100">Daftar</button>
    </form>
    <p class="text-center mt-3">Sudah punya akun? <a href="index.php">Login</a></p>
</div>
</body>
</html>
