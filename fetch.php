<?php

include 'partials/db_connect.php';

if ($_POST['type'] == "") {
    $sql = "SELECT * FROM division";

    $query = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

    $str = "";
    while ($row = mysqli_fetch_assoc($query)) {
        $str .= "<option value='{$row['unit']}'>{$row['unitdesc']}</option>";
    }
} else if ($_POST['type'] == "sectionData") {

    $sql = "SELECT * FROM section ";

    $query = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

    $str = "";
    while ($row = mysqli_fetch_assoc($query)) {
        $str .= "<option value='{$row['sectioncode']}'>{$row['secdesc']}</option>";
    }
}
else if ($_POST['type'] == "userData") {

    $sql = "SELECT * FROM user_id where division = {$_POST['id']} AND  sectioncode = {$_POST['id1']} ";

    $query = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

    $str = "";
    while ($row = mysqli_fetch_assoc($query)) {
        $str .= "<option value='{$row['userid']}'>{$row['userid']}</option>";
    }
}

echo $str;
?>  