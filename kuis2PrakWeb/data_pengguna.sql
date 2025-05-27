-- Membuat database jika belum ada
CREATE DATABASE IF NOT EXISTS `data_pengguna` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `data_pengguna`;

-- Membuat tabel users
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'pengguna') NOT NULL DEFAULT 'pengguna',
  `profile_picture` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Menambahkan data ke tabel users
INSERT INTO `users` (`id`, `username`, `password`, `role`, `profile_picture`) VALUES
(1, 'admin','$2y$10$e22gQE0cETlpNW8RoCOyVe3BfMGrQMcB94Kx/XjHfIli4rGF6jHZi', 'admin', NULL),
(28, 'ady','$2y$10$I7nVJaI7XQlBcluZ9ZBcc.aNkDfoFoNuVHRRh6OYwa6QFrapX0SH2', 'pengguna', '6835a7cabf33.jpg'),
(30, 'okta','$2y$10$.j2/PDjDogM9T2TKNQtMGOPdvCkpaDlCqc9Z8OveOkAdMIsr.nAy.', 'pengguna', '6835a96c5d58a.jpg'),
(31, 'Lita','$2y$10$EZ8ludfrPY7983X86IPXmeNQr4Jut6EPw5BFkVG5YwXbZGDN2w.C6', 'pengguna', NULL),
(32, 'Syafira','$2y$10$M9HRwqcqZkfMMCjKzrvSP.H.GeXqr7JTjU3bNCW/gE.vAbYlKUY2m', 'pengguna', '6835ab216c56e.jpg');

-- Menyimpan perubahan
COMMIT;
