<?php
session_start();
error_reporting(0);

include 'dbconnect1.php';
$emailq = "Select * from login";
$emailqconnect = mysqli_query($conn, $emailq);
$_SESSION['fname'] = $_POST['fname'];
$_SESSION['lname'] = $_POST['lname'];
$_SESSION['cemail'] = $_POST['email'];
if ($_POST['cpb_val'] == 1) {
    while ($emailrow = mysqli_fetch_assoc($emailqconnect)) {
        if ($emailrow['Email'] == $_POST['email']) {
            echo 2;
            exit();
        }
    }
    echo 3;
} else {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    //$rdate = $_POST['rdate'];
    $sql = "UPDATE `login` SET `First_Name`='$fname',`Last_Name`='$lname' WHERE Email='{$_SESSION['email']}'";

    $result1 = mysqli_query($conn, $sql) or die("Query Failed");
    if ($result1) {
        echo 1;
    } else {
        echo 0;
    }
}
