<?php
session_start();
include 'db.php';

$pesan = '';
$username = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
  if (mysqli_num_rows($cek) > 0) {
    $pesan = "Username sudah digunakan. Silakan pilih yang lain.";
  }
  elseif (
    strlen($password) < 8 ||
    !preg_match('/[a-z]/', $password) ||
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[\W]/', $password)
  ) {
    $pesan = "Password tidak valid.";
  }
  else {
    mysqli_query($conn, "INSERT INTO users(username, password) VALUES('$username','$password')");
    echo "<p>✅ Registrasi berhasil. <a href='login.php'>Login sekarang</a></p>";
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="card">
    <h2>Registrasi Siswa</h2>

    <?php if ($pesan): ?>
      <div class="error"><?= $pesan ?></div>
    <?php endif; ?>

    <form method="post">
      <label>Username:</label>
      <input name="username" value="<?= htmlspecialchars($username) ?>" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <div class="rules">
        <p><strong>Password harus:</strong></p>
        <ul>
          <li>1. Minimal 8 karakter</li>
          <li>2. Ada huruf kecil (a–z)</li>
          <li>3. Ada huruf besar (A–Z)</li>
          <li>4. Ada simbol (! @ # $ % dll)</li>
        </ul>
      </div>

      <input type="submit" value="Daftar">
    </form>
    <p>Sudah punya akun? <a href="login.php">Login Sekarang</a></p>
    <p><a href="index.php">Kembali ke Beranda</a></p>
  </div>
</body>
</html>
