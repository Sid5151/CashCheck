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

$q16 = "SELECT * from login where Email='{$_SESSION['email']}'";
$result16 = mysqli_query($conn, $q16);
$row16 = mysqli_fetch_assoc($result16);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            max-width: 900px;
            width: 100%;
            text-align: center;
        }

        .container h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        #piechart {
            width: 100%;
            max-width: 600px;
            height: 400px;
            margin: 0 auto;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Expense Tracker</h2>
        <div id="piechart"></div>
        <input type="text" id="naam" value="<?php echo $row16['First_Name'] ?>" class="hidden">
    </div>
    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Expense Category', 'Expense Amount'],
                ['Transportation', parseInt('<?php echo $row1['sum']; ?>')],
                ['Food', parseInt('<?php echo $row2['sum']; ?>')],
                ['Utilities', parseInt('<?php echo $row3['sum']; ?>')],
                ['Clothing', parseInt('<?php echo $row4['sum']; ?>')],
                ['Medical/Healthcare', parseInt('<?php echo $row5['sum']; ?>')],
                ['Insurance', parseInt('<?php echo $row6['sum']; ?>')],
                ['Household_Items/Supplies', parseInt('<?php echo $row7['sum']; ?>')],
                ['Debt/Loan', parseInt('<?php echo $row8['sum']; ?>')],
                ['Education', parseInt('<?php echo $row9['sum']; ?>')],
                ['Savings', parseInt('<?php echo $row10['sum']; ?>')],
                ['Investments', parseInt('<?php echo $row11['sum']; ?>')],
                ['Entertainment', parseInt('<?php echo $row12['sum']; ?>')],
                ['Gifts/Donations', parseInt('<?php echo $row13['sum']; ?>')],
                ['Housing', parseInt('<?php echo $row14['sum']; ?>')],
            ]);

            var options = {
                title: 'Expense of ' + document.getElementById('naam').value + ' till date',
                pieHole: 0.4,
                // Customize colors for different expense types
                colors: ['#007BFF', '#FF5733', '#33FF57', '#3366FF', '#FF33E9', '#FFD700', '#00BFFF', '#FF1493', '#32CD32', '#808080', '#800000', '#006400', '#8A2BE2', '#FF4500'],
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</body>
</html>
