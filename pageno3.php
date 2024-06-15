<?php
session_start();
// if ((time() - $_SESSION['user_time']) > 3600) {
//     echo '
//     <script>
//     alert("Your 60 seconds expired");
//     window.location="logout.php";
//     </script>';
// }
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    header("location:projectlogin.php");
}
?>
<?php
include 'dbconnect1.php';
$limit_per_page = 5;
$firstdate = date("Y/m/d", strtotime("first day of this month"));

$lastdate = date("Y/m/d", strtotime("last day of this month"));


$sql3 = "SELECT * FROM addexp where Email='{$_SESSION['email']}'and Expense_Date BETWEEN '$firstdate' AND '$lastdate' ORDER BY Expense_Date";
$sql3connect = mysqli_query($conn, $sql3) or die("Query Pageno Failed");
$nrows3 = mysqli_num_rows($sql3connect);
$total_pages = ceil($nrows3 / $limit_per_page);
$output2 = "
<div id='divwala' style='float:left'; class='container' >
<button name='prev'  id='prev3' type='button' class='btn btn-outline-dark mx-2'>Previous</button>
<input type='text' id='total_pages3' value='$total_pages' hidden>
";

for ($i = 1; $i <= $total_pages; $i++) {
    $output2 .= "<a hidden id='$i'>$i</a>";
}
$output2 .= "<button  name='next' id='next3' class='btn btn-outline-dark'>Next</button></div>";
echo $output2;
