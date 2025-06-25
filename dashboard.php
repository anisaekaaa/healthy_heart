<?php
// dashboard.php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit;
}

include 'includes/header.php';
?>

<div class="dashboard-container">
  <div class="dashboard-content">
    <div class="dashboard-left">
      <h1 class="dashboard-title">HEALTHY HEART</h1>
      <p class="dashboard-description">
        Healthy Heart adalah aplikasi untuk mendeteksi dan memantau tingkat stres agar kamu bisa menjaga kesehatan jiwa secara mandiri dan lebih sadar akan kondisi emosionalmu.
      </p>
    </div>
    <div class="dashboard-right">
      <img src="pictures/icon_hh.png" alt="Icon Healthy Heart" class="dashboard-image">
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
