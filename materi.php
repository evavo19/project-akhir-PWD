<?php
session_start();
include 'session.php';
include 'db.php';

$kelas = isset($_GET['kelas']) ? (int)$_GET['kelas'] : 0;
$mapel = isset($_GET['mapel']) ? $_GET['mapel'] : '';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Materi</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="body-materi">
<a href="index.php" class="back">Kembali ke Beranda</a>

<h1 class="judul-halaman">Materi Pembelajaran</h1>

<section class="section-kelas">
  <h2 class="judul-subbagian">Pilih Kelas</h2>
  <div class="menu-kelas">
    <?php for ($i = 1; $i <= 6; $i++): ?>
      <a href="materi.php?kelas=<?= $i ?>" class="btn-kelas <?= ($kelas == $i) ? 'aktif' : '' ?>">Kelas <?= $i ?></a>
    <?php endfor; ?>
  </div>
</section>

<?php if ($kelas): ?>
  <section class="section-mapel">
    <h2 class="judul-subbagian">Mata Pelajaran untuk Kelas <?= $kelas ?></h2>
    <div class="menu-mapel">
      <?php
      $result_mapel = mysqli_query($conn, "SELECT DISTINCT mapel FROM materi WHERE kelas = $kelas");
      while ($m = mysqli_fetch_assoc($result_mapel)):
      ?>
        <a href="materi.php?kelas=<?= $kelas ?>&mapel=<?= urlencode($m['mapel']) ?>" class="btn-mapel <?= ($mapel == $m['mapel']) ? 'aktif' : '' ?>">
          <?= htmlspecialchars($m['mapel']) ?>
        </a>
      <?php endwhile; ?>
    </div>
  </section>
<?php endif; ?>

<?php if ($kelas && $mapel): ?>
  <section class="section-materi">
    <h2 class="judul-subbagian">Materi Kelas <?= $kelas ?> - <?= htmlspecialchars($mapel) ?></h2>
    <?php
    $result_materi = mysqli_query($conn, "SELECT * FROM materi WHERE kelas = $kelas AND mapel = '$mapel'");
    if (mysqli_num_rows($result_materi) == 0): ?>
      <p class="pesan-tidak-ada">Tidak ada materi tersedia.</p>
    <?php else: ?>
      <ul class="daftar-materi">
        <?php while ($row = mysqli_fetch_assoc($result_materi)): ?>
          <li class="item-materi">
            <strong class="judul-materi"><?= htmlspecialchars($row['judul']) ?></strong><br>
            <div class="konten-materi"><?= nl2br(htmlspecialchars($row['konten'])) ?></div>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
  </section>
<?php endif; ?>

</body>
</html>
