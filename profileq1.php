<?php
session_start();
// error_reporting(0);
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
  echo "<script>window.location='projectlogin.php';</script>";
} else {
  include "dbconnect1.php";

  $query = "SELECT * FROM login WHERE Email='{$_SESSION['email']}'";
  $result = mysqli_query($conn, $query) or die("Sorry query failed");
  $nrows = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  if (!$row['Last_Used_Date'] == "" && !$row['Last_Used_Time'] == "") {
    if ($nrows == 1) {
      $output = "
        <html>
        <head>
        <title></title>
        </head>
        <body>
                <div class='container mt-4'>
                <div class='card'>
                  <div class='card-header'>
                    <h5>User Profile</h5>
                  </div>";

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
      $_SESSION['count_for_limit_profile1']++;
      if ($_SESSION['count_for_limit_profile1'] == 1) {
        if ($addexp_q_row['total_cost'] > base64_decode($login_q_row['Monthly_Limit'])) {

          $output .= "
    <div class='alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 mt-3 me-3' role='alert'>
        Your monthly limit exceeds your monthly expenses. Kindly spend wisely!!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
        }
      }
      $output .= "
      <div class='alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 mt-3 me-3' role='alert' id='alert_wala' hidden>
      Your monthly limit exceeds your monthly expenses. Kindly spend wisely!!!
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>

                  <div class='card-body'>
                    <div class='row'>
                      <div class='col-md-3'>
                      ";
      if ($row['First_Name'][0] == 'A') {
        $output .= "<img src='A-Z alpha/A.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'B') {
        $output .= "<img src='A-Z alpha/B.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'C') {
        $output .= "<img src='A-Z alpha/C.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'D') {
        $output .= "<img src='A-Z alpha/D.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'E') {
        $output .= "<img src='A-Z alpha/E.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'F') {
        $output .= "<img src='A-Z alpha/F.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'G') {
        $output .= "<img src='A-Z alpha/G.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'H') {
        $output .= "<img src='A-Z alpha/H.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'I') {
        $output .= "<img src='A-Z alpha/I.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'J') {
        $output .= "<img src='A-Z alpha/J.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'K') {
        $output .= "<img src='A-Z alpha/K.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'L') {
        $output .= "<img src='A-Z alpha/L.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'M') {
        $output .= "<img src='A-Z alpha/M.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'N') {
        $output .= "<img src='A-Z alpha/N.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'O') {
        $output .= "<img src='A-Z alpha/O.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'P') {
        $output .= "<img src='A-Z alpha/P.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'Q') {
        $output .= "<img src='A-Z alpha/Q.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'R') {
        $output .= "<img src='A-Z alpha/R.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'S') {
        $output .= "<img src='A-Z alpha/S.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>"; // Code for names starting with 'S'
      } else if ($row['First_Name'][0] == 'T') {
        $output .= "<img src='A-Z alpha/T.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'U') {
        $output .= "<img src='A-Z alpha/U.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'V') {
        $output .= "<img src='A-Z alpha/V.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'W') {
        $output .= "<img src='A-Z alpha/W.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'X') {
        $output .= "<img src='A-Z alpha/X.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'Y') {
        $output .= "<img src='A-Z alpha/Y.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      } else if ($row['First_Name'][0] == 'Z') {
        $output .= "<img src='A-Z alpha/Z.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
      }

      $output .= "
                      </div>
                      <div class='col-md-9'>
            
                <div class='form-group'>
                <label for='firstName'>First Name:</label>
                <input type='text' name='fname' id='fn' value='{$row['First_Name']}'  class='form-control'  />
              </div>
      
              <div class='form-group'>
              <label for='lastName'>Last Name:</label>
              <input type='text' name='lname' id='ln' value='{$row['Last_Name']}' class='form-control'  />
            </div>
            <div class='row'>
            <div class='col-md-4'>
            <div class='form-group'>
                <label for='email' style='margin-right:20rem;'>Email:</label>
                <input type='email' id='cemail' name='cemail' class='form-control form-control-custom' value='{$row['Email']}' disabled>
                <div class='input-group-append mt-2'>
                    <button class='btn btn-primary' name='cpb' id='cpb' type='button'>Change Email</button>
                    <span id='click_update' class='input-group-append mt-2'style='background-color:red;color:yellow;padding:0.2rem;font-size:smaller;' hidden>Click on update down below after you have entered your new mail</span>
                    </div>
            </div>

        </div>
        
        <div class='col-md-4'>
  <div class='form-group'>
         
      <div class='form-group'>
      <label for='changePassword'>Change Password:</label>
        <input type='password' name='pass' id='pass' onkeyup='validate()' class='form-control form-control-custom' placeholder='Enter new password:' onfocus='showRequirements()' onblur='hideRequirements()'>
        <div class='password-requirements' style='background-color: #f8f9fa; padding: 10px; border-radius: 5px; border: 1px solid #ccc; margin-top: 10px;'>
          <p style='font-weight:bold;'>Password Requirements:</p>
          <ul style='list-style-type: none; padding: 0;'>
            <li><span id='upper' style='font-weight:bold;'>At least one uppercase</span></li>
            <li><span id='lower' style='font-weight:bold;'>At least one lowercase</span></li>
            <li><span id='special_char' style='font-weight:bold;'>At least one special character</span></li>
            <li><span id='number' style='font-weight:bold;'>At least one number</span></li>
            <li><span id='length' style='font-weight:bold;'>At least 6 characters in length</span></li>
          </ul>
        </div>
        <div class='input-group-append mt-2'>
          <button class='cpassb' id='cpassb' onclick='pass_update()' style='color: #fff;
          background-color: #007bff;
          border-color: #007bff;border-radius:0.5rem;'>Submit</button>
          </div>
      </div>
  </div>
</div>

        
        <div class='col-md-4'>
            <div class='form-group'>
                <label for='monthlyLimit'>Set Monthly Limit:</label>
                <input type='text' id='ml' name='ml' placeholder='Enter an amount' disabled value='" . base64_decode($row['Monthly_Limit']) . "' class='form-control form-control-custom'>
                <div class='input-group-append mt-2'>
                    <input type='submit' class='btn btn-primary' value='Submit' id='mls' name='mls' onclick='return monthly_limit_submit()' hidden>
                    <input type='submit' value='Set Limit' class='btn btn-primary' id='sl' name='sl' onclick='return set_limit_button()'>
                </div>
            </div>
        </div>
        </div>
                     <input type='text' id='cpb_val' name='cpb_val' hidden>
                     <input type='text' id='total_c' value='" . htmlspecialchars($addexp_q_row['total_cost'], ENT_QUOTES) . "' hidden>
                     <input type='text' id='monthly_l' value='" . htmlspecialchars(base64_decode($login_q_row['Monthly_Limit']), ENT_QUOTES) . "'hidden>
                 
             <br>
            <div class='form-group'>
              <label for='registrationDate'>Registration Date & Time:</label>
              <input type='text' name='rdate' id='rdate' value='{$row['TimeStamp']}' class='form-control' readonly />
            </div>
            <div class='form-group'>
              <label for='lastUsedDate'>Last Used Date & Time:</label>
              <input type='text' name='lud' id='lud' value='{$row['Last_Used_Date']}' class='form-control' readonly />
              <div class='form-group'>
              <label for='registrationDate'>Last Used Time:</label>
              <input type='text' name='lut' id='lut' value='{$row['Last_Used_Time']}' class='form-control' readonly />
            </div>
              <div class='form-group mt-4'>
                <button type='button' class='btn btn-primary' id='update'>Update</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
  </body>
  </html>
        ";
    }
    // $_SESSION['cpb'] = $_POST['cpb'];
  } else {
    $output = "
        <html>
        <head>
        <title></title>
        </head>
        <body>
                <div class='container mt-4'>
                <div class='card'>
                  <div class='card-header'>
                    <h5>User Profile</h5>
                  </div>";

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
    $_SESSION['count_for_limit_profile1']++;
    if ($_SESSION['count_for_limit_profile1'] == 1) {
      if ($addexp_q_row['total_cost'] > base64_decode($login_q_row['Monthly_Limit'])) {

        $output .= "
    <div class='alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 mt-3 me-3' role='alert'>
        Your monthly limit exceeds your monthly expenses. Kindly spend wisely!!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
      }
    }
    $output .= "
      <div class='alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 mt-3 me-3' role='alert' id='alert_wala' hidden>
      Your monthly limit exceeds your monthly expenses. Kindly spend wisely!!!
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>

                  <div class='card-body'>
                    <div class='row'>
                      <div class='col-md-3'>
                      ";
    if ($row['First_Name'][0] == 'A') {
      $output .= "<img src='A-Z alpha/A.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'B') {
      $output .= "<img src='A-Z alpha/B.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'C') {
      $output .= "<img src='A-Z alpha/C.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'D') {
      $output .= "<img src='A-Z alpha/D.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'E') {
      $output .= "<img src='A-Z alpha/E.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'F') {
      $output .= "<img src='A-Z alpha/F.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'G') {
      $output .= "<img src='A-Z alpha/G.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'H') {
      $output .= "<img src='A-Z alpha/H.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'I') {
      $output .= "<img src='A-Z alpha/I.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'J') {
      $output .= "<img src='A-Z alpha/J.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'K') {
      $output .= "<img src='A-Z alpha/K.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'L') {
      $output .= "<img src='A-Z alpha/L.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'M') {
      $output .= "<img src='A-Z alpha/M.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'N') {
      $output .= "<img src='A-Z alpha/N.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'O') {
      $output .= "<img src='A-Z alpha/O.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'P') {
      $output .= "<img src='A-Z alpha/P.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'Q') {
      $output .= "<img src='A-Z alpha/Q.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'R') {
      $output .= "<img src='A-Z alpha/R.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'S') {
      $output .= "<img src='A-Z alpha/S.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>"; // Code for names starting with 'S'
    } else if ($row['First_Name'][0] == 'T') {
      $output .= "<img src='A-Z alpha/T.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'U') {
      $output .= "<img src='A-Z alpha/U.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'V') {
      $output .= "<img src='A-Z alpha/V.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'W') {
      $output .= "<img src='A-Z alpha/W.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'X') {
      $output .= "<img src='A-Z alpha/X.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'Y') {
      $output .= "<img src='A-Z alpha/Y.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    } else if ($row['First_Name'][0] == 'Z') {
      $output .= "<img src='A-Z alpha/Z.jpg' alt='Profile Photo' class='profile-photo' style='margin-left: 4rem;'/>";
    }

    $output .= "
                      </div>
                      <div class='col-md-9'>
            
                <div class='form-group'>
                <label for='firstName'>First Name:</label>
                <input type='text' name='fname' id='fn' value='{$row['First_Name']}'  class='form-control'  />
              </div>
      
              <div class='form-group'>
              <label for='lastName'>Last Name:</label>
              <input type='text' name='lname' id='ln' value='{$row['Last_Name']}' class='form-control'  />
            </div>
            <div class='row'>
            <div class='col-md-4'>
            <div class='form-group'>
                <label for='email' style='margin-right:20rem;'>Email:</label>
                <input type='email' id='cemail' name='cemail' class='form-control form-control-custom' value='{$row['Email']}' disabled>
                <div class='input-group-append mt-2'>
                    <button class='btn btn-primary' name='cpb' id='cpb' type='button'>Change Email</button>
                    <span id='click_update' class='input-group-append mt-2'style='background-color:red;color:yellow;padding:0.2rem;font-size:smaller;' hidden>Click on update down below after you have entered your new mail</span>
                    </div>
            </div>

        </div>
        
        <div class='col-md-4'>
  <div class='form-group'>
         
      <div class='form-group'>
      <label for='changePassword'>Change Password:</label>
        <input type='password' name='pass' id='pass' onkeyup='validate()' class='form-control form-control-custom' placeholder='Enter new password:' onfocus='showRequirements()' onblur='hideRequirements()'>
        <div class='password-requirements' style='background-color: #f8f9fa; padding: 10px; border-radius: 5px; border: 1px solid #ccc; margin-top: 10px;'>
          <p style='font-weight:bold;'>Password Requirements:</p>
          <ul style='list-style-type: none; padding: 0;'>
            <li><span id='upper' style='font-weight:bold;'>At least one uppercase</span></li>
            <li><span id='lower' style='font-weight:bold;'>At least one lowercase</span></li>
            <li><span id='special_char' style='font-weight:bold;'>At least one special character</span></li>
            <li><span id='number' style='font-weight:bold;'>At least one number</span></li>
            <li><span id='length' style='font-weight:bold;'>At least 6 characters in length</span></li>
          </ul>
        </div>
        <div class='input-group-append mt-2'>
          <button class='cpassb' id='cpassb' class='btn btn-primary' onclick='pass_update()'>Submit</button>
          </div>
      </div>
  </div>
</div>

        
        <div class='col-md-4'>
            <div class='form-group'>
                <label for='monthlyLimit'>Set Monthly Limit:</label>
                <input type='text' id='ml' name='ml' placeholder='Enter an amount' disabled value='" . base64_decode($row['Monthly_Limit']) . "' class='form-control form-control-custom'>
                <div class='input-group-append mt-2'>
                    <input type='submit' class='btn btn-primary' value='Submit' id='mls' name='mls' onclick='return monthly_limit_submit()' hidden>
                    <input type='submit' value='Set Limit' class='btn btn-primary' id='sl' name='sl' onclick='return set_limit_button()'>
                </div>
            </div>
        </div>
        </div>
                     <input type='text' id='cpb_val' name='cpb_val' hidden>
                     <input type='text' id='total_c' value='" . htmlspecialchars($addexp_q_row['total_cost'], ENT_QUOTES) . "' hidden>
                     <input type='text' id='monthly_l' value='" . htmlspecialchars(base64_decode($login_q_row['Monthly_Limit']), ENT_QUOTES) . "'hidden>
                 
             <br>
            <div class='form-group'>
              <label for='registrationDate'>Registration Date & Time:</label>
              <input type='text' name='rdate' id='rdate' value='{$row['TimeStamp']}' class='form-control' readonly />
            </div>
            <div class='form-group'>
              <label for='lastUsedDate'>Last Used Date & Time:</label>
              <input type='text' name='lud' id='lud' value='{$row['Last_Used_Date']}' class='form-control' readonly />
              <div class='form-group'>
              <label for='registrationDate'>Last Used Time:</label>
              <input type='text' name='lut' id='lut' value='{$row['Last_Used_Time']}' class='form-control' readonly />
            </div>
              <div class='form-group mt-4'>
                <button type='button' class='btn btn-primary' id='update'>Update</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
  </body>
  </html>
        ";
  }

  echo $output;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
  <title>Document</title>
</head>

<body>
  <script>
    // function validate() {
    //   var password = document.getElementById("pass").value;
    //   var requirementsMet = {
    //     upper: /[A-Z]/.test(password),
    //     lower: /[a-z]/.test(password),
    //     special_char: /[!@#$%^&*(),.?":{}|<>]/.test(password),
    //     number: /\d/.test(password),
    //     length: password.length >= 6
    //   };

    //   var passwordField = document.getElementById("pass");
    //   var passwordRequirements = document.querySelectorAll(".password-requirements li span");

    //   // Check if password meets requirements and update corresponding elements
    //   for (var req in requirementsMet) {
    //     var element = document.getElementById(req);
    //     if (requirementsMet[req]) {
    //       element.style.color = "green";
    //     } else {
    //       element.style.color = "initial";
    //     }
    //   }

    //   // Check if password is not null and at least 6 characters
    //   if (password && password.length >= 6) {
    //     passwordField.style.borderColor = "green";
    //     return true;
    //   } else {
    //     passwordField.style.borderColor = "initial";
    //     return false;
    //   }
    // }

    // function check() {
    //   // Additional validation if needed
    //   return validate();
    // }

    // function showRequirements() {
    //   document.querySelector(".password-requirements").style.display = "block";
    // }

    // function hideRequirements() {
    //   document.querySelector(".password-requirements").style.display = "none";
    // }
  </script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> -->
  <script src="jquery-3.7.0.min.js"></script>
</body>

</html>