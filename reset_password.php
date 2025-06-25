<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "healthy_heart");
$pesan = "";

// Ambil username dari URL
$username = isset($_GET['u']) ? trim($_GET['u']) : '';

if (empty($username)) {
  header("Location: lupa_password.php");
  exit;
}

// Proses form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $password = $_POST['password'];
  $konfirmasi = $_POST['konfirmasi'];

  if (empty($password) || empty($konfirmasi)) {
    $pesan = "Password tidak boleh kosong.";
  } elseif ($password !== $konfirmasi) {
    $pesan = "Password dan konfirmasi tidak cocok.";
  } else {
    // Hash dan update password
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $koneksi->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $hash, $username);

    if ($stmt->execute()) {
      $pesan = "Password berhasil diubah. <a href='index.php'>Login sekarang</a>.";
    } else {
      $pesan = "Gagal mengubah password.";
    }

    $stmt->close();
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Reset Password - Healthy Heart</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="daftar-page">
  <div class="form-wrapper">
    <h2>Reset Password</h2>
    <?php if (!empty($pesan)) echo "<div class='pesan'>$pesan</div>"; ?>
    <form method="POST" action="">
      <input type="password" name="password" placeholder="Password Baru" required>
      <input type="password" name="konfirmasi" placeholder="Konfirmasi Password" required>
      <button type="submit">Simpan Password</button>
    </form>
    <p class="login-link">Kembali ke <a href="index.php">Login</a></p>
  </div>
</body>
</html>
