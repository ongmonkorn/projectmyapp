<?php

include('../config.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "../PHPMailer/PHPMailer.php";
require_once "../PHPMailer/SMTP.php";
require_once "../PHPMailer/Exception.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $email = mysqli_real_escape_string($conn, $_POST['email']);
    $link = "http://localhost/projectmyapp/user/resetpassword.php";
    // $status = mysqli_real_escape_string($conn, $_POST['status']);
    // $email = mysqli_real_escape_string($conn, $_POST['email']);

    // $sql = $conn->query("UPDATE orders SET order_status = $status WHERE order_id = $id");

    // if ($sql) {
        // ส่ง mail
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = 'ongrov1@gmail.com';
        $mail->Password = 'vvvxrbohdnbubuxw';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('ongrov1@gmail.com');

        $mail->addAddress($_POST["email"]);

        $mail->isHTML(true);

        $mail->Subject = "Training";
        $mail->Body = "คลิกเพื่อเปลี่ยนรหัสผ่านใหม่ <a href=".$link." >คลิก</a>";
        $mail->send();
        $_SESSION['resetpassword'] = $_POST["email"];
        $_SESSION['emailreset'] = 1;
        header('location: login.php');
//     }
// } else {
//     $_SESSION['approve_error'] = 1;
//     header('location: approve.php');
}
