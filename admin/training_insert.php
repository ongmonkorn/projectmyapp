<?php

include('../config.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มโครงการอบรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

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
                    <h3 class="content-header-title">เพิ่มโครงการอบรม</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">เพิ่มโครงการอบรม
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12 mt-5">
                        <div class="shadow mb-3 p-3">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="d-flex justify-content-center mt-2 p-4">
                                        <div class="rounded bg-light pt-2 px-2 pb-2">
                                            <img class="profile w-100" id="previewImage" src="../images/training.jpg" alt="...">
                                        </div>
                                    </div>
                                    <form action="training_insert_db.php" method="post" enctype="multipart/form-data">
                                        <div class="d-grid">
                                            <!-- <p class="text-danger text-center">รองรับเฉพาะไฟล์ jpeg, jpg, png และ gif</p>
                                            <div class="text-center">
                                                <label for="imgInput" class="uploadBtn btn btn-danger" id="uploadBtn"><i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i> เลือกรูปภาพ</label>
                                                <input class="form-control border-danger d-none" name="file" type="file" id="imgInput" accept="image/gif, image/jpeg,  image/jpg, image/png" onchange="previewFile()">
                                            </div> -->
                                            <div class="d-none">
                                                <input type="text" name="path" placeholder="เส้นทาง" readonly="">
                                                <input type="text" name="id" placeholder="ไอดี" readonly="">
                                            </div>
                                        </div>

                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <div class="row my-2">
                                        <div class="col-12 my-3 d-none">
                                            <h3 class="text-center">เพิ่มโครงการอบรม</h3>
                                        </div>
                                        <div class="d-none">
                                            <input type="text" name="path" placeholder="เส้นทาง" value="profile_edit.php" readonly="">
                                            <input type="text" name="id" placeholder="ไอดี" readonly="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 my-1">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control border-primary" id="floatingInput" name="training_name" placeholder="ชื่อดครงการ" required="">
                                                <label for="floatingInput">ชื่อโครงการอบรม</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <textarea class="form-control border-primary" rows="5" id="floatingInput" name="training_details" placeholder="รายละเอียด" required="" style="height: 14px;"></textarea>
                                                <label for="floatingInput">รายละเอียด</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <input oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control border-primary" id="floatingInput" name="training_limit" placeholder="จำนวนที่รับ" required="">
                                                <label for="floatingInput">จำนวนที่รับ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <input oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control border-primary" id="floatingInput" name="training_price" placeholder="ค่าสมัคร" required="">
                                                <label for="floatingInput">ค่าสมัคร</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-mb-2 my-1">
                                            <label for="money" class="form-label">อัปโหลดวิธีการชำระค่าบริการ :</label><br>
                                            <input class="form-control border-primary" type="file" name="file" id="formFile" required>
                                        </div>
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <input type="date" class="form-control border-primary" id="floatingInput" name="training_date" placeholder="วันที่จัดอบรม" required="">
                                                <label for="floatingInput">วันที่จัดอบรม</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <input type="date" class="form-control border-primary" id="floatingInput" name="training_enddate" placeholder="วันสุดท้ายที่จัดอบรม" required="">
                                                <label for="floatingInput">วันสุดท้ายที่จัดอบรม</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-primary" id="floatingInput" name="training_lecturer" placeholder="วิทยากร" required="">
                                                <label for="floatingInput">วิทยากร</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-primary" id="floatingInput" name="training_place" placeholder="สถานที่จัดอบรม" required="">
                                                <label for="floatingInput">สถานที่จัดอบรม</label>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-12 col-sm-12 my-1">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text border-primary" for="fileToUpload">อัปโหลดไฟล์ที่ใช้อบรม</label>
                                                <input type="file" class="form-control border-primary" name="fileToUpload" id="fileToUpload">
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 my-1">
                                                <div class="d-flex justify-content-center ">
                                                    <input class="btn btn-primary me-2 " name="insert_training" type="submit" value="บันทึก">
                                                    <a class="btn btn-secondary ms-2" href="list_training.php">กลับ</a>
                                                    <!-- <button type="button" class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        อัพโหลดไฟล์ที่ใช้อบรม
                                                    </button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">อัพโหลดไฟล์ที่ใช้อบรม</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="uploadfile_db.php" method="post" enctype="multipart/form-data">
                                                    <div class="input-group mb-3">
                                                        <!-- <label class="input-group-text border-primary" for="fileToUpload">อัปโหลดไฟล์ที่ใช้อบรม</label> -->
                                                        <input type="file" class="form-control border-primary" name="fileToUpload" id="fileToUpload">
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">กลับ</button>
                                                <input type="submit" class="btn btn-primary" value="บันทึก" name="submit">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content p-2">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนรหัสผ่าน</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="reset_pass_db.php" method="POST">
                                    <div class="mb-1">
                                        <label class="label" for="password1">รหัสผ่านเดิม :</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password1" id="password1" placeholder="รหัสผ่านเดิม" required="">
                                            <span class="input-group-text" onclick="togglePassword('password1')">
                                                <i class="la la-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <label class="label" for="password1">รหัสผ่านใหม่ :</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password2" id="password2" placeholder="รหัสผ่านใหม่" required="">
                                            <span class="input-group-text" onclick="togglePassword('password2')">
                                                <i class="la la-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <label class="label" for="password1">ยืนยันรหัสผ่านใหม่ :</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password3" id="password3" placeholder="ยืนยันรหัสผ่านใหม่" required="">
                                            <span class="input-group-text" onclick="togglePassword('password3')">
                                                <i class="la la-eye"></i>
                                            </span>
                                        </div>
                                    </div>
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
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php
        if (isset($_SESSION['success'])) { ?>

            Swal.fire({
                title: "สำเร็จ!",
                text: "เพิ่มโครงการอบรมสำเร็จ",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "list_training.php";
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['success']);
        } ?>

        // function previewFile() {
        //     var preview = document.getElementById('previewImage');
        //     var file = document.getElementById('imgInput').files[0];
        //     var reader = new FileReader();

        //     reader.onloadend = function() {
        //         preview.src = reader.result;
        //     }

        //     if (file) {
        //         reader.readAsDataURL(file);
        //     } else {
        //         preview.src = "../images/training.jpg";
        //     }
        // }


        function previewFile() {
            var preview = document.getElementById('previewImage');
            var fileInput = document.getElementById('imgInput');
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "../images/training.jpg"; // ใส่ URL รูปภาพเริ่มต้นที่นี่
            }
        }

        // function previewFile2() {
        //     var preview2 = document.getElementById('previewImage2');
        //     var fileInput2 = document.getElementById('imgInput2');
        //     var file2 = fileInput2.files[0];
        //     var reader2 = new FileReader2();

        //     reader2.onloadend = function() {
        //         preview2.src = reader2.result;
        //     }

        //     if (file2) {
        //         if (!file2.type.match('image.*')) { // ตรวจสอบว่าไฟล์เป็นไฟล์รูปภาพหรือไม่
        //             Swal.fire({
        //                 title: "ผิดพลาด!",
        //                 text: "รองรับเฉพาะไฟล์รูปภาพ",
        //                 icon: "error",
        //                 confirmButtonText: "ตกลง"
        //             })
        //             return;
        //         }
        //         reader2.readAsDataURL(file2);
        //     } else {
        //         preview2.src = "slip/<?php echo $row['user_file']; ?>";
        //     }
        // }

        // function validateImage() {
        //     const imageInput = document.getElementById("imgInput2");

        //     if (!imageInput.files.length) {
        //         Swal.fire({
        //             title: "ผิดพลาด!",
        //             text: "กรุณาเลือกไฟล์รูปภาพ",
        //             icon: "error",
        //             confirmButtonText: "ตกลง",
        //         });

        //         return false;
        //     }

        //     return true;
        // }
    </script>
</body>

</html>