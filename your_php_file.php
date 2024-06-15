<?php
session_start();
include "dbconnect1.php";

$pass = $_POST["pass"];

$sanitized_password = mysqli_escape_string($conn, $pass);
$hash = password_hash($sanitized_password, PASSWORD_DEFAULT);
$query = "UPDATE `login` SET `Password`='$hash' WHERE Email='{$_SESSION['email']}'";
$result = mysqli_query($conn, $query);

$passq = "SELECT * FROM login WHERE Email='{$_SESSION['email']}'";
$passqres = mysqli_query($conn, $passq);
$r = mysqli_fetch_assoc($passqres);
// if (password_verify($sanitized_password, $r['Password'])) {
//     echo 0;
// } else {
//     echo 1;
// }

if (password_verify($sanitized_password, $r['Password'])) {
    echo 0;
}
if ($result) {
    echo 1;
}
