<?php
session_start();
error_reporting(0);
if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
    header("location:fpage.php");
} else if (!isset($_SESSION['email2'])) {
    header("location:forgotpass.php");
} else if (!$_SESSION['vcode'] == true) {
    header("location:forgotpass.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        li {
            font-size: large;
        }
    </style>
    <title>Forgot Password</title>
</head>

<body class="bg-red-100">
    <?php
    include "dbconnect1.php";
    if (isset($_SESSION['email2'])) {
        $query1 = "SELECT * FROM `login` WHERE Email='{$_SESSION['email2']}'";
        $res = mysqli_query($conn, $query1);
        $r = mysqli_fetch_assoc($res);
    }

    ?>
    <section class="vh-100 bg-red-100 ">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="login3.png" heigh="80%" width="80%" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; margin-top: 5vw; margin-left: 1vw;" />
                                <div class="errors" style="text-align: center;"> <br><br>
                                    <ul>
                                        <li id="upper">Atleast one uppercase </li>
                                        <li id="lower">Atleast one lower </li>
                                        <li id="special_char">Atleast special_char </li>
                                        <li id="number">Atleast one number </li>
                                        <li id="length">Atleast one length </li>
                                    </ul>
                                </div><br><br>
                            </div>

                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="post">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3"></i>
                                            <span class="h1 fw-bold mb-0">Reset Password</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Forgot Password</h5>

                                        <div class="form-outline mb-4">

                                            <label class="form-label" for="form2Example17">Enter new password</label>
                                            <input type="password" maxlength="15" name="pass" id="pass" onkeyup=" return validate()" required class="form-control form-control-lg" />

                                        </div>

                                        <div class="form-outline mb-4">

                                            <label class="form-label" for="form2Example17">Confirm new password</label>
                                            <input type="password" name="pass1" id="pass1" required class="form-control form-control-lg" />

                                        </div>

                                        <div class="pt-1 mb-4">

                                            <button type="submit" class="btn btn-outline-primary" onclick="return check()">Change Password</button>
                                        </div>

                                        <!-- <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a> -->
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var pass = document.getElementById('pass');
        var upper = document.getElementById('upper');
        var lower = document.getElementById('lower');
        var special_char = document.getElementById('special_char');
        var number = document.getElementById('number');
        var length = document.getElementById('length');
        var cpass = document.getElementById('pass1');
        const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;

        function validate() {


            if (pass.value.match(/[0-9]/)) {
                number.style.color = 'green';
            } else {
                number.style.color = 'red';

            }

            if (pass.value.match(/[A-Z]/)) {
                upper.style.color = 'green';
            } else {
                upper.style.color = 'red';

            }

            if (pass.value.match(/[a-z]/)) {
                lower.style.color = 'green';
            } else {
                lower.style.color = 'red';

            }

            if (pass.value.length >= 6) {
                length.style.color = 'green';
            } else {
                length.style.color = 'red';

            }

            if (pass.value.match(specialChars)) {
                special_char.style.color = 'green';
            } else {
                special_char.color = 'red';

            }

        }

        function check() {
            if (pass.value != cpass.value) {
                alert("Password and Confirm Password do not match!!!");
                return false;
            }
            if (!pass.value.match(specialChars) ||
                !pass.value.match(/[A-Z]/) || !pass.value.match(/[a-z]/) ||
                !pass.value.length >= 6 || !pass.value.match(/[0-9]/)) {
                alert("Please meet all the password requirements");
                return false;
            }
        }
    </script>


</body>

</html>

<?php
if (isset($_POST['pass'])) {
    $pass = $_POST['pass'];
    $sanitized_password = mysqli_escape_string($conn, $pass);
    $hash = password_hash($sanitized_password, PASSWORD_DEFAULT);
    $query = "UPDATE `login` SET `Password`='$hash' WHERE Email='{$_SESSION['email2']}'";
    $result = mysqli_query($conn, $query);

    if (password_verify($sanitized_password, $r['Password'])) {
        echo '
    
    <script>
    
        alert("Please enter a new password");
    
    </script>';
    } else {
        if ($result) {

            echo '<script>
        alert("Your password has been updated");
        window.location="projectlogin.php";
        </script>';
        } else {
            echo '<script>
        alert("Sorry your password has not been updated due to some techincal glitch");
        </script>';
        }
    }
}
?>