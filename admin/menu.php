<?php

if (!isset($_SESSION['admin_id'])) {
    $_SESSION['nologin'] = "ยังไม่ได้เข้าสู่ระบบ";
    header('location: login.php');
}
if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION["admin_id"];
    $sql = "SELECT * FROM tb_admin WHERE admin_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
}

?>

<html class="loaded" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>หน้าแรก</title>
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
</head>

<body class="vertical-layout vertical-menu 2-columns fixed-navbar  menu-expanded pace-done" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>

    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="collapse navbar-collapse show" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs is-active" href="#"><i class="ft-menu"></i></a></li>
                        <!-- <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li> -->
                        <!-- <li class="nav-item dropdown navbar-search"><a class="nav-link dropdown-toggle hide" data-toggle="dropdown" href="#"><i class="ficon ft-search"></i></a>
                            <ul class="dropdown-menu">
                                <li class="arrow_box">
                                    <form>
                                        <div class="input-group search-box">
                                            <div class="position-relative has-icon-right full-width">
                                                <input class="form-control" id="search" type="text" placeholder="Search here...">
                                                <div class="form-control-position navbar-search-close"><i class="ft-x"> </i></div>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item">
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                                <div class="arrow_box"><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> Chinese</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-ru"></i> Russian</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-es"></i> Spanish</a></div>
                            </div>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"> <span class="avatar avatar-online"><img src="../images/<?php echo $row['admin_image']; ?>" alt="avatar"><i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="arrow_box_right"><a class="dropdown-item" href="#"><span class="avatar avatar-online"><img src="../images/<?php echo $row['admin_image']; ?>" alt="avatar"><span class="user-name text-bold-700 ml-1"><?php echo $row['admin_username']; ?></span></span></a>
                                    <!-- <div class="dropdown-divider"></div><a class="dropdown-item" href="profile.php"><i class="ft-user"></i>ข้อมูลส่วนตัว</a><a class="dropdown-item" id="btnChangePass" href="" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="ft-check-square"></i>เปลี่ยนรหัสผ่าน</a> -->
                                    <div class="dropdown-divider"></div><a class="dropdown-item" onclick="confirmLogout()"><i class="ft-power"></i>ออกจากระบบ</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="../theme-assets/images/backgrounds/02.jpg">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html"><img class="brand-logo" alt="Chameleon admin logo" src="../images/logo.png">
                        <h3 class="brand-text">Training</h3>
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
            </ul>
        </div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item"><a href="home.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">หน้าแรก</span></a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="ft-menu"></i>
                        <span class="menu-title" data-i18n="">จัดการ</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="list_training.php">
                                <span class="menu-title" data-i18n=""> จัดการโครงการอบรม</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user_list.php">
                                <span class="menu-title" data-i18n="">จัดการผู้ใช้</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a href="status.php"><i class="la la-hourglass"></i><span class="menu-title" data-i18n="">อนุมัติการลงทะเบียน</span></a>
                </li>
                <li class="nav-item"><a href="training_result.php"><i class="la la-edit"></i><span class="menu-title" data-i18n="">ตรวจสอบผลการอบรม</span></a>
                </li>
                <li class="nav-item"><a href="history.php"><i class="la la-history"></i><span class="menu-title" data-i18n="">บันทึกการทำรายการ</span></a>
                </li>
                <li class="nav-item"><a href="calendar.php"><i class="la la-calendar"></i><span class="menu-title" data-i18n="">ปฏิทิน</span></a>
                </li>
                <li class="nav-item"><a href="contact.php"><i class="la la-info-circle"></i><span class="menu-title" data-i18n="">ติดต่อ</span></a>
                </li>
            </ul>
        </div>
        <div class="navigation-background" style="background-image: url(&quot;theme-assets/images/backgrounds/02.jpg&quot;);"></div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1DIVuzaNb0i4wRS/YacYk2hO0mi09b56g8/5vN/I9jXwdGd1465t1CEj0BDh" crossorigin="anonymous"></script>

    <script>
        const btnChangePass = document.getElementById('btnChangePass');
        const changePassModal = document.getElementById('changePassModal');

        btnChangePass.addEventListener('click', () => {
            changePassModal.showModal();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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

        const activeClassName = 'active';
        const currentPageUrl = window.location.href;
        const menuItems = document.querySelectorAll('#main-menu-navigation .nav-item a');
        menuItems.forEach(menuItem => {
            const menuLink = menuItem.href;
            if (menuLink === currentPageUrl) {
                menuItem.classList.add(activeClassName);
            }
        });
        menuItems.forEach(menuItem => {
            menuItem.addEventListener('click', (event) => {
                // Remove any existing active classes
                menuItems.forEach(item => item.classList.remove(activeClassName));
                // Add the active class to the clicked item
                event.currentTarget.classList.add(activeClassName);
            });
        });

        function confirmLogout() {
            // ใช้ SweetAlert2 สำหรับการแสดงหน้าต่างยืนยันการออกจากระบบ
            Swal.fire({
                title: "ออกจากระบบ?",
                text: "เลือกตกลงเพื่อออกจากระบบ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ออกจากระบบ",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    // ทำการออกจากระบบ โดย redirect ไปยังหน้า 'logout.php'
                    window.location.href = 'logout.php';
                } else {
                    // ถ้าผู้ใช้ยกเลิกการออกจากระบบ
                    Swal.fire({
                        title: "ยกเลิก!",
                        text: "คุณยังคงอยู่ในระบบ",
                        icon: "info"
                    });
                }
            }).catch((error) => {
                // หากมีข้อผิดพลาดในกระบวนการออกจากระบบ
                Swal.fire({
                    title: "ผิดพลาด!",
                    text: "เกิดข้อผิดพลาดในการออกจากระบบ",
                    icon: "error"
                });
            });
        }
    </script>

</body>

</html>