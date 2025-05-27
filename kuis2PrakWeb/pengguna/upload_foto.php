<?php
include '../auth.php';
include '../koneksi.php';

$id = $_SESSION['id'];
$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
  $nama = $_FILES['foto']['name'];
  $tmp = $_FILES['foto']['tmp_name'];
  $ekst = strtolower(pathinfo($nama, PATHINFO_EXTENSION));

  if (in_array($ekst, ['jpg', 'jpeg', 'png'])) {
    $nama_baru = uniqid() . '.' . $ekst;
    move_uploaded_file($tmp, "../uploads/$nama_baru");

    // hapus lama
    $lama = $conn->query("SELECT profile_picture FROM users WHERE id=$id")->fetch_assoc();
    if ($lama['profile_picture'] && file_exists("../uploads/{$lama['profile_picture']}")) {
      unlink("../uploads/{$lama['profile_picture']}");
    }

    $stmt = $conn->prepare("UPDATE users SET profile_picture=? WHERE id=?");
    $stmt->bind_param("si", $nama_baru, $id);
    $stmt->execute();

    $pesan = "Foto berhasil diupload.";
  } else {
    $pesan = "Format tidak didukung.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Upload Foto</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h4>Upload Foto Profil</h4>
  <?php if ($pesan): ?><div class="alert alert-info"><?= $pesan ?></div><?php endif; ?>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png" required>
    </div>
    <button class="btn btn-primary">Upload</button>
    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
  </form>
</body>
</html>
