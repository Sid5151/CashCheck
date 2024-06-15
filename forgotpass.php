<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Forgot Password</title>
</head>

<body class="bg-red-100">

    <section class="vh-100 bg-red-100 ">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="login3.png" heigh="80%" width="80%" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; margin-top: 5vw; margin-left: 1vw;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="post">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3"></i>
                                            <span class="h1 fw-bold mb-0">Check Email</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Forgot Password</h5>

                                        <div class="form-outline mb-4">

                                            <label class="form-label" for="form2Example17">Email address</label>
                                            <input type="email" name="email" required class="form-control form-control-lg" />
                                            <br>
                                            <h5>Enter the your email</h5>
                                        </div>



                                        <div class="pt-1 mb-4">

                                            <button type="submit" class="btn btn-outline-primary">Submit</button>
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
</body>

</html>

<?php
session_start();
error_reporting(0);

if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
    header("location:first.php");
} else {
    include 'dbconnect1.php';
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        $sanitized_email =
            mysqli_real_escape_string($conn, $email);
        $_SESSION['email2'] = $sanitized_email;

        $query = "SELECT * FROM `login` where Email='$sanitized_email'";
        $result = mysqli_query($conn, $query);
        $nrow = mysqli_num_rows($result);
        echo $nrow;
        if ($nrow == 1) {
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($sanitized_email == $row['Email']) {
                        header("location:mail2.php");
                    }
                }
            }
        } else {
            echo '
    <script>
        alert("This email does not exist");
    </script>
        ';
        }

        //   
    }
}
?>