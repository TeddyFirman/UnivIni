<?php
require 'koneksi.php';
/*if(isset($_POST['upload']))
{

 $file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="upload/";

 /* new file size in KB */
 //$new_size = $file_size/1024;
 /* new file size in KB */

 /* make file name in lower case */
 //$new_file_name = strtolower($file);
 /* make file name in lower case */

 /*$final_file=str_replace(' ','-',$new_file_name);

 if(move_uploaded_file($file_loc,$folder.$final_file))
 {
  $sql="INSERT INTO image(file,type,size) VALUES('$final_file','$file_type','$new_size')";
  mysqli_query($conn,$sql);


  echo "File sucessfully upload";


 }
 else
 {

  echo "Error.Please try again";

		}
	}*/



   /*if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
      include "koneksi.php";

      echo "<pre>";
      print_r($_FILES['my_image']);
      echo "</pre>";

      $img_name = $_FILES['my_image']['name'];
      $img_size = $_FILES['my_image']['size'];
      $tmp_name = $_FILES['my_image']['tmp_name'];
      $error = $_FILES['my_image']['error'];

      if ($error === 0) {
         if ($img_size > 999000) {
            $em = "Sorry, your file is too large.";
             header("Location: ?error=$em");
         }else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
               $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
               $img_upload_path = 'uploads/'.$new_img_name;
               move_uploaded_file($tmp_name, $img_upload_path);

               // Insert into Database
               $sql = "INSERT INTO images(image_url)
                       VALUES('$new_img_name')";
               mysqli_query($conn, $sql);
               header("Location: view.php");
            }else {
               $em = "You can't upload files of this type";
                 header("Location: index.php?error=$em");
            }
         }
      }else {
         $em = "unknown error occurred!";
         header("Location: ?error=$em");
      }

   }else {
      header("Location: ");
   } */





/*$rand = rand();
$ekstensi =  array('png','jpg','jpeg','gif');
$filename = $_FILES['my_image']['name'];
$ukuran = $_FILES['my_image']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array($ext,$ekstensi) ) {
	header("location:?alert=gagal_ekstensi");
}else{
	if($ukuran < 1044070){
		$xx = $rand.'_'.$filename;
		move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/'.$rand.'_'.$filename);
		mysqli_query($koneksi, "INSERT INTO user VALUES('$xx')");
		header("location:?alert=berhasil");
	}else{
		header("location:?alert=gagak_ukuran");
	}
}*/
?>