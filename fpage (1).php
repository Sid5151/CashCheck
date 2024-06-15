<?php
session_set_cookie_params(0);
session_start();
error_reporting(0);
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
    include 'dbconnect1.php';
    $sqlfetch = "SELECT * FROM login where Email='{$_SESSION['email']}'";

    $result = mysqli_query($conn, $sqlfetch) or die("Query Failed");
    $nrows = mysqli_num_rows($result);
    //    echo "<br>";
    //    echo $nrows; echo "<br>";

    if ($nrows > 0) {

        $row = mysqli_fetch_assoc($result);
        echo "Hello " . $row['First_Name'];
    }
    // date_default_timezone_set("Asia/Calcutta");
    // $datetime = date("Y/m/d") . '<br>' . date("h:i:s");
    // $_SESSION['lastused'] = $datetime;
    // echo $_SESSION['lastused'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dash-Board</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <br><br>
    <a href="logout.php" class="btn btn-outline-primary">Logout</a>
    <a href="updatepass.php" class="btn btn-outline-primary">Update Password</a>
    <a href="addexp.php" class="btn btn-outline-primary">Add expense</a>
    <a href="showexp1.php" class="btn btn-outline-primary">Manage Expense</a> <br>
    <a href="profile.php" class="btn btn-outline-primary">profile</a>

</body>

</html><?php
session_set_cookie_params(0);
session_start();
error_reporting(0);
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
    include 'dbconnect1.php';
    $sqlfetch = "SELECT * FROM login where Email='{$_SESSION['email']}'";

    $result = mysqli_query($conn, $sqlfetch) or die("Query Failed");
    $nrows = mysqli_num_rows($result);
    //    echo "<br>";
    //    echo $nrows; echo "<br>";

    if ($nrows > 0) {

        $row = mysqli_fetch_assoc($result);
        echo "Hello " . $row['First_Name'];
    }
    // date_default_timezone_set("Asia/Calcutta");
    // $datetime = date("Y/m/d") . '<br>' . date("h:i:s");
    // $_SESSION['lastused'] = $datetime;
    // echo $_SESSION['lastused'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dash-Board</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <br><br>
    <a href="logout.php" class="btn btn-outline-primary">Logout</a>
    <a href="updatepass.php" class="btn btn-outline-primary">Update Password</a>
    <a href="addexp.php" class="btn btn-outline-primary">Add expense</a>
    <a href="showexp1.php" class="btn btn-outline-primary">Manage Expense</a> <br>
    <a href="profile.php" class="btn btn-outline-primary">profile</a>

</body>

</html><?php
session_set_cookie_params(0);
session_start();
error_reporting(0);
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
    include 'dbconnect1.php';
    $sqlfetch = "SELECT * FROM login where Email='{$_SESSION['email']}'";

    $result = mysqli_query($conn, $sqlfetch) or die("Query Failed");
    $nrows = mysqli_num_rows($result);
    //    echo "<br>";
    //    echo $nrows; echo "<br>";

    if ($nrows > 0) {

        $row = mysqli_fetch_assoc($result);
        echo "Hello " . $row['First_Name'];
    }
    // date_default_timezone_set("Asia/Calcutta");
    // $datetime = date("Y/m/d") . '<br>' . date("h:i:s");
    // $_SESSION['lastused'] = $datetime;
    // echo $_SESSION['lastused'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dash-Board</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <br><br>
    <a href="logout.php" class="btn btn-outline-primary">Logout</a>
    <a href="updatepass.php" class="btn btn-outline-primary">Update Password</a>
    <a href="addexp.php" class="btn btn-outline-primary">Add expense</a>
    <a href="showexp1.php" class="btn btn-outline-primary">Manage Expense</a> <br>
    <a href="profile.php" class="btn btn-outline-primary">profile</a>

</body>

</html>