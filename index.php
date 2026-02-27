<?php

include('config.php');
session_start();
$id = $_SESSION["user_id"];
$sql = "SELECT COUNT(*) AS total_rows FROM training ";
$resulrowtraining = mysqli_query($conn, $sql);

$row = $resulrowtraining->fetch_assoc();
$totalRows = $row['total_rows'];

$sql2 = "SELECT COUNT(*) AS total_rowsreg FROM orders WHERE user_id = '$id'";
$resulrowreg = mysqli_query($conn, $sql2);

$rowreg = $resulrowreg->fetch_assoc();
$totalRowsreg = $rowreg['total_rowsreg'];

$sql3 = "SELECT COUNT(*) AS total_rowsreg2 FROM orders WHERE user_id = '$id' AND order_status = 1";
$resulrowreg2 = mysqli_query($conn, $sql3);

$rowreg2 = $resulrowreg2->fetch_assoc();
$totalRowsreg2 = $rowreg2['total_rowsreg2'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>
</head>

<body>
    <?php include('menu.php'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row mt-2">
                <div class="content-header-left col-md-4 col-12">
                    <h3 class="content-header-title">หน้าแรก</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">หน้าแรก
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-content">

                                <div id="carousel-area" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-area" data-slide-to="0" class=""></li>
                                        <li data-target="#carousel-area" data-slide-to="1" class="active"></li>
                                        <li data-target="#carousel-area" data-slide-to="2" class=""></li>
                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item">
                                            <img src="../assets/img/banner1 copy.png" class="d-block w-100" alt="First slide">
                                        </div>
                                        <div class="carousel-item active">
                                            <img src="../assets/img/banner2.png" class="d-block w-100" alt="Second slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../assets/img/banner5.png" class="d-block w-100" alt="Third slide">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel-area" role="button" data-slide="prev">
                                        <span class="la la-angle-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-area" role="button" data-slide="next">
                                        <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="card pull-up ecom-card-1 bg-white">
                            <div class="card-content ecom-card2 height-180">
                                <h3 class="text-muted danger position-absolute p-1">โครงการอบรม</h3>
                                <div>
                                    <p class="danger font-large-1 float-right p-1"><?php echo $totalRows; ?></p>
                                </div>
                                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3">
                                    <div class="p-3 text-center">
                                        <i class="ft-layers danger" style="font-size: 50px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="card pull-up ecom-card-1 bg-white">
                            <div class="card-content ecom-card2 height-180">
                                <h3 class="text-muted primary position-absolute p-1">โครงการอบรมที่ลงทะเบียน</h3>
                                <div>
                                    <p class="primary font-large-1 float-right p-1"><?php echo $totalRowsreg;?></p>
                                </div>
                                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                                    <div class="p-3 text-center">
                                        <i class="la la-shopping-cart primary" style="font-size: 50px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12">
                        <div class="card pull-up ecom-card-1 bg-white">
                            <div class="card-content ecom-card2 height-180">
                                <h3 class="text-muted success position-absolute p-1">อนุมัติแล้ว</h3>
                                <div>
                                    <p class="success font-large-1 float-right p-1"><?php echo $totalRowsreg2;?></p>
                                </div>
                                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                                    <div class="p-3 text-center">
                                        <i class="la la-check-square-o success" style="font-size: 50px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="heading-multiple-thumbnails">Multiple Thumbnail</h4>
                                <a class="heading-elements-toggle">
                                    <i class="la la-ellipsis-v font-medium-3"></i>
                                </a>
                                <div class="heading-elements">
                                    <span class="avatar">
                                        <img src="../theme-assets/images/portrait/small/avatar-s-2.png" alt="avatar">
                                    </span>
                                    <span class="avatar">
                                        <img src="../theme-assets/images/portrait/small/avatar-s-3.png" alt="avatar">
                                    </span>
                                    <span class="avatar">
                                        <img src="../theme-assets/images/portrait/small/avatar-s-4.png" alt="avatar">
                                    </span>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">Content title</h4>
                                    <p class="card-text">Jelly beans sugar plum cheesecake cookie oat cake soufflé.Tootsie roll bonbon liquorice tiramisu pie powder.Donut sweet
                                        roll marzipan pastry cookie cake tootsie roll oat cake cookie.Jelly beans sugar plum cheesecake cookie oat cake soufflé. Tart lollipop carrot cake sugar plum. </p>
                                    <p class="card-text">Sweet roll marzipan pastry halvah. Cake bear claw sweet. Tootsie roll pie marshmallow lollipop chupa chups donut fruitcake
                                        cake.Jelly beans sugar plum cheesecake cookie oat cake soufflé. Tart lollipop carrot cake sugar plum. Marshmallow
                                        wafer tiramisu jelly beans.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recent Buyers</h4>
                                <a class="heading-elements-toggle">
                                    <i class="fa fa-ellipsis-v font-medium-3"></i>
                                </a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a data-action="reload">
                                                <i class="ft-rotate-cw"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div id="recent-buyers" class="media-list">
                                    <a href="#" class="media border-0">
                                        <div class="media-left pr-1">
                                            <span class="avatar avatar-md avatar-online">
                                                <img class="media-object rounded-circle" src="../theme-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                                                <i></i>
                                            </span>
                                        </div>
                                        <div class="media-body w-100">
                                            <span class="list-group-item-heading">Kristopher Candy

                                            </span>
                                            <ul class="list-unstyled users-list m-0 float-right">
                                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 1" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../theme-assets/images/portfolio/portfolio-1.jpg" alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 2" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../theme-assets/images/portfolio/portfolio-2.jpg" alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 3" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../theme-assets/images/portfolio/portfolio-4.jpg" alt="Avatar">
                                                </li>
                                            </ul>
                                            <p class="list-group-item-text mb-0">
                                                <span class="blue-grey lighten-2 font-small-3"> #INV-12332 </span>
                                            </p>
                                        </div>
                                    </a>
                                    <a href="#" class="media border-0">
                                        <div class="media-left pr-1">
                                            <span class="avatar avatar-md avatar-away">
                                                <img class="media-object rounded-circle" src="../theme-assets/images/portrait/small/avatar-s-8.png" alt="Generic placeholder image">
                                                <i></i>
                                            </span>
                                        </div>
                                        <div class="media-body w-100">
                                            <span class="list-group-item-heading">Lawrence Fowler

                                            </span>
                                            <ul class="list-unstyled users-list m-0 float-right">
                                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 1" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../theme-assets/images/portfolio/portfolio-5.jpg" alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 2" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../theme-assets/images/portfolio/portfolio-6.jpg" alt="Avatar">
                                                </li>
                                            </ul>
                                            <p class="list-group-item-text mb-0">
                                                <span class="blue-grey lighten-2 font-small-3"> #INV-12333 </span>
                                            </p>
                                        </div>
                                    </a>
                                    <a href="#" class="media border-0">
                                        <div class="media-left pr-1">
                                            <span class="avatar avatar-md avatar-busy">
                                                <img class="media-object rounded-circle" src="../theme-assets/images/portrait/small/avatar-s-9.png" alt="Generic placeholder image">
                                                <i></i>
                                            </span>
                                        </div>
                                        <div class="media-body w-100">
                                            <span class="list-group-item-heading">Linda Olson

                                            </span>
                                            <ul class="list-unstyled users-list m-0 float-right">
                                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 1" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../theme-assets/images/portfolio/portfolio-2.jpg" alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 2" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../theme-assets/images/portfolio/portfolio-5.jpg" alt="Avatar">
                                                </li>
                                            </ul>
                                            <p class="list-group-item-text mb-0">
                                                <span class="blue-grey lighten-2 font-small-3"> #INV-12334 </span>
                                            </p>
                                        </div>
                                    </a>
                                    <a href="#" class="media border-0">
                                        <div class="media-left pr-1">
                                            <span class="avatar avatar-md avatar-online">
                                                <img class="media-object rounded-circle" src="../theme-assets/images/portrait/small/avatar-s-10.png" alt="Generic placeholder image">
                                                <i></i>
                                            </span>
                                        </div>
                                        <div class="media-body w-100">
                                            <span class="list-group-item-heading">Roy Clark

                                            </span>
                                            <ul class="list-unstyled users-list m-0 float-right">
                                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 1" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../theme-assets/images/portfolio/portfolio-6.jpg" alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 2" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../theme-assets/images/portfolio/portfolio-1.jpg" alt="Avatar">
                                                </li>
                                            </ul>
                                            <p class="list-group-item-text mb-0">
                                                <span class="blue-grey lighten-2 font-small-3"> #INV-12335 </span>
                                            </p>
                                        </div>
                                    </a>
                                    <a href="#" class="media border-0">
                                        <div class="media-left pr-1">
                                            <span class="avatar avatar-md avatar-online">
                                                <img class="media-object rounded-circle" src="../theme-assets/images/portrait/small/avatar-s-11.png" alt="Generic placeholder image">
                                                <i></i>
                                            </span>
                                        </div>
                                        <div class="media-body w-100">
                                            <span class="list-group-item-heading">Kristopher Candy

                                            </span>
                                            <ul class="list-unstyled users-list m-0 float-right">
                                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 1" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../theme-assets/images/portfolio/portfolio-5.jpg" alt="Avatar">
                                                </li>
                                            </ul>
                                            <p class="list-group-item-text mb-0">
                                                <span class="blue-grey lighten-2 font-small-3"> #INV-12336 </span>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!--/ Statistics -->
            </div>
        </div>
    </div>
    <?php include('footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php

        if (isset($_SESSION['success'])) { ?>

            Swal.fire({
                title: 'สำเร็จ!',
                text: 'เข้าสู่ระบบแล้ว',
                icon: 'success',
                confirmButtonText: 'OK'
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['success']);
        } ?>

        <?php

        if (isset($_SESSION['passerror'])) { ?>

            Swal.fire({
                title: 'ผิดพลาด!',
                text: 'รหัสผ่านเดิมไม่ถูกต้อง',
                icon: 'error',
                confirmButtonText: 'OK'
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['passerror']);
        } ?>

        <?php

        if (isset($_SESSION['errorpass'])) { ?>

            Swal.fire({
                title: 'ผิดพลาด!',
                text: 'รหัสผ่านใหม่ไม่ตรงกัน',
                icon: 'error',
                confirmButtonText: 'OK'
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['errorpass']);
        } ?>

        <?php

        if (isset($_SESSION['editpass'])) { ?>

            Swal.fire({
                title: 'สำเร็จ',
                text: 'เปลี่ยนรหัสผ่านสำเร็จ',
                icon: 'success',
                confirmButtonText: 'OK'
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['editpass']);
        } ?>
    </script>
</body>

</html>