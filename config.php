<?php

$server = "localhost";
$user_name = "root";
$password = "";
$db_name = "d1";

$conn = new mysqli($server,$user_name,$password,$db_name);
if ($conn -> connect_error){
    die ("Connection Failed" . $conn -> connect_error);
}
?>