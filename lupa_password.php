<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "healthy_heart");
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);

  if (empty($username)) {
    $pesan = "Silakan masukkan username Anda.";
  } else {
    $cek = $koneksi->prepare("SELECT id FROM users WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
      // Redirect ke halaman reset password
      header("Location: reset_password.php?u=" . urlencode($username));
      exit;
    } else {
      $pesan = "Username tidak ditemukan.";
    }

    $cek->close();
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password - Healthy Heart</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="daftar-page">
  <div class="form-wrapper">
    <h2>Lupa Password?</h2>
    <?php if (!empty($pesan)) echo "<div class='pesan'>$pesan</div>"; ?>
    <form method="POST" action="">
      <input type="text" name="username" placeholder="Masukkan Username Anda" required>
      <button type="submit">Lanjut</button>
    </form>
    <p class="login-link">Sudah ingat password? <a href="index.php">Login!</a></p>
  </div>
</body>
</html>
