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
} else {
    $search_term = $_POST['search'];

    include "dbconnect1.php";
    $query = "SELECT * FROM `addexp` WHERE Email='{$_SESSION['email']}' AND Expense_Name Like '%$search_term%' ORDER BY Expense_Date";
    $result = mysqli_query($conn, $query) or die("Sorry query failed");
    $nrows = mysqli_num_rows($result);

    $sumquery = "SELECT SUM(Expense_Cost) AS sum FROM addexp WHERE Email='{$_SESSION['email']}'";
    $result1 = mysqli_query($conn, $sumquery);
    $row1 = mysqli_fetch_assoc($result1);


    if ($nrows > 0) {
        $boutput = "<br><table'>
            <tr>
    <th >Expense_Date</th>
    <th>Expense_Name</th>
    <th>Expense_Cost</th>
    <th>Edit</th>
    <th >Delete</th>
    </tr>";
        echo $boutput;
        while ($row = mysqli_fetch_assoc($result)) {

            $output = "
    
                    <tr>
            <td >" . $row['Expense_Date'] . "</td>
            <td >" . $row['Expense_Name'] . "</td>
            <td >" . $row['Expense_Cost'] . "</td>
            <td ><button id='ebtn' data-uid='{$row['ID']}' style='transition: transform.1s;'>Edit</button></td>
            <td ><button id='dbtn' data-id='{$row['ID']}' style='transition: transform.1s;'>Delete</button></td>
            </tr>
            </table>";
            echo $output;
        }
        // $output1 = "<tr style='border:0.3vw solid black;padding:0.5vw'><td id='te'>Total Expense = " . $row1['sum'] . "</td></tr>";
        // echo $output1;
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
