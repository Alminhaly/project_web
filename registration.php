<?php // inset to DB
error_reporting(E_ERROR | E_PARSE);
require 'connection_mysql.php';
$query="CREATE TABLE IF NOT EXISTS `account` (`id`, `first_name`, `last_name`, `user_name`, `password`, `phone_number`, `email`, `web_site`, `gender`, `date_birth`) VALUES (NULL,'$fname','$lname','$user_name','$password','$phone_number','$email','$web_site','$gender','$date_birth)";
if(mysqli_query($connection,$query)) echo "successfully registered". " " . "id=" .mysqli_insert_id($connection);
    else "Registration failed";
?>
