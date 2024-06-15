<?php
session_start();
error_reporting(0);
// if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
//     header("location:n_first.php");
// } 

if (isset($_POST['bsubmit'])) {

    $hiddencode = $_POST['hcode'];
    // $_SESSION['hcode']=$hiddencode;

    $verifycode = $_POST['vcode'];
    // $_SESSION['vcode']=$verifycode;
    if ($verifycode == $hiddencode) {

        include "dbconnect1.php";

        $query = "UPDATE `login` SET `First_Name`='{$_SESSION['fname']}',`Last_Name`='{$_SESSION['lname']}',`Email`='{$_SESSION['cemail']}' WHERE Email='{$_SESSION['email']}'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $nemailquery = "UPDATE `addexp` SET `Email`='{$_SESSION['cemail']}' WHERE Email='{$_SESSION['email']}'";
            $nemailresult = mysqli_query($conn, $nemailquery);
            echo '<script>
                        alert("Your Email has been updated!!!\nYou will be logged out now.\nKindly login in again");
                        window.location="logout.php";
                        </script>';
        } else {
            echo "Sorry your Email has not been updated, since there is a techical difficulties...." . mysqli_error($conn);
        }
    }
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

    <title>Email Verification</title>
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
                                            <span class="h1 fw-bold mb-0">Verify Email</span>
                                        </div>


                                        <div class="form-outline mb-4">
                                            <input type="text" name="hcode" id="hcode" hidden value="<?php echo $_SESSION['code'] ?>">
                                            <label class="form-label" for="form2Example17">Verification Code</label>
                                            <input type="text" name="vcode" id="vcode" required class="form-control form-control-lg" />
                                            <br>
                                            <h5 style="font-weight: 700;">Enter the verification code which has been send to <?php echo $_SESSION['cemail'] ?></h5>
                                        </div>

                                        <div class="pt-1 mb-4">

                                            <button type="submit" name="bsubmit" id="bsubmit" class="btn btn-outline-primary">Submit</button>
                                        </div>
                                        <script src="jquery-3.7.0.min.js"></script>
                                        <script>
                                            $(function() {
                                                $('#bsubmit').click(function() {

                                                    var hiddencode = $('#hcode').val();
                                                    var verifycode = $('#vcode').val();
                                                    if (verifycode != hiddencode) {
                                                        alert("Enter the correct code");
                                                        return false;
                                                    }
                                                });
                                            });
                                        </script>

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