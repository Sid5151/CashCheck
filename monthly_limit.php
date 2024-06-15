<?php
session_start();
include "dbconnect1.php";
$real_ml=$_POST['ml'];
$ml = mysqli_real_escape_string($conn, $real_ml);
$encoded_ml = base64_encode($ml);
$query = "Update `login` set `Monthly_Limit`='$encoded_ml' where Email='{$_SESSION['email']}'";
$query_connect = mysqli_query($conn, $query);
if ($query_connect) {
    echo 1;
} else {
    echo 0;
}
