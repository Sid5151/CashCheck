<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact/Support</title>
  <link rel = "icon" href = 
    "favicon-32x32.png" 
            type = "image/x-icon">
  <style>
    body {
      background: whitesmoke;
      margin: 0
    }

    .form {
      width: 340px;
      height: 440px;
      background: #e6e6e6;
      border-radius: 8px;
      box-shadow: 0 0 40px -10px #000;
      margin: calc(50vh - 220px) auto;
      padding: 20px 30px;
      max-width: calc(100vw - 40px);
      box-sizing: border-box;
      font-family: 'Montserrat', sans-serif;
      position: relative
    }

    h2 {
      margin: 10px 0;
      padding-bottom: 10px;
      width: 180px;
      color: #78788c;
      border-bottom: 3px solid #78788c
    }

    input {
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
      background: none;
      outline: none;
      resize: none;
      border: 0;
      font-family: 'Montserrat', sans-serif;
      transition: all .3s;
      border-bottom: 2px solid #bebed2
    }

    input:focus {
      border-bottom: 2px solid #78788c
    }

    p:before {
      content: attr(type);
      display: block;
      margin: 28px 0 0;
      font-size: 14px;
      color: #5a5a5a
    }

    #b {
      float: right;
      padding: 8px 12px;
      margin: 8px 0 0;
      font-family: 'Montserrat', sans-serif;
      border: 2px solid #78788c;
      background: 0;
      color: #5a5a6e;
      cursor: pointer;
      transition: all .3s
    }

    #b:hover {
      background: #78788c;
      color: #fff
    }

    div {
      content: 'Hi';
      position: absolute;
      bottom: -15px;
      right: -15px;
      background: #50505a;
      color: #fff;
      width: 200px;
      padding: 16px 4px 16px 0;
      border-radius: 6px;
      font-size: 13px;
      box-shadow: 10px 10px 40px -14px #000
    }

    span {
      margin: 0 5px 0 15px
    }
  </style>
</head>

<body>
 
  <form class="form" method="post">
    <h2>CONTACT US</h2>
    <p type="Name:"><input type="text" placeholder="Write your name here.." name="name"></input></p>
    <p type="Email:"><input type="text" placeholder="Let us know how to contact you back.." name="email" disabled value="<?php echo $_SESSION['email'] ?>"></input></p>
    <p type="Message:"><input type="text" placeholder="What would you like to tell us.." name="msg"></input></p>
    <div>
      <span>cashcheck0707@gmail.com</span>
    </div>
    <button id="b" name="b">Send Message</button>

  </form>

  <!-- <script>
    function s() {
      window.location = "mailcontact.php";
    }
  </script> -->
</body>

</html>
<?php
if (isset($_POST['b'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $msg = $_POST['msg'];

  $_SESSION['cname'] = $name;
  $_SESSION['cemail'] = $email;
  $_SESSION['cmsg'] = $msg;
  header("location:mailcontact.php");
}
?>