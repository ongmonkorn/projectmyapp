<?php

include('../config.php');
session_start();

$targetDir = "../files/";

if (isset($_POST['submit'])) {
    if (!empty($_FILES["fileToUpload"]["name"])) {
        $training = mysqli_real_escape_string($conn, $_POST['training']);
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $fileSize = basename($_FILES["fileToUpload"]["size"]);
        // $fileTmpName = basename($_FILES["fileToUpload"]["tmp_name"]);
        // อ่านข้อมูลจากไฟล์ที่อัปโหลด
        // $fileContent = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
        $targetFilePath = $targetDir . $fileName;
        $file_path = $targetFilePath;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');


        if (in_array($fileType, $allowTypes)) {

            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFilePath)) {
                $update = $conn->query("INSERT INTO files (name, type, size, training_id, file_path) VALUES ('$fileName', '$fileType', '$fileSize', '$training', '$file_path')");
                if ($update) {
                    $statusMsg = "ไฟล์ <b>" . $fileName . "</b> ถูกอัปโหลดเรียบร้อยแล้ว.";
                    $_SESSION['filesuccess'] = true;
                    header('location: list_training.php');
                } else {
                    header("location: user_edit.php?user_id='.$id.'");
                }
            } else {
                $statusMsg = "ขออภัยเกิดข้อผิดพลาดในการอัปโหลดไฟล์ของคุณ.";
            }
        } else {
            $statusMsg = "ขออภัยเฉพาะไฟล์ JPG, JPEG, PNG และ GIF เท่านั้นที่อนุญาตให้อัปโหลด.";
        }
    } else {
        $statusMsg = "โปรดเลือกไฟล์ที่ต้องการอัปโหลด.";
    }
}


// // ตรวจสอบว่าไฟล์ถูกอัปโหลดหรือไม่
// if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
//     $fileName = $_FILES["fileToUpload"]["name"];
//     $fileType = $_FILES["fileToUpload"]["type"];
//     $fileSize = $_FILES["fileToUpload"]["size"];
//     $fileTmpName = $_FILES["fileToUpload"]["tmp_name"];
//     $targetFilePath = $targetDir . $fileName;

//     // อ่านข้อมูลจากไฟล์ที่อัปโหลด
//     $fileContent = addslashes(file_get_contents($fileTmpName));

//     // เตรียมคำสั่ง SQL เพื่อบันทึกข้อมูลลงในฐานข้อมูล
//     $sql = "INSERT INTO files (name, type, size, content) VALUES ('$fileName', '$fileType', '$fileSize', '$fileContent')";

//     // ทำการ query ข้อมูล
//     if ($conn->query($sql) === TRUE) {
//         echo "File uploaded successfully.";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// } else {
//     echo "Error uploading file.";
// }
