<?php

include('../config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดต่อ</title>
    <!-- <style>
        .map-container-3 {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
        }

        .map-container-3 iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }
    </style> -->
</head>

<body>
    <?php include('menu.php'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row mt-2">
                <div class="content-header-left col-md-4 col-12">
                    <h3 class="content-header-title">ติดต่อ</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">ติดต่อ
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body mt-5">
                <div class="row match-height">
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="card pull-up ecom-card-1 bg-white">
                            <div class="card-content ecom-card2 height-180">
                                <h3 class="text-muted danger position-absolute p-1">ที่อยู่</h3>
                                <div>
                                    <i class="la la-map-marker danger font-large-1 float-right p-1"></i>
                                </div>
                                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                                    <div class="p-2">
                                        <h5 class="text-header">อาคาร 5 ชั้น 2</h5>
                                        <p>สาขาวิชาวิทยาการคอมพิวเตอร์ 439 ถนน จิระ ตำบลในเมือง อำเภอเมือง จังหวัดบุรีรัมย์ 31000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="card pull-up ecom-card-1 bg-white">
                            <div class="card-content ecom-card2 height-180">
                                <h3 class="text-muted primary position-absolute p-1">อีเมล</h3>
                                <div>
                                    <i class="la la-envelope primary font-large-1 float-right p-1"></i>
                                </div>
                                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                                    <div class="p-2">
                                        <h5 class="text-header">ส่งอีเมลมาหาเรา</h5>
                                        <p>อีเมล: comsci_bru@hotmail.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="card pull-up ecom-card-1 bg-white">
                            <div class="card-content ecom-card2 height-180">
                                <h3 class="text-muted warning position-absolute p-1">ที่อยู่</h3>
                                <div>
                                    <i class="la la-phone warning font-large-1 float-right p-1"></i>
                                </div>
                                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                                    <div class="p-2">
                                        <h5 class="text-header">เบอร์โทรติดต่อ</h5>
                                        <p>โทร. 044-611221 ต่อ 6611. 6612</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!--Google map-->
                        <div class="row shadow text-center p-2 my-2">
                            <div class="col">
                                <h3>ตึก 17</h3>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3487.698558429827!2d103.09897798272523!3d14.99090857897694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311995c66d172511%3A0x1903999087a5daf4!2z4Lit4Liy4LiE4Liy4Lij4LiZ4Lin4Lix4LiV4Lib4Lix4LiN4LiN4Liy!5e1!3m2!1sth!2sth!4v1714655563016!5m2!1sth!2sth" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <div class="col">
                                <h3>ตึก 5</h3>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3487.711565758844!2d103.09836643906982!3d14.990110572564342!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311995c601928e01%3A0x90672fe2cf1efe74!2z4Liq4Liy4LiC4Liy4Lin4Li04LiK4Liy4Lin4Li04LiX4Lii4Liy4LiB4Liy4Lij4LiE4Lit4Lih4Lie4Li04Lin4LmA4LiV4Lit4Lij4LmMIOC4oeC4q-C4suC4p-C4tOC4l-C4ouC4suC4peC4seC4ouC4o-C4suC4iuC4oOC4seC4j-C4muC4uOC4o-C4teC4o-C4seC4oeC4ouC5jA!5e1!3m2!1sth!2sth!4v1714655655421!5m2!1sth!2sth" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div id="map-container-google-3" class="z-depth-1-half map-container-3">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1743.8553969889995!2d103.09910860931937!3d14.990157922879662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311995c601928e01%3A0x90672fe2cf1efe74!2z4Liq4Liy4LiC4Liy4Lin4Li04LiK4Liy4Lin4Li04LiX4Lii4Liy4LiB4Liy4Lij4LiE4Lit4Lih4Lie4Li04Lin4LmA4LiV4Lit4Lij4LmMIOC4oeC4q-C4suC4p-C4tOC4l-C4ouC4suC4peC4seC4ouC4o-C4suC4iuC4oOC4seC4j-C4muC4uOC4o-C4teC4o-C4seC4oeC4ouC5jA!5e1!3m2!1sth!2sth!4v1706841710610!5m2!1sth!2sth" width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>