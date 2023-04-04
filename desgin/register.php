<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
  header("Location: index.html");
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

// Check if the registration form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the form data
  $username = $_POST['name'];
  $email = $_POST['email'];
  $ph_no = $_POST['phno'];
  $password = $_POST['pass'];

  // Hash the password for security
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Check if the username already exists
  $sql = "SELECT id FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $error_message = "Username already taken.";
  } else {
    // Insert the user into the database
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
    if (mysqli_query($conn, $sql)) {
      // Store the user ID and any other relevant information in session variables
      $user_id = mysqli_insert_id($conn);
      $_SESSION['username'] = $username;

      // Redirect to the dashboard page
      header("Location: dashboard.php");
      exit();
    } else {
      $error_message = "Registration failed. Please try again later.";
    }
  }
}

// If the registration form wasn't submitted, show the registration form
?>