<?php


$host="localhost";
$user_name="ali";
$password="123456";
$DB_name="users";
$connection= mysqli_connect($host,$user_name,$password,$DB_name);

if (!$connection) die("DB ERROR");
?>
