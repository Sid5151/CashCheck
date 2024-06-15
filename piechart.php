<?php
session_start();
include "dbconnect1.php";

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    echo '<script>
    window.location="projectlogin.php";
    </script>';
}
$firstdate = date("Y/m/d", strtotime("first day of this month"));

$lastdate = date("Y/m/d", strtotime("last day of this month"));

$q1 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Transportation' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result1 = mysqli_query($conn, $q1);
$row1 = mysqli_fetch_assoc($result1);

$q2 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Food' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result2 = mysqli_query($conn, $q2);
$row2 = mysqli_fetch_assoc($result2);

$q3 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Utilities' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result3 = mysqli_query($conn, $q3);
$row3 = mysqli_fetch_assoc($result3);

$q4 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Clothing' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result4 = mysqli_query($conn, $q4);
$row4 = mysqli_fetch_assoc($result4);

$q5 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Medical/Healthcare' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result5 = mysqli_query($conn, $q5);
$row5 = mysqli_fetch_assoc($result5);

$q6 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Insurance' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result6 = mysqli_query($conn, $q6);
$row6 = mysqli_fetch_assoc($result6);

$q7 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Household_Items/Supplies' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result7 = mysqli_query($conn, $q7);
$row7 = mysqli_fetch_assoc($result7);

$q8 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Debt/Loan' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result8 = mysqli_query($conn, $q8);
$row8 = mysqli_fetch_assoc($result8);

$q9 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Education' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result9 = mysqli_query($conn, $q9);
$row9 = mysqli_fetch_assoc($result9);

$q10 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Savings' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result10 = mysqli_query($conn, $q10);
$row10 = mysqli_fetch_assoc($result10);

$q11 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Investments' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result11 = mysqli_query($conn, $q11);
$row11 = mysqli_fetch_assoc($result11);

$q12 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Entertainment' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result12 = mysqli_query($conn, $q12);
$row12 = mysqli_fetch_assoc($result12);

$q13 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Gifts/Donations' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result13 = mysqli_query($conn, $q13);
$row13 = mysqli_fetch_assoc($result13);

$q14 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Housing' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result14 = mysqli_query($conn, $q14);
$row14 = mysqli_fetch_assoc($result14);

$q15 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Personal'";
$result15 = mysqli_query($conn, $q15);
$row15 = mysqli_fetch_assoc($result15);

$q = "SELECT * from login where Email='{$_SESSION['email']}'";
$result = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($result);

// $KEY = "PUNK";

// $decrypted_row1 = openssl_decrypt(base64_decode($row1['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row2 = openssl_decrypt(base64_decode($row2['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row3 = openssl_decrypt(base64_decode($row3['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row4 = openssl_decrypt(base64_decode($row4['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row5 = openssl_decrypt(base64_decode($row5['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row6 = openssl_decrypt(base64_decode($row6['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row7 = openssl_decrypt(base64_decode($row7['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row8 = openssl_decrypt(base64_decode($row8['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row9 = openssl_decrypt(base64_decode($row9['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row10 = openssl_decrypt(base64_decode($row10['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row11 = openssl_decrypt(base64_decode($row11['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row12 = openssl_decrypt(base64_decode($row12['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row13 = openssl_decrypt(base64_decode($row13['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
// $decrypted_row14 = openssl_decrypt(base64_decode($row14['sum']), 'aes-128-cbc', $KEY, 0, '5555555555555555');


// if ($decrypted_row1 == false) {
//     $display_row1 = $row1['sum'];
// } else {
//     $display_row1 = $decrypted_row1;
// }

// if ($decrypted_row2 == false) {
//     $display_row2 = $row2['sum'];
// } else {
//     $display_row2 = $decrypted_row2;
// }

// if ($decrypted_row3 == false) {
//     $display_row3 = $row3['sum'];
// } else {
//     $display_row3 = $decrypted_row3;
// }

// // Continue this pattern for the remaining rows
// if ($decrypted_row4 == false) {
//     $display_row4 = $row4['sum'];
// } else {
//     $display_row4 = $decrypted_row4;
// }

// if ($decrypted_row5 == false) {
//     $display_row5 = $row5['sum'];
// } else {
//     $display_row5 = $decrypted_row5;
// }
// // For Row 6
// if ($decrypted_row6 == false) {
//     $display_row6 = $row6['sum'];
// } else {
//     $display_row6 = $decrypted_row6;
// }

// // For Row 7
// if ($decrypted_row7 == false) {
//     $display_row7 = $row7['sum'];
// } else {
//     $display_row7 = $decrypted_row7;
// }

// // For Row 8
// if ($decrypted_row8 == false) {
//     $display_row8 = $row8['sum'];
// } else {
//     $display_row8 = $decrypted_row8;
// }

// // For Row 9
// if ($decrypted_row9 == false) {
//     $display_row9 = $row9['sum'];
// } else {
//     $display_row9 = $decrypted_row9;
// }

// // For Row 10
// if ($decrypted_row10 == false) {
//     $display_row10 = $row10['sum'];
// } else {
//     $display_row10 = $decrypted_row10;
// }

// // For Row 11
// if ($decrypted_row11 == false) {
//     $display_row11 = $row11['sum'];
// } else {
//     $display_row11 = $decrypted_row11;
// }

// // For Row 12
// if ($decrypted_row12 == false) {
//     $display_row12 = $row12['sum'];
// } else {
//     $display_row12 = $decrypted_row12;
// }

// // For Row 13
// if ($decrypted_row13 == false) {
//     $display_row13 = $row13['sum'];
// } else {
//     $display_row13 = $decrypted_row13;
// }

// // For Row 14
// if ($decrypted_row14 == false) {
//     $display_row14 = $row14['sum'];
// } else {
//     $display_row14 = $decrypted_row14;
// }

// Repeat the above pattern until row 14
$q = "Select * from login where Email='{$_SESSION['email']}'";
$result = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($result);

$q16 = "SELECT * from login where Email='{$_SESSION['email']}'";
$result16 = mysqli_query($conn, $q16);
$row16 = mysqli_fetch_assoc($result16);


$eq1 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}' and FROM_BASE64(Exp_type)='Transportation'";

$eresult1 = mysqli_query($conn, $eq1);
$row1 = mysqli_fetch_assoc($eresult1);
$total_cost1 = $row1['total_cost'];

$eq2 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}' and FROM_BASE64(Exp_type)='Food'";

$eresult2 = mysqli_query($conn, $eq2);
$row2 = mysqli_fetch_assoc($eresult2);
$total_cost2 = $row2['total_cost'];

$eq3 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}' and FROM_BASE64(Exp_type)='Utilities'";

$eresult3 = mysqli_query($conn, $eq3);
$row3 = mysqli_fetch_assoc($eresult3);
$total_cost3 = $row3['total_cost'];

$eq4 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}' and FROM_BASE64(Exp_type)='Clothing'";

$eresult4 = mysqli_query($conn, $eq4);
$row4 = mysqli_fetch_assoc($eresult4);
$total_cost4 = $row4['total_cost'];

$eq5 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}' and FROM_BASE64(Exp_type)='Medical/Healthcare'";

$eresult5 = mysqli_query($conn, $eq5);
$row5 = mysqli_fetch_assoc($eresult5);
$total_cost5 = $row5['total_cost'];

$eq6 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}'and FROM_BASE64(Exp_type)='Insurance'";

$eresult6 = mysqli_query($conn, $eq6);
$row6 = mysqli_fetch_assoc($eresult6);
$total_cost6 = $row6['total_cost'];

$eq7 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}' and FROM_BASE64(Exp_type)='Household_Items/Supplies'";

$eresult7 = mysqli_query($conn, $eq7);
$row7 = mysqli_fetch_assoc($eresult7);
$total_cost7 = $row7['total_cost'];

$eq8 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}' and FROM_BASE64(Exp_type)='Debt/Loan'";

$eresult8 = mysqli_query($conn, $eq8);
$row8 = mysqli_fetch_assoc($eresult8);
$total_cost8 = $row8['total_cost'];

$eq9 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}' and FROM_BASE64(Exp_type)='Education'";

$eresult9 = mysqli_query($conn, $eq9);
$row9 = mysqli_fetch_assoc($eresult9);
$total_cost9 = $row9['total_cost'];

$eq10 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}' and FROM_BASE64(Exp_type)='Savings'";

$eresult10 = mysqli_query($conn, $eq10);
$row10 = mysqli_fetch_assoc($eresult10);
$total_cost10 = $row10['total_cost'];

$eq11 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}'and FROM_BASE64(Exp_type)='Investments'";

$eresult11 = mysqli_query($conn, $eq11);
$row11 = mysqli_fetch_assoc($eresult11);
$total_cost11 = $row11['total_cost'];

$eq12 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}'and FROM_BASE64(Exp_type)='Entertainment'";

$eresult12 = mysqli_query($conn, $eq12);
$row12 = mysqli_fetch_assoc($eresult12);
$total_cost12 = $row12['total_cost'];

$eq13 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}' and FROM_BASE64(Exp_type)='Gifts/Donations'";

$eresult13 = mysqli_query($conn, $eq13);
$row13 = mysqli_fetch_assoc($eresult13);
$total_cost13 = $row13['total_cost'];

$eq14 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}' and FROM_BASE64(Exp_type)='Housing'";

$eresult14 = mysqli_query($conn, $eq14);
$row14 = mysqli_fetch_assoc($eresult14);
$total_cost14 = $row14['total_cost'];


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
            margin-bottom: 50px;
        }

        .container h2 {
            font-size: 28px;
            margin-bottom: 10px; /* Adjust the margin-bottom to move the title upwards */
            color: #333;
        }

        #piechart {
            background-color: #ffffff; /* Set the background color here */
            width: 100%;
            max-width: 900px; /* Adjust the max-width for a larger chart */
            height: 600px; /* Adjust the height for a larger chart */
            margin: 0 auto;
        }

        .hidden {
            display: none;
        }

        /* Responsive styles for screens smaller than 768px */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .container h2 {
                font-size: 24px;
            }

            #piechart {
                max-width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Multi-Color Piechart</h2>
        <div id="piechart"></div>
        <input type="text" id="naam" value="<?php echo $row['First_Name'] ?>" class="hidden">
    </div>
    
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Transportation', parseInt('<?php echo $row1['total_cost']; ?>')],
                ['Food', parseInt('<?php echo $row2['total_cost']; ?>')],
                ['Utilities', parseInt('<?php echo $row3['total_cost']; ?>')],
                ['Clothing', parseInt('<?php echo $row4['total_cost']; ?>')],
                ['Medical/Healthcare', parseInt('<?php echo $row5['total_cost']; ?>')],
                ['Insurance', parseInt('<?php echo $row6['total_cost']; ?>')],
                ['Household_Items/Supplies', parseInt('<?php echo $row7['total_cost']; ?>')],
                ['Debt/Loan', parseInt('<?php echo $row8['total_cost']; ?>')],
                ['Education', parseInt('<?php echo $row9['total_cost']; ?>')],
                ['Savings', parseInt('<?php echo $row10['total_cost']; ?>')],
                ['Investments', parseInt('<?php echo $row11['total_cost']; ?>')],
                ['Entertainment', parseInt('<?php echo $row12['total_cost']; ?>')],
                ['Gifts/Donations', parseInt('<?php echo $row13['total_cost']; ?>')],
                ['Housing', parseInt('<?php echo $row14['total_cost']; ?>')]


            ], true);
            var naam = document.getElementById('naam').value;
            var options = {
                title: 'Expense of ' + naam + ' till date'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</body>
</html>
