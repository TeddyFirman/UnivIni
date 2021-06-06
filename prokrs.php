<?php

    if (isset($_POST['btn']) && $_POST['btn'] == 'Simpan' && isset($_POST['matkul'])) {

      $userid = (int) $_SESSION['userid'];
      $matkul = ($_POST['matkul']);

      foreach ($matkul as $pelajaran) {
          # code...
          $query=mysqli_query($db_connection,"INSERT INTO krs(matkul,loginid
          )VALUES
          ('$pelajaran',
          '$userid'
          )"
          );
      }


    }
?>

