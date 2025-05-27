<?php
include '../auth.php';
include '../koneksi.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$err = $ok = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';
    $r = $_POST['role'] ?? 'pengguna';

    if ($u === '' || $p === '') {
        $err = 'Semua field wajib diisi.';
    } else {
        $cek = $conn->prepare("SELECT id FROM users WHERE username=?");
        $cek->bind_param("s", $u);
        $cek->execute();
        $cek->store_result();

        if ($cek->num_rows) {
            $err = 'Username sudah digunakan.';
        } else {
            $hash = password_hash($p, PASSWORD_DEFAULT);
            $ins  = $conn->prepare("INSERT INTO users (username,password,role) VALUES (?,?,?)");
            $ins->bind_param("sss", $u, $hash, $r);
            $ins->execute();
            $ok  = 'Pengguna berhasil ditambahkan.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<h4>Tambah Pengguna</h4>
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
        <label>Role</label>
        <select name="role" class="form-select" required>
            <option value="pengguna">Pengguna</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <button class="btn btn-primary">Tambah</button>
    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
</form>
</body>
</html>
