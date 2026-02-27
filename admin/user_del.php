
    <?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once '../config.php';

    // รับค่า ID ที่ต้องการลบ
    $idToDelete = $_POST['id'];

    // สร้างคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM user WHERE user_id = $idToDelete";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    ?>