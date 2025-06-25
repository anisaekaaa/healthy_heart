<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$koneksi = new mysqli("localhost", "root", "", "healthy_heart");

$hasil_cek = [];
if (!$koneksi->connect_error) {
  $stmt = $koneksi->prepare("SELECT jenis_cek, hasil, tanggal FROM hasil_cek WHERE user_id = ? ORDER BY tanggal DESC");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $hasil_cek[] = $row;
  }
  $stmt->close();
  $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Cek</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <div class="cek-container">
    <h2 class="cek-title">Riwayat Hasil Pemeriksaan Anda</h2>
    <p class="cek-description">Berikut adalah hasil pengecekan BMI, stres, dan kecemasan Anda.</p>

    <?php if (count($hasil_cek) > 0): ?>
      <div class="hasil-grid">
        <?php foreach ($hasil_cek as $item):
          $jenis = $item['jenis_cek'];
          $ikon = $jenis === 'BMI' ? '❤️' : ($jenis === 'Stres' ? '🧠' : '⚖️');
          $warna = $jenis === 'BMI' ? 'bmi' : ($jenis === 'Stres' ? 'stres' : 'cemas');
          
          // Ekstrak kategori dari hasil string
          preg_match('/\((.*?)\)/', $item['hasil'], $match);
          $kategori = $match[1] ?? '';
        ?>
          <div class="hasil-card <?= $warna ?>">
            <div class="hasil-header">
              <span class="hasil-ikon"><?= $ikon ?></span>
              <h4><?= htmlspecialchars($jenis) ?></h4>
            </div>
            <p><?= htmlspecialchars($item['hasil']) ?></p>
            <span class="badge <?= strtolower($kategori) ?>"><?= $kategori ?></span>
            <span class="hasil-tanggal"><?= date('d M Y, H:i', strtotime($item['tanggal'])) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p style="text-align:center; margin-top:40px;">Belum ada hasil yang tersedia.</p>
    <?php endif; ?>
  </div>

  <?php include '../includes/footer.php'; ?>
</body>
</html>
