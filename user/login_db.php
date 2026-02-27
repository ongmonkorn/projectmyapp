
<?php
session_start();
include('../config.php');

$errors = array();


if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        // แปลงรหัสผ่านเป็นรหัสผ่านแบบเข้ารหัส
        $password = md5($password);

        $query = "SELECT * FROM user WHERE user_email = '$email' AND user_password = '$password' ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['success'] = "Successfully";
            $_SESSION['user_id'] = $row["user_id"];
            $_SESSION['pname'] = $row["user_pname"];
            $_SESSION['fname'] = $row["user_fname"]; // เก็บชื่อจริงใน Session
            $_SESSION['lname'] = $row["user_lname"];   // เก็บนามสกุลใน Session
            header("location: home.php");
        } else {
            array_push($errors, "Wrong username/password combination");
            $_SESSION['error'] = "Wrong username or password try againt";
            header("location: login.php");
        }
    }
}
