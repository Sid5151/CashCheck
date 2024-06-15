<?php
session_start();
// if ((time() - $_SESSION['user_time']) > 3600) {
//     echo '
//     <script>
//     alert("Your are inactive for an hour!!!");
//     window.location="logout.php";
//     </script>';
// }
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    echo '<script>
    window.location="projectlogin.php";
    </script>';
} else {
    include 'dbconnect1.php';
    //current_month
    $current_month_firstdate = date("Y/m/d", strtotime("first day of this month"));
    $current_month_lastdate = date("Y/m/d", strtotime("last day of this month"));
    //previous_month
    $previous_month_firstdate = date("Y/m/d", strtotime("first day of last month"));
    $previous_month_lastdate = date("Y/m/d", strtotime("last day of last month"));
    //previous_3_months
    $previous_3_months_firstdate = date("Y/m/d", strtotime("first day of -3 months"));
    $previous_3_months_lastdate = date("Y/m/d", strtotime("last day of last month"));

    //previous_6_months
    $previous_6_months_firstdate = date("Y/m/d", strtotime("first day of -6 months"));
    $previous_6_months_lastdate = date("Y/m/d", strtotime("last day of last month"));
    //previous 9 months
    $previous_9_months_firstdate = date("Y/m/d", strtotime("first day of -9 months"));
    $previous_9_months_lastdate = date("Y/m/d", strtotime("last day of last month"));
    //curreny year
    $cy_firstdate = date("Y/m/d", strtotime("first day of january this year"));
    $cy_lastdate = date("Y/m/d", strtotime("last day of december this year"));

    $login_q = "Select * from login where Email='{$_SESSION['email']}'";
    $login_q_connect = mysqli_query($conn, $login_q);
    $login_q_row = mysqli_fetch_assoc($login_q_connect);

    $first_day_of_month = date("Y/m/d", strtotime("first day of this month"));
    $last_day_of_month = date("Y/m/d", strtotime("last day of this month"));
    $addexp_q = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS total_cost
    FROM addexp
    WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$first_day_of_month' AND '$last_day_of_month'";
    $addexp_q_connect = mysqli_query($conn, $addexp_q);
    $addexp_q_row = mysqli_fetch_assoc($addexp_q_connect);
    $_SESSION['count_for_limit']++;
    if ($_SESSION['count_for_limit'] == 1) {
       
    }
    $current_month = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS total_cost
    FROM addexp
    WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$current_month_firstdate' AND '$current_month_lastdate'";
    $cm_connect = mysqli_query($conn, $current_month) or die("Query Failed");
    $current_month1 = "SELECT * FROM addexp WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$current_month_firstdate' AND '$current_month_lastdate'";
    $cm_connect1 = mysqli_query($conn, $current_month1) or die("Query Failed");
    $cm_row = mysqli_fetch_assoc($cm_connect1);
    $cm_row1 = mysqli_fetch_assoc($cm_connect);
    // if ($cm_connect) {
    //   $cm_total = $cm_row1['sum'];
    // } if (mysqli_num_rows($cm_connect1) <= 0) {
    //   $cm_total = "0";
    // }

    $previous_month = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS total_cost
    FROM addexp
    WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$previous_month_firstdate' AND '$previous_month_lastdate'";
    $previous_month1 = "SELECT * FROM addexp WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$previous_month_firstdate' AND '$previous_month_lastdate'";
    $pm_connect1 = mysqli_query($conn, $previous_month1) or die("Query Failed");
    $pm_connect = mysqli_query($conn, $previous_month) or die("Query Failed");
    $pm_row = mysqli_fetch_assoc($pm_connect1);
    $pm_row1 = mysqli_fetch_assoc($pm_connect);
    // if ($pm_connect) {
    //   $pm_total = $pm_row1['sum'];
    // }
    // if (mysqli_num_rows($pm_connect1) <= 0) {
    //   $pm_total = "0";
    // }

    $previous_3_months = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS total_cost
    FROM addexp
    WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$previous_3_months_firstdate' AND '$previous_3_months_lastdate'";
    $p3m_connect = mysqli_query($conn, $previous_3_months) or die("Query Failed");
    $previous_3_months1 = "SELECT * FROM addexp WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$previous_3_months_firstdate' AND '$previous_3_months_lastdate'";
    $p3m_connect1 = mysqli_query($conn, $previous_3_months1) or die("Query Failed");
    $p3m_row = mysqli_fetch_assoc($p3m_connect1);
    $p3m_row1 = mysqli_fetch_assoc($p3m_connect);


    $previous_6_months = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS total_cost
    FROM addexp
    WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$previous_6_months_firstdate' AND '$previous_6_months_lastdate'";
    $p6m_connect = mysqli_query($conn, $previous_6_months) or die("Query Failed");
    $previous_6_months1 = "SELECT * FROM addexp WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$previous_6_months_firstdate' AND '$previous_6_months_lastdate'";
    $p6m_connect1 = mysqli_query($conn, $previous_6_months1) or die("Query Failed");
    $p6m_row = mysqli_fetch_assoc($p6m_connect1);
    $p6m_row1 = mysqli_fetch_assoc($p6m_connect);

    $previous_9_months = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS total_cost
    FROM addexp
    WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$previous_9_months_firstdate' AND '$previous_9_months_lastdate'";
    $p9m_connect = mysqli_query($conn, $previous_9_months) or die("Query Failed");
    $previous_9_months1 = "SELECT * FROM addexp WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$previous_9_months_firstdate' AND '$previous_9_months_lastdate'";
    $p9m_connect1 = mysqli_query($conn, $previous_9_months1) or die("Query Failed");
    $p9m_row = mysqli_fetch_assoc($p9m_connect1);
    $p9m_row1 = mysqli_fetch_assoc($p9m_connect);

    $cy = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS total_cost
    FROM addexp
    WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$cy_firstdate' AND '$cy_lastdate'";
    $cy_connect = mysqli_query($conn, $cy) or die("Query Failed");
    $cy1 = "SELECT * FROM addexp WHERE Email='{$_SESSION['email']}' and Expense_Date BETWEEN '$cy_firstdate' AND '$cy_lastdate'";
    $cy_connect1 = mysqli_query($conn, $cy1) or die("Query Failed");
    $cy_row = mysqli_fetch_assoc($cy_connect1);
    $cy_row1 = mysqli_fetch_assoc($cy_connect);


    if ($cm_connect) {
        $cm_total = $cm_row1['total_cost'];
    }
    if (mysqli_num_rows($cm_connect1) <= 0) {
        $cm_total = "0";
    }
    if ($pm_connect) {
        $pm_total = $pm_row1['total_cost'];
    }
    if (mysqli_num_rows($pm_connect1) <= 0) {
        $pm_total = "0";
    }
    if ($p3m_connect) {
        $p3m_total = $p3m_row1['total_cost'];
    }
    if (mysqli_num_rows($p3m_connect1) <= 0) {
        $p3m_total = "0";
    }

    if ($p6m_connect) {
        $p6m_total = $p6m_row1['total_cost'];
    }
    if (mysqli_num_rows($p6m_connect1) <= 0) {
        $p6m_total = "0";
    }

    if ($p9m_connect) {
        $p9m_total = $p9m_row1['total_cost'];
    }
    if (mysqli_num_rows($p9m_connect1) <= 0) {
        $p9m_total = "0";
    }
    if ($cy_connect) {
        $cy_total = $cy_row1['total_cost'];
    }
    if (mysqli_num_rows($cy_connect1) <= 0) {
        $cy_total = "0";
    }
}

$sqlfetch = "SELECT * FROM login where Email='{$_SESSION['email']}'";

$result = mysqli_query($conn, $sqlfetch) or die("Query Failed");
$nrows = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CashCheck</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }

        .calendar-images {
            margin-top: 30px;
        }

        .calendar-images img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 2px solid #007bff;
        }

        .calendar-text {
            height: 55px;
            line-height: 25px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            color: #343a40;
            margin-left: 0;
        }

        .calendar-images input {
            margin-top: -10px;
            margin-left: -10px;
            margin-bottom: 10px;
        }

        .welcome-message {
            background-color: cadetblue;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
        }

        .pad-right {
            padding-right: 684px;
        }
        .bg-custom {
        background-color: black !important; /* Custom background color */
    }

        /* Dropdown menu styles */
        .dropdown-menu {
            background-color: #343a40;
            /* Background color */
            border: 1px solid rgba(0, 0, 0, 0.1);
            /* Border color */
            border-radius: 0.25rem;
            /* Border radius */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            /* Box shadow */
            padding: 0.5rem;
        }

        /* Dropdown item styles */
        .dropdown-item {
            color: #ffffff;
            /* Text color */

        }

        /* Hover effect on dropdown items */
        .dropdown-item:hover {
            background-color: whitesmoke;
            /* Background color on hover */
        }

        /* Active state for dropdown items */
        .dropdown-item.active,
        .dropdown-item:active {
            background-color: whitesmoke;
            /* Background color */
            color: #ffffff;
            /* Text color */
        }

        /* Submenu positioning */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
        }

        /* Toggle arrow for submenu */
        .dropdown-submenu .dropdown-toggle::after {
            display: inline-block;
            width: 0;
            height: 0;
            vertical-align: middle;
            content: "";
            border-top: 5px solid transparent;
            border-bottom: 5px solid transparent;
            border-left: 5px solid #ffffff;
            /* Color of the arrow */
            margin-left: 5px;
        }

        /* Hide toggle arrow for links with no submenu */
        .dropdown-submenu:not(:has(> .dropdown-menu)) .dropdown-toggle::after {
            display: none;
        }

        /* CSS for the mobile navbar toggle box */
        @media (max-width: 991.98px) {
            .navbar-toggler {
                background-color: #ffffff;
                /* Background color */
                border: 1px solid #ffffff;
                /* Border color */
                color: black;
                /* Text color */
                font-size: 1rem;
                padding: 1rem;
            }
        }
        .navbar-link {
        font-weight: bold; /* Sets the font weight to bold */
        font-size: large;
        color: #f5f5f5 !important;
        
    }
    .alert-dismissible .btn-close {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 2;
    padding: 1.0rem 1rem;
   
}
.alert-dismissible {
    padding-right: 3rem;
}
    </style>
</head>

<body>

<?php if ($addexp_q_row['total_cost'] > base64_decode($login_q_row['Monthly_Limit']) && $_SESSION['count_for_limit'] == 1): ?>
    <div class='alert alert-danger alert-dismissible fade show' role='alert' style="position:absolute;right: 5px; top: 90px; z-index: 1050;font-size: 0.8rem;">
        Your monthly limit exceeds your monthly expenses. Kindly spend wisely!!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    <?php endif; ?>
    
    <nav class="navbar navbar-expand-lg bg-custom bg-body-tertiary navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="cclogo.png" alt="CashCheck Logo" class="logo" style="max-height: 100px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="margin-right: 1rem;">Click Here</span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link navbar-link" aria-current="page" href="n_first.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link navbar-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Expenses
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item " href="addexp1.php">Add Expenses</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="showexp2.php" id="me">Manage Expenses</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="sum_of_exptype.php" id="me">Display Expense Type</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link navbar-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Graphs/Analysis
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-toggle" href="#" style="margin-left: 1.5rem;color: whitesmoke;">Piechart</a>
                                <!-- Dropdown menu for Piechart -->
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                    <li><a href="piechart_cm.php" style="color: whitesmoke;">Current Month</a></li>
                                    <li><a href="piechart_pm.php" style="color: whitesmoke;">Previous Month</a></li>
                                    <li><a href="piechart_l3m.php" style="color: whitesmoke;">Previous 3 Months</a></li>
                                    <li><a href="piechart_l6m.php" style="color: whitesmoke;">Previous 6 Months</a></li>
                                    <li><a href="piechart.php" style="color: whitesmoke;">Till Date</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="diff_chart.php" id="me">Comparing Charts</a></li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link navbar-link" href="profile1.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-link" href="report.php">Report</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link navbar-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-link" href="logout.php">LogOut</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    

    <div class="welcome-message">
        Welcome, <?php echo $row['First_Name'] ?>
    </div>

    <div class="container calendar-images">
        <div class="row">
            <div class="col-md-4">
                <img src="calendar.jpg" alt="Calendar 1">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="calendar-text">Current Month</div>
                    </div>
                    <div class="col">
                        <input type="" name="date" id="" value="&#8377;<?php echo $cm_total ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="calendar.jpg" alt="Calendar 2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="calendar-text">Previous Month</div>
                    </div>
                    <div class="col">
                        <input type="" name="date" id="" value="&#8377;<?php echo $pm_total  ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="calendar.jpg" alt="Calendar 3">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="calendar-text">Previous 3 Months</div>
                    </div>
                    <div class="col">
                        <input type="" name="date" id="" value="&#8377;<?php echo $p3m_total ?>" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img src="calendar.jpg" alt="Calendar 4">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="calendar-text">Previous 6 Months</div>
                    </div>
                    <div class="col">
                        <input type="" name="date" id="" value="&#8377;<?php echo $p6m_total ?> " disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="calendar.jpg" alt="Calendar 5">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="calendar-text">Previous 9 Months</div>
                    </div>
                    <div class="col">
                        <input type="" name="date" id="" value="&#8377;<?php echo $p9m_total ?> " disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="calendar.jpg" alt="Calendar 6">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="calendar-text">Current Year</div>
                    </div>
                    <div class="col">
                        <input type="" name="date" id="" value="&#8377;<?php echo $cy_total ?>" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#close").click(function() {
                $(".alert").alert("close");
            });

            // Toggle the dropdown menu on click
            $('.dropdown-submenu .dropdown-toggle').click(function(e) {
                e.preventDefault();
                e.stopPropagation(); // Prevent event bubbling
                $(this).next('.dropdown-menu').slideToggle(200);
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown-submenu').length) {
                    $('.dropdown-menu.multi-level').slideUp(105);
                }
            });
        });
    </script>

</body>

</html>