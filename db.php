<?php

$servername = "localhost";
$username = "root";
$dbname = "todo_db";
$password = "";

$conn = new mysqli ($servername, $username , $password ,$dbname);
 if($conn->connect_error){
    echo "database is not connected".$conn->connect_error;
 }else {
    echo"connected succesfully";
 }

?>