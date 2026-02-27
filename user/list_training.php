<?php
session_start();
include('../config.php');
include('../month.php');

$sql = "SELECT * FROM training";
$result = $conn->query($sql);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โครงการอบรม</title>
</head>
<style>
    /* Add this CSS to your stylesheet */
    .hover-effect {
        transition: transform 0.3s ease-in-out;
    }

    .hover-effect:hover {
        transform: scale(1.02);
    }

    .text {
        font-size: 13px;
    }

    .fixed-size-image {
        height: 300px;
        /* Adjust the height to your preference */
        object-fit: cover;
        /* Maintain aspect ratio and cover the container */
    }
</style>

<body>
    <?php include('menu.php'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row mt-2">
                <div class="content-header-left col-md-4 col-12">
                    <h3 class="content-header-title">รายการโครงการอบรม</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">รายการโครงการอบรม
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body"><!-- Chart -->
                <div class="row match-height">
                    <div class="col-12">
                        <div class="">

                        </div>
                    </div>
                </div>
                <!-- Chart -->

                <div class="row match-height">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // แปลงรูปแบบวันที่จาก "YYYY-MM-DD" ไปเป็น "dd/mm/yyyy"
                            $date = date("d/m/Y", strtotime($row['training_date']));
                            $formattedTrainingDate = toDateThai($date);
                            $date2 = date("d/m/Y", strtotime($row['training_enddate']));
                            $formattedTrainingDate2 = toDateThai($date2);

                            echo '<div class="col-xl-3 col-lg-6 hover-effect mt-3">';
                            echo '<div class="card border-0 shadow" >';
                            echo '<a href="training.php?training_id=' . $row['training_id'] . '"><img src="../images/' . $row["training_image"] . '" class="card-img-top fixed-size-image" alt="..."></a> ';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $row["training_name"] . '</label></h5>';
                            echo '<p class="text"><i class="la la-calendar"> </i> ลงทะเบียนได้ตั้งแต่วันนี้ </p>';
                            echo '<p class="text"><i class="la la-calendar-check-o"> </i> วันที่อบรม : ' . $formattedTrainingDate . " - " . $formattedTrainingDate2 . '</p>';
                            echo '<p class="text"><i class="la la-users"> </i> วิทยากร : สาขาวิทยาการคอมพิวเตอร์</p>';
                            echo '<p class="card-text d-none">' . $row["training_details"] . '</p>';
                            echo '<p class="text-end fs-6 my-1 text-success">ค่าลงทะเบียน : ฿ ' . $row["training_price"] . '</p>';
                            //echo '<div class="col-md-5 align-self-center text-default-800 ps-0">';
                            //echo '<div class=" text-end"><i class=""></i>31';
                            //echo '<span class="text-black">/</span><p>'. $row["training_limit"] .'</p>';
                            //echo '</div>';
                            //echo '</div>';
                            echo '<a href="training.php?training_id=' . $row["training_id"] . '" class="btn btn-primary"><i class="fa-solid fa-eye"></i> ดูรายละเอียด</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "No data available.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>