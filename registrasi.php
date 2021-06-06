<?php
session_start();
require 'koneksi.php';
require 'inputan.php';
// IF USER LOGGED IN
if(isset($_SESSION['username'])){
header('Location: beranda.php');
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/login.css">
    <title>Universitas Ini</title>
</head>
<body>
  <div class="container-login">
    <h2>Universitas Ini</h2>
    <form class="form login" action="" method="post">
      <div class="input-container">
        <input class="input-field" type="text" name="email" placeholder="Email">
      </div>
      <div class="input-container">
        <input class="input-field" type="text" name="username" placeholder="Username">
      </div>
      <div class="input-container">
        <input class="input-field" type="password" name="password" placeholder="Password">
      </div>
      <button type="submit" class="button" name="registrasi">Registrasi</button>
      <?php
if(isset($success_message)){
echo '<div class="success_message">Registrasi Berhasil</div>';
}
if(isset($error_message)){
echo '<div class="error_message">Silahkan Isi Semua Form Yang Diperlukan</div>';
}
?>
      <p>Sudah Memiliki Akun?<a href="index.php"> Masuk</a></p>
    </form>
  </div>
</body>
<script src="JavaScript/JavaScript.js"></script>
</html>
