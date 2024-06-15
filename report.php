<?php
session_start();
include "dbconnect1.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        table,
        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            border: 1px solid #ddd;
            font-size: larger;
            padding: 8px;
            text-align: left;
        }

        th:nth-child(odd),
        td:nth-child(odd) {
            background-color: #d1c4e9;
            color: #000000;
        }

        th:nth-child(even),
        td:nth-child(even) {
            background-color: #e1bee7;
            color: #000000;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        form input[type="submit"] {
            margin-top: 10px;
        }


        .table thead th {
            background-color: #007bff;
            color: #ffffff;
            border-color: #007bff;
        }

        .table a {
            color: #007bff;
            text-decoration: none;
        }

        .table a:hover {
            text-decoration: underline;
        }


        .btn-custom {
            background-color: #28a745;
            color: #ffffff;
            border-color: #28a745;
            padding: 6px 12px;
            border-radius: 5px;
        }

        .btn-custom:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        #md:hover {
            color: red;
            text-decoration: underline;
        }

        /* #check{
            display: none;
        } */
        /* #prev,
        #next {
            background-color: red;
            color: yellow;
            font-size: 20px;
            width: 4rem;
            border-radius: 1rem;
            float: left;
        }

        #prev {
            margin-right: 2rem;
        } */

        #dbtn {
            background-color: red;
            color: white;

        }

        #dbtn:hover {
            color: yellow;

            transform: scale(1.1);
        }

        #ebtn {
            background-color: blue;
            color: white;

        }

        #ebtn:hover {
            color: yellow;

            transform: scale(1.1);
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
    </style>
</head>

<body>
    <img src="norecordfound.png" alt="" hidden>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                        Edit Info
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- modal body starts here -->
                <div class="modal-body">
                    <table id="tab">

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" id="esub">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="rsdate" class="col-sm-4 col-form-label">Enter the Start Date:</label>
                        <div class="col-sm-8">
                            <input type="date" name="rsdate" id="rsdate" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="redate" class="col-sm-4 col-form-label">Enter the End Date:</label>
                        <div class="col-sm-8">
                            <input type="date" name="redate" id="redate" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <input type="submit" value="Send Mail" class="btn btn-custom" id="sub" name="sub">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Date-Wise</th>
                <th>View & Download Report</th>
                <th>Send Mail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Till Date</td>
                <td><a href="makepdf.php" target="_blank" id="till_date" download="">View & Download</a></td>
                <td><a href="pdfmail.php" target="_blank" id="till_date">Send Mail</a></td>
            </tr>
            <tr>
                <td>Current_Year</td>
                <td><a href="CY_makepdf.php" target="_blank" id="CY" download="">View & Download</a></td>
                <td><a href="CY_report.php" target="_blank" id="CY">Send Mail</a></td>
            </tr>
            <tr>
                <td>Current_Month</td>
                <td><a href="CM_makepdf.php" target="_blank" id="CM" download="">View & Download</a></td>
                <td><a href="CM_report.php" target="_blank" id="CM">Send Mail</a></td>
            </tr>
            <tr>
                <td>Previous_Month</td>
                <td><a href="PM_makepdf.php" target="_blank" id="CM" download="">View & Download</a></td>
                <td><a href="PM_report.php" target="_blank" id="CM">Send Mail</a></td>
            </tr>
            <tr>
                <td>Previous_3_Months</td>
                <td><a href="P3M_makepdf.php" target="_blank" id="CM" download="">View & Download</a></td>
                <td><a href="P3M_report.php" target="_blank" id="CM">Send Mail</a></td>
            </tr>
            <tr>
                <td>Previous_6_months</td>
                <td><a href="P6M_makepdf.php" target="_blank" id="CM" download="">View & Download</a></td>
                <td><a href="P6M_report.php" target="_blank" id="CM">Send Mail</a></td>
            </tr>
        </tbody>
    </table>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

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
</body>

</html>
<?php
session_start();
include "dbconnect1.php";

if (isset($_POST['sub'])) {
    $rsdate = $_POST['rsdate'];
    $redate = $_POST['redate'];
    $_SESSION['rsdate'] = $rsdate;
    $_SESSION['redate'] = $redate;
    //header("location:datereport.php");
    echo "<script>
    window.location='datereport.php';
    
    </script>";
}
?>