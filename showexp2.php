<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    header("location:projectlogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <title>Manage Expenses</title>
    <style>
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

        prev {
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


        .social-links {
            display: none;
            /* Hiding the social links */
        }

        .statement {
            font-family: Arial, sans-serif;
            /* Setting font family */
            font-size: 24px;
            /* Setting font size */
            font-weight: bold;
            /* Setting font weight */
            color: #333;
            /* Setting font color */
            text-align: center;
            /* Aligning text to center */
            margin-top: 20px;
            /* Adding top margin */
        }

        .reduced-width {
            width: 250px;
            /* Adjust the width as per your requirement */
        }

        .btn-outline-dark:hover {
            color: #fff;
            background-color: #28a745;
            /* Green color */
            border-color: #28a745;
            /* Green color */
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

        @media (max-width: 1200px) {

            /* Add margin-left for start date and end date input fields */
            #start_date,
            #end_date {
                margin-left: 100px;
            }
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

    <!-- Navbar with Logo -->
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
        <form>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col">
                            <label id="sdlabel"><b>Start Date:</b></label>
                            <input type="date" id="start_date" name="start_date" class="form-control form-control-sm reduced-width" required />
                        </div>
                        <div class="col">
                            <label id="edlabel"><b>End Date:</b></label>
                            <input type="date" id="end_date" name="end_date" class="form-control form-control-sm reduced-width" required />
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <button type="submit" id="dd" name="submit" class="btn btn-outline-dark btn-block mt-1" style="margin-right: 0.5rem;">Display Data</button> <!-- Adding margin-right: 0.5rem -->
                </div>
            </div>
        </form>

        <!-- Move "Enter the Page no" field outside the form -->
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="row">
                    <div class="col">
                        <label><b>Select Month-Wise:</b></label>
                        <select name="month_wise" id="month_wise" class="form-control form-control-sm reduced-width">
                            <option name='Till_Date' id="Till_Date" value="Till_Date">Till_Date</option>
                            <option name='Current_Month' id="Current_Month" value="Current_Month">Current Month</option>
                            <option name='Previous_Month' id="Previous_Month" value="Previous_Month">Last Month</option>
                            <option name='Previous_3_Months' id="Previous_3_Months" value="Previous_3_Months">Previous_3_Months</option>
                            <option name='Last_6_Month' id="Last_6_Month" value="Last_6_Months">Last 6 Months</option>
                            <option name='Current_Year' id="Current_Year" value="Current_Year">Current Year</option>
                            <option name='DateWise' id="DateWise" value="DateWise">DateWise</option>
                        </select>
                    </div>
                    <div class="col">
                        <label><b>Enter the Page no:</b></label>
                        <div class="input-group">
                            <input type="text" name="gtp" id="gtp" class="form-control form-control-sm reduced-width" /> <!-- Using the same class as the end date field -->
                            <div class="input-group-append">
                                <button type="submit" id="gts" name="gts" class="btn btn-outline-dark" style="margin-right: 0.5rem;">Submit</button> <!-- Adding margin-right: 0.5rem -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <br>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script type="text/javascript" src="jquery-3.7.0.min.js"></script>
    <script type="text/javascript">
        $(function() {

            var selectedname = $('#month_wise').val();
            $(document).on("change", "#month_wise", function() {
                if (selectedname != "DateWise") {
                    $("#start_date").hide();
                    $("#end_date").hide();
                    $("#dd").hide();
                    $("#sdlabel").hide();
                    $("#edlabel").hide();
                }
            });

            $('#gts').click(function() {

                var gtp = $("#gtp").val();
                if (gtp[0] == 0) {
                    alert("Sorry first num can't be zero");
                    exit;
                }
                var t_pages = $("#t_pages").val();
                var new_tpages = "0" + t_pages;
                var selectedname = $('#month_wise').val();
                if (selectedname == "Till_Date") {
                    if (t_pages > 9) {
                        if (gtp >= 1 && gtp <= 9) {
                            var new_gtp = "0" + gtp;
                            if (new_gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({
                                    url: "pagination2",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        } else {
                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "pagination2",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        }
                    }
                    if (t_pages <= 9) {
                        var gtp = $("#gtp").val();
                        var t_pages = $("#t_pages").val();
                        if (gtp >= 1 && gtp <= 9) {
                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({
                                    url: "pagination2",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        } else {
                            if (gtp > new_tpages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "pagination2",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        }

                    }
                } else if (selectedname == 'Current_Month') {
                    if (t_pages > 9) {
                        var t_pages = $("#t_pages").val();
                        var gtp = $("#gtp").val();
                        var new_gtp = "0" + gtp;
                        console.log(new_gtp);
                        var new_tpages = "0" + t_pages;
                        if (gtp >= 1 && gtp <= 9) {

                            if (new_gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Current_Month",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        } else {
                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Current_Month",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        }
                    }
                    if (t_pages <= 9) {
                        var t_pages = $("#t_pages").val();
                        var gtp = $("#gtp").val();
                        var new_gtp = "0" + gtp;
                        console.log(new_gtp);
                        var new_tpages = "0" + t_pages;
                        if (gtp >= 1 && gtp <= 9) {

                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Current_Month",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        } else {
                            if (gtp > new_tpages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Current_Month",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        }

                    }

                }
                if (selectedname == 'Previous_Month') {
                    var t_pages = $("#t_pages").val();
                    var gtp = $("#gtp").val();
                    var new_tpages = "0" + t_pages;
                    console.log(new_tpages);
                    if (t_pages > 9) {
                        if (gtp >= 1 && gtp <= 9) {
                            if (new_gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({
                                    url: "Previous_Month",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        } else {
                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Previous_Month",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        }
                    }
                    if (t_pages <= 9) {
                        if (gtp >= 1 && gtp <= 9) {
                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({
                                    url: "Previous_Month",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        } else {
                            if (gtp > new_tpages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Previous_Month",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        }

                    }
                } else if (selectedname == 'Previous_3_Months') {
                    var t_pages = $("#t_pages").val();
                    var gtp = $("#gtp").val();
                    var new_tpages = "0" + t_pages;
                    console.log(new_tpages);
                    if (t_pages > 9) {
                        if (gtp >= 1 && gtp <= 9) {
                            if (new_gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Previous_3_Months",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        } else {
                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Previous_3_Months",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        }

                    }
                    if (t_pages <= 9) {
                        if (gtp >= 1 && gtp <= 9) {
                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Previous_3_Months",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        } else {
                            if (gtp > new_tpages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Previous_3_Months",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        }

                    }

                } else if (selectedname == 'Last_6_Months') {
                    var t_pages = $("#t_pages").val();
                    var gtp = $("#gtp").val();
                    var new_tpages = "0" + t_pages;
                    console.log(new_tpages);
                    if (t_pages > 9) {
                        if (gtp >= 1 && gtp <= 9) {
                            var new_gtp5 = "0" + gtp;
                            if (new_gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Previous_6_Months",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        } else {
                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({
                                    url: "Previous_6_Months",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        }

                    }
                    if (t_pages <= 9) {
                        if (gtp >= 1 && gtp <= 9) {
                            var new_gtp5 = "0" + gtp;
                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Previous_6_Months",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        } else {
                            if (gtp > new_tpages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({
                                    url: "Previous_6_Months",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        }

                    }
                } else if (selectedname == "Current_Year") {
                    var t_pages = $("#t_pages").val();
                    var gtp = $("#gtp").val();
                    var new_tpages = "0" + t_pages;
                    console.log(gtp);
                    console.log(t_pages);
                    if (t_pages > 9) {
                        if (gtp >= 1 && gtp <= 9) {
                            if (new_gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({
                                    url: "Current_year",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        } else {

                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Current_year",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        }

                    }
                    if (t_pages <= 9) {
                        if (gtp >= 1 && gtp <= 9) {
                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({

                                    url: "Current_year",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        } else {

                            if (gtp > new_tpages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                $.ajax({
                                    url: "Current_year",
                                    type: "POST",
                                    data: {
                                        gtp: gtp
                                    },
                                    success: function(data) {
                                        $('#td').html(data);
                                    }
                                });
                            }
                        }
                    }
                } else if (selectedname == "DateWise") {
                    if (t_pages > 9) {
                        if (gtp >= 1 && gtp <= 9) {
                            if (new_gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                var sd = $('#start_date').val();
                                var ed = $('#end_date').val();
                                var tp = $('#total_pages7').val();
                                var pagination_pages = $('#pages7').val();
                                var pageid = pagination_pages;
                                if (sd == "" || ed == "") {
                                    alert("Please enter all fields");
                                } else if (sd > ed) {
                                    alert("Start date cannot be ahead of the end date");
                                } else {
                                    $.ajax({
                                        url: 'datewiseq',
                                        type: "POST",
                                        data: {
                                            sd: sd,
                                            ed: ed,
                                            gtp: gtp
                                        },
                                        success: function(data) {
                                            // $('#tdh4').show();
                                            // $('#tdh4').html("Expense displayed from " + sd + " to " + ed);
                                            $('#td').html(data);
                                            $('#start_date').val(sd);
                                            $('#end_date').val(ed);
                                        }
                                    });
                                }
                            }
                        } else {

                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                var sd = $('#start_date').val();
                                var ed = $('#end_date').val();
                                var tp = $('#total_pages7').val();
                                var pagination_pages = $('#pages7').val();
                                var pageid = pagination_pages;

                                if (sd == "" || ed == "") {
                                    alert("Please enter all fields");
                                } else if (sd > ed) {
                                    alert("Start date cannot be ahead of the end date");
                                } else {
                                    $.ajax({
                                        url: 'datewiseq',
                                        type: "POST",
                                        data: {
                                            sd: sd,
                                            ed: ed,
                                            gtp: gtp
                                        },
                                        success: function(data) {
                                            // $('#tdh4').show();
                                            // $('#tdh4').html("Expense displayed from " + sd + " to " + ed);
                                            $('#td').html(data);
                                            $('#start_date').val(sd);
                                            $('#end_date').val(ed);
                                        }
                                    });
                                }
                            }
                        }
                    }
                    if (t_pages <= 9) {
                        if (gtp >= 1 && gtp <= 9) {
                            if (gtp > t_pages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                var sd = $('#start_date').val();
                                var ed = $('#end_date').val();
                                var tp = $('#total_pages7').val();
                                var pagination_pages = $('#pages7').val();
                                var pageid = pagination_pages;
                                if (sd == "" || ed == "") {
                                    alert("Please enter all fields");
                                } else if (sd > ed) {
                                    alert("Start date cannot be ahead of the end date");
                                } else {
                                    $.ajax({
                                        url: 'datewiseq',
                                        type: "POST",
                                        data: {
                                            sd: sd,
                                            ed: ed,
                                            gtp: gtp
                                        },
                                        success: function(data) {
                                            // $('#tdh4').show();
                                            // $('#tdh4').html("Expense displayed from " + sd + " to " + ed);
                                            $('#td').html(data);
                                            $('#start_date').val(sd);
                                            $('#end_date').val(ed);
                                        }
                                    });
                                }
                            }
                        } else {

                            if (gtp > new_tpages) {
                                alert("You cannot exceed the total pages");
                            } else {
                                var sd = $('#start_date').val();
                                var ed = $('#end_date').val();
                                var tp = $('#total_pages7').val();
                                var pagination_pages = $('#pages7').val();
                                var pageid = pagination_pages;

                                if (sd == "" || ed == "") {
                                    alert("Please enter all fields");
                                } else if (sd > ed) {
                                    alert("Start date cannot be ahead of the end date");
                                } else {
                                    $.ajax({
                                        url: 'datewiseq',
                                        type: "POST",
                                        data: {
                                            sd: sd,
                                            ed: ed,
                                            gtp: gtp
                                        },
                                        success: function(data) {
                                            // $('#tdh4').show();
                                            // $('#tdh4').html("Expense displayed from " + sd + " to " + ed);
                                            $('#td').html(data);
                                            $('#start_date').val(sd);
                                            $('#end_date').val(ed);
                                        }
                                    });
                                }
                            }
                        }

                    }
                }
            });


            // $("#me").click(function(event) {
            //     event.preventDefault();
            //     $.ajax({
            //         url: "showexp2.php",
            //         type: "POST",
            //         success: function(data) {
            //             $("body").html(data);
            //         },
            //     });
            // });
            $(document).on("click", "#dd", function(e) {
                e.preventDefault();
                //code for DateWise

                function datekedata(page) {
                    var sd = $('#start_date').val();
                    var ed = $('#end_date').val();
                    var tp = $('#total_pages7').val();
                    var pagination_pages = $('#pages7').val();
                    var pageid = pagination_pages;

                    if (sd == "" || ed == "") {
                        alert("Please enter all fields");
                    } else if (sd > ed) {
                        alert("Start date cannot be ahead of the end date");
                    } else {
                        $.ajax({
                            url: 'datewiseq',
                            type: "POST",
                            data: {
                                sd: sd,
                                ed: ed,
                                page_no: page
                            },
                            success: function(data) {
                                // $('#tdh4').show();
                                // $('#tdh4').html("Expense displayed from " + sd + " to " + ed);
                                $('#td').html(data);
                                $('#start_date').val(sd);
                                $('#end_date').val(ed);
                            }
                        });
                    }
                }

                function datekepages() {
                    var sd = $('#start_date').val();
                    var ed = $('#end_date').val();
                    var tp = $('#total_pages7').val();
                    var pagination_pages = $('#pages7').val();
                    var pageid = pagination_pages;

                    $.ajax({
                        url: "pageno7",
                        type: "POST",
                        data: {
                            sd: sd,
                            ed: ed
                        },
                        success: function(data) {
                            $('#tbkineeche').html(data);
                        }
                    });
                }
                $(document).on("click", "#next7", function(e) {
                    e.preventDefault();
                    var tp = $('#total_pages7').val();
                    var pagination_pages = $('#pages7').val();
                    var pageid = pagination_pages;

                    if (pageid == tp) {
                        pageid == tp;
                    } else {
                        pageid++;
                    }
                    console.log(pageid);
                    datekedata(pageid);


                });
                $(document).on("click", "#prev7", function(e) {
                    e.preventDefault();
                    var tp = $('#total_pages7').val();
                    var pagination_pages = $('#pages7').val();
                    var pageid = pagination_pages;

                    if (pageid == 1) {
                        pageid == 1;
                    } else {
                        pageid--;
                    }
                    console.log(pageid);
                    datekedata(pageid);
                });

                datekedata();
                datekepages();
            });

            // code for till_date
            function loadData1(page) {

                $.ajax({

                    url: "pagination2",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#td').html(data);
                        var rowCount = $('#table_ko_count tbody tr').length;

                        // Output the number of rows
                        console.log("Number of rows in the table: " + rowCount);
                        if (parseInt(rowCount) == 0 && parseInt(page) > 1) { // Check if there are no rows and if we're not on the first page
                            var pagination_pages = $('#pages').val();
                            var pageid = parseInt(pagination_pages); // Convert to integer

                            loadData1(page - 1); // Load the previous page
                        }

                    }
                });

            }

            function loadData2() {
                $.ajax({
                    url: "pageno",
                    type: "POST",

                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });


            }
            loadData1();
            loadData2();

            //prev and next button
            $(document).on("click", "#next", function(e) {
                e.preventDefault();
                var tp = $('#total_pages').val();
                var pagination_pages = $('#pages').val();
                var pageid = parseInt(pagination_pages); // Convert to integer

                if (pageid < tp) {
                    pageid++;
                    loadData1(pageid);
                }
            });

            // Handle Prev button click
            $(document).on("click", "#prev", function(e) {
                e.preventDefault();
                var pagination_pages = $('#pages').val();
                var pageid = parseInt(pagination_pages); // Convert to integer

                if (pageid > 1) {
                    pageid--;
                    loadData1(pageid);
                }
            });


            //page code for current month

            function Current_Month(page) {
                $.ajax({
                    url: "Current_Month",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#td').html(data);
                        var rowCount = $('#table_ko_count tbody tr').length;

                        // Output the number of rows
                        console.log("Number of rows in the table: " + rowCount);
                        if (parseInt(rowCount) == 0 && parseInt(page) > 1) { // Check if there are no rows and if we're not on the first page
                            var pagination_pages = $('#pages').val();
                            var pageid = parseInt(pagination_pages); // Convert to integer

                            Current_Month(page - 1); // Load the previous page
                        }

                    }
                });
            }

            function loadData3Current_Month() {
                $.ajax({
                    url: "pageno3",
                    type: "POST",

                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });
            }


            // Current_Month();
            // loadData3Current_Month();

            $(document).on("click", "#next3", function(e) {
                e.preventDefault();
                var tp = $('#total_pages3').val();
                var pagination_pages = $('#pages3').val();
                var pageid = pagination_pages;
                $('#next3').show();

                if (pageid == tp) {
                    pageid == tp;
                } else {
                    pageid++;
                }
                console.log(pageid);
                Current_Month(pageid);


            });
            $(document).on("click", "#prev3", function(e) {
                e.preventDefault();
                var tp = $('#total_pages3').val();
                var pagination_pages = $('#pages3').val();
                var pageid = pagination_pages;

                if (pageid == 1) {
                    pageid == 1;
                } else {
                    pageid--;
                }

                console.log(pageid);
                Current_Month(pageid);


            });


            //code for previous month
            function Previous_Month(page) {
                $.ajax({
                    url: "Previous_Month",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#td').html(data);
                        var rowCount = $('#table_ko_count tbody tr').length;

                        // Output the number of rows
                        console.log("Number of rows in the table: " + rowCount);
                        if (parseInt(rowCount) == 0 && parseInt(page) > 1) { // Check if there are no rows and if we're not on the first page
                            var pagination_pages = $('#pages').val();
                            var pageid = parseInt(pagination_pages); // Convert to integer

                            Previous_Month(page - 1); // Load the previous page
                        }
                    }
                });

            }

            $(document).on("click", "#next2", function(e) {
                e.preventDefault();
                var tp = $('#total_pages2').val();
                var pagination_pages = $('#pages2').val();
                var pageid = pagination_pages;

                if (pageid == tp) {
                    pageid == tp;
                } else {
                    pageid++;
                }
                console.log(pageid);
                Previous_Month(pageid);
            });

            $(document).on("click", "#prev2", function(e) {
                e.preventDefault();
                var tp = $('#total_pages2').val();
                var pagination_pages = $('#pages2').val();
                var pageid = pagination_pages;

                if (pageid == 1) {
                    pageid == 1;
                } else {
                    pageid--;
                }

                console.log(pageid);
                Previous_Month(pageid);


            });

            function loadData2Previous_Month() {
                $.ajax({
                    url: "pageno2",
                    type: "POST",

                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });
            }
            //code for previous 3 months
            function Previous_3_Months(page) {
                $.ajax({
                    url: "Previous_3_Months",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#td').html(data);
                        var rowCount = $('#table_ko_count tbody tr').length;

                        // Output the number of rows
                        console.log("Number of rows in the table: " + rowCount);
                        if (parseInt(rowCount) == 0 && parseInt(page) > 1) { // Check if there are no rows and if we're not on the first page
                            var pagination_pages = $('#pages').val();
                            var pageid = parseInt(pagination_pages); // Convert to integer

                            Previous_3_Months(page - 1); // Load the previous page
                        }

                    }
                });
            }
            //page code for previous 3 months
            $(document).on("click", "#next4", function(e) {
                e.preventDefault();
                var tp = $('#total_pages4').val();
                var pagination_pages = $('#pages4').val();
                var pageid = pagination_pages;

                if (pageid == tp) {
                    pageid == tp;
                } else {
                    pageid++;
                }
                console.log(pageid);
                Previous_3_Months(pageid);


            });
            $(document).on("click", "#prev4", function(e) {
                e.preventDefault();
                var tp = $('#total_pages4').val();
                var pagination_pages = $('#pages4').val();
                var pageid = pagination_pages;

                if (pageid == 1) {
                    pageid == 1;
                } else {
                    pageid--;
                }

                console.log(pageid);
                Previous_3_Months(pageid);


            });

            function loadData4Previous_3_Months() {
                $.ajax({
                    url: "pageno4",
                    type: "POST",

                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });
            }

            function Previous_6_Months(page) {
                $.ajax({
                    url: "Previous_6_Months",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#td').html(data);
                        var rowCount = $('#table_ko_count tbody tr').length;

                        // Output the number of rows
                        console.log("Number of rows in the table: " + rowCount);
                        if (parseInt(rowCount) == 0 && parseInt(page) > 1) { // Check if there are no rows and if we're not on the first page
                            var pagination_pages = $('#pages').val();
                            var pageid = parseInt(pagination_pages); // Convert to integer

                            Previous_6_Months(page - 1); // Load the previous page
                        }
                    }
                });
            }

            $(document).on("click", "#next5", function(e) {
                e.preventDefault();
                var tp = $('#total_pages5').val();
                var pagination_pages = $('#pages5').val();
                var pageid = pagination_pages;

                if (pageid == tp) {
                    pageid == tp;
                } else {
                    pageid++;
                }
                console.log(pageid);
                Previous_6_Months(pageid);


            });
            $(document).on("click", "#prev5", function(e) {
                e.preventDefault();
                var tp = $('#total_pages5').val();
                var pagination_pages = $('#pages5').val();
                var pageid = pagination_pages;

                if (pageid == 1) {
                    pageid == 1;
                } else {
                    pageid--;
                }

                console.log(pageid);
                Previous_6_Months(pageid);


            });

            function loadData5Previous_6_Months() {
                $.ajax({
                    url: "pageno5",
                    type: "POST",

                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });
            }

            //Current year 

            function Cy(page) {
                $.ajax({
                    url: "Current_year",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#td').html(data);
                        var rowCount = $('#table_ko_count tbody tr').length;

                        // Output the number of rows
                        console.log("Number of rows in the table: " + rowCount);
                        if (parseInt(rowCount) == 0 && parseInt(page) > 1) { // Check if there are no rows and if we're not on the first page
                            var pagination_pages = $('#pages').val();
                            var pageid = parseInt(pagination_pages); // Convert to integer

                            Cy(page - 1); // Load the previous page
                        }
                    }
                });
            }

            $(document).on("click", "#next6", function(e) {
                e.preventDefault();
                var tp = $('#total_pages6').val();
                var pagination_pages = $('#pages6').val();
                var pageid = pagination_pages;

                if (pageid == tp) {
                    pageid == tp;
                    console.log(pageid);
                } else {
                    pageid++;
                    console.log(pageid);

                }
                Cy(pageid);
            });

            $(document).on("click", "#prev6", function(e) {
                e.preventDefault();
                var tp = $('#total_pages6').val();
                var pagination_pages = $('#pages6').val();
                var pageid = pagination_pages;

                if (pageid == 1) {
                    pageid == 1;
                } else {
                    pageid--;
                }

                console.log(pageid);
                Cy(pageid);
            });

            function loadData6Cy() {
                $.ajax({
                    url: "pageno6",
                    type: "POST",

                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });
            }
            //code for DateWise
            function datekedata(page) {
                var sd = $('#start_date').val();
                var ed = $('#end_date').val();
                var tp = $('#total_pages7').val();
                var pagination_pages = $('#pages7').val();
                var pageid = pagination_pages;

                if (sd == "" || ed == "") {
                    alert("Please enter all fields");
                } else if (sd > ed) {
                    alert("Start date cannot be ahead of the end date");
                } else {
                    $.ajax({
                        url: 'datewiseq',
                        type: "POST",
                        data: {
                            sd: sd,
                            ed: ed,
                            page_no: page
                        },
                        success: function(data) {
                            // $('#tdh4').show();
                            // $('#tdh4').html("Expense displayed from " + sd + " to " + ed);
                            $('#td').html(data);
                            $('#start_date').val(sd);
                            $('#end_date').val(ed);
                            var rowCount = $('#table_ko_count tbody tr').length;

                            // Output the number of rows
                            console.log("Number of rows in the table: " + rowCount);
                            if (parseInt(rowCount) == 0 && parseInt(page) > 1) { // Check if there are no rows and if we're not on the first page
                                var pagination_pages = $('#pages').val();
                                var pageid = parseInt(pagination_pages); // Convert to integer

                                datekedata(page - 1); // Load the previous page
                            }
                        }
                    });
                }
            }

            function datekepages() {
                var sd = $('#start_date').val();
                var ed = $('#end_date').val();
                var tp = $('#total_pages7').val();
                var pagination_pages = $('#pages7').val();
                var pageid = pagination_pages;

                $.ajax({
                    url: "pageno7",
                    type: "POST",
                    data: {
                        sd: sd,
                        ed: ed
                    },
                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });
            }
            $(document).on("click", "#next7", function(e) {
                e.preventDefault();
                var tp = $('#total_pages7').val();
                var pagination_pages = $('#pages7').val();
                var pageid = pagination_pages;

                if (pageid == tp) {
                    pageid == tp;
                } else {
                    pageid++;
                }
                console.log(pageid);
                datekedata(pageid);


            });
            $(document).on("click", "#prev7", function(e) {
                e.preventDefault();
                var tp = $('#total_pages7').val();
                var pagination_pages = $('#pages7').val();
                var pageid = pagination_pages;

                if (pageid == 1) {
                    pageid == 1;
                } else {
                    pageid--;
                }
                console.log(pageid);
                datekedata(pageid);
            });


            // function loaddata() {
            //     $.ajax({
            //         url: "fetchdata1.php",
            //         type: "POST",
            //         success: function(data) {

            //             $("#td").html(data);

            //         },
            //     });
            // }




            $(document).on("click", '#dbtn', function() {
                var user_id = $(this).data('id');

                //var url = "http://localhost/sidphp/TYBCA%20Project/showexp1.php";
                if (confirm("Are you sure you want to delete")) {
                    $.ajax({
                        url: "deletequery",
                        type: "POST",
                        data: {
                            user_id: user_id
                        },
                        success: function(data) {
                            if (data == 1) {
                                var selectedname = $('#month_wise').val();
                                var page_mil_gaya = $('#pages').val();
                                var page_mil_gaya2 = $('#pages3').val();
                                var page_mil_gaya3 = $('#pages2').val();
                                var page_mil_gaya4 = $('#pages4').val();
                                var page_mil_gaya5 = $('#pages5').val();
                                var page_mil_gaya6 = $('#pages6').val();
                                var page_mil_gaya7 = $('#pages7').val();

                                if (selectedname == "Till_Date") {
                                    loadData1(page_mil_gaya);
                                    loadData2();
                                } else if (selectedname == 'Current_Month') {

                                    Current_Month(page_mil_gaya2);
                                    loadData3Current_Month();

                                } else if (selectedname == 'Previous_Month') {

                                    Previous_Month(page_mil_gaya3);
                                    loadData2Previous_Month();
                                } else if (selectedname == 'Previous_3_Months') {

                                    Previous_3_Months(page_mil_gaya4);
                                    loadData4Previous_3_Months();
                                } else if (selectedname == 'Last_6_Months') {

                                    Previous_6_Months(page_mil_gaya5);
                                    loadData5Previous_6_Months();
                                } else if (selectedname == 'Current_Year') {

                                    Cy(page_mil_gaya6);
                                    loadData6Cy();
                                } else {
                                    datekedata(page_mil_gaya7);
                                    datekepages();
                                }

                            } else {
                                alert("Sorry not deleted");
                            }
                        }
                    });
                }
            });
            $(document).on("click", "#ebtn", function() {
                var studId = $(this).data("uid");

                // $('#staticBackdrop').modal('show');
                $('#staticBackdrop').modal('toggle');

                $.ajax({
                    url: "updateq",
                    type: "POST",
                    data: {
                        stud_id: studId,

                    },
                    success: function(data) {

                        $('#tab').html(data);

                    }
                });
            });
            $('#editsuccess').hide();

            $(document).on("click", "#esub", function() {

                var stu_Id2 = $("#updateqid").val();
                console.log(stu_Id2);
                var ed = $("#ed").val();
                var en = $("#en").val();
                var ec = $("#ec").val();
                var et = $("#et").val();
                var mop = $("#mop").val();
                console.log(et);

                if (ed == "" || en == "" || ec == "") {
                    alert("Enter all the fields");
                } else {
                    $.ajax({
                        url: "updateq2",
                        type: "POST",
                        data: {
                            stud_id2: stu_Id2,
                            ed: ed,
                            en: en,
                            ec: ec,
                            et: et,
                            mop: mop
                        },
                        success: function(data) {
                            if (data == 1) {
                                $('#staticBackdrop').modal('toggle');
                                var selectedname = $('#month_wise').val();
                                var page_mil_gaya = $('#pages').val();
                                var page_mil_gaya2 = $('#pages3').val();
                                var page_mil_gaya3 = $('#pages2').val();
                                var page_mil_gaya4 = $('#pages4').val();
                                var page_mil_gaya5 = $('#pages5').val();
                                var page_mil_gaya6 = $('#pages6').val();
                                var page_mil_gaya7 = $('#pages7').val();

                                if (selectedname == "Till_Date") {
                                    loadData1(page_mil_gaya);
                                    loadData2();
                                } else if (selectedname == 'Current_Month') {

                                    Current_Month(page_mil_gaya2);
                                    loadData3Current_Month();

                                } else if (selectedname == 'Previous_Month') {

                                    Previous_Month(page_mil_gaya3);
                                    loadData2Previous_Month();
                                } else if (selectedname == 'Previous_3_Months') {

                                    Previous_3_Months(page_mil_gaya4);
                                    loadData4Previous_3_Months();
                                } else if (selectedname == 'Last_6_Months') {

                                    Previous_6_Months(page_mil_gaya5);
                                    loadData5Previous_6_Months();
                                } else if (selectedname == 'Current_Year') {
                                    Cy(page_mil_gaya6);
                                    loadData6Cy();
                                } else {
                                    datekedata(page_mil_gaya7);
                                    datekepages();
                                }

                            }

                        }
                    });
                }

            });

            $('#search').on("keyup", function() {
                var searchval = $(this).val();
                if (searchval != "") {

                    $.ajax({
                        url: "livesearchq1",
                        type: "POST",
                        data: {
                            search: searchval
                        },
                        success: function(data) {
                            $('#tdh4').hide();

                            $('#td').html(data);
                        }
                    });
                } else {
                    loadData1();
                    loadData2();
                }
            });

            $("#start_date").hide();
            $("#end_date").hide();
            $("#dd").hide();
            $("#sdlabel").hide();
            $("#edlabel").hide();

            $(document).on("change", "#month_wise", function() {

                // e.preventDefault();

                var selectedname = $(this).val();
                if (selectedname == "Till_Date") {

                    loadData1();
                    loadData2();
                } else if (selectedname == 'Current_Month') {

                    Current_Month();
                    loadData3Current_Month();

                } else if (selectedname == 'Previous_Month') {

                    Previous_Month();
                    loadData2Previous_Month();
                } else if (selectedname == 'Previous_3_Months') {

                    Previous_3_Months();
                    loadData4Previous_3_Months();
                } else if (selectedname == 'Last_6_Months') {

                    Previous_6_Months();
                    loadData5Previous_6_Months();
                } else if (selectedname == 'DateWise') {
                    $("#sdlabel").show();
                    $("#edlabel").show();
                    $("#dd").show();
                    $("#start_date").show();
                    $("#end_date").show();

                } else {
                    Cy();
                    loadData6Cy();
                }
            });

            // $('#showog').on("click", function() {
            //     $('#tdh4').hide();
            //     $('#tbkineeche').hide();

            //     $('#showpagination').show();
            //     loaddata();
            // });

            // $('#showpagination').on("click", function() {
            //     $('#tbkineeche').show();
            //     loadData1();
            //     loadData2();
            // });
            $(document).on("click", "#divwala a", function(e) {
                e.preventDefault();
                var page_id = $(this).attr("id");
                loadData1(page_id);

            });
            $(document).on("click", '#mdelete', function() {
                var allid = [];
                var selectedname = $('#month_wise').val();
                var page_mil_gaya = $('#pages').val();
                var page_mil_gaya2 = $('#pages3').val();
                var page_mil_gaya3 = $('#pages2').val();
                var page_mil_gaya4 = $('#pages4').val();
                var page_mil_gaya5 = $('#pages5').val();
                var page_mil_gaya6 = $('#pages6').val();
                var page_mil_gaya7 = $('#pages7').val();

                $(":checkbox:checked").each(function(key) {
                    allid[key] = $(this).val();
                });
                if (allid.length == 0) {
                    alert("Kindly select aleast one checkbox");
                } else {
                    if (confirm("Do you really want to delete these entries?")) {
                        $.ajax({
                            url: "multidelete",
                            type: "POST",
                            data: {
                                allid: allid
                            },
                            success: function(data) {
                                if (data == 1) {
                                    alert("Deleted Successfully");
                                    loadData1();
                                    loadData2();
                                } else {
                                    alert("Error");
                                }
                            }
                        });
                    }
                }
            });

        });
    </script>
    <script>
        function check1() {
            $(document).on("click", "#check", function() {
                // var user_id = $(this).data('id');

                // console.log(user_id);
                if ($(this).is(":checked")) {
                    console.log($(this).val());
                    $(this).html("")
                    $('#md').html("<button id='mdelete' style='width:7vw;height:2.2vw;background-color:red;color:yellow'>Delete</button>");
                } else {
                    console.log("Sorry");
                    $('#md').html("Multi-Delete");
                }
            });
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

    <?php
    include "dbconnect1.php";
    $currencyq = "SELECT * FROM login where Email='{$_SESSION['email']}'";
    $currencyq_connect = mysqli_query($conn, $currencyq) or die("Query Failed");
    $currencyq_connect_assoc = mysqli_fetch_assoc($currencyq_connect);

    ?>
    <div class="table-responsive">
        <div class="container">
            <table class="table table-bordered table-striped table-hover" id="table_ko_count">
                <thead class='table-primary'>
                    <tr>
                        <thead class='table-primary' style="position: relative;">
                            <th scope='col'>Expense Date</th>
                            <th scope='col'>Expense Name</th>
                            <th scope='col'>Expense Type</th>
                            <th scope='col'>Payment_Mode</th>
                            <th scope='col'>Expense Cost</th>
                            <th scope='col'>Edit</th>
                            <th scope='col'>Delete</th>
                    </tr>
                <tbody id='td'>

                </tbody>
                </thead>
            </table>
            <div id="tbkineeche" style="float:left;"></div>
        </div>

    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> -->

</body>

</html>