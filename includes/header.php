<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'User';
$inisial = strtoupper(substr($nama, 0, 1));
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Healthy Heart</title>
  <!-- CSS Global, aman di semua halaman -->
  <link rel="stylesheet" href="/healthy_heart/css/style.css">
</head>
<body>
  <header class="navbar">
    <div class="navbar-container">

      <!-- Logo Tulisan -->
      <div class="navbar-logo-text">
        <a href="/healthy_heart/dashboard.php">HEALTHY HEART</a>
      </div>

      <!-- Navigasi -->
      <nav class="navbar-menu">
        <ul>
          <li><a href="/healthy_heart/dashboard.php">Home</a></li>
          <li><a href="/healthy_heart/pages/cek.php">Cek</a></li>
          <li><a href="/healthy_heart/pages/hasil_cek.php">Hasil</a></li>
          <li><a href="/healthy_heart/proses/logout.php" class="logout">Logout</a></li>
        </ul>
      </nav>

      <!-- Inisial User -->
      <div class="navbar-user">
        <?= $inisial ?>
      </div>

    </div>
  </header>
