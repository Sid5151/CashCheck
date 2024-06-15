<?php
error_reporting(0);
session_start();
if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
    echo "<script>window.location='n_first.php';</script>";
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
    <link rel="icon" href="favicon-32x32.png" type="image/x-icon">
    <title>Login Page</title>
    <style>
    @media (max-width: 992px) {
            .left-bg,
            .col-md-6 {
                flex: 1;
                max-width: 100%;
            }
                            margin-right:0.5rem;

        }
        .card {
            border-radius: 1rem;
            border: 1px solid #ccc;
            overflow: hidden; 
        }

        .content {
            font-size: 1.2rem;
            line-height: 1.6;
            text-align: center;
            color: #333;
            padding: 30px; 
        }

        .content h2 {
            color: #1a73e8;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .content p {
            margin-bottom: 10px;
        }

        .welcome-text {
            font-size: 3rem;
            font-weight: bold;
            color: #aa66cc;
            margin-bottom: 1rem;
            white-space: nowrap; 
        }
        @media (max-width: 576px) {
    .welcome-text {
        font-size: 2rem; 
    }
}

        .sub-text {
            font-size: 1.8rem;
            color: #333;
        }

        .login-text {
            color: #aa66cc;
            text-align: left;
            margin-bottom: 20px;
            font-size: 3rem;
        }

        .left-bg {
            background-color: lightblue;
            padding: 30px; 
            border-radius: 1rem;
        }

        .logo-img {
            max-width: 80%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .card-body {
            padding: 40px; 
            border-radius: 0 1rem 1rem 0;
        }

        .form-outline.mb-4 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-6 left-bg">
                                <div class="content">
                                    <h1 class="welcome-text"><i>C</i>ash<i>C</i>heck</h1>
                                    <p class="sub-text">Welcome to CashCheck - Your Ultimate Expense Tracker</p>
                                    <p class="sub-text">Kindly Login!</p>
                                    <img src="cclogo.png" alt="CashCheck Logo" class="logo-img">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3"></i>
                                            <span class="h1 fw-bold mb-0 login-text">Log-in Here!</span>
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
                                                    $sanitized_email = mysqli_real_escape_string($conn, $email);
                                                    $sanitized_password = mysqli_real_escape_string($conn, $pass);
                                                    $query = "SELECT * FROM `login` WHERE Email='$sanitized_email'";
                                                    $result = mysqli_query($conn, $query);
                                                    $nrow = mysqli_num_rows($result);
                                                    $row = mysqli_fetch_assoc($result);
                                                    if ($nrow > 0) {
                                                        if (password_verify($sanitized_password, $row['Password'])) {
                                                            session_start();
                                                            $_SESSION['loggedin'] = true;
                                                            $_SESSION['email'] = $sanitized_email;
                                                            $_SESSION['user_time'] = time();
                                                               echo "<script>window.location='n_first.php';</script>";
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
                                        <a class="small text-muted" href="forgotpass.php">Forgot password?</a>
                                        <p class="mb-5 pb-lg-2" style="color:blue;">Don't have an account? <a href="projectregister.php" style="color: #393f81;">Register here</a></p>
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
