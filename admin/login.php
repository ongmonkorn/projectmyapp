<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <link rel="apple-touch-icon" href="../theme-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../theme-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/08e59a5d41.js" crossorigin="anonymous"></script>
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="../theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="../theme-assets/vendors/css/charts/chartist.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="../theme-assets/css/app-lite.css">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="../theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../theme-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="../theme-assets/css/pages/dashboard-ecommerce.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <!-- END Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../theme-assets/css/font.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Trirong&display=swap" rel="stylesheet">
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }

        body {
            background-image: url("../images/bg-blue.svg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
    </style>
</head>

<body>
    <section class="vh-100 p-2">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="text-center col-md-9 col-lg-6 col-xl-5">
                    <img src="../images/logo.png" width="400" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="login_db.php" method="POST">




                        <div class="card p-2">
                            <div class="card-header">
                                <h2 class="title">เข้าสู่ระบบสำหรับผู้ดูแลระบบ</h2>
                            </div>
                            <div class="card-block">
                                <div class="card-body">
                                    <fieldset class="form-group">
                                        <label for="username">ชื่อ :</label>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="กรอกชื่อ" required="">
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label class="label" for="password">รหัสผ่าน :</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="รหัสผ่าน" required="">
                                            <span class="input-group-text" onclick="togglePassword('password')">
                                                <i class="la la-eye"></i>
                                            </span>
                                        </div>
                                    </fieldset>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- Checkbox -->
                                        <div class="form-check">
                                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3">
                                            <label class="form-check-label" for="form2Example3">
                                                จำผู้ใช้
                                            </label>
                                        </div>
                                        <a href="../user/login.php" class="fw-bold text-primary">สำหรับผู้ใช้ทั่วไป</a>
                                    </div>

                                    <div class="text-center text-lg-start pt-2">
                                        <button type="submit" name="login_admin" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">เข้าสู่ระบบ</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function togglePassword(inputId) {
        var passwordInput = document.getElementById(inputId);
        var eyeIcon = document.querySelector(`#${inputId} + .input-group-text i`);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('la-eye');
            eyeIcon.classList.add('la-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('la-eye-slash');
            eyeIcon.classList.add('la-eye');
        }
    }

    <?php
    if (isset($_SESSION['adminerror'])) {
    ?>


        Swal.fire({
            title: 'เข้าสู่ระบบไม่สำเร็จ',
            text: 'Email หรือ Password ไม่ถูกต้อง',
            icon: 'error',
            confirmButtonText: 'OK'
        })

    <?php
        // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
        unset($_SESSION['adminerror']);
    }
    ?>


    <?php

    if (isset($_SESSION['logout'])) { ?>

        Swal.fire({
            title: 'สำเร็จ',
            text: 'ออกจากระบบแล้ว',
            icon: 'success',
            confirmButtonText: 'OK'
        });

    <?php
        // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
        unset($_SESSION['logout']);
    } ?>
</script>

</html>