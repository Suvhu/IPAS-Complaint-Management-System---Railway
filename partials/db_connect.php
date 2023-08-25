<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "railway";
$conn = mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    echo "Error:".mysqli_connect_error() ;
}
?>