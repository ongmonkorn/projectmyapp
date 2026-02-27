
<?php
session_start();
include('../config.php');

$errors = array();


if (isset($_POST['login_admin'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "user is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $query = "SELECT * FROM tb_admin WHERE admin_username = '$username' AND admin_password = '$password' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if (mysqli_num_rows($result) == 1) {
      
      $_SESSION['loginadmin'] = "Successfully";
      $_SESSION['admin_id'] = $row["admin_id"];
      /*$_SESSION['pname'] = $row["admin_pname"];
      $_SESSION['fname'] = $row["admin_fname"]; // เก็บชื่อจริงใน Session
      $_SESSION['lname'] = $row["admin_lname"];*/   // เก็บนามสกุลใน Session
      header("location: home.php");
    } else {
      array_push($errors, "Wrong username/password combination");
      $_SESSION['adminerror'] = "Wrong username or password try againt";
      header("location: login.php");
    }
  }
}
