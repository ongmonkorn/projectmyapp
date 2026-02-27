<?php
include('../config.php');
session_start();
$errors = array();
$statusMsg = "";


if (isset($_POST['reg_user'])) {
    $pname = mysqli_real_escape_string($conn, $_POST['pname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);

    $check_query = "SELECT * FROM user WHERE user_email = '$email'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        $_SESSION['emailerror'] = "อีเมลถูกใช้ไปแล้ว";
        header('location: register.php');
    } else if ($password_1 != $password_2) {
        $_SESSION['passworderror'] = "รหัสผ่านไม่ตรงกัน";
        header('location: register.php');
    } else {
        $password = md5($password_1);

        $insert = $conn->query("INSERT INTO user (user_pname, user_fname, user_lname, user_password, user_tel, user_sex, user_email, user_contact, user_birthday) 
                        VALUES ('$pname', '$fname', '$lname', '$password', '$tel', '$sex', '$email', '$contact', '$birthday') ");

        if ($insert) {
            $_SESSION['regissuccess'] = "You are now logged in";
            header('location: register.php');
        }
    }
}
