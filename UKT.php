<?php
session_start();
require 'koneksi.php';
require 'pukt.php';

// CHECK USER IF LOGGED IN
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {

  $username = $_SESSION['username'];
  $get_user_data = mysqli_query($db_connection, "SELECT * FROM `login` WHERE username = '$username'");
  $userData =  mysqli_fetch_assoc($get_user_data);

  $userid = (int) $_SESSION['userid'];
  $pukts = ambilUkt($userid);
} else {
  header('Location: UKT.php');
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
  <script src="./Javascript/currencyformater.js"> </script>
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
    <div class="Container-Informasi">
      <div class="Total">
        <div class="Total-Kiri">
          <p class="Lunas">Total Tagihan UKT Lunas</p>


          <?php

          $sql = "SELECT SUM(lunas) as lunas
          FROM ukt WHERE loginid = '$userid'";

          $query = mysqli_query($db_connection, $sql);


          $row = mysqli_fetch_array($query);
          ?>
          <p class="Jumlah">
            <script>
              let nominal = '<?= $row['lunas'] ?>' !== ''? '<?= $row['lunas'] ?>' : 0;
              let jumlah = CurrencyFormatter.format(nominal);
              document.write(jumlah);
            </script>

          </p>

        </div>
        <div class="Total-Kanan">
          <p class="Belum-Lunas">Total Tagihan UKT Belum Lunas</p>
          <?php

          $sql = "SELECT SUM(blunas) as blunas
          FROM ukt WHERE loginid = '$userid'" ;

          $query = mysqli_query($db_connection, $sql);
          $row = mysqli_fetch_array($query);

          ?>
          <p class="Jumlah">
            <script>
                nominal = '<?= $row['blunas'] ?>' !== ''? '<?= $row['blunas'] ?>' : 0;
                jumlah = CurrencyFormatter.format(nominal);
                document.write(jumlah);
            </script>

          </p>
        </div>
      </div>
      <div class="Detail">
        <h4>Riwayat Pembayaran</h4>
        <div class="List-Riwayat">
        <?php

          $sql = "SELECT *
          FROM ukt WHERE loginid = '$userid'";

          $query = mysqli_query($db_connection, $sql);
          ?>

          <?php if($query->num_rows>0) : ?>

            <?php while ($row = mysqli_fetch_array($query)) : ?>
              <div class="Riwayat">
                <div class="Kiri">
                  <p class="Nominal">Nominal Tagihan</p>
                  <p class="Status">Status Tagihan</p>
                  <p class="Beasiswa">Bidikmisi</p>
                </div>

                <div class="Tengah">
                  <p class="Nominal">
                    <script>
                      document.write(CurrencyFormatter.format(<?= $row['nominal'] ?>));
                    </script>
                  </p>
                  <p class="Status"><?= $row['status'] ?></p>
                  <p class="Beasiswa"><?= $row['bidikmisi'] ?></p>
                </div>
                <div class="Kanan">
                  <p class="Keterangan"><?= $row['gg'] ?></p>
                </div>
              </div>
            <?php endwhile ?>
          <?php else : ?>
            <div class="Riwayat">
              <div class="Kiri">
                <p class="Nominal">Nominal Tagihan</p>
                <p class="Status">Status Tagihan</p>
                <p class="Beasiswa">Bidikmisi</p>
              </div>
              <div class="Tengah">
                <p class="Nominal">-</p>
                <p class="Status">-</p>
                <p class="Beasiswa">-</p>
              </div>
              <div class="Kanan">
                <p class="Keterangan">-</p>
              </div>
            </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </main>
  <!-- Akhir Konten -->
</body>
<script src="JavaScript/JavaScript_Base.JS">
</script>

</html>