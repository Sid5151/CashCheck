<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    echo '<script>window.location="projectlogin.php"</script>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>

</head>

<body>
    <?php
    include "dbconnect1.php";
    $query1 = "SELECT * FROM `login` WHERE Email='{$_SESSION['email']}'";
    $res = mysqli_query($conn, $query1);
    $r = mysqli_fetch_assoc($res);
    ?>
    <form action="" method="post">
        <span>First Name: </span><input type="text" name="fname" id="fname" value="<?php echo $r['First_Name'];  ?>" disabled><br><br>
        <span>Last Name: </span><input type="text" name="lname" id="lname" value="<?php echo $r['Last_Name'];  ?>" disabled><br><br>
        <span>Email: </span><input type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>" disabled><br><br>
        <span>Enter new password </span><input type="password" name="pass" id="pass" oninput="return validate()" maxlength="15"><br><br>
        <span>Confirm new password </span><input type="password" name="pass1" id="pass1" maxlength="15"><br><br>
        <button type="submit" onclick="return check()">Submit</button>
    </form>
    <div class="errors"> <br><br>
        <ul>
            <h4>Password Requirements</h4>
            <li id="upper">Atleast one uppercase </li>
            <li id="lower">Atleast one lower </li>
            <li id="special_char">Atleast special_char </li>
            <li id="number">Atleast one number </li>
            <li id="length">Atleast one length </li>
        </ul>
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
            if (!pass.value.match(specialChars) ||
                !pass.value.match(/[A-Z]/) || !pass.value.match(/[a-z]/) ||
                !pass.value.length >= 6 || !pass.value.match(/[0-9]/)) {
                alert("Please meet all the password requirements");
                return false;
            } else if (pass.value != cpass.value) {
                alert("Password and Confirm Password do not match!!!");
                return false;
            }


        }
    </script>
</body>

</html>
<?php
include "dbconnect1.php";
if (isset($_POST['pass'])) {
    $pass = $_POST['pass'];
    $_SESSION['password'] = $pass;

    $sanitized_password = mysqli_escape_string($conn, $pass);
    $hash = password_hash($sanitized_password, PASSWORD_DEFAULT);
    $query = "UPDATE `login` SET `Password`='$hash' WHERE Email='{$_SESSION['email']}'";
    $result = mysqli_query($conn, $query);

    if (password_verify($sanitized_password, $r['Password'])) {
        echo '<script>          
            alert("Please enter a new password");
            </script>';
    } else {
        echo "<script>window.location='mail3.php'</script>";
    }
}

?>