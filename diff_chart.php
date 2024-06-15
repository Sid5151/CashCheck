<?php
session_start();
include "dbconnect1.php";

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    echo '<script>
    window.location="projectlogin.php";
    </script>';
}
if (isset($_POST['sd1']) && isset($_POST['ed1']) && isset($_POST['sd2']) && isset($_POST['ed2'])) {

    $sd1 = $_POST['sd1'];
    $ed1 = $_POST['ed1'];
    $sd2 = $_POST['sd2'];
    $ed2 = $_POST['ed2'];

    $q = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum
    FROM addexp
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Transportation' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";

    $result1 = mysqli_query($conn, $q);
    $row1 = mysqli_fetch_assoc($result1);
    $q2 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Food' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result2 = mysqli_query($conn, $q2);
    $row2 = mysqli_fetch_assoc($result2);

    $q3 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Utilities' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result3 = mysqli_query($conn, $q3);
    $row3 = mysqli_fetch_assoc($result3);

    $q4 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Clothing' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result4 = mysqli_query($conn, $q4);
    $row4 = mysqli_fetch_assoc($result4);

    $q5 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Medical/Healthcare' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result5 = mysqli_query($conn, $q5);
    $row5 = mysqli_fetch_assoc($result5);

    $q6 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Insurance' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result6 = mysqli_query($conn, $q6);
    $row6 = mysqli_fetch_assoc($result6);

    $q7 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Household_Items/Supplies' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result7 = mysqli_query($conn, $q7);
    $row7 = mysqli_fetch_assoc($result7);

    $q8 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Debt/Loan' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result8 = mysqli_query($conn, $q8);
    $row8 = mysqli_fetch_assoc($result8);

    $q9 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Education' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result9 = mysqli_query($conn, $q9);
    $row9 = mysqli_fetch_assoc($result9);

    $q10 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Savings' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result10 = mysqli_query($conn, $q10);
    $row10 = mysqli_fetch_assoc($result10);

    $q11 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Investments' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result11 = mysqli_query($conn, $q11);
    $row11 = mysqli_fetch_assoc($result11);

    $q12 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Entertainment' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result12 = mysqli_query($conn, $q12);
    $row12 = mysqli_fetch_assoc($result12);

    $q13 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Gifts/Donations' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result13 = mysqli_query($conn, $q13);
    $row13 = mysqli_fetch_assoc($result13);

    $q14 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Housing' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result14 = mysqli_query($conn, $q14);
    $row14 = mysqli_fetch_assoc($result14);

    $q15 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Personal' AND Expense_Date BETWEEN '$sd1' AND '$ed1'";
    $result15 = mysqli_query($conn, $q15);
    $row15 = mysqli_fetch_assoc($result15);

    $q16 = "SELECT * from login where Email='{$_SESSION['email']}'";
    $result16 = mysqli_query($conn, $q16);
    $row16 = mysqli_fetch_assoc($result16);

    //Second Comparision

    $q17 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum
    FROM addexp
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Transportation' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result17 = mysqli_query($conn, $q17);
    $row17 = mysqli_fetch_assoc($result17);

    $q18 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Food' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result18 = mysqli_query($conn, $q18);
    $row18 = mysqli_fetch_assoc($result18);

    $q19 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Utilities' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result19 = mysqli_query($conn, $q19);
    $row19 = mysqli_fetch_assoc($result19);

    $q20 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Clothing' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result20 = mysqli_query($conn, $q20);
    $row20 = mysqli_fetch_assoc($result20);

    $q21 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Medical/Healthcare' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result21 = mysqli_query($conn, $q21);
    $row21 = mysqli_fetch_assoc($result21);

    $q22 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Insurance' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result22 = mysqli_query($conn, $q22);
    $row22 = mysqli_fetch_assoc($result22);

    $q23 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Household_Items/Supplies' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result23 = mysqli_query($conn, $q23);
    $row23 = mysqli_fetch_assoc($result23);

    $q24 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Debt/Loan' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result24 = mysqli_query($conn, $q24);
    $row24 = mysqli_fetch_assoc($result24);

    $q25 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Education' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result25 = mysqli_query($conn, $q25);
    $row25 = mysqli_fetch_assoc($result25);

    $q26 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Savings' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result26 = mysqli_query($conn, $q26);
    $row26 = mysqli_fetch_assoc($result26);

    $q27 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Investments' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result27 = mysqli_query($conn, $q27);
    $row27 = mysqli_fetch_assoc($result27);

    $q28 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Entertainment' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result28 = mysqli_query($conn, $q28);
    $row28 = mysqli_fetch_assoc($result28);

    $q29 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Gifts/Donations' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result29 = mysqli_query($conn, $q29);
    $row29 = mysqli_fetch_assoc($result29);

    $q30 = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum 
    FROM addexp 
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Housing' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    $result30 = mysqli_query($conn, $q30);
    $row30 = mysqli_fetch_assoc($result30);

    $q33 = "SELECT * from login where Email='{$_SESSION['email']}'";
    $result33 = mysqli_query($conn, $q33);
    $row33 = mysqli_fetch_assoc($result33);


    // $q32 = "SELECT SUM(
    //     CAST(
    //         CASE
    //             WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
    //             ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
    //         END AS DECIMAL(10,2)
    //     )
    // ) AS sum 
    // FROM addexp 
    // WHERE Email='{$_SESSION['email']}' AND Exp_type='Personal' AND Expense_Date BETWEEN '$sd2' AND '$ed2'";
    // $result32 = mysqli_query($conn, $q32);
    // $row32 = mysqli_fetch_assoc($result32);
    // $q33 = "SELECT * from login where Email='{$_SESSION['email']}'";
    // $result33 = mysqli_query($conn, $q33);
    // $row33 = mysqli_fetch_assoc($result33);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="favicon-32x32.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compare_Charts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        input[type="date"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        #chart_div {
            width: 100%;
            height: 100%;
            margin-top: 10px;
            padding:2rem;
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
    form{
        padding:2rem;
    }
    </style>
</head>

<body>
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
                                <a class="dropdown-item" href="exptype.php" id="me">Display Expense Type</a>
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
    <br>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div>
        <form action="" method="post">
            <span>Select the <b>Start Date</b> <input type="date" name="sd1" id="sd1">
                and <b>End Date <input type="date" name="ed1" id="ed1">
                </b> for <strong>First Comparision</strong></span>
            <br><br>
            <span>Select the <b>Start Date</b> <input type="date" name="sd2" id="sd2">
                and <b>End Date <input type="date" name="ed2" id="ed2">
                </b> for <strong>Second Comparision</strong></span>
            <input type="submit" value="Submit">
        </form>
    </div>
    <br>
    <div id="chart_div" style="height:80vh;width:80vw;"></div>
    <script>
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawMaterial);

        function drawMaterial() {
            var jsd1 = document.getElementById('sd1').value;
            var jed1 = document.getElementById('ed1').value;
            var jsd2 = document.getElementById('sd2').value;
            var jed2 = document.getElementById('ed2').value;
            console.log(jsd1);
            var data = google.visualization.arrayToDataTable([

                ['Expense_Cost', '<?php echo $sd1; ?> to <?php echo $ed1; ?>', '<?php echo $sd2; ?> to <?php echo $ed2; ?>'],

                ['Transportation', parseInt('<?php echo $row1['sum']; ?>'), parseInt('<?php echo $row17['sum']; ?>')],
                ['Food', parseInt('<?php echo $row2['sum']; ?>'), parseInt('<?php echo $row18['sum']; ?>')],
                ['Utilities', parseInt('<?php echo $row3['sum']; ?>'), parseInt('<?php echo $row19['sum']; ?>')],
                ['Clothing', parseInt('<?php echo $row4['sum']; ?>'), parseInt('<?php echo $row20['sum']; ?>')],
                ['Medical/Healthcare', parseInt('<?php echo $row5['sum']; ?>'), parseInt('<?php echo $row21['sum']; ?>')],
                ['Insurance', parseInt('<?php echo $row6['sum']; ?>'), parseInt('<?php echo $row22['sum']; ?>')],
                ['Household_Items/Supplies', parseInt('<?php echo $row7['sum']; ?>'), parseInt('<?php echo $row23['sum']; ?>')],
                ['Debt/Loan', parseInt('<?php echo $row8['sum']; ?>'), parseInt('<?php echo $row24['sum']; ?>')],
                ['Education', parseInt('<?php echo $row9['sum']; ?>'), parseInt('<?php echo $row25['sum']; ?>')],
                ['Savings', parseInt('<?php echo $row10['sum']; ?>'), parseInt('<?php echo $row26['sum']; ?>')],
                ['Investments', parseInt('<?php echo $row11['sum']; ?>'), parseInt('<?php echo $row27['sum']; ?>')],
                ['Entertainment', parseInt('<?php echo $row12['sum']; ?>'), parseInt('<?php echo $row28['sum']; ?>')],
                ['Gifts/Donations', parseInt('<?php echo $row13['sum']; ?>'), parseInt('<?php echo $row29['sum']; ?>')],
                ['Housing', parseInt('<?php echo $row14['sum']; ?>'), parseInt('<?php echo $row30['sum']; ?>')]

            ]);

            var materialOptions = {

                chart: {
                    title: 'Expense Comparison Between  <?php echo $sd1; ?> to <?php echo $ed1; ?> and <?php echo $sd2; ?> to <?php echo $ed2; ?> '
                },
                hAxis: {
                    title: 'Expense Comparison',

                    minValue: 0,
                },
                vAxis: {
                    title: 'Expense_Cost'
                },
                bars: 'horizontal'
            };
            var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
            materialChart.draw(data, materialOptions);
        }
    </script>
    <script src="jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>

</html>