<?php

include('../config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['resetpassword'];
    $password1 = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
    // $password3 = mysqli_real_escape_string($conn, $_POST['password3']);


    // $check_query = "SELECT * FROM user WHERE user_id = '$id' ";
    // $query = mysqli_query($conn, $check_query);
    // $result = mysqli_fetch_assoc($query);

    if ($password1 != $password2) {
        $_SESSION['reseterrorpass'] = "รหัสใหม่ไม่เหมือนกัน";
        header("location: resetpassword.php");
    } else {
        $password = md5($password2);

        $update = $conn->query("
        UPDATE user SET 
        user_password = '$password' 
        WHERE user_email = '$email' ");

        if ($update) {
            unset($_SESSION['resetpassword']);
            $_SESSION['resetpasssuccess'] = "เปลี่ยนรหัสผ่านสำเร็จ";
            // $sql = $conn->query("INSERT INTO history (user_id, history, history_time)
            // VALUES (" . $_SESSION['user_id'] . ", '" . $_SESSION['editpass'] . "', NOW() )");
            header('location: login.php');
        } else {
            array_push($errors, "Username or Email already exists");
            $_SESSION['error'] = "Username or Email already exists";
            header("location: test.php");
        }
    }
}
