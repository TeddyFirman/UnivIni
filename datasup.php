<?php

require 'koneksi.php';

if(isset($_POST['btn']) && $_POST['btn'] == 'Update' && isset($_POST['prov']) && isset($_POST['kab']) && isset($_POST['kec']) && isset($_POST['nama'])  ){

    // CHECK IF FIELDS ARE NOT EMPTY

    if(!empty(trim($_POST['prov'])) && !empty(trim($_POST['kab'])) && !empty(trim($_POST['kec'])) && !empty(trim($_POST['nama']))   ){

        $prov = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['prov']));
        $kab = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['kab']));
        $kec = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['kec']));
        $nama = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['nama']));



        // INSER USER INTO THE DATABASE
        $userid = (int) $_SESSION['userid'];
        $update_user = mysqli_query($db_connection, "UPDATE `sekolah` SET
            prov = '$prov',
            kab = '$kab',
            kec = '$kec',
            nama = '$nama'

             WHERE loginid = '$userid'"
                );
                if(!$update_user) {
                    var_dump(mysqli_error($db_connection));
                }
    }
    else{
        // IF FIELDS ARE EMPTY

        $error_message = "Please fill in all the required fields.";
    }


}
?>