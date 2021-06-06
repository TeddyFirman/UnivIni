<?php
session_start();
require 'koneksi.php';

// CHECK USER IF LOGGED IN
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {

  $username = $_SESSION['username'];
  $get_user_data = mysqli_query($db_connection, "SELECT * FROM `login` WHERE username = '$username'");
  $userData =  mysqli_fetch_assoc($get_user_data);
} else {
  header('Location: logout.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="CSS/Style.CSS">
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
    <div class="Main Container">
      <!-- Mulai Konten Kiri -->
      <div class="Main Kiri">
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
        <img src="Images/UserImg/<?= $gambar ?>">
        <?php

        $sql = "SELECT nama, prodi
FROM biodata WHERE loginid = '{$_SESSION['userid']}'";

        $query = mysqli_query($db_connection, $sql);


        while ($row = mysqli_fetch_assoc($query)) {
          echo '<p>' . $row['nama'] . '</p>
    <p>' . $row['prodi'] . '</p>';
        }

        ?>
      </div>
      <!-- Akhir Konten Kiri -->
      <!-- Mulai Konten Tengah -->
      <div class="Main Tengah">
        <div class="Tengah-Atas">
          <h4>Perkuliahan :
            <?php
            date_default_timezone_set("Asia/Bangkok");
            ?>

            <script type="text/javascript">
              function date_time(id) {
                date = new Date;
                year = date.getFullYear();
                month = date.getMonth();
                months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                  'Agustus', 'September', 'Oktober', 'November', 'Desember');
                d = date.getDate();
                day = date.getDay();
                days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
                h = date.getHours();
                if (h < 10) {
                  h = "0" + h;
                }
                m = date.getMinutes();
                if (m < 10) {
                  m = "0" + m;
                }
                s = date.getSeconds();
                if (s < 10) {
                  s = "0" + s;
                }
                result = '' + days[day] + ' ' + d + ' ' + months[month] + ' ' + year;
                document.getElementById(id).innerHTML = result;
                setTimeout('date_time("' + id + '");', '1000');
                return true;
              }
            </script>

            <span id="date_time"></span>
            <script type="text/javascript">
              window.onload = date_time('date_time');
            </script>
          </h4>
          <div class="List-Reminder">
            <?php

            $sql = "SELECT matkul, dosen FROM krs WHERE loginid = '{$_SESSION['userid']}'";

            $query = mysqli_query($db_connection, $sql);


            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <?php
              echo '<div class="Reminder">';

              echo '<div class="Matkul">' . $row['matkul'] .'</div>
              <div class="Dosen">' . $row['dosen'] . '</div>
              </div>';
            }
            ?>
          </div>
        </div>
        <div class="Tengah-Bawah">
          <h4>Today Article</h4>
          <div class="Slideshow-Container">
            <div class="Slides Fade">
              <div class="TitleText">
                <h2>REMEMBER YOU</h2>
              </div>
              <img src="Images/Thumbnails/Gambar-1.PNG" style="width:100%">
              <div class="Text">
                <p>Sebuah landing page yang dibuat dari HTML,CSS dan Javascript yang berfungsi untuk sebagai jam pengingat serta ada kata-kata mutiara di dalam webnya.</p><a href="https://teddyfirman.github.io/Pengingat/">Read More...</a>
              </div>
            </div>
            <div class="Slides Fade">
              <div class="TitleText">
                <h2>FAMILY PTI19 B</h2>
              </div>
              <img src="Images/Thumbnails/Gambar-2.PNG" style="width:100%">
              <div class="Text">
                <p>Sebuah Home Page dari sebuah web Kelas Pendidikan Teknologi Informasi 2019 B dari Jurusan Teknik Informatika Fakultas Teknik Universitas Ini.</p><a href="https://pti19b.github.io/">Read More...</a>
              </div>
            </div>
            <div class="Slides Fade">
              <div class="TitleText">
                <h2>SAKECY</h2>
              </div>
              <img src="Images/Thumbnails/Gambar-3.PNG" style="width:100%">
              <div class="Text">
                <p>Sebuah web karya mahasiswa Universitas Ini yang menjuarai lomba web pada tahun 2019.</p><a href="https://teddyfirman.github.io/sakecy/">Read More...</a>
              </div>
            </div>
            <a class="Prev" onclick="plusSlide(-1)">&#10094;</a>
            <a class="Next" onclick="plusSlide(1)">&#10095;</a>
          </div>
          <div style="text-align:center">
            <span class="Dot" onclick="currentSlide(1)"></span>
            <span class="Dot" onclick="currentSlide(2)"></span>
            <span class="Dot" onclick="currentSlide(3)"></span>
          </div>
        </div>
      </div>
      <!-- Akhir Konten Tengah -->
      <!-- Awal Konten Kanan -->
      <div class="Main Kanan">
        <h4>Daftar Teman</h4>
        <div class="List Teman">
          <?php

          $sql = "SELECT *
          FROM teman ";

          $query = mysqli_query($db_connection, $sql);
          ?>

          <?php while ($row = mysqli_fetch_array($query)) : ?>

            <div class="Teman">
              <img src="Images/Teman/<?= $row['foto'] ?>">
              <div class="Label"><a href="#Teman-1"><?= $row['nama'] ?></a></div>
            </div>
          <?php endwhile; ?>

        </div>
      </div>
      <!-- Akhir Konten Kanan -->
    </div>
    <!-- Akhir Konten -->
  </main>
</body>
<script src="Javascript/JavaScript.JS">
</script>
<script src="Javascript/JavaScript_Base.JS"></script>

</html>