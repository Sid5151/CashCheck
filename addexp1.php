<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    echo '<script>
    window.location="projectlogin.php";
    </script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Add Expense</title>
    <style>
        body {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            height: auto;
            width: 1000px;

        }

        h1 {
            color: #343a40;
        }

        label {
            font-weight: bold;
        }


        .instructions {
            background-color: #f0f0f0;
            text-align: left;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text-center">Expense Entry</h1>
        <div class="row">
            <div class="col-md-6 instructions">
                <p><strong>
                        <h3>Instructions:</h3>
                    </strong></p>
                <p><b><i>
                            <h5>Date: Enter the date of the Expense.</h5>
                        </i></b></p>
                <p><b><i>
                            <h5>Type of Expense: Select the type of Expense from the dropdown.</h5>
                        </i></b></p>
                <p><b><i>
                            <h5>Expense Name: Enter the name of your Expense.</h5>
                        </i></b></p>
                <p><b><i>
                            <h5>Cost: Enter the cost of the expense.</h5>
                        </i></b></p>
            </div>
            <div class="col-md-6">
                <form method="post" onsubmit="return valid()">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sel">Type of Expense</label>
                        <select class="form-control" id="sel" required>
                            <option value="Select" disabled selected>Select</option>
                            <option value="Transportation">Transportation</option>
                            <option value="Food">Food</option>
                            <option value="Utilities">Utilities</option>
                            <option value="Clothing">Clothing</option>
                            <option value="Medical/Healthcare">Medical/Healthcare</option>
                            <option value="Insurance">Insurance</option>
                            <option value="Household_Items/Supplies">Household_Items/Supplies</option>
                            <option value="Debt/Loan">Debt/Loan</option>
                            <option value="Education">Education</option>
                            <option value="Savings">Savings</option>
                            <option value="Investments">Investments</option>
                            <option value="Entertainment ">Entertainment</option>
                            <option value="Gifts/Donations">Gifts/Donations</option>
                            <option value="Housing">Housing</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="m_o_p">Mode of Payment</label>
                        <select class="form-control" id="m_o_p" required>
                            <option value="Select" disabled selected>Select</option>
                            <option value="UPI/Gpay">UPI/Gpay</option>
                            <option value="UPI/Phonepay">UPI/Phonepay</option>
                            <option value="UPI/Paytm">UPI/Paytm</option>
                            <option value="Cash">Cash</option>
                            <option value="Credit_Card">Credit Card</option>
                            <option value="Debit_Card">Debit_Card</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exp">Expense Name</label>
                        <div class="input-group">
                            <input type="text" name="exp" id="exp" class="form-control">
                            <button type="button" id="startButton" class="btn btn-primary">Voice Text</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cost">Cost</label>
                        <input type="text" name="cost" id="cost" class="form-control">
                        <input type="text" id="it" name="it" hidden>
                        <input type="text" id="m_o_p_val" name="m_o_p_val" hidden>

                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success">Add Expense</button>
                    </div>
                </form>
                <a href="showexp2.php" class="mt-3 btn btn-success">Manage Expense</a>
            </div>
        </div>
    </div>


    <script src="jquery-3.7.0.min.js"></script>
    <script>
        $(function() {
            $("#sel").change(function() {
                var val = $(this).val();
                console.log(val);
                $('#it').val(val);
            });
            $("#m_o_p").change(function() {
                var m_o_p_val = $(this).val();
                console.log(m_o_p_val);
                $("#m_o_p_val").val(m_o_p_val);
            });
        });

        function hp() {
            var exp = document.getElementById("exp").value.toString();
            var cost = document.getElementById("cost").value.toString();
            console.log(exp);
        }
         function valid() {
            var exp = document.getElementById("exp").value;
            var cost = document.getElementById("cost").value;
            if (exp == "" || cost == "") {
                alert("Kindly don't leave blank fields");
                return false;
            } else if (!exp.trim() || !cost.trim()) {
                alert("Kindly don't leave blank fields");
                return false;
            } else if (isNaN(cost)) {
                alert("Kindly enter only digits in Cost field");
                return false;
            } else if (!isNaN(exp)) {
                alert("Kindly enter only characters in Expense Name field");
                return false;
            }

        }
    </script>
    <script>
        // Select DOM elements
        const startButton = document.getElementById("startButton");
        const transcription = document.getElementById("exp");

        // Event handler for when the startButton is clicked
        startButton.addEventListener("click", () => {
            // Detect user's browser
            const userAgent = navigator.userAgent;

            if (
                userAgent.indexOf("Chrome") === -1 &&
                userAgent.indexOf("Brave") === -1
            ) {
                alert(
                    "This feature is only available in Google Chrome. Please use Chrome to access this feature."
                );
            } else if (userAgent.indexOf("Brave") !== -1) {
                alert(
                    "This feature is only available in Google Chrome. Please use Chrome to access this feature."
                );
            } else {
                // Initialize SpeechRecognition object
                const recognition =
                    new webkitSpeechRecognition() || new SpeechRecognition();

                // Set recognition parameters
                recognition.lang = "en-US"; // Set the language
                recognition.interimResults = true; // Get interim results
                recognition.continuous = true; // Keep recognition active even after a pause

                let timeoutId; // Variable to store timer ID

                // Event handler for when speech recognition starts
                recognition.onstart = () => {
                    startButton.textContent = "Recording...";
                };

                // Event handler for when speech recognition ends
                recognition.onend = () => {
                    startButton.textContent = "Start Recording";
                    clearTimeout(timeoutId); // Clear the timer when recognition ends
                };

                // Event handler for when speech is recognized
                recognition.onresult = (event) => {
                    const transcript = Array.from(event.results)
                        .map((result) => result[0].transcript)
                        .join("");
                    transcription.value = transcript;

                    // Clear the previous timer and set a new one after each result
                    clearTimeout(timeoutId);
                    timeoutId = setTimeout(() => {
                        recognition.stop(); // Stop recognition after 3.5 seconds of silence
                    }, 2000);
                };

                // Start speech recognition
                recognition.start();
            }
        });
    </script>

</body>

</html>
<?php
include 'dbconnect1.php';
define("KEY", "PUNK");
$_SESSION['KEY'] = KEY;
if (isset($_POST['date']) || isset($_POST['exp']) || isset($_POST['cost'])) {
    $date =  $_POST['date'];
    $exp =  htmlspecialchars($_POST['exp']);
    $cost = htmlspecialchars($_POST['cost']);
    $exp_type = $_POST['it'];
    $payment_type = $_POST['m_o_p_val'];

    $str_exp_type = base64_encode($exp_type);
    $str_payment_type = base64_encode($payment_type);

    $sanitized_date =
        mysqli_real_escape_string($conn, $date);

    $sanitized_exp =
        mysqli_real_escape_string($conn, $exp);
    $str_exp = base64_encode($sanitized_exp);

    $sanitized_cost =
        mysqli_real_escape_string($conn, $cost);
    $str_cost = base64_encode($sanitized_cost);

    $query = "INSERT INTO `addexp`(`Email`, `Expense_Date`, `Expense_Name`, `Expense_Cost`,`Exp_type`,`Payment_Mode`) VALUES ('{$_SESSION['email']}','$sanitized_date','$str_exp','$str_cost','$str_exp_type','$str_payment_type')";
    $result = mysqli_query($conn, $query);

    // $query2 = "Select * from piechart where Name='$exp_type' and Email='{$_SESSION['email']}' ";
    // $result2 = mysqli_query($conn, $query2);
    // $row2 = mysqli_fetch_assoc($result2);
    // $nrows2 = mysqli_num_rows($result2);

    // $query5 = "Select * from piechart where Name='$exp_type' and Email='{$_SESSION['email']}'";
    // $result5 = mysqli_query($conn, $query5);
    // $nrows5 = mysqli_num_rows($result5);


    // if ($nrows5 <= 0) {
    //     $query4 = "INSERT INTO `piechart`(`Name`, `Val`, `Email`) VALUES ('$exp_type','$sanitized_cost','{$_SESSION['email']}')";
    //     $result4 = mysqli_query($conn, $query4);
    // } elseif ($nrows5 > 0) {
    //     $query3 = "UPDATE `piechart` SET `Val`={$row2['Val']}+'$sanitized_cost' WHERE Email='{$_SESSION['email']}' and Name='$exp_type'; " or die("Failed");
    //     $result3 = mysqli_query($conn, $query3);
    // }

    // if ($nrows5 > 0) {
    //     $query3 = "UPDATE `piechart` SET `Val`={$row2['Val']}+'$sanitized_cost' WHERE Email='{$_SESSION['email']}' and Name='$exp_type'; " or die("Failed");
    //     $result3 = mysqli_query($conn, $query3);
    // } else {
    //     $query4 = "INSERT INTO `piechart`(`Name`, `Val`, `Email`) VALUES ('$exp_type','$sanitized_cost','{$_SESSION['email']}')";
    //     $result4 = mysqli_query($conn, $query4);
    // }

    if ($result) {
        echo '<script>
                    alert("Your expense has been added.");
                    window.location="addexp1.php";
                    </script>';
        // header("showexp.php");

    } else {
        echo "Sorry Your expense has not been added, since there is a techical difficulties....";
    }
}

?>