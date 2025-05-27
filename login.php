<?php
session_start();
include 'db.php';

$pesan = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];


  $username = mysqli_real_escape_string($conn, $username);
  $password = mysqli_real_escape_string($conn, $password);

  $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

  if (mysqli_num_rows($result) == 1) {
    $_SESSION['username'] = $username;
    header('Location: index.php');
    exit;
  } else {
    $pesan = "❌ Akun tidak ditemukan. Silakan daftar terlebih dahulu.";
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="../Web-Dev/style.css">
</head>

<body>
  <div class="card">
    <h2>Login</h2>

    <?php if ($pesan): ?>
      <div class="error"><?= $pesan ?></div>
      <p>Belum punya akun? <a href="register.php">Daftar Sekarang</a></p>
    <?php endif; ?>

    <form method="post" action="">
      <input name="username" placeholder="Masukkan Username" required>
      <input type="password" name="password" placeholder="Masukkan Username" required>
      <input type="submit" value="Login">
    </form>
    <p>Jika belum punya akun <a href="register.php">Daftar</a> </p>
    <p><a href="../Web-Dev/index.html">Kembali ke Beranda</a></p>
  </div>
</body>

</html>