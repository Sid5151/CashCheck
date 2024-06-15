<?php
session_start();
if(!isset($_SESSION['loggedin'])||!$_SESSION['loggedin']==true)
{
    echo'<script>
    window.location="projectlogin.php";
    </script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Expense </title>
</head>
<body>
<h3>Expense displayed from <?php echo $_SESSION['startd']; ?> to <?php echo $_SESSION['endd']; ?>  </h3>
    <table style='border:0.5vw solid black;'>
        <tr>
        <th style='border:0.3vw solid black;padding:0.5vw'>Expense_Date</th>
        <th style='border:0.3vw solid black;padding:0.5vw'>Expense_Name</th>
        <th style='border:0.3vw solid black;padding:0.5vw'>Expense_Cost</th>
        <th style='border:0.3vw solid black;padding:0.5vw'>Update</th>
        <th style='border:0.3vw solid black;padding:0.5vw'>Delete</th>    
    </tr>
    <?php
    include 'dbconnect1.php';

        // Fetch data from the database between the selected dates
        $query = "SELECT * FROM addexp WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '{$_SESSION['startd']}' AND '{$_SESSION['endd']}'";
        $result2 = mysqli_query($conn, $query);
    
        if ($result2 && mysqli_num_rows($result2) > 0) 
        {
            while ($row = mysqli_fetch_assoc($result2)) 
            {
                echo "<tr>
                <td style='border:0.3vw solid black;padding:0.5vw'>".$row['Expense_Date']."</td>
                <td style='border:0.3vw solid black;padding:0.5vw'>".$row['Expense_Name']."</td>
                <td style='border:0.3vw solid black;padding:0.5vw'>".$row['Expense_Cost']."</td>
                <td style='border:0.3vw solid black;padding:0.5vw'><a class='btn btn-outline-primary' onclick='return ufirm()' href='updateexp.php?idd=$row[ID]'>Update</td>
                <td style='border:0.3vw solid black;padding:0.5vw'><a class='btn btn-outline-primary' onclick='return dfirm()' href='deleteexp.php?idd=$row[ID]'>Delete</td>
                </tr>";
            }
        } 
        else 
        {
                echo 'No data available between the selected dates.';
        }
    
        // Free result set
        // mysqli_free_result($result);
    
    
    ?>
</table>
<script>
        function redirect()
        {
            window.location="updateexp.php";
        }
        function dfirm()
        {
            var a=confirm("Are you sure want to delete?");
            console.log(a);
            if(!a==true)
            {
                return false;
                
            }
        }
        function ufirm()
        {
            var a=confirm("Are you sure want to update?");
            console.log(a);
            if(!a==true)
            {
                return false;
            }
        }
    </script>
</body>
</html>