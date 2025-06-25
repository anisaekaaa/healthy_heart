<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // kosongkan jika kamu belum set password di XAMPP
$db   = 'healthy_heart'; // nama database kamu

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
  die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
