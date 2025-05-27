<?php
include '../auth.php';
include '../koneksi.php';

$id = $_SESSION['id'];
$data = $conn->query("SELECT * FROM users WHERE id = $id");
$user = $data->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Pengguna</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h3>Halo, <?= htmlspecialchars($user['username']) ?></h3>
  <p>Role: <?= $user['role'] ?></p>

  <div class="mb-3">
    <?php if ($user['profile_picture']): ?>
      <img src="../uploads/<?= $user['profile_picture'] ?>" width="100" class="mb-2"><br>
      <a href="hapus_foto.php" class="btn btn-danger btn-sm" onclick="return confirm('Hapus foto?')">Hapus Foto</a>
    <?php else: ?>
      <p>Belum ada foto.</p>
    <?php endif; ?>
  </div>

  <a href="upload_foto.php" class="btn btn-primary">Upload Foto</a>
  <a href="edit_profile.php" class="btn btn-warning">Edit Profil</a>
  <a href="../logout.php" class="btn btn-secondary">Keluar</a>
</body>
</html>
