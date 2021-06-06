<?php
session_start();
require 'koneksi.php';
require 'prokrs.php';
require 'prokrsu.php';


// CHECK USER IF LOGGED IN
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {

  $username = $_SESSION['username'];
  $userid = (int) $_SESSION['userid'];
  $get_user_data = mysqli_query($db_connection, "SELECT * FROM `login` WHERE username = '$username'");
  $userData =  mysqli_fetch_assoc($get_user_data);
} else {
  header('Location: KRS.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/6088b6ddd3.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="CSS/style.CSS">
  <link rel="icon" href="Images/Icon.png">
  <title>Universitas Ini</title>
</head>

<body>
  <!-- Mulai Navbar -->
  <header>
    <nav class="Navbar" id="Navbar">
      <div class="Logo">
        <h2>Universitas Ini</h2>
      </div>
      <ul class="Navbar-Menu">
        <li class="Navbar-Item"><a href="beranda.php">Beranda</a></li>
        <li class="Navbar-Item"><a href="mahasiswa.php">Data Mahasiswa</a></li>
        <li class="Navbar-Item"><a href="transkrip.php">Transkrip Niai</a></li>
        <li class="Navbar-Item"><a href="UKT.php">Informasi UKT</a></li>
        <li class="Navbar-Item"><a href="KRS.php">KRS Online</a></li>
        <li class="Navbar-Item"><a href="logout.php">Logout</a></li>
      </ul>
      <div class="Burger-Menu">
        <div class="Icon-Open Fade"><img src="Images/Icon/Open-Menu.PNG"></div>
        <div class="Icon-Close Fade"><img src="Images/Icon/Close-Menu.PNG"></div>
      </div>
    </nav>
  </header>
  <!-- Akhir Navbar -->
  <!-- Mulai Content -->
  <main>
    <div class="Container KRS">
      <div class="KRS-Atas">
        <div class="KRS-Biodata">
          <p>Nama Mahasiswa</p>
          <p>NIM</p>
          <p>Prodi</p>
          <p>Angkatan</p>
        </div>

        <div class="KRS-Biodata">
          <?php

          $sql = "SELECT nama, nim, prodi, angkatan
FROM biodata WHERE loginid = '$userid'";

          $query = mysqli_query($db_connection, $sql);


          while ($row = mysqli_fetch_array($query)) {
            echo '<p>' . $row['nama'] . '</p>
    <p>' . $row['nim'] . '</p>
    <p>' . $row['prodi'] . '</p>
    <p>' . $row['angkatan'] . '<p>';
          }

          ?>
        </div>

        <div class="KRS-Photo">
        <?php
        $userid = (int) $_SESSION['userid'];
        $sql = "SELECT gambar FROM biodata WHERE loginid = '$userid'";

        $query = mysqli_query($db_connection, $sql);


        $row = mysqli_fetch_assoc($query);
        if ($row || $row['gambar'] != '') {
          $gambar = $row['gambar'];
        } else {
          $gambar = 'Default.png';
        } ?>
          <img class="" src="Images/UserImg/<?= $gambar ?>">
        </div>
      </div>
      <div class="KRS-Bawah">
        <div class="KRS-Kiri">
          <h4>Kelas Yang Tersedia</h4>
          <form onload="window.location.reload()" method="POST" id="List-KRS">
            <ul class="Checkbox-List">
              <li><input autocomplete="off" type="checkbox" name="matkul[]" value="Pemograman Web"><label for="checkbox">Pemograman Web</label></li>
              <li><input autocomplete="off" type="checkbox" name="matkul[]" value="Matematika Diskrit"><label for="checkbox">Matematika Diskrit</label></li>
              <li><input autocomplete="off" type="checkbox" name="matkul[]" value="Keterampilan Mengajar & Pembalajaran Mikro"><label for="checkbox">Keterampilan Mengajar & Pembelajaran Mikro</label></li>
              <li><input autocomplete="off" type="checkbox" name="matkul[]" value="Bahasa Inggris Lanjut"><label for="checkbox">Bahasa Inggris Lanjut</label></li>
              <li><input autocomplete="off" type="checkbox" name="matkul[]" value="Jaringan Komputer"><label for="checkbox">Jaringan Komputer</label></li>
              <li><input autocomplete="off" type="checkbox" name="matkul[]" value="Rekayasa Perangkat Lunak"><label for="checkbox">Rekayasa Perangkat Lunak</label></li>
              <li><input autocomplete="off" type="checkbox" name="matkul[]" value="Teknik Komputasi"><label for="checkbox">Teknik Komputasi</label></li>
              <li><input autocomplete="off" type="checkbox" name="matkul[]" value="Analisis & Perancangan Sistem"><label for="checkbox">Analisis & Perancangan Sistem</label></li>
            </ul>
            <!-- Checkbox Hanya Dapat Dipilih Salah Satu -->
            <script>
            $(document).ready(function() {
                $('input:checkbox').click(function() {
                    $('input:checkbox').not(this).prop('checked', false).end();
                });
            });
            </script>
            <!-- Web Tidak Melakukan Resubmission -->
            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
          <?php

          $sql = "SELECT *
          FROM krs WHERE loginid = '$userid'";

            $query = mysqli_query($db_connection, $sql);
            if ($query->num_rows>0)
              echo '<input class="Button-Forms" autocomplete="off" type="submit" name="btn" value="Update">';
            else echo '<input class="Button-Forms" autocomplete="off" type="submit" name="btn" value="Simpan">';

            if (isset($success_message)) {
              echo '<div class="success_message">' . $success_message . '</div>';
            }
            if (isset($error_message)) {
              echo '<div class="error_message">' . $error_message . '</div>';
            }
          ?>

        </div>
        </form>
        <div class="KRS-Kanan">
          <h4>Kelas Yang Diambil</h4>
          <?php

            $sql = "SELECT matkul
            FROM krs WHERE loginid = '$userid'";

            $query = mysqli_query($db_connection, $sql);
          ?>

          <?php if($query->num_rows>0) : ?>

            <?php while ($row = mysqli_fetch_array($query)) : ?>
              <ul class="Checkbox-List">
                <li class="Item-KRS"><?= $row['matkul'] ?></li>
              </ul>
              <?php endwhile ?>
          <?php else : ?>

          <?php endif ?>   
        </div>
      </div>
    </div>
  </main>
</body>
<script src="JavaScript/JavaScript_Base.JS">
</script>

</html>