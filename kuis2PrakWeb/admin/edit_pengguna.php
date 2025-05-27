<?php
include '../auth.php';
include '../koneksi.php';

$id = $_GET['id'] ?? 0;
$st = $conn->prepare("SELECT * FROM users WHERE id=?");
$st->bind_param("i", $id);
$st->execute();
$res = $st->get_result();
$row = $res->fetch_assoc();

if (!$row) die("Pengguna tidak ditemukan.");

$info = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = trim($_POST['username']);
  $role = $_POST['role'];
  $pass = $_POST['password'];

  if ($user !== '') {
    if ($pass !== '') {
      $hash = password_hash($pass, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("UPDATE users SET username=?, password=?, role=? WHERE id=?");
      $stmt->bind_param("sssi", $user, $hash, $role, $id);
    } else {
      $stmt = $conn->prepare("UPDATE users SET username=?, role=? WHERE id=?");
      $stmt->bind_param("ssi", $user, $role, $id);
    }
    $stmt->execute();
    $info = "Data berhasil diupdate.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Pengguna</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h4>Edit Pengguna</h4>
  <?php if ($info): ?><div class="alert alert-success"><?= $info ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label>Username</label>
      <input name="username" class="form-control" value="<?= htmlspecialchars($row['username']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Password (kosongkan jika tidak diganti)</label>
      <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
      <label>Role</label>
      <select name="role" class="form-select">
        <option value="pengguna" <?= $row['role']=='pengguna'?'selected':'' ?>>Pengguna</option>
        <option value="admin" <?= $row['role']=='admin'?'selected':'' ?>>Admin</option>
      </select>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
  </form>
</body>
</html>
