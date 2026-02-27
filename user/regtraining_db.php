<?php
include('../config.php');
session_start();
$errors = array();
$statusMsg = "";
$targetDir = "slip/";

if (isset($_POST['reg_training'])) {
    if (!empty($_FILES["file"]["name"])) {
        $trainingID = mysqli_real_escape_string($conn, $_POST['training_id']);
        $trainingName = mysqli_real_escape_string($conn, $_POST['training_name']);
        $userID = mysqli_real_escape_string($conn, $_POST['user_id']);
        $budget = mysqli_real_escape_string($conn, $_POST['budget']);
        $fileName = basename($_FILES["file"]["name"]);

        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');


        $user_check_query = "SELECT * FROM orders WHERE training_id = '$trainingID' AND user_id = '$userID' ";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) {
            if ($result['user_id'] == $userID) {
                array_push($errors, "Email already exists");
            }
        }

        if (count($errors) == 0) {

            if (in_array($fileType, $allowTypes)) {

                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                    $insert = $conn->query("INSERT INTO orders (training_id, user_id, order_date, order_total, order_slip) 
                    VALUES ('$trainingID', '$userID', NOW(), '$budget', '" . $fileName . "') ");

                    if ($insert) {
                        // เพิ่มประวัติ
                        $sql = $conn->query("INSERT INTO history (user_id, his_name, his_time)
                        VALUES (" . $_SESSION['user_id'] . ", 'ลงทะเบียนสมัครอบรม ". $trainingName ." เมื่อผู้ดูแลระบบอนุมัติจะแจ้งเตือนไปยังอีเมล', NOW() )");
                        $statusMsg = "The file <b>" . $fileName . "</b> has been uploaded successfully.";
                        $_SESSION['regsuccess'] = "You are now logged in";
                        header('location: training.php?training_id=' . $trainingID);
                    } else {
                        $statusMsg = "file upload failed, please try again.";
                        array_push($errors, "Username or Email already exists");
                        $_SESSION['error'] = "Username or Email already exists";
                        header("location: regtraining.php");
                    }
                } else {
                    $statusMsg = "Sorry, there was an eror uploading tour file.";
                }
            } else {
                $statusMsg = "Sorry, only JPG,JPEG, PNG & GIF files are aloowed to upload.";
            }
        } else {
            $_SESSION['error'] = "มีอยู่แล้ว";
            header('location: regtraining.php?training_id=' . $trainingID);
            $statusMsg = "please select a file to upload.";
        }
    }
}
