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
    header("location:projectlogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>


    <?php
    include 'dbconnect1.php';
    // if (isset($_POST['start_date']) || isset($_POST['end_date'])) {
    //     $startDate = $_POST['start_date'];
    //     $endDate = $_POST['end_date'];
    //     $_SESSION['startd'] = $startDate;
    //     $_SESSION['endd'] = $endDate;

    //     header("location:dateexp.php");
    // }

    $sqlfetch = "SELECT * FROM addexp where Email='{$_SESSION['email']}' ORDER BY Expense_Date";

    $result = mysqli_query($conn, $sqlfetch) or die("Query Failed");
    $nrows = mysqli_num_rows($result);

    $sumquery = "SELECT SUM(Expense_Cost) AS sum FROM addexp WHERE Email='{$_SESSION['email']}'";
    $result1 = mysqli_query($conn, $sumquery);
    $row1 = mysqli_fetch_assoc($result1);
    if ($nrows > 0 && $result1) {
        $boutput = "<table style='border:0.5vw solid black;float:left'>
        <tr>
<th style='border:0.3vw solid black;padding:0.5vw'>Expense_Date</th>
<th style='border:0.3vw solid black;padding:0.5vw'>Expense_Name</th>
<th style='border:0.3vw solid black;padding:0.5vw'>Expense_Cost</th>
<th style='border:0.3vw solid black;padding:0.5vw'>Edit</th>
<th style='border:0.3vw solid black;padding:0.5vw'>Delete</th>
</tr>";
        echo $boutput;
        while ($row = mysqli_fetch_assoc($result)) {

            $output = "

                <tr>
        <td style='border:0.3vw solid black;padding:0.5vw'>" . $row['Expense_Date'] . "</td>
        <td style='border:0.3vw solid black;padding:0.5vw'>" . $row['Expense_Name'] . "</td>
        <td style='border:0.3vw solid black;padding:0.5vw'>" . $row['Expense_Cost'] . "</td>
        <td style='border:0.3vw solid black;padding:0.5vw'><button id='ebtn' data-uid='{$row['ID']}' style='transition: transform.1s;'>Edit</button></td>
        <td style='border:0.3vw solid black;padding:0.5vw'><button id='dbtn' data-id='{$row['ID']}' style='transition: transform.1s;'>Delete</button></td>
        </tr>
        </table>";
            echo $output;
        }
        $output1 = "<tr style='border:0.3vw solid black;padding:0.5vw'><td id='te'>Total Expense = " . $row1['sum'] . "</td></tr>";
        echo $output1;
    } else {
        $filepath = 'https://sid.free.nf/norecordfound.jpg';
        echo '<div>
                <img src="' . $filepath . '" alt="nrf" width="15%" style="margin-left:20px">
            <h2 style="font-weight: 400;">Sorry no <i><u>record</u></i> found!</h2>
            <h3>Add an expense to see one... </h3>
            </div>
            ';
    }
    ?>

</body>

</html>