<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Healthy Heart</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-page">
  <div class="login-wrapper">
    <!-- BAGIAN KIRI -->
    <div class="login-left">
      <img src="pictures\icon_login.png" alt="Gambar Login">
      <h1>WELCOME TO HEALTHY HEART</h1>
      <p>Healthy Heart adalah aplikasi untuk mendeteksi dan memantau tingkat stres 
        agar kamu bisa menjaga kesehatan jiwa secara mandiri dan lebih sadar akan kondisi emosionalmu.</p>
    </div>

    <!-- BAGIAN KANAN -->
    <div class="login-right">
      <h2>USER LOGIN</h2>
      <form action="proses/login.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <div class="login-options">
          <label><input type="checkbox" name="remember"> Remember me</label>
          <a href="lupa_password.php">Forgot password?</a>
        </div>

        <button type="submit">LOGIN</button>
        <p class="register-link">
          Belum punya akun? <a href="daftar.php">Daftar!</a>
        </p>
      </form>
    </div>
  </div>
</body>
</html>
