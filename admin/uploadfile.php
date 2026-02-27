<?php

include('../config.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ชื่อ Tab</title>
</head>

<body>
    <?php include('menu.php'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row mt-2">
                <div class="content-header-left col-md-4 col-12">
                    <h3 class="content-header-title">แก้ไขข้อมูลการสมัครอบรม</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">แก้ไขข้อมูลการสมัครอบรม
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12 mt-5">
                        <!-- <form action="uploadfile_db.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload File" name="submit">
                        </form> -->

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            อัพโหลดไฟล์ที่ใช้อบรม
                        </button>

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
                                            <div class="input-group">
                                                <label for="dropdown">เลือกโครงการ :</label>
                                                <select class="ms-2" id="dropdown" name="training">
                                                    <?php // สร้างคำสั่ง SQL เพื่อดึงข้อมูล
                                                    $trainingdropdown = "SELECT * FROM training";
                                                    $resulttrainingdropdown = $conn->query($trainingdropdown);

                                                    // ถ้ามีข้อมูลในฐานข้อมูล
                                                    if ($resulttrainingdropdown->num_rows > 0) {
                                                        // วนลูปเพื่อแสดงผลลงใน dropdown
                                                        while ($rowtrainingdropdown = $resulttrainingdropdown->fetch_assoc()) {
                                                            echo "<option value='" . $rowtrainingdropdown["training_id"] . "'>" . $rowtrainingdropdown["training_name"] . "</option>";
                                                        }
                                                    } else {
                                                        echo "0 results";
                                                    }
                                                    ?>
                                                </select>
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
    </div>
    <?php include('footer.php'); ?>
</body>

</html>