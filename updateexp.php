
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
  
    $id=$_GET['idd'];
    $sqlfetch="SELECT * FROM addexp where ID='$id'";

    $result1=mysqli_query($conn,$sqlfetch) or die("Query Failed");
   $nrows=mysqli_num_rows($result1); 
   $row=mysqli_fetch_assoc($result1);

   $id=$_GET['idd'];
if(isset($_POST['submit']))
{
    
    $date=$_POST['date'];
    $exp=$_POST['exp'];
    $cost=$_POST['cost'];
    
    $sanitized_date = 
        mysqli_real_escape_string($conn, $date);
          
    $sanitized_exp = 
        mysqli_real_escape_string($conn, $exp);
    
    $sanitized_cost = 
        mysqli_real_escape_string($conn, $cost);
        $query="UPDATE `addexp` SET `Expense_Date`='$sanitized_date',`Expense_Name`='$sanitized_exp',`Expense_Cost`='$sanitized_cost' WHERE ID= $id";
        
        $result=mysqli_query($conn,$query);
        if($result)
                  {
                      echo '<script>
                      alert("Your expense has been updated.");
                      window.location="showexp.php";
                      </script>';  
                      
                      
                  }
                  else{
                      echo "Sorry Your expense has not been updated, since there is a techical difficulties....";
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
    <form method="post">
    <span>Date </span><input type="date" name="date" id="date" required value="<?php echo $row['Expense_Date']; ?>"> <br><br>
    <span>Expense </span><input type="text" name="exp" id="exp" required value="<?php echo $row['Expense_Name']; ?>"><br><br>
    <span>Cost </span><input type="text" name="cost" id="cost" required value="<?php echo $row['Expense_Cost']; ?>"> <br><br>
    <input type="submit" value="Update Details" name="submit">
    <a href="fpage.php">First Page</a>
</form>
</body>
</html>

