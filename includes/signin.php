<?php

session_start();

if (isset($_POST['submit'])) {

  include_once 'connect.php';

$username = $_POST['USname'];
$pwd = $_POST['pwd'];

// Error handler for empty inputs
if (empty($username) || empty($pwd)) {
  header("location: ../index.php?error=emptyinputs");
  exit();
} else {
    $sql = "SELECT * FROM users WHERE user_username = '$username' OR user_email = '$username';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_affected_rows($conn);

    // Check the inputed data if exists
    if ($resultCheck < 1) {
      header("location: ../index.php?error=signin");
      exit();
    } else {
      if ($row = mysqli_fetch_assoc($result)) {

        // Error handler for password
        if ($pwd == false) {
          header("location: ../index.php?error=signin");
          exit();
        }
        elseif ($pwd == true) {
          // Log in user here
          $_SESSION['admin_uid']      = $row['user_id'];
          $_SESSION['admin_name']     = $row['user_name'];
          $_SESSION['admin_username'] = $row['user_username'];
          $_SESSION['admin_email']    = $row['user_email'];
          $_SESSION['admin_pass']     = $row['user_password'];
          $_SESSION['admin_usertype'] = $row['user_usertype'];

          header("location: ../users/index.php?login=success");
          exit();
        }
      }
    }
  }
}  else {
  header("location: ../login.php?error=7");
  exit();
}



 ?>
