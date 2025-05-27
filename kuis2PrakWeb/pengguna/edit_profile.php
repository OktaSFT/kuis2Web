<?php
include '../auth.php';
include '../koneksi.php';

$id = $_SESSION['id'];
$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = trim($_POST['username']);
  $pass = $_POST['password'];

  if ($user !== '') {
    if ($pass !== '') {
      $hash = password_hash($pass, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("UPDATE users SET username=?, password=? WHERE id=?");
      $stmt->bind_param("ssi", $user, $hash, $id);
    } else {
      $stmt = $conn->prepare("UPDATE users SET username=? WHERE id=?");
      $stmt->bind_param("si", $user, $id);
    }
    $stmt->execute();
    $pesan = "Profil berhasil diperbarui.";
  }
}

$user = $conn->query("SELECT * FROM users WHERE id = $id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Profil</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h4>Edit Profil</h4>
  <?php if ($pesan): ?><div class="alert alert-success"><?= $pesan ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label>Username</label>
      <input name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Password (kosongkan jika tidak diganti)</label>
      <input type="password" name="password" class="form-control">
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
  </form>
</body>
</html>
