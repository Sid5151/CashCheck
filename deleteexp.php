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
    
    
    $query="DELETE FROM `addexp` WHERE ID=$id";
    $result=mysqli_query($conn,$query);
    if($query)
    {
        echo'<script>
        
        alert("Expense Deleted");
        window.location="showexp.php";
        </script>
        
        ';
    }
    else
    {
        echo'<script>
        
        alert("Expense not Deleted");
        </script>
        ';
    }
}

?>