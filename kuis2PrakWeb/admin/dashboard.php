<?php
include '../auth.php';
include '../koneksi.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$data = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<h3>Halo Admin, <?= htmlspecialchars($_SESSION['username']) ?></h3>
<a href="../logout.php" class="btn btn-danger mb-3">Logout</a>

<a href="tambah_pengguna.php" class="btn btn-primary mb-3">Tambah Pengguna</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Profile Picture</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $data->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= $row['role'] ?></td>
            <td>
                <?php if ($row['profile_picture']): ?>
                    <img src="../uploads/<?= $row['profile_picture'] ?>" width="50" alt="Foto Profil">
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
            <td>
                <a href="edit_pengguna.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="hapus_pengguna.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pengguna ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>
