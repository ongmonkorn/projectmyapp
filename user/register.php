<?php

include('../config.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link rel="apple-touch-icon" href="theme-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="theme-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/08e59a5d41.js" crossorigin="anonymous"></script>
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/vendors/css/charts/chartist.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="theme-assets/css/app-lite.css">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/pages/dashboard-ecommerce.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <!-- END Custom CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Trirong&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-image: url("../images/bg-blue.svg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }

        option,
        select {
            font-family: 'Kanit', sans-serif;
        }

        a,
        p,
        h6,
        h5,
        h4,
        h3,
        h2,
        h1,
        label,
        input,
        .btn,
        table,
        span,
        option,
        select,
        textarea,
        button,
        div {
            font-family: 'Kanit', sans-serif;

        }
    </style>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 ">สมัครสมาชิก</h3>
                            <form action="register_db.php" method="post">
                                <div class="row">
                                    <div class="col-md-2 mb-2 form-floating">
                                        <select class="select form-select" name="pname" id="pname" required>
                                            <option selected></option>
                                            <option class="option" value="นาย">นาย</option>
                                            <option class="option" value="นางสาว">นางสาว</option>
                                            <option class="option" value="นาง">นาง</option>
                                        </select>
                                        <label class="floatingInput" for="pName">คำนำหน้า</label>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-floating ">
                                            <input type="text" name="fname" id="fname" class="form-control" required />
                                            <label class="floatingInput" for="fname">ชื่อ</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-floating">
                                            <input type="text" name="lname" id="lname" class="form-control" required />
                                            <label class="floatingInput" for="lname">นามสกุล</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-floating">
                                            <div class="form-floating input-group">
                                                <input type="password" name="password_1" id="password_1" class="form-control" required />

                                                <span class="input-group-text" onclick="togglePassword('password_1')">
                                                    <i class="bi bi-eye"></i>
                                                </span>
                                                <label class="floatingInput" for="password_1">ตั้งรหัสผ่าน</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-floating">
                                            <div class="form-floating input-group">
                                                <input type="password" name="password_2" id="password_2" class="form-control" required />

                                                <span class="input-group-text" onclick="togglePassword('password_2')">
                                                    <i class="bi bi-eye"></i>
                                                </span>
                                                <label class="floatingInput" for="password_2">ยืนยันรหัสผ่าน</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-2 d-flex align-items-center">
                                        <div class="form-floating datepicker w-100">
                                            <input type="date" name="birthday" class="form-control" id="birthday" required />
                                            <label for="birthday" class="floatingInput">วัน/เดือน/ปีเกิด</label>
                                        </div>
                                    </div>
                                    <div class="ms-5 col-md-5 mb-2">
                                        <h6 class="mb-2 pb-1">เพศ: </h6>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sex" id="femaleGender" value="ชาย" checked />
                                            <label class="form-check-label" for="femaleGender">ชาย</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sex" id="maleGender" value="หญิง" />
                                            <label class="form-check-label" for="maleGender">หญิง</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sex" id="otherGender" value="ไม่ระบุ" />
                                            <label class="form-check-label" for="otherGender">ไม่ระบุ</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2 pb-2">
                                        <div class="form-floating">
                                            <input type="email" name="email" id="emailAddress" class="form-control " />
                                            <label class="floatingInput" for="emailAddress">อีเมล</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2 pb-2">
                                        <div class="form-floating">
                                            <input oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10" name="tel" id="phoneNumber" class="form-control form-control" maxlength="20" />
                                            <label class="floatingInput" for="phoneNumber">เบอร์โทร</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-2 pb-2">
                                        <div class="form-floating">
                                            <input type="text" name="contact" id="contact" class=" form-control" />
                                            <label class="floatingInput" for="contact">ที่อยู่</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 text-center">
                                    <input class="btn btn-primary btn-md" type="submit" name="reg_user" value="ยืนยัน" />
                                    <a class="btn btn-danger ms-2" href="login.php">ยกเลิก</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function togglePassword(inputId) {
            var passwordInput = document.getElementById(inputId);
            var eyeIcon = document.querySelector(`#${inputId} + .input-group-text i`);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        }

        <?php
        if (isset($_SESSION['regissuccess'])) { ?>

            Swal.fire({
                title: "เข้าสู่ระบบเลย!",
                text: "ลงทะเบียนสำเร็จ",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "login.php";
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['regissuccess']);
        } ?>

        <?php
        if (isset($_SESSION['passworderror'])) { ?>

            Swal.fire({
                title: "กรุณาลองอีกครั้ง",
                text: "รหัสผ่านไม่ตรงกัน",
                icon: "error",
                showConfirmButton: false,
                timer: 2000
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['passworderror']);
        } ?>

        <?php
        if (isset($_SESSION['emailerror'])) { ?>

            Swal.fire({
                title: "ผิดผลาด!",
                text: "อีเมลถูกใช้ไปแล้ว",
                icon: "error",
                showConfirmButton: false,
                timer: 2000
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['emailerror']);
        } ?>
    </script>
</body>

</html>