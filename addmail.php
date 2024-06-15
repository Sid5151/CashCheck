<?php
session_start();
include "dbconnect1.php";

$firstdate = date("Y/m/d", strtotime("first day of last month"));
$lastdate = date("Y/m/d", strtotime("last day of last month"));

$allmail = "SELECT * FROM login";
$result3 = mysqli_query($conn, $allmail);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

while ($row3 = mysqli_fetch_assoc($result3)) {
    $sql3 = "SELECT * FROM addexp WHERE Email='{$row3['Email']}' and Expense_Date BETWEEN '$firstdate' AND '$lastdate' ORDER BY Expense_Date";
    $result  = mysqli_query($conn, $sql3) or die("Query Failed");
    $nrows3 = mysqli_num_rows($result);

    $sumquery = "SELECT SUM(Expense_Cost) AS sum FROM addexp WHERE Email='{$row3['Email']}'and Expense_Date BETWEEN '$firstdate' AND '$lastdate' ORDER BY Expense_Date";
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
    <h2>This is list of all the expenses for the Previous Month <i><u>" . $row3['First_Name'] . "</u></i></h2>
        <br>
    
          <table>
          <tr>
            <th style='border:0.3vw solid black;padding:2.5rem;font-size:100px'>Expense_Date</th>
            <th style='border:0.3vw solid black;padding:2.5rem;font-size:100px'>Expense_Name</th>
            <th style='border:0.3vw solid black;padding:2.5rem;font-size:100px'>Expense_Type</th>
    
            <th style='border:0.3vw solid black;padding:2.5rem;font-size:100px'>Expense_Cost</th>
            </tr>
      ";
    while ($row = mysqli_fetch_assoc($result)) {

        $html .= "
    
          <tr>
      <td style='border:0.3vw solid black;padding:2.5rem;font-size:70px'>" . $row['Expense_Date'] . "</td>
      <td style='border:0.3vw solid black;padding:2.5rem;font-size:70px'>" . $row['Expense_Name'] . "</td>
      <td style='border:0.3vw solid black;padding:2.5rem;font-size:70px'>" . $row['Exp_type'] . "</td>
      <td style='border:0.3vw solid black;padding:2.5rem;font-size:70px'>" . $row['Expense_Cost'] . "</td>
      </tr>
      ";
    }
    $html .= "
    <tr><td style='border:0.3vw solid black;padding:2.5rem;font-size:70px' id='te'>Total Expense = " . $row2['sum'] . "</td></tr>
    
    </table>
    </body>
    </html>";

    require_once __DIR__ . '/vendor1/autoload.php';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $pdf = $mpdf->Output("", "S");

    // Create an instance of PHPMailer
    $mail = new PHPMailer();

    // Set mailer to use SMTP
    $mail->isSMTP();

    // Define SMTP host
    $mail->Host = "smtp.gmail.com";

    // Enable SMTP authentication
    $mail->SMTPAuth = true;

    // Set type of encryption (ssl/tls)
    $mail->SMTPSecure = "tls";

    // Set port to connect SMTP
    $mail->Port = 587;

    // Set Gmail username and password
    $mail->Username = "cashcheck0707@gmail.com";
    $mail->Password = "raqv ibxs jtri pfwt";

    // Set email subject
    $mail->Subject = "Previous Month Expenses";

    // Set sender email
    $mail->setFrom("cashcheck0707@gmail.com");

    // Email Body
    $mail->isHTML(true);
    $mail->Body = "🌟 Your Monthly Expenditure Odyssey Awaits 📊

    Dear Valued Users,
    
    Within the folds of this PDF attachment lies a snapshot of your past month's financial voyage. 🌙💰<br>
    
    Uncover the secrets, illuminate the patterns, and embrace the insights that await you as you embark on this journey through your expenses. 💡🚀<br>
    
    Open with anticipation, for within these pages, you'll find the story of your choices and priorities, beautifully captured in numbers. 📈✨<br>
    
    May this document be your compass for the path ahead, guiding you towards a brighter and more prosperous future. 🌟🛤️<br.
    
    With appreciation for your trust,<br>
    
    [CashCheck] 💼🌐";

    // Add recipient
    $mail->addAddress($row3['Email']);

    // Add the PDF attachment
    $mail->addStringAttachment($pdf, "Expenses_PreviousMonth.pdf");

    // Finally send email
    if ($mail->send()) {
        echo '<script>alert("A pdf has been sent");</script>';
    } else {
        echo '<script>alert("Could not send pdf")</script>';
    }

    // Closing SMTP
    $mail->smtpClose();
}
