<?php

require 'koneksi.php';

if(isset($_POST['btn']) && $_POST['btn'] == 'Simpan' && isset($_POST['nama']) && isset($_POST['kwn']) && isset($_POST['ttl']) && isset($_POST['agama']) && isset($_POST['nid']) && isset($_POST['jalur']) && isset($_POST['tempat']) && isset($_POST['nim']) && isset($_POST['prodi']) && isset($_POST['jk']) && isset($_POST['angkatan'])  ){

    // CHECK IF FIELDS ARE NOT EMPTY

    if(!empty(trim($_POST['nama'])) && !empty(trim($_POST['kwn'])) && !empty(trim($_POST['ttl'])) && !empty(trim($_POST['agama'])) && !empty(trim($_POST['nid'])) && !empty(trim($_POST['jalur'])) && !empty(trim($_POST['tempat'])) && !empty(trim($_POST['nim'])) && !empty(trim($_POST['prodi'])) && !empty(trim($_POST['jk'])) && !empty(trim($_POST['angkatan'])) ){

        $nama = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['nama']));
        $kwn = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['kwn']));
        $ttl = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['ttl']));
        $ttl = date("Y/M/D", strtotime($ttl));
        $agama = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['agama']));
        $nid = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['nid']));
        $jalur = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['jalur']));
        $tempat = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['tempat']));
        $nim = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['nim']));
        $prodi = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['prodi']));
        $jk = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['jk']));
        $angkatan = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['angkatan']));

        // INSER USER INTO THE DATABASE
        $userid = (int) $_SESSION['userid'];
    $insert_user = mysqli_query($db_connection, "INSERT INTO `biodata` (
        nama,
        kwn,
        ttl,
        agama,
        nid,
        jalur,
        tempat,
        nim,
        prodi,
        jk,
        angkatan,
        loginid
        ) VALUES (
            '$nama',
            '$kwn',
            '$ttl',
            '$agama',
            '$nid',
            '$jalur',
            '$tempat',
            '$nim',
            '$prodi',
            '$jk',
            '$angkatan',
            '$userid'
            )"
            );
    }
    else{
        // IF FIELDS ARE EMPTY

        $error_message = "Please fill in all the required fields.";
    }


}
?>