<?php

//index.php

//Include Configuration File
include('config.php');

$login_button = '';


if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);


        $_SESSION['access_token'] = $token['access_token'];


        $google_service = new Google_Service_Oauth2($google_client);


        $data = $google_service->userinfo->get();


        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['email'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}


if (!isset($_SESSION['access_token'])) {

    $login_button = '<a href="' . $google_client->createAuthUrl() . '">Login With Google</a>';
}

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PHP Login using Google Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <br />
        <div class="panel panel-default">
            <?php
            include "dbconnect1.php";
            $query1 = "SELECT * FROM `login` WHERE Email='{$_SESSION['email']}'";
            $result1 = mysqli_query($conn, $query1);
            $row1 = mysqli_num_rows($result1);

            if ($login_button == '') {
                if ($row1 > 0) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_time'] = time();
                    header("location:first.php");
                } else {

                    $insertsql = "INSERT INTO `login`(`First_Name`, `Last_Name`, `Email`, `Password`) VALUES ('{$_SESSION['user_first_name']}','{$_SESSION['user_last_name']}','{$_SESSION['email']}','Google_Wala_User')";
                    $result = mysqli_query($conn, $insertsql);
                    if ($result) {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['user_time'] = time();
                        header("location:first.php");
                    }
                }
            } else {
                echo '<div align="center">' . $login_button . '</div>';
            }
            ?>
        </div>
    </div>
</body>

</html>