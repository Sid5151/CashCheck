<?php
session_start();
error_reporting(0);
include "dbconnect1.php";

$firstdate = date("Y/m/d", strtotime("first day of -3 months"));
$lastdate = date("Y/m/d", strtotime("last day of last month"));

$sql3 = "SELECT * FROM addexp where Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$firstdate' AND '$lastdate' ORDER BY Expense_Date";
$result  = mysqli_query($conn, $sql3) or die("Query Failed");
$nrows3 = mysqli_num_rows($result);

$qlogin = "Select * from login where Email='{$_SESSION['email']}'";
$result1 = mysqli_query($conn, $qlogin);
$row1 = mysqli_fetch_assoc($result1);

$sumquery = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS total_cost
FROM addexp
WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$firstdate' AND '$lastdate'";
$result2 = mysqli_query($conn, $sumquery);
$row2 = mysqli_fetch_assoc($result2);


$html = "
<!DOCTYPE html>
<html>
<head>
    <title>CashCheck</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1,h2{
            text-align: center;
            background-color: #007BFF;
            color: #fff;
            padding: 20px 0;
            margin: 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1 style='padding:2rem;border-radius:2rem;'>CashCheck </h1>
<h4 style='text-align: right;background-color:orange;padding:0.8rem;border-radius:1rem;'>-Unlock your financial freedom</h4>
<br><br>
<h2>This is list of last 3 Months Expense for <i><u>" . $row1['First_Name'] . "</u></i></h2>
    <br>
    
      <table>
      <tr>
        <th style='border:0.3vw solid black;padding:2.5rem;font-size:100px'>Expense_Date</th>
        <th style='border:0.3vw solid black;padding:2.5rem;font-size:100px'>Expense_Name</th>
        <th style='border:0.3vw solid black;padding:2.5rem;font-size:100px'>Expense_Type</th>
                        <th style='border:0.3vw solid black;padding:2.5rem;font-size:100px'>Payment_Mode</th>
        <th style='border:0.3vw solid black;padding:2.5rem;font-size:100px'>Expense_Cost</th>
        </tr>
  ";
$KEY = "PUNK";
while ($row = mysqli_fetch_assoc($result)) {
    $decrypted_name = openssl_decrypt(base64_decode($row['Expense_Name']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
    $decrypted_cost = openssl_decrypt(base64_decode($row['Expense_Cost']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
    $decrypted_type = openssl_decrypt(base64_decode($row['Exp_type']), 'aes-128-cbc', $KEY, 0, '5555555555555555');
    if ($decrypted_name == false) {
        $display_name = $row['Expense_Name'];
    } else {
        $display_name = $decrypted_name;
    }
    if ($decrypted_cost == false) {
        $display_cost = $row['Expense_Cost'];
    } else {
        $display_cost = $decrypted_cost;
    }
    if ($decrypted_type == false) {
        $display_type = $row['Exp_type'];
    } else {
        $display_type = $decrypted_type;
    }

    $html .= "
  
      <tr>
  <td style='border:0.3vw solid black;padding:2.5rem;font-size:70px'>" . $row['Expense_Date'] . "</td>
  <td style='border:0.3vw solid black;padding:2.5rem;font-size:70px'>" . base64_decode($row['Expense_Name']) . "</td>
  <td style='border:0.3vw solid black;padding:2.5rem;font-size:70px'>" . base64_decode($row['Exp_type']) . "</td>
    <td style='border:0.3vw solid black;padding:2.5rem;font-size:70px'>" . base64_decode($row['Payment_Mode'])  . "</td>
  <td style='border:0.3vw solid black;padding:2.5rem;font-size:70px'>" . base64_decode($row['Expense_Cost']) . "</td>
  </tr>
  ";
}
$html .= "
<tr><td style='border:0.3vw solid black;padding:2.5rem;font-size:70px' id='te'>Total Expense = " . $row2['total_cost'] . "</td></tr>

</table>
</body>
</html>";
require_once __DIR__ . '/vendor1/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();
