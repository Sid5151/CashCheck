
<?php
session_start();
if(!isset($_SESSION['loggedin'])||!$_SESSION['loggedin']==true)
{
    echo'<script>
    window.location="projectlogin.php";
    </script>';
}
else
{
include 'dbconnect1.php';
if(isset($_POST['submit']))
{
    $id= $_GET['idd'];
    $date=$_POST['date'];
    $exp=$_POST['exp'];
    $cost=$_POST['cost'];
    $sanitized_date = 
        mysqli_real_escape_string($conn, $date);
          
    $sanitized_exp = 
        mysqli_real_escape_string($conn, $exp);
    
    $sanitized_cost = 
        mysqli_real_escape_string($conn, $cost);
        $query="UPDATE `addexp` SET 
    `Expense_Date`='$sanitized_date',`Expense_Name`='$sanitized_exp',`Expense_Cost`='$sanitized_cost'
     WHERE ID= $id";
     $result=mysqli_query($conn,$query);
     if($result)
     {
         echo'<script>
         
         alert("Expense Updated");
         window.location="showexp.php";
         </script>
         
         ';
     }
     else
     {
         echo'<script>
         
         alert("Expense not updated");
         </script>
         ';
     }
}
        
}



    

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Expense</title>
</head>
<body>
    <form  method="post">
    <span>Date </span><input type="date" name="date" id="date" required  > <br><br>
    <span>Expense </span><input type="text" name="exp" id="exp" required  ><br><br>
    <span>Cost </span><input type="text" name="cost" id="cost" required ><br><br>
    <button type="submit" class='btn btn-outline-primary' name="update">Update Expense</button>
    </form>
    
</body>
</html>