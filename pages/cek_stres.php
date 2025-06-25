<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit;
}

$skor = null;
$kategori = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Total dari 10 pertanyaan
  $total = 0;
  for ($i = 1; $i <= 10; $i++) {
    $total += intval($_POST["q$i"]);
  }
  $skor = $total;

  // Kategori berdasarkan skor
  if ($skor <= 15) {
    $kategori = "Rendah";
  } elseif ($skor <= 25) {
    $kategori = "Sedang";
  } else {
    $kategori = "Tinggi";
  }

  // Simpan ke database
  $user_id = $_SESSION['user_id'];
  $hasil = "Skor Stres: $skor ($kategori)";
  $koneksi = new mysqli("localhost", "root", "", "healthy_heart");

  if (!$koneksi->connect_error) {
    $stmt = $koneksi->prepare("INSERT INTO hasil_cek (user_id, jenis_cek, hasil) VALUES (?, 'Stres', ?)");
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
  <title>Cek Stres</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <div class="cek-container">
    <h2 class="cek-title">Cek Tingkat Stres</h2>
    <p class="cek-description">Jawablah 10 pertanyaan berikut sesuai kondisi Anda selama seminggu terakhir.</p>

    <form method="post" class="stres-form">
      <?php
      $pertanyaan = [
        "Saya merasa gugup atau gelisah",
        "Saya kesulitan tidur di malam hari",
        "Saya merasa mudah marah",
        "Saya kesulitan berkonsentrasi",
        "Saya merasa tidak bersemangat",
        "Saya merasa cemas tanpa alasan yang jelas",
        "Saya merasa kewalahan dengan tugas harian",
        "Saya merasa detak jantung saya lebih cepat dari biasanya",
        "Saya merasa ingin menyendiri",
        "Saya merasa tertekan oleh situasi sekitar"
      ];

      foreach ($pertanyaan as $i => $text) {
        $no = $i + 1;
        echo "
        <div class='stres-question'>
          <label>$no. $text</label>
          <div class='scale-options'>
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
      <div class="bmi-result">
        <h3>Hasil Cek Stres:</h3>
        <p><strong><?= $skor ?></strong> - Tingkat Stres: <strong><?= $kategori ?></strong></p>
      </div>
    <?php endif; ?>
  </div>

  <?php include '../includes/footer.php'; ?>
</body>
</html>
