<?php
// error_reporting(0);
session_start();
date_default_timezone_set("Asia/Calcutta");
$date = date("Y/m/d");
$time = date("h:i:s");
include "dbconnect1.php";
$query = "UPDATE `login` SET `Last_Used_Date`='$date',`Last_Used_time`='$time' WHERE Email='{$_SESSION['email']}'";
$result = mysqli_query($conn, $query);
if ($result) {
    echo '<script>
        alert("Logged out");
        window.location="projectlogin.php";
        </script>';
} else {
    '<script>
        alert("Problem");
        
        </script>';
}
session_unset();
session_destroy();

exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel = "icon" href = 
    "favicon-32x32.png" 
            type = "image/x-icon">
</head>
<body>
</body>
</html>