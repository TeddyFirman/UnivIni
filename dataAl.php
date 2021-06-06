<?php

require 'koneksi.php';

if(isset($_POST['btn']) && $_POST['btn'] == 'Simpan' && isset($_POST['prov']) && isset($_POST['kab']) && isset($_POST['kec']) && isset($_POST['desa']) && isset($_POST['jln']) ){

    // CHECK IF FIELDS ARE NOT EMPTY

    if(!empty(trim($_POST['prov'])) && !empty(trim($_POST['kab'])) && !empty(trim($_POST['kec'])) && !empty(trim($_POST['desa'])) && !empty(trim($_POST['jln']))  ){

        $prov = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['prov']));
        $kab = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['kab']));
        $kec = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['kec']));
        $desa = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['desa']));
        $jln = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['jln']));


        // INSER USER INTO THE DATABASE
    $userid = (int) $_SESSION['userid'];

    $insert_user = mysqli_query($db_connection, "INSERT INTO `alamat` (
        prov,
        kab,
        kec,
        desa,
        jln,
        loginid)
        VALUES (
            '$prov',
            '$kab',
            '$kec',
            '$desa',
            '$jln',
            '$userid')");
    }
    else{
        // IF FIELDS ARE EMPTY

        $error_message = "Please fill in all the required fields.";
    }


}
?>