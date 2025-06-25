<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit;
}

$bmi = null;
$kategori = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $berat = floatval($_POST['berat']);
  $tinggi_cm = floatval($_POST['tinggi']);
  $tinggi_m = $tinggi_cm / 100;

  if ($tinggi_m > 0) {
    $bmi = $berat / ($tinggi_m * $tinggi_m);
    $bmi = round($bmi, 1);

    // Tentukan kategori
    if ($bmi < 18.5) {
      $kategori = "Kurus";
    } elseif ($bmi < 25) {
      $kategori = "Normal";
    } elseif ($bmi < 30) {
      $kategori = "Gemuk";
    } else {
      $kategori = "Obesitas";
    }

    // Simpan ke database
    $user_id = $_SESSION['user_id'];
    $hasil = "BMI Anda: $bmi ($kategori)";
    $koneksi = new mysqli("localhost", "root", "", "healthy_heart");

    if (!$koneksi->connect_error) {
      $stmt = $koneksi->prepare("INSERT INTO hasil_cek (user_id, jenis_cek, hasil) VALUES (?, 'BMI', ?)");
      $stmt->bind_param("is", $user_id, $hasil);
      $stmt->execute();
      $stmt->close();
      $koneksi->close();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cek BMI</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <div class="cek-container">
    <h2 class="cek-title">Cek BMI (Body Mass Index)</h2>
    <p class="cek-description">Masukkan berat dan tinggi badan Anda untuk mengetahui status berat badan.</p>

    <!-- FORM BMI -->
    <form method="post" class="bmi-form">
      <label for="berat">Berat Badan (kg):</label>
      <input type="number" name="berat" id="berat" required step="0.1">

      <label for="tinggi">Tinggi Badan (cm):</label>
      <input type="number" name="tinggi" id="tinggi" required step="0.1">

      <button type="submit" class="cek-button center-button">Hitung BMI</button>
    </form>

    <!-- HASIL -->
    <?php if ($bmi): ?>
      <div class="bmi-result">
        <h3>Hasil BMI Anda:</h3>
        <p><strong><?= $bmi ?></strong> - <?= $kategori ?></p>
      </div>
    <?php endif; ?>
  </div>

  <?php include '../includes/footer.php'; ?>
</body>
</html>
