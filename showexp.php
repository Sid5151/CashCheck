<?php
session_start();
if(!isset($_SESSION['loggedin'])||!$_SESSION['loggedin']==true)
{
    header("location:projectlogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Expense</title>
    
</head>
<body> <br>
<form method="POST">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>
        <button type="submit" id="dd" name="submit" >Display Data</button>
    </form> <br><br>

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
    if (isset($_POST['start_date'])||isset($_POST['end_date'])) 
{
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
$_SESSION['startd']=$startDate;
$_SESSION['endd']=$endDate;

header("location:dateexp.php");
}

    $sqlfetch="SELECT * FROM addexp where Email='{$_SESSION['email']}'";
    
    $result=mysqli_query($conn,$sqlfetch) or die("Query Failed");
   $nrows=mysqli_num_rows($result); 
//    echo "<br>";
//    echo $nrows; echo "<br>";
  
   if($nrows>0)
   {
    
    while( $row=mysqli_fetch_assoc($result))
    {
        // $_SESSION['value1']=$row['Expense_Date'];
        // $_SESSION['value2']=$row['Expense_Name'];
        // $_SESSION['value3']=$row['Expense_Cost'];
        // $_SESSION['value4']=$row['ID'];
        
        echo "<tr>
        <td style='border:0.3vw solid black;padding:0.5vw'>".$row['Expense_Date']."</td>
        <td style='border:0.3vw solid black;padding:0.5vw'>".$row['Expense_Name']."</td>
        <td style='border:0.3vw solid black;padding:0.5vw'>".$row['Expense_Cost']."</td>
        <td style='border:0.3vw solid black;padding:0.5vw'><a class='btn btn-outline-primary' onclick='return ufirm()' href='updateexp.php?idd=$row[ID]'>Update</td>
        <td style='border:0.3vw solid black;padding:0.5vw'><a class='btn btn-outline-primary' onclick='return dfirm()' href='deleteexp.php?idd=$row[ID]'>Delete</td>
        </tr>";
        
    }
    
    // echo "<br>".$_SESSION['value1'];
    //     echo "<br>".$_SESSION['value2'];
    //     echo "<br>".$_SESSION['value3'];
   }

//    mysqli_close($conn);
?>

       </table>
       <a href="fpage.php">First Page</a>
       
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