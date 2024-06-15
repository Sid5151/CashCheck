<?php
session_start();
error_reporting(0);
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
} else {
    include 'dbconnect1.php';
    $firstdate = date("Y/m/d", strtotime("first day of -6 months"));

    $lastdate = date("Y/m/d", strtotime("last day of last month"));

    $limit_per_page = 5;
    $sql3 = "SELECT * FROM addexp WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$firstdate' AND '$lastdate' ORDER BY Expense_Date";
    $sql3connect = mysqli_query($conn, $sql3) or die("Query Failed");
    $nrows3 = mysqli_num_rows($sql3connect);
    $total_pages = ceil($nrows3 / $limit_per_page);
    $page = "";
    if (isset($_POST['page_no'])) {
        $page = $_POST['page_no'];
    } else if (isset($_POST['gtp'])) {
        $page = $_POST['gtp'];
    } else {
        $page = 1;
    }
    // Fetch data from the database between the selected dates

    $offset = ($page - 1) * $limit_per_page;

    $query = "SELECT * FROM addexp where Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$firstdate' AND '$lastdate' ORDER BY Expense_Date LIMIT {$offset} , {$limit_per_page}";
    $result2 = mysqli_query($conn, $query);

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
    $result1 = mysqli_query($conn, $sumquery);
    $row1 = mysqli_fetch_assoc($result1);

    if ($result2 && mysqli_num_rows($result2) > 0) {

        $boutput = "<input type='text' id='pages5' value='$page' hidden>
        <input type='text' id='t_pages' value='$total_pages' hidden>";
        echo $boutput;
        $KEY = "PUNK";
        while ($row = mysqli_fetch_assoc($result2)) {
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
            $output = "<tr>
            <td >" . $row['Expense_Date'] . "</td>
            <td >" . base64_decode($row['Expense_Name'])  . "</td>
            <td >" . base64_decode($row['Exp_type'])  . "</td>
            <td >" . base64_decode($row['Payment_Mode']) . "</td>
            <td >" . base64_decode($row['Expense_Cost'])  . "</td>
            <td ><button id='ebtn' data-uid='{$row['ID']}'  >Edit</button></td>
            <td ><button id='dbtn' data-id='{$row['ID']}'>Delete</button></td>
            </tr>";
            echo $output;
        }
        $output1 = "<tr style='font-weight:700;'><td id='te'>Total Expense = " . $row1['total_cost'] . "</td></tr>";
        echo $output1;

        $output2 = "<span id='showpageno'>Page No: $page of $total_pages</span";
        echo $output2;
    } else {
        $filepath = 'https://sid.free.nf/norecordfound.jpg';
        echo '<div>
                <img src="' . $filepath . '" alt="nrf" width="15%" style="margin-left:20px">
            <h2 style="font-weight: 400;">Sorry no <i><u>record</u></i> found!</h2>
            <h3>Add an expense to see one... </h3>
            </div>
            ';
    }
}
