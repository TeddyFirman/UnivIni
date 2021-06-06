<?php

require 'koneksi.php';


if(isset($_POST['sub']))
{
$checkbox1=$_POST['matkul'];
$chk="";
foreach($checkbox1 as $chk1)
   {
      $chk .= $chk1.",";
   }
$in_ch=mysqli_query($con,"insert into krs values ('$chk')");
if($in_ch==1)
   {
      echo'<script>alert("Inserted Successfully")</script>';
   }
else
   {
      echo'<script>alert("Failed To Insert")</script>';
   }
}
?>