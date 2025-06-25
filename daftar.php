<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "healthy_heart");
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = trim($_POST['nama_lengkap']);
  $username = trim($_POST['username']);
  $password = $_POST['password'];
  $konfirmasi = $_POST['konfirmasi'];

  if (empty($nama) || empty($username) || empty($password) || empty($konfirmasi)) {
    $pesan = "Semua field harus diisi.";
  } elseif ($password !== $konfirmasi) {
    $pesan = "Password dan konfirmasi tidak cocok.";
  } else {
    $cek = $koneksi->prepare("SELECT id FROM users WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
      $pesan = "Username sudah digunakan.";
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $koneksi->prepare("INSERT INTO users (username, password, nama_lengkap) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $username, $hash, $nama);

      if ($stmt->execute()) {
        $pesan = "Pendaftaran berhasil. <a href='index.php'>Login di sini</a>.";
      } else {
        $pesan = "Terjadi kesalahan saat menyimpan data.";
      }

      $stmt->close();
    }

    $cek->close();
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Akun - Healthy Heart</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="daftar-page">
  <div class="form-wrapper">
    <h2>Daftar Akun</h2>
    <?php if (!empty($pesan)) echo "<div class='pesan'>$pesan</div>"; ?>
    <form method="POST" action="">
      <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= htmlspecialchars($_POST['nama_lengkap'] ?? '') ?>" required>
      <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="konfirmasi" placeholder="Konfirmasi Password" required>
      <button type="submit">Daftar</button>
    </form>
    <p class="login-link">Sudah punya akun? <a href="index.php">Login!</a></p>
  </div>
</body>
</html>
