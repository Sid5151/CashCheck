<?php
error_reporting(0);
session_start();
if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
    header("location:n_first.php");
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

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>



    <title>Login Page</title>
</head>

<body class="bg-red-100">

    <section class="vh-100 bg-red-100 ">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="login3.png" heigh="100%" width="100%" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; margin-top: 5vw; margin-left: 1vw;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="" method="post">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3"></i>
                                            <span class="h1 fw-bold mb-0">Log in</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                                        <div class="form-outline mb-4">

                                            <label class="form-label" for="form2Example17">Email address</label>
                                            <input type="email" name="email" required class="form-control form-control-lg" />

                                        </div>

                                        <div class="form-outline mb-4">

                                            <label class="form-label" for="form2Example27">Password</label>
                                            <input type="password" maxlength="15" name="pass" required class="form-control form-control-lg" />

                                        </div>
                                        <div class="g-recaptcha" data-sitekey="6LdoM1YoAAAAAMsF_lGlMatklLk53QHCS6fdjtKN"></div>
                                        <br>
                                        <div class="pt-1 mb-4">
                                            <button type="submit" class="btn btn-outline-primary">Login</button>
                                        </div>
                                        <?php
                                        include 'dbconnect1.php';


                                        //                             }
                                        if (!isset($_POST['g-recaptcha-response'])) {
                                            echo '<span>Kindly Fill The Recaptcha</span><br>';
                                        } else {
                                            $secret_key = '6LdoM1YoAAAAAOFxMsltBiucY_snQERf3Bb4Tq2q';
                                            $ip = $_SERVER['REMOTE_ADDR'];
                                            $response = $_POST['g-recaptcha-response'];
                                            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response&remoteip=$ip";
                                            $fire = file_get_contents($url);
                                            $data = json_decode($fire);
                                            if ($data->success == true) {
                                                if (isset($_POST['email']) || isset($_POST['pass'])) {

                                                    $email = $_POST['email'];
                                                    $pass = $_POST['pass'];
                                                    $sanitized_email =
                                                        mysqli_real_escape_string($conn, $email);

                                                    $sanitized_password =
                                                        mysqli_real_escape_string($conn, $pass);
                                                    $query = "SELECT * FROM `login` WHERE Email='$sanitized_email'";
                                                    $result = mysqli_query($conn, $query);
                                                    $nrow = mysqli_num_rows($result);
                                                    $row = mysqli_fetch_assoc($result);
                                                    if ($nrow > 0) {
                                                        // if ($sanitized_password == $row['Password']) {

                                                        if (password_verify($sanitized_password, $row['Password'])) {
                                                            session_start();
                                                            $_SESSION['loggedin'] = true;
                                                            $_SESSION['email'] = $sanitized_email;
                                                            $_SESSION['user_time'] = time();
                                                            header("location:n_first.php");
                                                        } else {
                                                            echo '<script>
                                            alert("Sorry your login failed.\nPlease check your Email-id and Password");
                                            </script>';
                                                        }
                                                    }
                                                }
                                            } else {
                                                echo "PLEASE FILL RECATPCHA";
                                            }
                                        }



                                        ?>
                                        <a class="small text-muted" href="forgotpass.php" ;>Forgot password?</a>
                                        <p class="mb-5 pb-lg-2" style="color:blue;">Don't have an account? <a href="projectregister.php" style="color: #393f81;">Register here</a></p>
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
</body>

</html>