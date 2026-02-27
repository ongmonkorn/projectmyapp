<?php

include('../config.php');
session_start();

if (isset($_GET['user_id'])) {
    $id = $_GET["user_id"];
    $sql = "SELECT * FROM user WHERE user_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $rowuser = mysqli_fetch_array($query, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลผู้ใช้</title>
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
                    <h3 class="content-header-title">แก้ไขข้อมูลผู้ใช้</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">แก้ไขข้อมูลผู้ใช้
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
                    <div class="shadow p-3 mb-3">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="d-flex justify-content-center mt-2 p-4">
                                    <div class="rounded bg-light pt-2 px-2 pb-2 ">
                                        <img class="profile w-100" id="previewImage" src="../images/upload/<?php echo $rowuser['user_file']; ?>" alt="profile">
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <form action="upload.php" method="post" enctype="multipart/form-data">
                                        <p class="text-danger text-center">รองรับเฉพาะไฟล์ jpeg, jpg, png และ gif</p>
                                        <div class="mt-2 text-center">
                                            <label for="imgInput" class="btn btn-danger" id="uploadBtn"><i class="fa-solid fa-arrow-up-from-bracket"></i> เลือกรูปภาพ</label>
                                            <input class="form-control border-danger" name="file" type="file" id="imgInput" accept="image/gif, image/jpeg,  image/jpg, image/png" required="" hidden onchange="previewFile()">
                                            <input class="btn btn-primary" style="margin: 0px 0px 7px;" type="submit" id="editimg" name="change_img" value="บันทึกรูปภาพ">
                                        </div>
                                        <div class="d-none">
                                            <input type="text" name="path" placeholder="เส้นทาง" value="profile_edit.php" readonly="">
                                            <input type="text" name="id" placeholder="ไอดี" value="<?php echo $rowuser["user_id"]; ?>" readonly="">
                                        </div>
                                        <div class="d-flex justify-content-end mt-2 mb-4">
                                            <input class="btn btn-primary text-light" type="submit" name="change_img" value="บันทึกรูปภาพ" hidden>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12 my-4">
                                <form action="user_edit_db.php" method="post">
                                    <div class="row">
                                        <div class="d-none">
                                            <input type="text" name="path" placeholder="เส้นทาง" value="profile_edit.php" readonly="">
                                            <input type="text" name="id" placeholder="ไอดี" value="<?php echo $rowuser['user_id']; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 col-sm-12 my-1">
                                            <div class="form-floating ">
                                                <select class="select form-select border-primary" name="pname">
                                                    <?php
                                                    // ค่าที่ได้จากฐานข้อมูล
                                                    $user_pname_from_db = $rowuser['user_pname'];

                                                    // รายการที่มีในตัวเลือก
                                                    $options = array("นาย", "นางสาว", "นาง");

                                                    // สร้าง option จากรายการ
                                                    foreach ($options as $option) {
                                                        $selected = ($user_pname_from_db == $option) ? 'selected' : '';
                                                        echo "<option class='option' value='$option' $selected>$option</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">คำนำหน้า</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 my-1">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control border-primary" id="floatingInput" name="fname" placeholder="ชื่อ" value="<?php echo $rowuser["user_fname"]; ?>" required="">
                                                <label for="floatingInput">ชื่อ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-primary" id="floatingInput" name="lname" placeholder="นามสกุล" value="<?php echo $rowuser["user_lname"]; ?>" required="">
                                                <label for="floatingInput">นามสกุล</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <input type="date" class="form-control border-primary" id="datepicker" name="birthday" placeholder="วันเกิด" value="<?php echo $rowuser['user_birthday']; ?>" required="">
                                                <label for="floatingInput">วัน/เดือน/ปีเกิด</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <h6 class="pb-1">เพศ: </h6>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="sex" id="femaleGender" value="ชาย" <?php echo ($rowuser['user_sex'] == 'ชาย') ? 'checked' : ''; ?> />
                                                    <label class="form-check-label" for="femaleGender">ชาย</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="sex" id="maleGender" value="หญิง" <?php echo ($rowuser['user_sex'] == 'หญิง') ? 'checked' : ''; ?> />
                                                    <label class="form-check-label" for="maleGender">หญิง</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="sex" id="otherGender" value="ไม่ระบุ" <?php echo ($rowuser['user_sex'] == 'ไม่ระบุ') ? 'checked' : ''; ?> />
                                                    <label class="form-check-label" for="otherGender">ไม่ระบุ</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-primary" id="floatingInput" name="email" placeholder="อีเมล" value="<?php echo $rowuser["user_email"]; ?>" required="">
                                                <label for="floatingInput">อีเมล</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-primary" id="floatingInput" name="tel" placeholder="เบอร์โทร" value="<?php echo $rowuser["user_tel"]; ?>" required="">
                                                <label for="floatingInput">เบอร์โทร</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 my-1">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-primary" row="3" id="floatingInput" name="contact" placeholder="ที่อยู่" value="<?php echo $rowuser["user_contact"]; ?>" required="">
                                                <label for="floatingInput">ที่อยู่</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 my-4">
                                                <div class="d-flex justify-content-center">
                                                    <input class="btn btn-primary me-2" name="edit" type="submit" value="บันทึก">
                                                    <a class="btn btn-secondary ms-2" href="user_list.php">กลับ</a>
                                                </div>
                                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php
        if (isset($_SESSION['editusersuccess'])) { ?>

            Swal.fire({
                title: "แก้ไขข้อมูลสำเร็จ!",
                text: "",
                icon: "success",
                showConfirmButton: true,
                timer: 3000
            })

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['editusersuccess']);
        } ?>

        <?php
        if (isset($_SESSION['imgsuccess'])) { ?>

            Swal.fire({
                title: "เปลี่ยนรูปโปรไฟล์สำเร็จ!",
                text: "",
                icon: "success",
                showConfirmButton: true,
                timer: 3000
            })

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['imgsuccess']);
        } ?>

        <?php
        if (isset($_SESSION['userediterror'])) { ?>

            Swal.fire({
                title: "ผิดผลาด!",
                text: "อีเมลถูกใช้ไปแล้ว",
                icon: "error",
                showConfirmButton: false,
                timer: 3000
            })

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['userediterror']);
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
                if (!file.type.match('image.*')) { // ตรวจสอบว่าไฟล์เป็นไฟล์รูปภาพหรือไม่
                    Swal.fire({
                        title: "ผิดพลาด!",
                        text: "รองรับเฉพาะไฟล์รูปภาพ",
                        icon: "error",
                        confirmButtonText: "ตกลง"
                    }).then(() => {
                        window.location.href = "user_edit.php?user_id=<?php echo $rowuser['user_id']; ?>";
                    });
                    return;
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = "../images/upload/<?php echo $rowuser['user_file']; ?>";
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
        document.getElementById("editimg").addEventListener("click", function() {
            if (!validateImage()) {
                // ป้องกันไม่ให้บันทึกข้อมูล
                event.preventDefault();
            }
        });
    </script>
</body>

</html>