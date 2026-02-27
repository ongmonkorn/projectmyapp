<?php

include('../config.php');
session_start();
if (isset($_GET["order_id"])) {
    $id = $_GET["order_id"];

    $sql = "SELECT orders.*, training.*, user.* FROM orders
    JOIN training ON orders.training_id = training.training_id
    JOIN user ON orders.user_id = user.user_id WHERE orders.order_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $orders = mysqli_fetch_array($query, MYSQLI_ASSOC);
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
    <title>อนุมัติการลงทะเบียน</title>
    <style>
        .responsive-image {
            width: 100%;
            height: auto;
        }

        .shadow{
            background-color: white;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php include('menu.php'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row mt-2">
                <div class="content-header-left col-md-4 col-12">
                    <h3 class="content-header-title">อนุมัติการลงทะเบียน</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">อนุมัติการลงทะเบียน
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12 mt-5">
                        <div class="reg shadow p-4">
                            <div class="mt-2">
                                <h4 class="text-primary">ข้อมูลการลงทะเบียนสมัครอบรม</h4>
                            </div>
                            <form class="row g-3" action="approve_db.php" method="post" enctype="multipart/form-data">
                                <div class="d-none">
                                    <input type="text" name="path" placeholder="เส้นทาง" value="profile_edit.php" readonly="">
                                    <input type="text" name="id" placeholder="ไอดี" value="<?php echo $orders["order_id"]; ?>" readonly="">
                                </div>
                                <div class="col-md-4 col-sm-12 col-mb-2">
                                    <label for="trainingid" class="form-label">รหัสโครงการ :</label>
                                    <input class="form-control" type="text" name="training_id" readonly value="<?php echo $orders["training_id"]; ?>">
                                </div>
                                <div class="col-md-8 col-sm-12 col-mb-2">
                                    <label for="trainingname" class="form-label">โครงการอบรม :</label>
                                    <input class="form-control" type="text" name="training_name" readonly value="<?php echo $orders["training_name"]; ?>">
                                </div>
                                <div class="col-md-4 col-sm-12 col-mb-2">
                                    <label for="user_id" class="form-label">รหัสประจำตัวผู้ลงทะเบียน :</label>
                                    <input class="form-control" type="text" name="user_id" readonly value="<?php echo $orders["user_id"]; ?>">

                                </div>
                                <div class="col-md-8 col-sm-12 col-mb-2">
                                    <label for="fullname" class="form-label">ชื่อ-สกุลผู้ลงทะเบียน :</label>
                                    <input class="form-control" type="text" name="fullname" readonly value="<?php echo  $orders['user_pname'] . $orders['user_fname'] .  " " . $orders['user_lname']; ?>">
                                </div>

                                <div class="col-md-4 col-sm-12 col-mb-2">
                                    <label for="date" class="form-label">วันที่อบรม :</label>
                                    <input class="form-control" type="text" name="date" readonly value="<?php echo $orders["training_date"]; ?>">

                                </div>
                                <div class="col-md-8 col-sm-12 col-mb-2 d-none">
                                    <label for="lecturer" class="form-label">อีเมล :</label>
                                    <input class="form-control" type="text" name="email" value="<?php echo $orders["user_email"] ;?>" readonly>
                                </div>
                                <div class="col-md-8 col-sm-12 col-mb-2">
                                    <label for="lecturer" class="form-label">วิทยากร :</label>
                                    <input class="form-control" type="text" name="lecturer" value="<?php echo $orders["training_lecturer"] ;?>" readonly>
                                </div>

                                <div class="col-md-8 col-sm-12 col-mb-2">
                                    <label class="form-label">สถานที่ดำเนินการ : </label>
                                    <input class="form-control" type="text" name="date" readonly value="<?php echo $orders["training_place"]; ?>">
                                </div>
                                <div class="col-md-4 col-sm-12 col-mb-2">
                                    <label for="budget" class="form-label">ค่าละทะเบียน :</label>
                                    <input class="form-control" type="text" name="budget" readonly value="<?php echo $orders["training_price"]; ?> บาท">

                                </div>
                                <div class="col-md-2 col-sm-12 col-mb-2">
                                    <label for="money" class="form-label">หลักฐานการชำระ :</label><br>
                                    <img src="../user/slip/<?php echo $orders['order_slip'] ?>" class="responsive-image" alt="...">
                                </div>

                                <div class="py-4 col-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="status1" value="1" checked>
                                        <label class="form-check-label" for="inlineRadio1">อนุมัติ</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="status2" value="0">
                                        <label class="form-check-label" for="inlineRadio2">ไม่อนุมัติ</label>
                                    </div>
                                    <div class="pt-2 text-center">
                                        <input class="btn btn-primary btn-md" type="submit" name="approve" value="บันทึก" />
                                        <a class="btn btn-danger ms-2" href="status.php">ยกเลิก</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>