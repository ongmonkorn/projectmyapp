<?php

include('../config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION['user_id'];
    $password1 = md5(mysqli_real_escape_string($conn, $_POST['password1']));
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
    $password3 = mysqli_real_escape_string($conn, $_POST['password3']);


    $check_query = "SELECT * FROM user WHERE user_id = '$id' ";
    $query = mysqli_query($conn, $check_query);
    $result = mysqli_fetch_assoc($query);

    if ($result['user_password'] != $password1) {
        $_SESSION['passerror'] = "รหัสเดิมไม่ถูกต้อง";
        header("location: home.php");
    } else if ($password2 != $password3) {
        $_SESSION['errorpass'] = "รหัสใหม่ไม่เหมือนกัน";
        header("location: home.php");
    } else {
        $password = md5($password2);

        $update = $conn->query("
        UPDATE user SET 
        user_password = '$password' 
        WHERE user_id = '$id' ");

        if ($update) {
            $_SESSION['editpass'] = "เปลี่ยนรหัสผ่านสำเร็จ";
            // $sql = $conn->query("INSERT INTO history (user_id, history, history_time)
            // VALUES (" . $_SESSION['user_id'] . ", '" . $_SESSION['editpass'] . "', NOW() )");
            header('location: home.php');
        } else {
            array_push($errors, "Username or Email already exists");
            $_SESSION['error'] = "Username or Email already exists";
            header("location: test.php");
        }
    }
}
