<?php
session_start();
error_reporting(0);
include "dbconnect1.php";
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    echo "
   <script>
   window.location='projectlogin.php';
   </script>
   ";
}


$Current_Month_firstdate = date("Y/m/d", strtotime("first day of this month"));

$Current_Month_lastdate = date("Y/m/d", strtotime("last day of this month"));
// if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
//     echo '<script>
//     window.location="projectlogin.php";
//     </script>';
// }    


$sumquery_t = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum
    FROM addexp
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Transportation' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
$result1 = mysqli_query($conn, $sumquery_t);
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Food' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Utilities' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Clothing' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Medical/Healthcare' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Insurance' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Household_Items/Supplies' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Debt/Loan' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Education' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Savings' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Investments' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Entertainment' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Gifts/Donations' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Housing' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
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
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Personal' AND Expense_Date BETWEEN '$Current_Month_firstdate' AND '$Current_Month_lastdate'";
$result15 = mysqli_query($conn, $q15);
$row15 = mysqli_fetch_assoc($result15);

$q16 = "SELECT * from login where Email='{$_SESSION['email']}'";
$result16 = mysqli_query($conn, $q16);
$row16 = mysqli_fetch_assoc($result16);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <title>Exptype Sum</title>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }

        .bg-custom {
            background-color: black !important;
            /* Custom background color */
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
            font-weight: bold;
            /* Sets the font weight to bold */
            font-size: large;
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
    <br>
    <div class="container text-center">

        <div id=sd_ed hidden>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col">
                            <label id="sdlabel"><b>Start Date:</b></label>
                            <input type="date" id="sd" name="sd" class="form-control form-control-sm reduced-width" required />
                        </div>
                        <div class="col">
                            <label id="edlabel"><b>End Date:</b></label>
                            <input type="date" id="ed" name="ed" class="form-control form-control-sm reduced-width" required />
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <button type="submit" id="sub" name="sub" class="btn btn-outline-dark btn-block mt-1" style="margin-right: 0.5rem;">Display Data</button> <!-- Adding margin-right: 0.5rem -->
                </div>
            </div>
        </div>

        <br>
        <!-- Move "Enter the Page no" field outside the form -->
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="row">
                    <div class="col">
                        <h3>Select an option to display data</h3>
                        <label><b>Select Month-Wise:</b></label>
                        <select name="month_wise" id="month_wise" class="form-control form-control-sm reduced-width">
                            <option value="Select" selected disabled>Select</option>
                            <option name='Till_Date' id="Till_Date" value="Till_Date">Till_Date</option>
                            <option name='Current_Month' id="Current_Month" value="Current_Month">Current Month</option>
                            <option name='Previous_Month' id="Previous_Month" value="Previous_Month">Last Month</option>
                            <option name='Previous_3_Months' id="Previous_3_Months" value="Previous_3_Months">Previous_3_Months</option>
                            <option name='Last_6_Month' id="Last_6_Month" value="Last_6_Months">Last 6 Months</option>
                            <option name='Current_Year' id="Current_Year" value="Current_Year">Current Year</option>
                            <option name='DateWise' id="DateWise" value="DateWise">DateWise</option>
                        </select>
                    </div>
                    <br><br>
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
                    <script src="jquery-3.7.0.min.js"></script>
                    <script>
                        $(function() {
                            $("#month_wise").change(function() {
                                var month_wise_val = $(this).val();
                                console.log(month_wise_val);
                                if (month_wise_val == "Till_Date") {
                                    $.ajax({
                                        url: "sum_of_td",
                                        type: "POST",
                                        success: function(data) {
                                            $("#exp_type_table").html(data);
                                        }
                                    })
                                } else if (month_wise_val == "Current_Month") {
                                    $.ajax({
                                        url: "sum_of_cm",
                                        type: "POST",
                                        success: function(data) {
                                            $("#exp_type_table").html(data);
                                        }
                                    })

                                } else if (month_wise_val == "Previous_Month") {
                                    $.ajax({
                                        url: "sum_of_pm",
                                        type: "POST",
                                        success: function(data) {
                                            $("#exp_type_table").html(data);
                                        }
                                    })

                                } else if (month_wise_val == "Previous_3_Months") {
                                    $.ajax({
                                        url: "sum_of_p3m",
                                        type: "POST",
                                        success: function(data) {
                                            $("#exp_type_table").html(data);
                                        }
                                    })
                                } else if (month_wise_val == "Last_6_Months") {
                                    $.ajax({
                                        url: "sum_of_p6m",
                                        type: "POST",
                                        success: function(data) {
                                            $("#exp_type_table").html(data);
                                        }
                                    })
                                } else if (month_wise_val == "Current_Year") {
                                    $.ajax({
                                        url: "sum_of_cy",
                                        type: "POST",
                                        success: function(data) {
                                            $("#exp_type_table").html(data);
                                        }
                                    })
                                } else {
                                    $("#sd_ed").removeAttr("hidden");
                                    $("#sub").click(function() {
                                        var sd = $("#sd").val();
                                        var ed = $("#ed").val();
                                        $.ajax({
                                            url: "sum_of_dw",
                                            type: "POST",
                                            data: {
                                                sd: sd,
                                                ed: ed
                                            },
                                            success: function(data) {

                                                $("#exp_type_table").html(data);
                                            }
                                        })

                                    });


                                }
                            });
                        });
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
                    <br><br><br>
                    <div id="exp_type_table"></div>
</body>

</html>