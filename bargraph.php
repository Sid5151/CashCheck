<?php
session_start();
include "dbconnect1.php";

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    echo '<script>
    window.location="projectlogin.php";
    </script>';
}

$q = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Transportation'";
$result1 = mysqli_query($conn, $q);
$row1 = mysqli_fetch_assoc($result1);

$q2 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Food'";
$result2 = mysqli_query($conn, $q2);
$row2 = mysqli_fetch_assoc($result2);

$q3 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Utilities'";
$result3 = mysqli_query($conn, $q3);
$row3 = mysqli_fetch_assoc($result3);

$q4 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Clothing'";
$result4 = mysqli_query($conn, $q4);
$row4 = mysqli_fetch_assoc($result4);

$q5 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Medical/Healthcare'";
$result5 = mysqli_query($conn, $q5);
$row5 = mysqli_fetch_assoc($result5);

$q6 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Insurance'";
$result6 = mysqli_query($conn, $q6);
$row6 = mysqli_fetch_assoc($result6);

$q7 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Household_Items/Supplies'";
$result7 = mysqli_query($conn, $q7);
$row7 = mysqli_fetch_assoc($result7);

$q8 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Debt/Loan'";
$result8 = mysqli_query($conn, $q8);
$row8 = mysqli_fetch_assoc($result8);

$q9 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Education'";
$result9 = mysqli_query($conn, $q9);
$row9 = mysqli_fetch_assoc($result9);

$q10 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Savings'";
$result10 = mysqli_query($conn, $q10);
$row10 = mysqli_fetch_assoc($result10);

$q11 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Investments'";
$result11 = mysqli_query($conn, $q11);
$row11 = mysqli_fetch_assoc($result11);

$q12 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Entertainment'";
$result12 = mysqli_query($conn, $q12);
$row12 = mysqli_fetch_assoc($result12);

$q13 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Gifts/Donations'";
$result13 = mysqli_query($conn, $q13);
$row13 = mysqli_fetch_assoc($result13);

$q14 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Housing'";
$result14 = mysqli_query($conn, $q14);
$row14 = mysqli_fetch_assoc($result14);

$q15 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Personal'";
$result15 = mysqli_query($conn, $q15);
$row15 = mysqli_fetch_assoc($result15);

$q15 = "SELECT * from login where Email='{$_SESSION['email']}'";
$result15 = mysqli_query($conn, $q15);
$row15 = mysqli_fetch_assoc($result15);

$dataPoints = array(
    array("label" => "Transportation", "y" => $row1['sum']),
    array("label" => "Food", "y" => $row2['sum']),
    array("label" => "Utilities", "y" => $row3['sum']),
    array("label" => "Clothing", "y" => $row4['sum']),
    array("label" => "Medical/Healthcare", "y" => $row5['sum']),
    array("label" => "Insurance", "y" => $row6['sum']),
    array("label" => "Household_Items/Supplies", "y" => $row7['sum']),
    array("label" => "Debt/Loan", "y" => $row8['sum']),
    array("label" => "Education", "y" => $row9['sum']),
    array("label" => "Savings", "y" => $row10['sum']),
    array("label" => "Investments", "y" => $row11['sum']),
    array("label" => "Entertainment", "y" => $row12['sum']),
    array("label" => "Gifts/Donations", "y" => $row13['sum']),
    array("label" => "Housing", "y" => $row14['sum'])


);

?>
<!DOCTYPE HTML>
<html>

<head>
    <script>
        window.onload = function() {
            var naam = document.getElementById('naam').value;
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Expenses for " + naam + " till date "
                },
                axisY: {
                    title: "Expense_Cost"
                },
                data: [{
                    type: "column",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
    <link rel = "icon" href = 
    "favicon-32x32.png" 
            type = "image/x-icon">
</head>

<body>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <input type="text" id="naam" value="<?php echo $row15['First_Name'] ?>" hidden>

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>

</html>