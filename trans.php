<?php

require 'koneksi.php';



function ambilTranskripSemester($semester, $userid) {
    global $db_connection;
    $insert_user = mysqli_query($db_connection, "SELECT * FROM transkrip WHERE semester='{$semester}' AND loginid='{$userid}'");
    $result = [];
    if($insert_user->num_rows>0) {
        while($transkrip = mysqli_fetch_assoc($insert_user)) {
            $result[] = $transkrip;
        }
    }
    return $result;
}

?>