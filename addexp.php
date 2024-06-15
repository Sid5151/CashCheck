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
    echo '<script>
    window.location="projectlogin.php";
    </script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense</title>
    <link rel = "icon" href = 
    "favicon-32x32.png" 
            type = "image/x-icon">
    <style>
        span {
            font-size: larger;
        }
    </style>
</head>

<body>


    <form method="post">
        <span>Date </span><input type="date" name="date" id="date" required style="font-size: larger;"> <br><br>
        <span>Type of Expense </span>
        <select required style="font-size: larger;" id="sel">
            <option value="Select" disabled selected>Select</option>
            <option value="Transportation">Transportation</option>
            <option value="Food">Food</option>
            <option value="Utilities">Utilities</option>
            <option value="Clothing">Clothing</option>
            <option value="Medical/Healthcare">Medical/Healthcare</option>
            <option value="Insurance">Insurance</option>
            <option value="Household_Items/Supplies">Household_Items/Supplies</option>
            <option value="Debt/Loan">Debt/Loan</option>
            <option value="Education">Education</option>
            <option value="Savings">Savings</option>
            <option value="Investments">Investments</option>
            <option value="Entertainment ">Entertainment</option>
            <option value="Gifts/Donations">Gifts/Donations</option>
            <option value="Housing">Housing</option>
            <option value="Personal">Personal</option>

        </select>
        <br><br>
        <span>Expense </span><input type="text" name="exp" id="exp" required><br><br>


        <span>Cost </span><input type="text" name="cost" id="cost" required> <br><br>
        <input type="text" id="it" name="it" hidden>

        <input type="submit" value="Add Expense" onclick="return hp()">
    </form>
    <a href="showexp2.php">Manage Expense</a>
    <script src="jquery-3.7.0.min.js"></script>
    <script>
        $(function() {
            $("#sel").change(function() {
                var val = $(this).val();
                console.log(val);
                $('#it').val(val);
            })
        });


        function hp() {
            var exp = document.getElementById("exp").value.toString();
            var cost = document.getElementById("cost").value.toString();
            console.log(exp);
        }
    </script>

</body>

</html>

<?php

include 'dbconnect1.php';
if (isset($_POST['date']) || isset($_POST['exp']) || isset($_POST['cost'])) {
    $date =  $_POST['date'];
    $exp =  htmlspecialchars($_POST['exp']);
    $cost = htmlspecialchars($_POST['cost']);
    $exp_type = $_POST['it'];

    $sanitized_date =
        mysqli_real_escape_string($conn, $date);

    $sanitized_exp =
        mysqli_real_escape_string($conn, $exp);

    $sanitized_cost =
        mysqli_real_escape_string($conn, $cost);

    $query = "INSERT INTO `addexp`(`Email`, `Expense_Date`, `Expense_Name`, `Expense_Cost`,`Exp_type`) VALUES ('{$_SESSION['email']}','$sanitized_date','$sanitized_exp','$sanitized_cost','$exp_type')";
    $result = mysqli_query($conn, $query);

    // $query2 = "Select * from piechart where Name='$exp_type' and Email='{$_SESSION['email']}' ";
    // $result2 = mysqli_query($conn, $query2);
    // $row2 = mysqli_fetch_assoc($result2);
    // $nrows2 = mysqli_num_rows($result2);

    // $query5 = "Select * from piechart where Name='$exp_type' and Email='{$_SESSION['email']}'";
    // $result5 = mysqli_query($conn, $query5);
    // $nrows5 = mysqli_num_rows($result5);


    // if ($nrows5 <= 0) {
    //     $query4 = "INSERT INTO `piechart`(`Name`, `Val`, `Email`) VALUES ('$exp_type','$sanitized_cost','{$_SESSION['email']}')";
    //     $result4 = mysqli_query($conn, $query4);
    // } elseif ($nrows5 > 0) {
    //     $query3 = "UPDATE `piechart` SET `Val`={$row2['Val']}+'$sanitized_cost' WHERE Email='{$_SESSION['email']}' and Name='$exp_type'; " or die("Failed");
    //     $result3 = mysqli_query($conn, $query3);
    // }

    // if ($nrows5 > 0) {
    //     $query3 = "UPDATE `piechart` SET `Val`={$row2['Val']}+'$sanitized_cost' WHERE Email='{$_SESSION['email']}' and Name='$exp_type'; " or die("Failed");
    //     $result3 = mysqli_query($conn, $query3);
    // } else {
    //     $query4 = "INSERT INTO `piechart`(`Name`, `Val`, `Email`) VALUES ('$exp_type','$sanitized_cost','{$_SESSION['email']}')";
    //     $result4 = mysqli_query($conn, $query4);
    // }

    if ($result) {
        echo '<script>
                    alert("Your expense has been added.");
                    window.location="showexp2.php";
                    </script>';
        // header("showexp.php");

    } else {
        echo "Sorry Your expense has not been added, since there is a techical difficulties....";
    }
}

?>