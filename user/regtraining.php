<?php

include('../config.php');
session_start();

if (isset($_GET["training_id"])) {
    $id = $_GET["training_id"];

    // คิวรีเพื่อดึงข้อมูลการฝึกอบรม
    $sql = "SELECT * FROM training WHERE training_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $training = mysqli_fetch_array($query, MYSQLI_ASSOC);

    // คิวรีเพื่อดึงข้อมูลผู้เข้าร่วมการฝึกอบรม
    $sqllist = "SELECT * FROM orders 
        INNER JOIN training ON orders.training_id = training.training_id 
        INNER JOIN user ON orders.user_id = user.user_id
        WHERE orders.training_id = '$id' AND orders.order_status = 1";
    $result = mysqli_query($conn, $sqllist);

    $sqllimit = "SELECT COUNT(*) AS total_rows FROM orders WHERE training_id = '$id'";
    $resultlimit = mysqli_query($conn, $sqllimit);

    if ($resultlimit->num_rows > 0) {
        $row = $resultlimit->fetch_assoc();
        $totalRows = $row['total_rows'];
        // คำนวณและแสดงจำนวนแถวที่เหลือ
        $remainingRows = max(0, $training["training_limit"] - $totalRows);
    }
    include('../month.php');
    $date = date("d/m/Y", strtotime($training['training_date']));
    $formattedTrainingDate = toDateThai($date);
    $date2 = date("d/m/Y", strtotime($training['training_enddate']));
    $formattedTrainingDate2 = toDateThai($date2);
}

if ($remainingRows == 0) {
    $_SESSION['limit'] = "เต็ม";
    header('location: training.php?training_id=' .  $id);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียนสมัครอบรม</title>
    <style>
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
                    <h3 class="content-header-title">ลงทะเบียนสมัครอบรม</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">ลงทะเบียนสมัครอบรม
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12 mt-4">

                        <div class="reg shadow p-4 my-4">
                            <form class="row g-3" action="regtraining_db.php" method="post" enctype="multipart/form-data">
                                <div class="col-md-4 col-sm-12 col-mb-2 my-1">
                                    <label for="trainingid" class="form-label">รหัสโครงการ :</label>
                                    <input class="form-control" type="text" name="training_id" readonly value="<?php echo $training["training_id"]; ?>">
                                </div>
                                <div class="col-md-8 col-sm-12 col-mb-2 my-1">
                                    <label for="trainingname" class="form-label">โครงการอบรม :</label>
                                    <input class="form-control" type="text" name="training_name" readonly value="<?php echo $training["training_name"]; ?>">
                                </div>
                                <div class="col-md-4 col-sm-12 col-mb-2 my-1">
                                    <label for="user_id" class="form-label">รหัสประจำตัวผู้ลงทะเบียน :</label>
                                    <input class="form-control" type="text" name="user_id" readonly value="<?php echo $row['user_id']; ?>">

                                </div>
                                <div class="col-md-8 col-sm-12 col-mb-2 my-1">
                                    <label for="fullname" class="form-label">ชื่อ-สกุลผู้ลงทะเบียน :</label>
                                    <input class="form-control" type="text" name="fullname" readonly value="<?php echo $row['user_pname'] . $row['user_fname'] . " " . $row['user_lname']; ?>">
                                </div>

                                <div class="col-md-4 col-sm-12 col-mb-2 my-1">
                                    <label for="date" class="form-label">วันที่อบรม :</label>
                                    <input class="form-control" type="text" name="date" readonly value="<?php echo $formattedTrainingDate . " - " . $formattedTrainingDate2; ?>">

                                </div>
                                <div class="col-md-8 col-sm-12 col-mb-2 my-1">
                                    <label for="lecturer" class="form-label">วิทยากร :</label>
                                    <input class="form-control" type="text" name="lecturer" value="สาขาวิทยาการคอมพิวเตอร์" readonly>
                                </div>
                                <div class="col-md-4 col-sm-12 col-mb-2 my-1">
                                    <label for="budget" class="form-label">ค่าละทะเบียน :</label>
                                    <input class="form-control" type="text" name="budget" readonly value="<?php echo $training["training_price"]; ?>">
                                </div>
                                <div class="col-md-8 col-sm-12 col-mb-2 my-1">
                                    <label class="form-label">สถานที่ดำเนินการ : </label>
                                    <input class="form-control" type="text" name="date" readonly value="<?php echo $training["training_place"]; ?>">
                                </div>

                                <div class="col-md-4 col-sm-12 col-mb-2 my-1">
                                    <label for="money" class="form-label">ชำระค่าสมัคร :</label><br>
                                    <img src="slip/<?php echo $training["training_budget"]; ?>" width="200" height="200" id="previewImage" class="img-thumbnail" alt="...">
                                </div>
                                <div class="col-md-8 col-sm-12 col-mb-2 my-1">
                                    <label for="slip" class="form-label">อัพโหลดหลักฐานการชำระ : </label>
                                    <div>
                                        <label for="imgInput" class="uploadBtn btn btn-danger" id="uploadBtn"><i class="fa-solid fa-arrow-up-from-bracket"></i> อัพโหลดรูปภาพ</label>
                                        <input class="form-control border-danger" name="file" type="file" id="imgInput" accept="image/gif, image/jpeg,  image/jpg, image/png" required="" hidden onchange="previewFile()">
                                    </div>
                                </div>
                                <div class="col-12 my-2 text-center">
                                    <button type="submit" id="reg_training" name="reg_training" class="btn btn-primary">บันทึก</button>
                                    <a class="btn btn-secondary" href="training.php?training_id=<?php echo $training['training_id'] ?>">กลับ</a>
                                </div>
                            </form>
                        </div>
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
                    })
                    return;
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
        document.getElementById("reg_training").addEventListener("click", function() {
            if (!validateImage()) {
                // ป้องกันไม่ให้บันทึกข้อมูล
                event.preventDefault();
            }
        });

        <?php
        if (isset($_SESSION['regsuccess'])) { ?>

            Swal.fire({
                title: "สำเร็จ!",
                text: "สมัครฝึกอบรมสำเร็จ",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "training.php?training_id=<?php echo $training['training_id'] ?>";
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['regsuccess']);
        } ?>

        <?php
        if (isset($_SESSION['error'])) { ?>

            Swal.fire({
                title: "ไม่สามารถลงทะเบียนได้",
                text: "คุณได้เคยลงทะเบียนแล้ว",
                icon: "error",
            }).then(() => {
                window.location.href = "training.php?training_id=<?php echo $training['training_id']; ?>";
            });
        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['error']);
        } ?>
    </script>
</body>

</html>