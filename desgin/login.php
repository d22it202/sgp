<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
  header("Location: dashboard.php");
  exit();
}

$host = "localhost"; //your host name
$username = "root"; //your database username
$password = ""; //your database password
$database = "registration"; //your database name

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the login form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Check the username and password
  if ($_POST['user'] == 'username' && $_POST['pass'] == 'password') {
    // Store the user ID and any other relevant information in session variables
    $_SESSION['username'] = $username;

    // Redirect to the dashboard page
    header("Location: index.html");
    exit();
  } else {
    // If the login was unsuccessful, show an error message
    $error_message = "Invalid username or password.";
  }
}

// If the login form wasn't submitted, show the login form
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/style.css">

</head>
<body>
   
   <header class="header">

      <section class="flex">
   
         <a href="home.html" class="logo" >food_delivery_website</a>
   
         <nav class="navbar">
            <a href="home.html">Home</a>
            <a href="about.html">About</a>
            <a href="menu.html">Menu</a>
            <a href="orders.html">Orders</a>
            <a href="contact.html">Contact</a>
         </nav>
   
         <div class="icons">
            <a href="search.html"><i class="fas fa-search"></i></a>
            <a href="cart.html"><i class="fas fa-shopping-cart"></i><span></span></a>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
         </div>
   
         <div class="profile">
            <div class="flex">
               <a href="login.html" class="btn">login</a>
            </div>
            <p class="account"> or <a href="register.html">register</a></p>
         </div>
   
      </section>
   
   </header>

<section class="form-container">

   <form action="login.php" method="post">
      <h3>login now</h3>
      <input type="text" id="user" maxlength="25" name="username" placeholder="enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" id="pass" required maxlength="20" name="pass" placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')"><br>
      <input type="checkbox" required name="check" id="check-id" value="I agree all the terms & conditions"><label for="check-id">I agree all the terms & conditions</label><br>
      <input type="submit" value="login now" class="btn" name="submit">
      <p>don't have an account? <a href="register.html">register now</a></p>
   </form>

</section>

<footer class="footer">

   <section class="box-container">

      <div class="box">
         <img src="images/email-icon.png" alt="">
         <h3>our email</h3>
         <a href="ykotiya35@gmail.com">ykotiya35@gmail.com</a>
         <a href="azizmoriswala94@gmail.com">azizmoriswala94@gmail.com</a>
      </div>

      <div class="box">
         <img src="images/clock-icon.png" alt="">
         <h3>opening hours</h3>
         <p>09:00Am to 12:00Pm </p>
      </div>

      <div class="box">
         <img src="images/map-icon.png" alt="">
         <h3>our address</h3>
         <a href="https://www.google.com/maps">vadodara, india - 390019</a>
      </div>

      <div class="box">
         <img src="images/phone-icon.png" alt="">
         <h3>our number</h3>
         <a href="Phone No.:+91-7069835749">+91-7069835749</a>
         <a href="Phone No.:+91-9510850552">+91-9510850552</a>
      </div>

   </section>

   <div class="credit">&copy; Copyright @ 2023 By <span>Aziz Moriswala & Yash kotiya</span> | All Rights Reserved!</div>

</footer>

<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="./js/script.js"></script>

</body>
</html>