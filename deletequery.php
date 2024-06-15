<?php
session_start();
if ((time() - $_SESSION['user_time']) > 3600) {
    echo '
    <script>
    alert("Your 60 seconds expired");
    window.location="logout.php";
    </script>';
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    header("location:projectlogin.php");
} else {
    $userid = $_POST['user_id'];
    include 'dbconnect1.php';
    $sqldelete = "DELETE FROM `addexp` WHERE ID=$userid";

    $result = mysqli_query($conn, $sqldelete);

    if ($result) {
        echo 1;
    } else {

        echo 0;
    }
}
