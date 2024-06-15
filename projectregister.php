<?php
session_start();
error_reporting(0);
include 'dbconnect1.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="icon" href="favicon-32x32.png" type="image/x-icon">
    <title>Register</title>
    <style>
        .card {
            border-radius: 1rem;
        }

        .content {
            font-size: 1.2rem;
            line-height: 1.6;
            text-align: center;
            color: #333;
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
        }

        .sub-text {
            font-size: 1.8rem;
            color: #333;
        }

        .register-text {
            color: #aa66cc;
        }

        .left-bg {
            background-color: lightblue;
            padding: 20px;
        }

        .logo-img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .password-requirements {
            background-color: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
            border-radius: 10px;
            padding: 10px 20px;
            margin-bottom: 20px;
        }

        .password-requirements h2 {
            color: #721c24;
        }

        .password-requirements ul {
            list-style-type: none;
            padding: 0;
        }

        .password-requirements li {
            margin-bottom: 5px;
        }

        .password-requirements span {
            font-weight: bold;
        }

        .password-requirements span.green {
            color: green;
        }

        .password-requirements span.red {
            color: red;
        }

        .container {
            padding-top: 50px;
            margin-bottom: 20px;
        }

        @media (min-width: 992px) {
            .left-bg {
                padding: 40px;
            }
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-10">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 left-bg">
                                <div class="content">
                                    <br><br>
                                    <h1 class="welcome-text">CashCheck</h1>
                                    <br>
                                    <p class="sub-text">Welcome to CashCheck - Your Ultimate Expense Tracker</p>
                                    <br>
                                    <p class="sub-text">Kindly Register!</p>
                                    <br>
                                    <div class="password-requirements">
                                        <h2>Password Requirements:</h2>
                                        <ul>
                                            <li><span id="upper">At least one uppercase</span></li>
                                            <li><span id="lower">At least one lowercase</span></li>
                                            <li><span id="special_char">At least one special character</span></li>
                                            <li><span id="number">At least one number</span></li>
                                            <li><span id="length">At least 6 characters in length</span></li>
                                        </ul>
                                    </div>
                                    <br>
                                    <img src="cclogo.png" alt="CashCheck Logo" class="logo-img">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-7">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form method="post">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3"></i>
                                            <span class="h1 fw-bold mb-0 register-text">Register Here!</span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">First Name</label>
                                            <input type="text" name="fname" id="fname" maxlength="25" required required class="form-control form-control-lg" />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">Last Name</label>
                                            <input type="text" name="lname" id="lname" maxlength="25" required required class="form-control form-control-lg" />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">Email address</label>
                                            <input type="email" name="email" required class="form-control form-control-lg" />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Password</label>
                                            <input type="password" maxlength="15" name="pass" id="pass" onkeyup=" return validate()" required class="form-control form-control-lg" />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27"> Confirm Password</label>
                                            <input type="password" maxlength="15" name="pass1" id="pass1" required class="form-control form-control-lg" />
                                        </div>
                                        <div class="g-recaptcha" data-sitekey="6LdoM1YoAAAAAMsF_lGlMatklLk53QHCS6fdjtKN"></div>
                                        <br>
                                        <?php
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
                                                    $fname = $_POST['fname'];
                                                    $lname = $_POST['lname'];
                                                    $email = $_POST['email'];
                                                    $pass = $_POST['pass'];

                                                    $sanitized_fname = mysqli_real_escape_string($conn, $fname);
                                                    $sanitized_lname = mysqli_real_escape_string($conn, $lname);
                                                    $sanitized_email = mysqli_real_escape_string($conn, $email);
                                                    $sanitized_password = mysqli_real_escape_string($conn, $pass);

                                                    $_SESSION['fname2'] = $sanitized_fname;
                                                    $_SESSION['lname2'] = $sanitized_lname;
                                                    $_SESSION['email2'] = $sanitized_email;

                                                    $query1 = "SELECT * FROM `login` WHERE Email='$sanitized_email'";
                                                    $result1 = mysqli_query($conn, $query1);
                                                    $row1 = mysqli_num_rows($result1);
                                                    if ($row1 > 0) {
                                                        echo '<br><br><div class="alert alert-danger" role="alert">Sorry this email has already been taken!</div>';
                                                    } else {
                                                        $hash = password_hash($sanitized_password, PASSWORD_DEFAULT);
                                                        $_SESSION['pass2'] = $hash;
                                                        echo '<script>window.location="mail.php";</script>';
                                                    }
                                                }
                                            } else {
                                                echo "PLEASE FILL RECAPTCHA";
                                            }
                                        }
                                        ?><br>
                                        <div class="pt-1 mb-4">
                                            <button type="submit" class="btn btn-outline-primary" onclick="return check()">Register</button>
                                        </div>
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
                                                var fname = document.getElementById("fname").value;
                                                var lname = document.getElementById("lname").value;

                                                if (fname == "" || lname == "") {
                                                    alert("Kindly don't leave blank fields");
                                                    return false;
                                                } else if (!fname.trim() || !lname.trim()) {
                                                    alert("Kindly don't leave blank fields");
                                                    return false;
                                                } else if (!isNaN(fname) || !isNaN(lname)) {
                                                    alert("Kindly enter only characters");
                                                    return false;
                                                }
                                            }
                                        </script>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>
</body>

</html>