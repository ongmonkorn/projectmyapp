
<?php

include('../config.php');
session_start();

if (isset($_POST['training_result'])) {
    // รับ array ของ order_id และ result จากฟอร์ม
    $ids = $_POST['order_id'];
    $trainingResults = $_POST['result'];

    // วนลูปเพื่ออัปเดตผลการอบรมสำหรับแต่ละ order_id
    foreach ($ids as $key => $id) {
        // ตรวจสอบว่ามีผลการอบรมถูกเลือกไว้หรือไม่
        if (isset($trainingResults[$key])) {
            $trainingResult = mysqli_real_escape_string($conn, $trainingResults[$key]);

            // อัปเดตข้อมูลในฐานข้อมูล
            $update = $conn->query("UPDATE orders SET 
                order_result = '$trainingResult'
                WHERE order_id = '$id'");

            if (!$update) {
                $_SESSION['error'] = "Error updating training";
                header("location: training_edit.php");
                exit; // ออกจากสคริปต์หลังจาก redirect
            }
        }
    }

    // หลังจากอัปเดตทุกอย่างเรียบร้อยแล้ว ทำการ redirect ไปยังหน้า training_result.php
    $_SESSION['resultsuccess'] = 1;
    header('location: training_result.php');
    exit; // ออกจากสคริปต์หลังจาก redirect
} else {
    // $_SESSION['error'] = "Error uploading file";
    header("location: training_edit.php");
    exit; // ออกจากสคริปต์หลังจาก redirect
}





