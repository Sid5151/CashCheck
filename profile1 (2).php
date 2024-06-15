<?php
session_start();
include "dbconnect1.php";
// error_reporting(0);
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
$login_q = "Select * from login where Email='{$_SESSION['email']}'";
$login_q_connect = mysqli_query($conn, $login_q);
$login_q_row = mysqli_fetch_assoc($login_q_connect);

$addexp_q_connect = mysqli_query($conn, $addexp_q);
$addexp_q_row = mysqli_fetch_assoc($addexp_q_connect);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
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
    body {
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
    }

    .card {
      margin-top: 20px;
    }

    .card-header {
      background-color: #007bff !important;
      color: white !important;
      padding: 10px;
    }



    .card-body {
      padding: 20px;
    }

    .profile-photo {
      max-width: 200px;
      max-height: 200px;
      border-radius: 50%;
    }

    .pad-right {
      padding-right: 684px;
    }

    /* Media queries for responsiveness */
    @media (max-width: 990px) {
      .profile-photo {
        max-width: 100px;
        /* Decrease profile picture size for smaller screens */
        max-height: 150px;
      }
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
  <div id="pro">

  </div>
  <br>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="jquery-3.7.0.min.js"></script>
<script>
  $(function() {
    profile_page_load2();
  })

  function profile_page_load() {
    $.ajax({
      url: "profileq1",
      type: "POST",

      success: function(data) {
        $('#pro').html(data);
      }
    });
  }
  profile_page_load();

  function profile_page_load2() {

    $.ajax({
      url: "profileq1",
      type: "POST",
      success: function(data) {
        $('#pro').html(data);
        var total_c_val = $("#total_c").val();
        var monthly_l_val = $("#monthly_l").val();
        console.log(parseInt(total_c_val));
        console.log(parseInt(monthly_l_val));
        if (parseInt(total_c_val) > parseInt(monthly_l_val)) {
          $("#alert_wala").removeAttr("hidden").removeClass("fade");
        } else {
          $("#alert_wala").attr("hidden", true);
        }

      }

    });
  }
  $(document).on("click", "#cpb", function() {
    $('#cemail').removeAttr('disabled');
    $('#cpb').attr('hidden', true);
    $('#click_update').removeAttr('hidden');
    $('#cpb_val').val(1);
  });



  $(document).on("click", "#update", function() {
    var firstname = $('#fn').val();
    var lastname = $('#ln').val();
    var email = $('#cemail').val();
    var cpb_val = $('#cpb_val').val();
    // var rdate = ('#rdate').val();

    $.ajax({
      url: "profileq",
      type: "POST",
      data: {
        fname: firstname,
        lname: lastname,
        email: email,
        cpb_val: cpb_val
        //rdate: rdate
      },
      success: function(data) {
        if (data == 1) {
          alert("Updated");
        } else if (data == 2) {
          alert("Sorry a similar email id exist");
        } else if (data == 3) {
          window.location = 'mail4.php';
        } else {
          alert("Not Updated");
        }

      }
    });

  });

  function set_limit_button() {

    var ml2 = document.getElementById('ml').removeAttribute("disabled");
    var sl = document.getElementById('sl').setAttribute("hidden", true);
    var mls = document.getElementById('mls').removeAttribute("hidden");
  }

  function monthly_limit_submit() {
    var ml = document.getElementById('ml').value;
    if (ml == "") {
      alert("Entered Value Cannot Be Null");
    } else if (isNaN(ml)) {
      alert("Please enter number value only");
    } else {
      $.ajax({
        url: "monthly_limit",
        type: "POST",
        data: {
          ml: ml
        },
        success: function(data) {
          if (data == 1) {
            alert("Your Monthly Limit has been updated");
            // $('#ml').attr("disabled", true);
            profile_page_load2();
          } else {
            alert("Server is down at the moment\n Try again later....");
            profile_page_load2();
          }
        }
      });
    }
  }
</script>

</html>