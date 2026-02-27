<?php

include('../config.php');
session_start();
if (isset($_GET["training_id"])) {
    $id = $_GET["training_id"];

    // คิวรีเพื่อดึงข้อมูลการฝึกอบรม
    $sql = "SELECT * FROM training WHERE training_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $training = mysqli_fetch_array($query, MYSQLI_ASSOC);
    // $training_obj = json_decode($training["training_obj"], true);
    // คิวรีเพื่อดึงข้อมูลผู้เข้าร่วมการฝึกอบรม
    $sqllist = "SELECT * FROM orders 
        INNER JOIN training ON orders.training_id = training.training_id 
        INNER JOIN user ON orders.user_id = user.user_id
        WHERE orders.training_id = '$id' AND orders.order_status = 1";
    $result = mysqli_query($conn, $sqllist);

    $sqllimit = "SELECT COUNT(*) AS total_rows FROM orders WHERE training_id = '$id' AND order_status = 1";
    $resultlimit = mysqli_query($conn, $sqllimit);


    if ($resultlimit->num_rows > 0) {
        $row = $resultlimit->fetch_assoc();
        $totalRows = $row['total_rows'];
        // คำนวณและแสดงจำนวนแถวที่เหลือ
        $remainingRows = max(0, $training["training_limit"] - $totalRows);
    }
    include('../month.php');
    $date = date("d/m/Y", strtotime($training['training_date']));
    $formattedTrainingDate = toDateThai($date);
    $date2 = date("d/m/Y", strtotime($training['training_enddate']));
    $formattedTrainingDate2 = toDateThai($date2);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดโครงการอบรม</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        .divider:after {
            content: "";
            flex: 1;
            height: 2px;
            background: #7878e0;
        }

        #table {
            background-color: white;
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
                    <h3 class="content-header-title">รายละเอียดโครงการอบรม</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">รายละเอียดโครงการอบรม
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Statistics -->
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12 mt-5">
                        <div class="mt-2 mb-2">
                            <img src="../images/<?php echo $training["training_image"]; ?>" width="300" class="rounded d-block p-4" alt="...">
                            <h1 class="ms-4 fw-bold"><?php echo $training["training_name"]; ?></h1>
                            <h3 class="ms-4"><?php echo $training["training_details"]; ?></h3>
                            <!--<p class="mb-2">วัตถุประสงค์ : <?php print_r($training_obj["obj"]); ?></p>-->
                        </div>

                        <div id="custom-list" class="list-group mt-2">
                            <ul>
                                <li class="list-group">
                                    <div class="d-flex">
                                        <h4 class="text-primary fw-bold">ชื่อโครงการ : </h4>
                                        <h4 class="text ms-2"><?php echo $training["training_name"]; ?></h4>
                                    </div>
                                </li>
                                <li class="list-group">
                                    <div class="d-flex">
                                        <h4 class="text-primary fw-bold">จำนวนที่นั่ง : </h4>
                                        <h4 class="text ms-2"><?php echo $training["training_limit"]; ?> คน
                                            <h4 class="text-danger ms-2"> (จำนวนที่ว่าง <?php echo $remainingRows ?> คน)</h4>
                                        </h4>
                                    </div>
                                </li>
                                <li class="list-group">
                                    <div class="d-flex">
                                        <h4 class="text-primary fw-bold">ค่าลงทะเบียน : </h4>
                                        <h4 class="text ms-2"><?php echo $training["training_price"]; ?> บาท</h4>
                                    </div>
                                </li>
                                <li class="list-group">
                                    <div class="d-flex">
                                        <h4 class="text-primary fw-bold">ระยะเวลา : </h4>
                                        <h4 class="text ms-2"><?php echo $formattedTrainingDate . " - " . $formattedTrainingDate2; ?></h4>
                                    </div>
                                </li>

                                <li class="list-group">
                                    <div class="d-flex">
                                        <h4 class="text-primary fw-bold">สถานที่ดำเนินการ : </h4>
                                        <h4 class="text-muted ms-2"><?php echo $training["training_place"]; ?></h4>
                                    </div>
                                </li>
                                <li class="list-group">
                                    <div class="d-flex">
                                        <h4 class="text-primary fw-bold">วิทยากร : </h4>
                                        <h4 class="text-muted ms-2">
                                            สาขาวิทยาการคอมพิวเตอร์
                                        </h4>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="text-center mb-4">
                            <a href="regtraining.php?training_id=<?php echo $training["training_id"]; ?>" class="btn btn-primary">ลงทะเบียนสมัครอบรม</a>
                            <a href="list_training.php" class="btn btn-secondary">กลับ</a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-primary">ไฟล์ที่ใช้อบรม</a>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">ไฟล์ที่ใช้อบรม</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $idfile = $training["training_id"];
                                        // ดึงข้อมูลของไฟล์ทั้งหมดจากฐานข้อมูล
                                        $file = "SELECT * FROM files WHERE training_id = '$idfile'";
                                        $resultfile = $conn->query($file);

                                        if ($resultfile->num_rows > 0) {
                                            // แสดงรายการไฟล์ในรูปแบบของตาราง HTML
                                            echo "<table>";
                                            echo "<tr><th>ชื่อไฟล์</th><th></th></tr>";
                                            while ($rowfile = $resultfile->fetch_assoc()) {
                                                echo "<tr>";
                                                // echo "<td>" . $rowfile["id"] . "</td>";
                                                echo "<td>" . $rowfile["name"] . "</td>";
                                                echo "<td><a href='download.php?id=" . $rowfile["id"] . "'>ดาวน์โหลด</a></td>"; // ลิงก์สำหรับการดาวน์โหลดไฟล์
                                                echo "</tr>";
                                            }
                                            echo "</table>";
                                        } else {
                                            echo "ไม่พบข้อมูล";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">กลับ</button>
                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="divider d-flex align-items-center">
                            <h3 class="fw-bold text-primary mx-1"> รายชื่อผู้เข้าอบรม </h3>
                        </div>
                        <div class="mt-2 col-md-12 col-sm-12 mb-2 rounded p-3">

                            <div class="table-responsive">
                                <table id="table" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr class="table-primary">
                                            <th class="col">ลำดับ</th>
                                            <th class="col">ชื่อผู้เข้าร่วม</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1; // ตัวแปรสำหรับเก็บลำดับ

                                        if ($result->num_rows > 0) {
                                            while ($listuser = $result->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <span class=" "><?php echo $counter ?></span>
                                                    </td>
                                                    <td>
                                                        <?php echo $listuser["user_pname"] . ' ' . $listuser["user_fname"] . ' ' . $listuser["user_lname"]; ?>
                                                    </td>
                                                </tr>
                                        <?php
                                                $counter++; // เพิ่มค่าลำดับทุกครั้งที่วนลูป
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Statistics -->
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script src=" https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#table').DataTable({
            info: true,
            ordering: true,
            paging: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/2.0.3/i18n/th.json"
            },
            "columnDefs": [{
                    "width": "5%",
                    "targets": 0
                },
                {
                    "width": "30%",
                    "targets": 1
                }
            ]
        });

        <?php
        if (isset($_SESSION['regsuccess'])) { ?>

            Swal.fire({
                title: "สำเร็จ!",
                text: "สมัครฝึกอบรมสำเร็จ รออนุมัติ",
                icon: "success",
                showConfirmButton: true,
                timer: 4000
            }).then(() => {
                window.location.href = "training.php?training_id=<?php echo $training['training_id'] ?>";
            });

        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['regsuccess']);
        } ?>

        <?php
        if (isset($_SESSION['limit'])) { ?>
            Swal.fire({
                title: "ขณะนี้มีผู้ลงทะเบียนเต็มแล้ว!",
                text: "",
                icon: "error",
                confirmButtonText: "ตกลง"
            })
        <?php
            // ลบข้อมูลใน $_SESSION เพื่อไม่ให้แสดงผลในการรีหน้า
            unset($_SESSION['limit']);
        } ?>
    </script>
</body>

</html>