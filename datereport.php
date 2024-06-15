<?php
session_start();
error_reporting(0);
include "dbconnect1.php";
$sql3 = "SELECT * FROM addexp where Email='{$_SESSION['email']}' and Expense_Date BETWEEN '{$_SESSION['rsdate']}' AND '{$_SESSION['redate']}' ORDER BY Expense_Date";
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
WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '{$_SESSION['rsdate']}' AND '{$_SESSION['redate']}'";
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
<h2>This is list of all the expenses from {$_SESSION['rsdate']} to {$_SESSION['redate']} for <i><u>" . $row1['First_Name'] . "</u></i></h2>
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
// $mpdf->Output();
$pdf = $mpdf->Output("", "S");
//include required php files
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Create instance of phpmailer
$mail = new PHPMailer();
//Set mailer to use smtp
$mail->isSMTP();
//define smtp host
$mail->Host = "smtp.gmail.com";
//enable smtp authentication
$mail->SMTPAuth = "true";
//set type of encryption(ssl/tls)
$mail->SMTPSecure = "tls";
//set port to connect smtp
$mail->Port = "587";
//set gmail username
$mail->Username = "cashcheck0707@gmail.com";
//set gmail password
$mail->Password = "xwku nbgs eolr xviw";
//Set email subject
$mail->Subject = "{$_SESSION['rsdate']} to {$_SESSION['redate']} Expenses";
//set sender email
$mail->setFrom("cashcheck0707@gmail.com");
//Email Body
$mail->isHTML(true);
$mail->Body = "🌟 Your Monthly Expenditure Odyssey Awaits 📊

Dear Valued Users,

Within the folds of this PDF attachment lies a snapshot of your expenses from <em>{$_SESSION['rsdate']} to {$_SESSION['redate']}</em> financial voyage. 🌙💰 <br>

Uncover the secrets, illuminate the patterns, and embrace the insights that await you as you embark on this journey through your expenses. 💡🚀<br>

Open with anticipation, for within these pages, you'll find the story of your choices and priorities, beautifully captured in numbers. 📈✨<br>

May this document be your compass for the path ahead, guiding you towards a brighter and more prosperous future. 🌟🛤️.<br>

With appreciation for your trust,<br>

[CashCheck] 💼🌐";
//Add recipient
$mail->addAddress("{$_SESSION['email']}");
$mail->addStringAttachment($pdf, "{$_SESSION['rsdate']} to {$_SESSION['redate']}.pdf");
// $mail->addAttachment($pdf, 'attach');
//Finally send email
if ($mail->send()) {

    echo '<script>alert("A pdf has been sent");
    
    </script>';
} else {
    echo '<script>alert("Could not send pdf")</script>';
}
//Closing smtp
$mail->smtpClose();
