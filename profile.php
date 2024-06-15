<?php
session_start();
if ((time() - $_SESSION['user_time']) > 3600) {
    echo '
    <script>
    alert("Your 60 seconds expired");
    window.location="logout.php";
    </script>';
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    header("location:projectlogin.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel = "icon" href = 
    "favicon-32x32.png" 
            type = "image/x-icon">
</head>

<body>
    <div id="pro">

    </div>

    <script src="jquery-3.7.0.min.js"></script>
    <script>
        $(function() {
            $.ajax({
                url: "profileq1",
                type: "POST",

                success: function(data) {
                    $('#pro').html(data);
                }
            });
            $(document).on("click", "#update", function() {
                var firstname = $('#fn').val();
                var lastname = $('#ln').val();
                var email = $('#email').val();
                // var rdate = ('#rdate').val();

                $.ajax({

                    url: "profileq",
                    type: "POST",
                    data: {
                        fname: firstname,
                        lname: lastname,
                        email: email,
                        //rdate: rdate
                    },
                    success: function(data) {
                        if (data == 1) {
                            alert("Updated");
                        } else {
                            alert("Not Updated");
                        }
                    }
                })

            });
        })
    </script>
</body>

</html>