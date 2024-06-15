<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    header("location:projectlogin.php");
}
$studend_id = $_POST['stud_id2'];
$ed = $_POST['ed'];
$en = base64_encode($_POST['en']);
$ec = base64_encode($_POST['ec']);
$et = base64_encode($_POST['et']);
$mop = base64_encode($_POST['mop']);

include "dbconnect1.php";
$query = "UPDATE `addexp` SET `Expense_Date`='$ed',`Expense_Name`='$en',`Exp_type`='$et',`Expense_Cost`='$ec',`Payment_Mode`='$mop' WHERE ID='$studend_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    echo 1;
} else {
    echo 0;
}
