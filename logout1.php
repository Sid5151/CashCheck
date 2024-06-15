<?php

//logout.php
error_reporting(0);
include('config.php');
$google_client->revokeToken();
date_default_timezone_set("Asia/Calcutta");
$date = date("Y/m/d");
$time = date("h:i:s");
include "dbconnect1.php";
$query = "UPDATE `login` SET `Last_Used_Date`='$date',`Last_Used_time`='$time' WHERE Email='{$_SESSION['email']}'";
$result = mysqli_query($conn, $query);
//Reset OAuth access token
if ($result) {
    echo '<script>
        alert("Loggged out");
        window.location="projectlogin.php";
        </script>';
} else {
    '<script>
        alert("Problem");
        
        </script>';
}

//Destroy entire session data.
session_unset();
session_destroy();

//redirect page to index.php
// header('location:projectlogin.php');
exit();
