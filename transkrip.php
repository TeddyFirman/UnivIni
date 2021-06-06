<?php
session_start();

require 'trans.php';

// CHECK USER IF LOGGED IN
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){

$username = $_SESSION['username'];
$get_user_data = mysqli_query($db_connection, "SELECT * FROM `login` WHERE username = '$username'");
$userData =  mysqli_fetch_assoc($get_user_data);

$semester = 1;
if(isset($_GET['semester'])) $semester = (int) $_GET['semester'];

$userid = (int) $_SESSION['userid'];
$transkrips = ambilTranskripSemester($semester, $userid);


}else{
header('Location: transkrip.php');
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
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
  <div class="Transkrip Container">
    <div class="Box-Nama">
      <div class="Sisi-Kiri">
        <p>Nama Mahasiswa</p>
        <p>NIM</p>
        <p>Program Studi</p>
        <p>Jenis Kelamin</p>
      </div>
      <div class="Sisi-Kanan">
      <?php

$sql = "SELECT nama, nim, prodi, jk
FROM biodata WHERE loginid = '$userid'";

$query = mysqli_query($db_connection, $sql);


while ($row = mysqli_fetch_array($query))
{
	echo '<p>'.$row['nama'].'</p>
    <p>'.$row['nim'].'</p>
    <p>'.$row['prodi'].'</p>
    <p>'.$row['jk'].'<p>';
}

    ?>
      </div>
    </div>
    <div class="Box-Transkrip">
      <h4>Semester :
      <?=
      $semester
      ?>
      </h4>
      <table class="Main-Table">
        <tr class="Header-Table">
          <th class="Table-Row">No.</th>
          <th class="Table-Row">Nama Matakuliah</th>
          <th class="Table-Row">SKS</th>
          <th class="Table-Row">Nilai</th>
          <th class="Table-Row">Indeks</th>
        </tr>
        <?php
          if(count($transkrips) >0) {
        ?>
        <?php
          $i=1;
          foreach($transkrips as $transkrip) {
        ?>
        <tr class="Body-Table">
          <td class="Table-Row"><?= $i++ ?></td>
          <td class="Table-Row"> <?= $transkrip['matkul'] ?></td>
          <td class="Table-Row"><?= $transkrip['sks'] ?></td>
          <td class="Table-Row"> <?= $transkrip['nilai'] ?></td>
          <td class="Table-Row"><?= $transkrip['indeks'] ?></td>
        </tr>
        <?php
          }
        ?>
        <?php
          } else {
        ?>
        <tr class="Body-Table">
          <td class="Table-Row">-</td>
          <td class="Table-Row">-</td>
          <td class="Table-Row">-</td>
          <td class="Table-Row">-</td>
          <td class="Table-Row">-</td>
        </tr>
        <?php
          }
        ?>
      </table>
      <div class="Center-Pagination">
        <div class="Pagination">
          <a href="?semester=1" class="<?= $semester == 1 ? 'page-active': ''?>">1</a>
          <a href="?semester=2" class="<?= $semester == 2 ? 'page-active': ''?>">2</a>
          <a href="?semester=3" class="<?= $semester == 3 ? 'page-active': ''?>">3</a>
          <a href="?semester=4" class="<?= $semester == 4 ? 'page-active': ''?>">4</a>
          <a href="?semester=5" class="<?= $semester == 5 ? 'page-active': ''?>">5</a>
          <a href="?semester=6" class="<?= $semester == 6 ? 'page-active': ''?>">6</a>
          <a href="?semester=7" class="<?= $semester == 7 ? 'page-active': ''?>">7</a>
          <a href="?semester=8" class="<?= $semester == 8 ? 'page-active': ''?>">8</a>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- Akhir Konten -->
</body>
<script src="JavaScript/JavaScript_Base.js">
</script>
</html>
