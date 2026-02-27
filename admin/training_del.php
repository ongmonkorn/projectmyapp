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
    session_start();

    // รับค่า ID ที่ต้องการลบ
    $idToDelete = $_POST['id'];

    // สร้างคำสั่ง SQL สำหรับตรวจสอบว่ามีรายการอบรมที่มี ID ที่ต้องการลบหรือไม่
    $order = "SELECT * FROM orders WHERE training_id = $idToDelete";
    $result = mysqli_query($conn, $order);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['errordel'] = "Error: Cannot delete training that has orders";
    } else {
        // สร้างคำสั่ง SQL สำหรับลบข้อมูลอบรม
        $sql = "DELETE FROM training WHERE training_id = $idToDelete";
        $_SESSION['succcessdel'] = 1;
        if (mysqli_query($conn, $sql)) {
            // $_SESSION['succcessdel'] = 1;
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }

    ?>

</body>

</html>