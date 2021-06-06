<?php
require 'koneksi.php';
if(isset($_POST['username']) && isset($_POST['password'])){

// CHECK IF FIELDS ARE NOT EMPTY
if(!empty(trim($_POST['username'])) && !empty(trim($_POST['password']))){


// Escape special characters.
$username = mysqli_real_escape_string($db_connection, htmlspecialchars(trim($_POST['username'])));

$query = mysqli_query($db_connection, "SELECT * FROM `login` WHERE username = '$username'");
echo $username;

if(mysqli_num_rows($query) > 0){

$row = mysqli_fetch_assoc($query);
$user_db_pass = $row['password'];

// VERIFY PASSWORD
$check_password = password_verify($_POST['password'], $user_db_pass);

if($check_password === TRUE){

session_regenerate_id(true);

$_SESSION['username'] = $username;
$_SESSION['userid'] = $row['id'];
header('Location: beranda.php');
exit;

}
else{
// INCORRECT PASSWORD
$error_message = "Incorrect Email Address or Password.";

}

}
else{
// EMAIL NOT REGISTERED
$error_message = "Incorrect Email Address or Password.";
}


}
else{

// IF FIELDS ARE EMPTY
$error_message = "Please fill in all the required fields.";
}

}
?>