<?php
include('../config.php');
session_start();

// รับพารามิเตอร์ id จาก URL
$id = $_GET['id'];

// คิวรี่ฐานข้อมูลเพื่อดึงข้อมูลไฟล์
$sql = "SELECT * FROM files WHERE id = $id";
$result = $conn->query($sql);

// ตรวจสอบว่าพบข้อมูลหรือไม่
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // ตั้งค่า header สำหรับการดาวน์โหลดไฟล์
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=".$row['name']);
    readfile($row['file_path']); // อ่านไฟล์และส่งกลับไปยังผู้ใช้
} else {
    echo "File not found";
}