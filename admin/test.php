<?php

include('../config.php');
session_start();

if (isset($_GET["training_id"])) {
    $id = $_GET["training_id"];
    $sql = "SELECT * FROM training WHERE training_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $training = mysqli_fetch_array($query, MYSQLI_ASSOC);
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ชื่อ Tab</title>
</head>

<body>
    <?php include('menu.php'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row mt-2">
                <div class="content-header-left col-md-4 col-12">
                    <h3 class="content-header-title">แก้ไขข้อมูลการสมัครอบรม</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">แก้ไขข้อมูลการสมัครอบรม
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12 mt-5">
                        <button type="button" class="ms-4 btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                            แก้ไขวิธีชำระ
                        </button>

                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">อัปโหลดวิธีชำระ :</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="training_edit_slip_db.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input class="" type="text" name="training_id" id="training_id" value="577">
                                            <input class="form-control border-primary" type="file" name="file" id="file" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">กลับ</button>
                                            <button type="submit" class="btn btn-primary">บันทึก</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>