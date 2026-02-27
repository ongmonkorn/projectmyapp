<?php

include('../config.php');
include('../month.php');
session_start();

$sql = "SELECT * FROM training";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โครงการอบรม</title>

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
</head>

<body>
    <?php include('menu.php'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row mt-2">
                <div class="content-header-left col-md-4 col-12">
                    <h3 class="content-header-title">จัดการโครงการอบรม</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">จัดการโครงการอบรม
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height mt-3">
                    <a href="training_insert.php" class="col-xl-2 col-lg-2 ms-3 btn btn-primary"><i class="fa-solid fa-square-plus"></i> เพิ่มโครงการ</a>
                    <button type="button" class="col-xl-2 col-lg-2 ms-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fa-solid fa-square-plus"></i> อัพโหลดไฟล์ที่ใช้อบรม
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

                    <!-- <div class="col-xl-2 col-lg-2 mt-3">
                        <a href="training_insert.php" class="btn btn-primary"><i class="fa-solid fa-square-plus"></i> เพิ่มโครงการ</a>
                    </div>

                    <div class="col-xl-2 col-lg-2 mt-3 ms-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            อัพโหลดไฟล์ที่ใช้อบรม
                        </button>
                    </div> -->
                </div>
                <div class="row match-height">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // แปลงรูปแบบวันที่จาก "YYYY-MM-DD" ไปเป็น "dd/mm/yyyy"
                            $date = date("d/m/Y", strtotime($row['training_date']));
                            $date2 = date("d/m/Y", strtotime($row['training_enddate']));
                            $formattedTrainingDate = toDateThai($date);
                            $formattedTrainingDate2 = toDateThai($date2);

                            echo '<div class="col-xl-3 col-lg-6 hover-effect mt-1">';
                            echo '<div class="card border-0 shadow" >';
                            echo '<a href="training.php?training_id=' . $row['training_id'] . '"><img src="../images/' . $row["training_image"] . '" class="card-img-top fixed-size-image" alt="..."></a> ';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title" >' . $row["training_name"] . '</label></h5>';
                            echo '<p class="text"><i class="la la-calendar"> </i> ลงทะเบียนได้ตั้งแต่วันนี้ </p>';
                            echo '<p class="text"><i class="la la-calendar-check-o"> </i> วันที่อบรม : ' . $formattedTrainingDate . ' - ' . $formattedTrainingDate2 . '</p>';
                            echo '<p class="text"><i class="la la-users"> </i> วิทยากร : ' . $row['training_lecturer'] . '</p>';
                            echo '<p class="card-text d-none">' . $row["training_details"] . '</p>';
                            echo '<p class="text-end fs-6 my-1 text-success">ค่าลงทะเบียน : ฿ ' . $row["training_price"] . '</p>';
                            //echo '<div class="col-md-5 align-self-center text-default-800 ps-0">';
                            //echo '<div class=" text-end"><i class=""></i>31';
                            //echo '<span class="text-black">/</span><p>'. $row["training_limit"] .'</p>';
                            //echo '</div>';
                            //echo '</div>';
                            echo '<div class="text-center">';
                            echo '<a href="training.php?training_id=' . $row["training_id"] . '" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>';
                            echo '<a href="training_edit.php?training_id=' . $row["training_id"] . '" class="btn btn-warning text-white ms-2" ><i class="fa-solid fa-pen-to-square"></i></a>';
                    ?>
                            <button class="btn btn-danger ms-2" name="del" onclick="confirmDelete(<?php echo $row['training_id']; ?>)">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                    <?php
                            echo '</div>';
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
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        <?php
        if (isset($_SESSION['insertsuccess'])) { ?>

            Swal.fire({
                title: " เพิ่มโครงการสำเร็จ!",
                text: "",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            })

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['insertsuccess']);
        } ?>

        <?php
        if (isset($_SESSION['filesuccess'])) { ?>

            Swal.fire({
                title: " เพิ่มไฟล์สำเร็จ!",
                text: "",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            })

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['filesuccess']);
        } ?>

        function confirmDelete(trainingId) {
            // ใช้ SweetAlert2 สำหรับการแสดงหน้าต่างยืนยันการลบ
            Swal.fire({
                title: "ต้องการลบรายการนี้หรือไม่?",
                text: "คุณแน่ใจหรือไม่ที่จะลบรายการนี้?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ลบข้อมูล",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    // หากผู้ใช้กดตกลงใน SweetAlert2
                    // ทำ AJAX request เพื่อส่งค่า ID ไปยัง PHP script สำหรับการลบ
                    $.ajax({
                        type: "POST",
                        url: "training_del.php",
                        data: {
                            id: trainingId
                        },
                        success: function(response) {
                            // หลังจากที่ลบข้อมูลเรียบร้อยแล้ว
                            // รีโหลดหน้าเว็บ
                            location.reload();

                            // },
                            // success: function(response) {
                            //     // หากการลบสำเร็จ
                            //     Swal.fire({
                            //         title: "ลบสำเร็จ!",
                            //         text: "คุณได้ลบรายการแล้ว",
                            //         icon: "success"
                            //   }).then(() => {
                            //       window.location.href = "list_training.php";
                            // });

                            // },
                            // error: function(error) {
                            //     // หากเกิดข้อผิดพลาดในการลบ
                            //     Swal.fire({
                            //         title: "Error!",
                            //         text: "There was an error deleting the order.",
                            //         icon: "error"
                            //     });
                        }
                    });
                }
            });
        }

        <?php
        if (isset($_SESSION['errordel'])) { ?>

            Swal.fire({
                title: " ผิดพลาด!",
                text: "ไม่สามารถลบโครงการได้ เนื่องจากมีผู้ลงทะเบียน",
                icon: "error",
                showConfirmButton: true,
                timer: 3500
            })

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['errordel']);
        } ?>

        <?php
        if (isset($_SESSION['succcessdel'])) { ?>

            Swal.fire({
                title: " สำเร็จ!",
                text: "ลบโครงการสำเร็จ",
                icon: "success",
                showConfirmButton: true,
                timer: 3500
            })

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['succcessdel']);
        } ?>
    </script>
</body>

</html>