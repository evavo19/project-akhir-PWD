<?php 
session_start(); 
include 'session.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Beranda Les SD</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="card">
    <h2>Halo, <?= htmlspecialchars($_SESSION['username']) ?> 👋</h2>
    <p>Selamat datang di portal belajar Les SD. Silakan pilih menu di bawah ini:</p>

    <div class="menu-links">
      <a href="materi.php" class="btn">📚 Lihat Materi</a>
      <a href="logout.php" class="btn logout">🚪 Logout</a>
    </div>
  </div>

</body>
</html>
