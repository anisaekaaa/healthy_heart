<?php
session_start();
include '../koneksi.php'; // Pastikan file koneksi.php ada di root folder

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Cek user berdasarkan username
$query = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Jika user ditemukan
if ($data = mysqli_fetch_assoc($result)) {
    // Verifikasi password yang di-hash
    if (password_verify($password, $data['password'])) {
        // Set session login
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['nama'] = $data['nama_lengkap'];
        header('Location: ../dashboard.php'); // Redirect ke dashboard
        exit;
    } else {
        // Password salah
        echo "<script>alert('Password salah!'); window.location.href='../index.php';</script>";
    }
} else {
    // Username tidak ditemukan
    echo "<script>alert('Username tidak ditemukan!'); window.location.href='../index.php';</script>";
}
?>
