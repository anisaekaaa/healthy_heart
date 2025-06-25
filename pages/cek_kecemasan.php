<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit;
}

$skor = null;
$kategori = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $total = 0;
  for ($i = 1; $i <= 10; $i++) {
    $total += intval($_POST["q$i"]);
  }
  $skor = $total;

  // Tentukan kategori kecemasan
  if ($skor <= 15) {
    $kategori = "Ringan";
  } elseif ($skor <= 25) {
    $kategori = "Sedang";
  } else {
    $kategori = "Berat";
  }

  // Simpan ke database
  $user_id = $_SESSION['user_id'];
  $hasil = "Skor Kecemasan: $skor ($kategori)";
  $koneksi = new mysqli("localhost", "root", "", "healthy_heart");

  if (!$koneksi->connect_error) {
    $stmt = $koneksi->prepare("INSERT INTO hasil_cek (user_id, jenis_cek, hasil) VALUES (?, 'Kecemasan', ?)");
    $stmt->bind_param("is", $user_id, $hasil);
    $stmt->execute();
    $stmt->close();
    $koneksi->close();
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cek Kecemasan</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <div class="cek-container">
    <h2 class="cek-title">Cek Tingkat Kecemasan</h2>
    <p class="cek-description">Jawablah 10 pertanyaan berikut berdasarkan kondisi Anda selama seminggu terakhir.</p>

    <form method="post" class="kecemasan-form">
      <?php
      $pertanyaan = [
        "Saya merasa khawatir berlebihan terhadap hal-hal kecil",
        "Saya sulit mengontrol rasa takut atau khawatir",
        "Saya mengalami detak jantung cepat tanpa sebab",
        "Saya merasa cemas saat berada di tempat umum",
        "Saya kesulitan untuk rileks",
        "Saya merasa ada sesuatu yang buruk akan terjadi",
        "Saya menghindari situasi yang membuat saya gugup",
        "Saya mengalami gangguan tidur karena cemas",
        "Saya mengalami sesak napas ketika cemas",
        "Saya tidak bisa berhenti merasa khawatir"
      ];

      foreach ($pertanyaan as $i => $text) {
        $no = $i + 1;
        echo "
        <div class='kecemasan-question'>
          <label>$no. $text</label>
          <div class='kecemasan-options'>
            <label><input type='radio' name='q$no' value='1' required> Tidak Pernah</label>
            <label><input type='radio' name='q$no' value='2'> Kadang-kadang</label>
            <label><input type='radio' name='q$no' value='3'> Sering</label>
            <label><input type='radio' name='q$no' value='4'> Selalu</label>
          </div>
        </div>";
      }
      ?>

      <button type="submit" class="cek-button center-btn">Kirim Jawaban</button>
    </form>

    <?php if ($skor): ?>
      <div class="bmi-result" style="margin-top: 30px;">
        <h3>Hasil Cek Kecemasan:</h3>
        <p><strong><?= $skor ?></strong> - Tingkat Kecemasan: <strong><?= $kategori ?></strong></p>
      </div>
    <?php endif; ?>
  </div>

  <?php include '../includes/footer.php'; ?>
</body>
</html>
