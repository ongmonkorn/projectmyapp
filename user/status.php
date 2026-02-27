<?php

include('../config.php');
session_start();
if (isset($_GET["user_id"])) {
    $id = $_GET["user_id"];
    $sql = "SELECT orders.*, training.*, user.* FROM orders
JOIN training ON orders.training_id = training.training_id
JOIN user ON orders.user_id = user.user_id WHERE orders.order_status = '0' AND user.user_id = '$id'";
    $result = $conn->query($sql);

    $sql2 = "SELECT orders.*, training.*, user.* FROM orders
JOIN training ON orders.training_id = training.training_id
JOIN user ON orders.user_id = user.user_id WHERE orders.order_status = '1' AND user.user_id = '$id'";
    $result2 = $conn->query($sql2);
}


include('../month.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะการลงทะเบียน</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        .approved {
            color: white;
            /* background-color: #65ff4c; */
            width: 50%;
            /* สีเขียวสำหรับสถานะอนุมัติ */
        }

        .pending {
            color: white;
            /* background-color: #FFD700; */
            width: 50%;
            /* สีเหลืองสำหรับสถานะรออนุมัติ */
        }

        a.btn {
            padding: 10px;
        }

        a i {
            font-size: 10px;
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
                    <h3 class="content-header-title">สถานะการลงทะเบียน</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">สถานะการลงทะเบียน
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body"><!-- Chart -->
                <div class="row match-height">
                    <div class="row mt-4">
                        <a class="col-sm-6 col-md-4 col-lg-10">
                        </a>
                        <h3 class="col-sm-6 col-md-4 col-lg-2 fw-bold text-white">รออนุมัติ</h3>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-2 bg-white rounded p-3">
                        <div class="table-responsive">
                            <table id="table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col" class="text-center">ลำดับ</th>
                                        <th scope="col">โครงการอบรม</th>
                                        <th scope="col" class="text-center">วันที่ลงทะเบียน</th>
                                        <th scope="col">สถานะ</th>
                                        <th scope="col" class="text-center">ตรวจสอบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1; // ตัวแปรสำหรับเก็บลำดับ
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $date = date("d/m/Y", strtotime($row['order_date']));
                                            $formattedTrainingDate = toDateThai($date);
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <p class=""><?php echo $counter ?></p>
                                                </td>
                                                <td>
                                                    <p class=""><?php echo $row["training_name"]; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?php echo $formattedTrainingDate; ?></p>
                                                </td>
                                                <td>
                                                    <p class="<?php echo ($row["order_status"] ? "approved" : "pending"); ?> bg-warning">
                                                        <i class="bi <?php echo ($row["order_status"] ? "la la-check-circle" : "la la-clock-o"); ?>"></i>
                                                        <?php echo ($row["order_status"] ? "อนุมัติแล้ว" : "รออนุมัติ"); ?>
                                                    </p>

                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-warning text-white" href="order_edit.php?order_id=<?php echo $row["order_id"]; ?>">
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger" name="del" onclick="confirmDelete(<?php echo $row['order_id']; ?>)">
                                                        <i class="la la-trash text-white"></i>
                                                    </a>

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
                    <div class="mt-5 row">
                        <a class="col-sm-6 col-md-4 col-lg-10">
                        </a>
                        <h3 class="col-sm-6 col-md-4 col-lg-2 fw-bold text-primary">อนุมัติแล้ว</h3>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-2 bg-white rounded p-3">
                        <div class="table-responsive">
                            <table id="table2" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr class=" table-primary">
                                        <th scope="col" class=" text-center">ลำดับ</th>
                                        <th scope="col" class="">โครงการอบรม</th>
                                        <th scope="col" class=" text-center">วันที่ลงทะเบียน</th>
                                        <th scope="col" class="">สถานะ</th>
                                        <th scope="col" class=" text-center">ตรวจสอบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1; // ตัวแปรสำหรับเก็บลำดับ
                                    if ($result2->num_rows > 0) {
                                        while ($row2 = $result2->fetch_assoc()) {
                                            $date = date("d/m/Y", strtotime($row2['order_date']));
                                            $formattedTrainingDate = toDateThai($date);
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <p class=""><?php echo $counter ?></p>
                                                </td>
                                                <td>
                                                    <p class=""><?php echo $row2["training_name"]; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?php echo $formattedTrainingDate; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="<?php echo ($row2["order_status"] ? "approved" : "pending"); ?> bg-success">
                                                        <i class="bi <?php echo ($row2["order_status"] ? "la la-check-circle" : "bi-x-circle"); ?>"></i>
                                                        <?php echo ($row2["order_status"] ? "อนุมัติแล้ว" : "รออนุมัติ"); ?>
                                                    </p>

                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary" href="order_view.php?order_id=<?php echo $row2["order_id"]; ?>">
                                                        <i class="la la-arrow-circle-o-right"></i>
                                                    </a>
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
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script src=" https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //dropdown
        document.addEventListener('DOMContentLoaded', function() {
            var dropdown = new bootstrap.Dropdown(document.querySelector('.dropdown'));
        });

        //TABLE
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
                    "width": "24%",
                    "targets": 1
                },
                {
                    "width": "12%",
                    "targets": 2
                },
                {
                    "width": "15%",
                    "targets": 3
                },
                {
                    "width": "15%",
                    "targets": 4
                },
            ]
        });

        //TABLE
        $('#table2').DataTable({
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
                    "width": "24%",
                    "targets": 1
                },
                {
                    "width": "12%",
                    "targets": 2
                },
                {
                    "width": "15%",
                    "targets": 3
                },
                {
                    "width": "15%",
                    "targets": 4
                },
            ]
        });


        function confirmDelete(orderId) {
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
                        url: "order_del.php",
                        data: {
                            id: orderId
                        },
                        success: function(response) {
                            // หากการลบสำเร็จ
                            Swal.fire({
                                title: "ลบสำเร็จ!",
                                text: "คุณได้ลบรายการแล้ว",
                                icon: "success"
                            }).then(() => {
                                window.location.href = "status.php?user_id=<?php echo $id; ?>";
                            });
                        },
                        error: function(error) {
                            // หากเกิดข้อผิดพลาดในการลบ
                            Swal.fire({
                                title: "ผิดพลาด!",
                                text: "ลบไม่สำเร็จ",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>