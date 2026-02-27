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
    <title>แก้ไขโครงการอบรม</title>

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
                    <h3 class="content-header-title">แก้ไขโครงการอบรม</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">แก้ไขโครงการอบรม
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12 mt-5">
                        <div class="shadow p-3 mb-3">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="d-flex justify-content-center p-4">
                                        <div class="rounded bg-light pt-2 px-2 pb-2 ">
                                            <img class="profile w-100" id="previewImage" src="../images/<?php echo $training['training_image']; ?>" alt="profile">
                                        </div>
                                    </div>
                                    <form action="training_edit_img_db.php" method="post" enctype="multipart/form-data">
                                        <div class="d-grid">
                                            <p class="text-danger text-center">รองรับเฉพาะไฟล์ jpeg, jpg, png และ gif</p>
                                            <div class="mt-2 text-center">
                                                <label for="imgInput" class="uploadBtn btn btn-danger mb-4" id="uploadBtn"><i class="fa-solid fa-arrow-up-from-bracket"></i> เลือกรูปภาพ</label>
                                                <label for="formFile" class="form-label d-none">รองรับเฉพาะไฟล์ jpeg, jpg, png และ gif</label>
                                                <input class="form-control border-danger d-none" name="file" type="file" id="imgInput" accept="image/gif, image/jpeg,  image/jpg, image/png" onchange="previewFile()">
                                                <input class="btn btn-primary mb-4" type="submit" name="change_img" value="บันทึกรูปภาพ">
                                            </div>
                                            <div class="d-none">
                                                <input type="text" name="path" placeholder="เส้นทาง" readonly="">
                                                <input type="text" name="training_id" placeholder="ไอดี" readonly="" value="<?php echo $training["training_id"]; ?>">
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-8 col-sm-12">
                                    <div class="row">
                                        <div class="col-12 my-3 d-none">
                                            <h3 class="text-center">แก้ไขโครงการอบรม</h3>
                                        </div>
                                        <div class="d-none">
                                            <input type="text" name="path" placeholder="เส้นทาง" value="profile_edit.php" readonly="">
                                            <input type="text" name="id" placeholder="ไอดี" readonly="">
                                        </div>
                                    </div>
                                    <form action="training_edit_db.php" method="post">
                                        <div class="d-none">
                                            <input type="text" name="training_id" placeholder="ไอดี" readonly="" value="<?php echo $training["training_id"]; ?>">
                                        </div>
                                        <div class="row my-4">
                                            <div class="col-md-12 col-sm-12 my-1">
                                                <div class="form-floating ">
                                                    <input type="text" class="form-control border-primary" id="floatingInput" name="training_name" placeholder="ชื่อดครงการ" required="" value="<?php echo $training['training_name']; ?>">
                                                    <label for="floatingInput">ชื่อโครงการอบรม</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 my-1">
                                                <div class="form-floating">
                                                    <textarea class="form-control border-primary" id="floatingInput" name="training_details" placeholder="รายละเอียด" required="" rows="3"><?php echo $training['training_details']; ?></textarea>
                                                    <label for="floatingInput">รายละเอียด</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 my-1">
                                                <div class="form-floating">
                                                    <input oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control border-primary" id="floatingInput" name="training_limit" placeholder="จำนวนที่รับ" required="" value="<?php echo $training['training_limit']; ?>">
                                                    <label for="floatingInput">จำนวนที่รับ (คน)</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 my-1">
                                                <div class="form-floating">
                                                    <input oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control border-primary" id="floatingInput" name="training_price" placeholder="ค่าสมัคร" required="" value="<?php echo $training['training_price']; ?>">
                                                    <label for="floatingInput">ค่าสมัคร (บาท)</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 my-1">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control border-primary" id="floatingInput" name="training_date" placeholder="วันที่จัดอบรม" required="" value="<?php echo $training['training_date']; ?>">
                                                    <label for="floatingInput">วันที่จัดอบรม</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 my-1">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control border-primary" id="floatingInput" name="training_enddate" placeholder="วันสุดท้ายที่จัดอบรม" required="" value="<?php echo $training['training_enddate']; ?>">
                                                    <label for="floatingInput">วันสุดท้ายที่จัดอบรม</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 my-1">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control border-primary" id="floatingInput" name="training_lecturer" placeholder="วิทยากร" required="" value="<?php echo $training['training_lecturer']; ?>">
                                                    <label for="floatingInput">วิทยากร</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 my-1">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control border-primary" id="floatingInput" name="training_place" placeholder="เบอร์โทร" required="" value="<?php echo $training['training_place']; ?>">
                                                    <label for="floatingInput">สถานที่จัดอบรม</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="d-flex justify-content-center">
                                                    <input class="btn btn-primary me-2" name="edit_training" type="submit" value="บันทึก">
                                                    <a class="btn btn-secondary ms-2" href="list_training.php">กลับ</a>
                                                    <button type="button" class="ms-4 btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                                        แก้ไขวิธีชำระ
                                                    </button>


                                                    <!-- <button type="button" class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        อัพโหลดไฟล์ที่ใช้อบรม
                                                    </button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">อัปโหลดวิธีชำระ :</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="training_edit_slip_db.php" method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <input class="d-none" type="text" name="training_id" id="training_id" value="<?php echo $training["training_id"]; ?>">
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
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php
        if (isset($_SESSION['editsuccess'])) { ?>

            Swal.fire({
                title: "สำเร็จ!",
                text: "แก้ไขโครงการฝึกอบรมสำเร็จ",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "training_edit.php?training_id=<?php echo $training['training_id'] ?>";
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['editsuccess']);
        } ?>

        <?php
        if (isset($_SESSION['edit_image'])) { ?>

            Swal.fire({
                title: "สำเร็จ!",
                text: "แก้ไขรูปภาพสำเร็จ",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "training_edit.php?training_id=<?php echo $training['training_id'] ?>";
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['edit_image']);
        } ?>

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
                preview.src = "../images/<?php echo $training['training_image']; ?>";
            }
        }

        <?php
        if (isset($_SESSION['edit_slip'])) { ?>

            Swal.fire({
                title: "สำเร็จ!",
                text: "แก้ไขวิธีชำระสำเร็จ",
                icon: "success",
                showConfirmButton: true,
                timer: 1500
            
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['edit_slip']);
        } ?>
    </script>
</body>

</html>