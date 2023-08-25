<?php
include 'partials/db_connect.php';
$sql = "UPDATE `visitor` SET `visitcount` = visitcount + 1";
$result = mysqli_query($conn, $sql);
include 'home.php';
?>