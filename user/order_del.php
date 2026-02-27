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
    // เชื่อมต่อกับฐานข้อมูล
    require_once '../config.php';

    // รับค่า ID ที่ต้องการลบ
    $idToDelete = $_POST['id'];

    // สร้างคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM orders WHERE order_id = $idToDelete";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    ?>
</body>

</html>