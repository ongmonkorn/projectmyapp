<?php

session_start();
include('../config.php');
include('../month.php');


$sql = "SELECT * FROM user";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการรายชื่อผู้ใช้</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <style>
        .shadow {
            background-color: white;
            border-radius: 10px;
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
                    <h3 class="content-header-title">จัดการรายชื่อผู้ใช้</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">จัดการรายชื่อผู้ใช้
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="shadow col-xl-12 col-lg-12 mt-5 p-4">
                        <div class="table-responsive">
                            <table id="table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">คำนำหน้า</th>
                                        <th scope="col">ชื่อ</th>
                                        <th scope="col">นามสกุล</th>
                                        <th scope="col">อีเมล</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1; // ตัวแปรสำหรับเก็บลำดับ

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <p><?php echo $counter ?></p>
                                                </td>
                                                <td>
                                                    <p><?php echo $row['user_pname'] ?></p>
                                                </td>
                                                <td>
                                                    <p>
                                                        <?php echo $row['user_fname'] ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p>
                                                        <?php echo $row['user_lname'] ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class=""><?php echo $row["user_email"]; ?></p>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary" href="user_view.php?user_id=<?php echo $row['user_id'] ?>">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-warning text-white" href="user_edit.php?user_id=<?php echo $row['user_id'] ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <button class="btn btn-danger" name="del" onclick="confirmDelete(<?php echo $row['user_id'] ?>)">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
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
        //TABLE
        var table = $('#table').DataTable({
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
                    "width": "7%",
                    "targets": 1
                },
                {
                    "width": "15%",
                    "targets": 2
                },
                {
                    "width": "20%",
                    "targets": 3
                },
                {
                    "width": "10%",
                    "targets": 4
                },
                {
                    "width": "20%",
                    "targets": 5
                },
            ]
        });
    </script>
    <script>
        function confirmDelete(UserID) {
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
                        url: "user_del.php",
                        data: {
                            id: UserID
                        },
                        success: function(response) {
                            // หากการลบสำเร็จ
                            Swal.fire({
                                title: "ลบสำเร็จ!",
                                text: "คุณได้ลบรายการแล้ว",
                                icon: "success"
                            }).then(() => {
                                window.location.href = "user_list.php";
                            });
                        },
                        error: function(error) {
                            // หากเกิดข้อผิดพลาดในการลบ
                            Swal.fire({
                                title: "Error!",
                                text: "There was an error deleting the order.",
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