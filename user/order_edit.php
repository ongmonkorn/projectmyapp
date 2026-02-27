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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลการสมัคร</title>

    <style>
        .responsive-image {
            width: 100%;
            height: auto;
        }

        .shadow {
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
        </div>
        <div class="content-body">
            <div class="row match-height">
                <div class="col-xl-12 col-lg-12 p-4">
                    <div class="reg shadow p-4 my-4">
                        <form class="row g-3" id="editForm" action="order_edit_db.php" method="post" enctype="multipart/form-data">
                            <div class="d-none">
                                <input type="text" name="path" placeholder="เส้นทาง" value="profile_edit.php" readonly="">
                                <input type="text" name="id" placeholder="ไอดี" value="<?php echo $orders["order_id"]; ?>" readonly="">
                            </div>
                            <div class="col-md-4 col-sm-12 col-mb-2 my-1">
                                <label for="trainingid" class="form-label">รหัสโครงการ :</label>
                                <input class="form-control" type="text" name="training_id" readonly value="<?php echo $orders["training_id"]; ?>">
                            </div>
                            <div class="col-md-8 col-sm-12 col-mb-2 my-1">
                                <label for="trainingname" class="form-label">โครงการอบรม :</label>
                                <input class="form-control" type="text" name="training_name" readonly value="<?php echo $orders["training_name"]; ?>">
                            </div>
                            <div class="col-md-4 col-sm-12 col-mb-2 my-1">
                                <label for="user_id" class="form-label">รหัสประจำตัวผู้ลงทะเบียน :</label>
                                <input class="form-control" type="text" name="user_id" readonly value="<?php echo $orders["user_id"]; ?>">

                            </div>
                            <div class="col-md-8 col-sm-12 col-mb-2 my-1">
                                <label for="fullname" class="form-label">ชื่อ-สกุลผู้ลงทะเบียน :</label>
                                <input class="form-control" type="text" name="fullname" readonly value="<?php echo  $orders['user_pname'] . $orders['user_fname'] .  " " . $orders['user_lname']; ?>">
                            </div>

                            <div class="col-md-4 col-sm-12 col-mb-2 my-1">
                                <label for="date" class="form-label">วันที่อบรม :</label>
                                <input class="form-control" type="text" name="date" readonly value="<?php echo $orders["training_date"]; ?>">

                            </div>
                            <div class="col-md-8 col-sm-12 col-mb-2 my-1">
                                <label for="lecturer" class="form-label">วิทยากร :</label>
                                <input class="form-control" type="text" name="lecturer" readonly>
                            </div>
                            <div class="col-md-4 col-sm-12 col-mb-2 my-1">
                                <label for="budget" class="form-label">ค่าละทะเบียน :</label>
                                <input class="form-control" type="text" name="budget" readonly value="<?php echo $orders["training_price"]; ?> บาท">

                            </div>
                            <div class="col-md-8 col-sm-12 col-mb-2 my-1">
                                <label class="form-label">สถานที่ดำเนินการ : </label>
                                <input class="form-control" type="text" name="date" readonly value="<?php echo $orders["training_place"]; ?>">
                            </div>
                            <div class="col-md-2 col-sm-12 col-mb-2 my-1">
                                <label for="money" class="form-label">ชำระค่าสมัคร :</label><br>
                                <img src="../images/qrcode.png" width="200" height="200" class="img-thumbnail" alt="...">

                            </div>
                            <div class="col-md-2 col-sm-12 col-mb-2 my-1">
                                <label for="money" class="form-label">หลักฐานการชำระ :</label><br>
                                <img src="slip/<?php echo $orders['order_slip'] ?>" id="previewImage" class="responsive-image" alt="...">
                            </div>
                            <div class="d-none">
                                <input type="text" name="id" id="id" value="<?php echo $orders['order_id'] ?>">
                            </div>
                            <div class="col-md-8 col-sm-12 col-mb-2 my-1">
                                <label for="slip" class="form-label">อัพโหลดหลักฐานการชำระ : </label>
                                <div>
                                    <label for="imgInput" class="uploadBtn btn btn-danger" id="uploadBtn"><i class="fa-solid fa-arrow-up-from-bracket"></i> อัพโหลดรูปภาพ</label>
                                    <input class="form-control border-danger" name="file" type="file" id="imgInput" accept="image/gif, image/jpeg,  image/jpg, image/png" required="" hidden onchange="previewFile()">
                                </div>
                            </div>
                            <div class="py-4 col-12">
                                <div class="pt-2 text-center">
                                    <input class="btn btn-primary me-2" id="edit" name="edit" type="submit" onclick="confirmEdit()" value="บันทึก">
                                    <a class="btn btn-secondary ms-2" href="status.php?user_id=<?php echo $orders['user_id'] ?>">กลับ</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function previewFile() {
            var preview = document.getElementById('previewImage');
            var fileInput = document.getElementById('imgInput');
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                if (!file.type.match('image.*')) { // ตรวจสอบว่าไฟล์เป็นไฟล์รูปภาพหรือไม่
                    Swal.fire({
                        title: "ผิดพลาด!",
                        text: "รองรับเฉพาะไฟล์รูปภาพ",
                        icon: "error",
                        confirmButtonText: "ตกลง"
                    }).then(() => {
                        window.location.href = "order_edit.php?order_id=<?php echo $orders["order_id"]; ?>";
                    });
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = "slip/<?php echo $row['user_file']; ?>";
            }
        }

        function validateImage() {
            const imageInput = document.getElementById("imgInput");

            if (!imageInput.files.length) {
                Swal.fire({
                    title: "ผิดพลาด!",
                    text: "กรุณาเลือกไฟล์รูปภาพ",
                    icon: "error",
                    confirmButtonText: "ตกลง",
                });

                return false;
            }

            return true;
        }
        // เพิ่ม event listener ให้กับปุ่มบันทึก
        document.getElementById("edit").addEventListener("click", function() {
            if (!validateImage()) {
                // ป้องกันไม่ให้บันทึกข้อมูล
                event.preventDefault();
            }
        });

        <?php
        if (isset($_SESSION['editregtraining'])) { ?>
            Swal.fire({
                title: "สำเร็จ!",
                text: "แก้ไขข้อมูลการสมัครสำเร็จ",
                icon: "success",
                confirmButtonText: "ตกลง"
            })
        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['editregtraining']);
        } ?>
    </script>
</body>

</html>