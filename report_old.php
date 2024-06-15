<?php
session_start();
include "dbconnect1.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Report</title>
    <style>
        table,
        th,
        tr,
        td {
            border: 2px solid black;
            font-size: larger;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <span style="font-size: large;">Enter the Start Date:</span> <input type="date" name="rsdate" id="rsdate">
        <span style="font-size: large;">Enter the End Date:</span> <input type="date" name="redate" id="redate">
        <input type="submit" value="Send Mail" id="sub" name="sub">
    </form>

    <br>
    <table>
        <tr>
            <th>Date-Wise</th>
            <th>View & Download Report</th>
        </tr>
        <tr>
            <td>Till Date</td>
            <td><a href="makepdf.php" target="_blank" id="till_date" download="">View & Download</a></td>
            <td><a href="pdfmail.php" target="_blank" id="till_date">Send Mail</a></td>

        </tr>
        <tr>
            <td>Current_Year</td>
            <td><a href="CY_makepdf.php" target="_blank" id="CY" download="">View & Download</a></td>
            <td><a href="CY_report.php" target="_blank" id="CY">Send Mail</a></td>
        </tr>
        <tr>
            <td>Current_Month</td>
            <td><a href="CM_makepdf.php" target="_blank" id="CM" download="">View & Download</a></td>
            <td><a href="CM_report.php" target="_blank" id="CM">Send Mail</a></td>
        </tr>
        <tr>
            <td>Previous_Month</td>
            <td><a href="PM_makepdf.php" target="_blank" id="CM" download="">View & Download</a></td>
            <td><a href="PM_report.php" target="_blank" id="CM">Send Mail</a></td>
        </tr>
        <tr>
            <td>Previous_3_Months</td>
            <td><a href="P3M_makepdf.php" target="_blank" id="CM" download="">View & Download</a></td>
            <td><a href="P3M_report.php" target="_blank" id="CM">Send Mail</a></td>
        </tr>
        <tr>
            <td>Previous_6_months</td>
            <td><a href="P6M_makepdf.php" target="_blank" id="CM" download="">View & Download</a></td>
            <td><a href="P6M_report.php" target="_blank" id="CM">Send Mail</a></td>
        </tr>
    </table>
    <!-- <script src="jquery-3.7.0.min.js"></script>
    <script>
        $(function() {
            $("#till_date").click(function() {
                window.location = "ProjectSynopsis.pdf";
            });
        });
    </script> -->
</body>

</html>
<?php


if (isset($_POST['sub'])) {
    $rsdate = $_POST['rsdate'];
    $redate = $_POST['redate'];
    $_SESSION['rsdate'] = $rsdate;
    $_SESSION['redate'] = $redate;
    header("location:datereport.php");
}
?>