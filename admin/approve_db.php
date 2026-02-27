<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <?php
    include('../config.php');
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once "../PHPMailer/PHPMailer.php";
    require_once "../PHPMailer/SMTP.php";
    require_once "../PHPMailer/Exception.php";

    $training_id = mysqli_real_escape_string($conn, $_POST['training_id']);
    if (isset($_POST['approve'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        // $email = mysqli_real_escape_string($conn, $_POST['email']);

        $sql = $conn->query("UPDATE orders SET order_status = $status WHERE order_id = $id");

        // คิวรีเพื่อดึงข้อมูลการฝึกอบรม
        $sql2 = "SELECT * FROM training WHERE training_id = '$training_id'";
        $query = mysqli_query($conn, $sql2);
        $training = mysqli_fetch_array($query, MYSQLI_ASSOC);

        if ($sql) {
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
            $mail->Body = "แอดมินได้ทำการตรวจสอบการลงทะเบียนของคุณแล้ว <a href='". $training['training_map']. "'>ลิ้งก์ google map</a>";
            $mail->send();
            $_SESSION['approvesuccess'] = 1;
            header('location: status.php');
        }
    } else {
        $_SESSION['approve_error'] = 1;
        header('location: approve.php');
    }
    ?>

</body>

</html>