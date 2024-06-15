<?php
session_start();
include "dbconnect1.php";

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    echo '<script>
    window.location="projectlogin.php";
    </script>';
}

$q = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Transportation'";
$result1 = mysqli_query($conn, $q);
$row1 = mysqli_fetch_assoc($result1);

$q2 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Food'";
$result2 = mysqli_query($conn, $q2);
$row2 = mysqli_fetch_assoc($result2);

$q3 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Utilities'";
$result3 = mysqli_query($conn, $q3);
$row3 = mysqli_fetch_assoc($result3);

$q4 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Clothing'";
$result4 = mysqli_query($conn, $q4);
$row4 = mysqli_fetch_assoc($result4);

$q5 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Medical/Healthcare'";
$result5 = mysqli_query($conn, $q5);
$row5 = mysqli_fetch_assoc($result5);

$q6 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Insurance'";
$result6 = mysqli_query($conn, $q6);
$row6 = mysqli_fetch_assoc($result6);

$q7 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Household_Items/Supplies'";
$result7 = mysqli_query($conn, $q7);
$row7 = mysqli_fetch_assoc($result7);

$q8 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Debt/Loan'";
$result8 = mysqli_query($conn, $q8);
$row8 = mysqli_fetch_assoc($result8);

$q9 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Education'";
$result9 = mysqli_query($conn, $q9);
$row9 = mysqli_fetch_assoc($result9);

$q10 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Savings'";
$result10 = mysqli_query($conn, $q10);
$row10 = mysqli_fetch_assoc($result10);

$q11 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Investments'";
$result11 = mysqli_query($conn, $q11);
$row11 = mysqli_fetch_assoc($result11);

$q12 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Entertainment'";
$result12 = mysqli_query($conn, $q12);
$row12 = mysqli_fetch_assoc($result12);

$q13 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Gifts/Donations'";
$result13 = mysqli_query($conn, $q13);
$row13 = mysqli_fetch_assoc($result13);

$q14 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Housing'";
$result14 = mysqli_query($conn, $q14);
$row14 = mysqli_fetch_assoc($result14);

$q15 = "SELECT SUM(Expense_Cost) AS sum from addexp where Email='{$_SESSION['email']}' and Exp_type='Personal'";
$result15 = mysqli_query($conn, $q15);
$row15 = mysqli_fetch_assoc($result15);

$q16 = "SELECT * from login where Email='{$_SESSION['email']}'";
$result16 = mysqli_query($conn, $q16);
$row16 = mysqli_fetch_assoc($result16);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Element', 'Expense_Cost', {
                    role: 'style'
                }],
                ['Transportation', parseInt('<?php echo $row1['sum']; ?>'), '#b87333'], // RGB value
                ['Food', parseInt('<?php echo $row2['sum']; ?>'), 'silver'], // English color name
                ['Utilities', parseInt('<?php echo $row3['sum']; ?>'), 'gold'],
                ['Clothing', parseInt('<?php echo $row4['sum']; ?>'), 'color: red'], // CSS-style declaration
                ['Medical/Healthcare', parseInt('<?php echo $row5['sum']; ?>'), 'color: #e5e4e2'], // CSS-style declaration
                ['Insurance', parseInt('<?php echo $row6['sum']; ?>'), 'color: #e5e4e2'], // CSS-style declaration
                ['Household_Items/Supplies', parseInt('<?php echo $row7['sum']; ?>'), 'color: #e5e4e2'], // CSS-style declaration
                ['Debt/Loan', parseInt('<?php echo $row8['sum']; ?>'), 'color: #e5e4e2'], // CSS-style declaration
                ['Education', parseInt('<?php echo $row9['sum']; ?>'), 'color: #e5e4e2'], // CSS-style declaration
                ['Savings', parseInt('<?php echo $row10['sum']; ?>'), 'color: #e5e4e2'], // CSS-style declaration
                ['Investments', parseInt('<?php echo $row11['sum']; ?>'), 'color: #e5e4e2'], // CSS-style declaration
                ['Entertainment', parseInt('<?php echo $row12['sum']; ?>'), 'color: #e5e4e2'], // CSS-style declaration
                ['Gifts/Donations', parseInt('<?php echo $row13['sum']; ?>'), 'color: #e5e4e2'], // CSS-style declaration
                ['Housing', parseInt('<?php echo $row14['sum']; ?>'), 'color: #e5e4e2'], // CSS-style declaration

            ]);
            var naam = document.getElementById('naam').value;

            var options = {
                chart: {
                    title: 'Expenses of ' + naam,
                    subtitle: 'Expense till date',
                },
                bars: 'horizontal' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
</head>

<body>
    <!-- Navbar code here -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="n_first.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Expenses
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="addexp1.php">Add Expenses</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="showexp2.php" id="me">Manage Expenses</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Graphs/Analysis
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="piechart.php">Piechart</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="g_bargraph.php" id="me">Bargraph</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="diff_chart.php" id="me">Comparing Charts</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="profile1.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="report.php">Report</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">LogOut</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <!-- End of Navbar -->
    <br>
    <!-- Rest of your PHP code -->
    <div id="barchart_material" style="width: 900px; height: 500px; margin-left:4rem;"></div>
    <input type="text" id="naam" value="<?php echo $row16['First_Name'] ?>" hidden>

</body>

</html>