<?php

require 'koneksi.php';

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) ){

// CHECK IF FIELDS ARE NOT EMPTY

if(!empty(trim($_POST['username'])) && !empty(trim($_POST['email'])) && !empty($_POST['password'])){



// Escape special characters.
$username = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['username']));
$user_email = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['email']));

//IF EMAIL IS VALID
if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {



// CHECK IF EMAIL IS ALREADY REGISTERED

$check_email = mysqli_query($db_connection, "SELECT `email` FROM `login` WHERE email = '$user_email'");

if(mysqli_num_rows($check_email) > 0){
$error_message = "This Email Address is already registered. Please Try another.";
}
else{
// IF EMAIL IS NOT REGISTERED
/* --

ENCRYPT USER PASSWORD USING PHP password_hash function
LEARN ABOUT PHP password_hash - http://php.net/manual/en/function.password-hash.php

-- */

$user_hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// INSER USER INTO THE DATABASE

$insert_user = mysqli_query($db_connection, "INSERT INTO `login` (username, email, password) VALUES ('$username', '$user_email', '$user_hash_password')");

if($insert_user === TRUE){
$success_message = "Thanks! You have successfully signed up.";
}
else{
$error_message = "Oops! something wrong.";
}

}

}
else {
// IF EMAIL IS INVALID
$error_message = "Invalid email address";
}

}
else{
// IF FIELDS ARE EMPTY

$error_message = "Please fill in all the required fields.";

}

}

?>