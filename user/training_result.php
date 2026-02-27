<?php

include('../config.php');
session_start();

$id = $_SESSION["user_id"];
$sql = "SELECT orders.*, training.*, user.* FROM orders
JOIN training ON orders.training_id = training.training_id
JOIN user ON orders.user_id = user.user_id WHERE orders.order_status = 1 AND orders.user_id = '$id'";
$result = $conn->query($sql);

$sql = "SELECT * FROM training";
$query = mysqli_query($conn, $sql);
$training = mysqli_fetch_array($query, MYSQLI_ASSOC);

// $sql2 = "SELECT orders.*, training.*, user.* FROM orders
// JOIN training ON orders.training_id = training.training_id
// JOIN user ON orders.user_id = user.user_id WHERE order_status = 1";
// $result2 = $conn->query($sql2);

include('../month.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลการอบรม</title>
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
                    <h3 class="content-header-title">ผลการอบรม</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">ผลการอบรม
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="row mt-4">
                        <a class="col-sm-6 col-md-4 col-lg-9">
                        </a>
                        <h3 class="col-sm-6 col-md-4 col-lg-3 fw-bold text-white">ผลการอบรม</h3>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-2 bg-white rounded p-3">
                        <div class="table-responsive">
                            
                                <table id="table" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr class="table-primary">
                                            <th scope="col" class="text-center">ลำดับ</th>
                                            <th scope="col" class="text-center">ชื่อผู้เข้าอบรม</th>
                                            <th scope="col">โครงการอบรม</th>
                                            <th scope="col" class="text-center">วันที่อบรม</th>
                                            <th scope="col">ผลการอบรม</th>
                                            <!-- <th scope="col" class="text-center">บันทึก</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1; // ตัวแปรสำหรับเก็บลำดับ
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $date = date("d/m/Y", strtotime($row['training_date']));
                                                $date2 = date("d/m/Y", strtotime($row['training_enddate']));
                                                $formattedTrainingDate = toDateThai($date);
                                                $formattedTrainingDate2 = toDateThai($date2);
                                        ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <p class=""><?php echo $counter ?></p>
                                                        <input type="text" class="d-none" name="order_id[]" value="<?php echo $row['order_id']; ?>">
                                                    </td>
                                                    <td>
                                                        <p><?php echo $row['user_pname'] . " " . $row['user_fname'] . " " . $row['user_lname'] ?></p>
                                                    </td>
                                                    <td>
                                                        <p class=""><?php echo $row["training_name"]; ?></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p><?php echo $formattedTrainingDate . " - " .  $formattedTrainingDate2; ?></p>
                                                    </td>
                                                    <td>

                                                        <p><?php echo $row['order_result'];?></p>


                                                    </td>
                                                    <!-- <td class="text-center">
                                                    <a class="btn btn-warning text-white" href="approve.php?order_id=<?php echo $row['order_id']; ?>">
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                </td> -->
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
        $('#table').DataTable({
            info: true,
            ordering: true,
            paging: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/2.0.3/i18n/th.json"
            },
            "columnDefs": [{
                    "width": "3%",
                    "targets": 0
                },
                {
                    "width": "18%",
                    "targets": 1
                },
                {
                    "width": "24%",
                    "targets": 2
                },
                {
                    "width": "26%",
                    "targets": 3
                },
                {
                    "width": "10%",
                    "targets": 4
                },

            ]
        });
    </script>
</body>

</html>