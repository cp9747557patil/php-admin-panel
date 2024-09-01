<?php

$hostname = "localhost";
$username = "root";
$password="";
$db_name = "Wscube-crud";

$conn = mysqli_connect($hostname,$username,$password,$db_name);

if($conn){
    // echo "Database Connected Successfully";
}else{
    die("Connection Failed..".mysqli_connect_error());
}

?>