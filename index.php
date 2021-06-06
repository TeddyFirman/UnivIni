<?php
session_start();
require 'koneksi.php';
require 'login.php';
// IF USER LOGGED IN
if(isset($_SESSION['username'])){
header('location: beranda.php');
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="CSS/login.css">
        <link rel="icon" href="Images/Icon.png">
        <title>Universitas Ini</title>
    </head>

    <body>
        <div class="container-login">
            <h2>Universitas Ini</h2>
            <form class="form login" action="index.php" method="post">
                <div class="input-container">
                    <input class="input-field" type="text" name="username" placeholder="Username">
                </div>
                <div class="input-container">
                    <input class="input-field" type="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="button">Masuk</button>
                <?php
                if(isset($success_message)){
                echo '<div class="success_message">Login Berhasil</div>';
                }
                if(isset($error_message)){
                echo '<div class="error_message">Silahkan Isi Semua Form Yang Diperlukan</div>';
                }
                ?>
                <p>Belum Memiliki Akun?<a href="registrasi.php"> Registrasi</a></p>
            </form>
        </div>
    </body>
    <script src="Javascript/Javascript.js"></script>
</html>