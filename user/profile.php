<?php

include('../config.php');
session_start();

if (isset($_SESSION["user_id"])) {
    $id = $_SESSION["user_id"];
    $sql = "SELECT * FROM user WHERE user_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
}
include('../month.php');
$date = date("d/m/Y", strtotime($row['user_birthday']));
$formattedTrainingDate = toDateThai($date);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลส่วนตัว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .responsive-image {
            width: 100%;
            height: auto;

        }

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
                    <h3 class="content-header-title">ข้อมูลส่วนตัว</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">ระบบบริหารจัดการโครงการอบรม</a>
                                </li>
                                <li class="breadcrumb-item active">ข้อมูลส่วนตัว
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row match-height">
                <div class="col-xl-12 col-lg-12 p-4">
                    <div class="shadow p-2 mb-3">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="d-flex justify-content-center mt-2 p-4">
                                    <div class="rounded bg-light pt-2 px-2 pb-2">
                                        <img class="profile w-100" src="../images/upload/<?php echo $row['user_file']; ?>" alt="profile">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12 mt-3">
                                <form action="profile_edit_db.php" method="post">
                                    <div class="row d-none">
                                        <div class="col-12 my-3">
                                            <h3 class="text-center">ข้อมูลส่วนตัว</h3>
                                        </div>
                                        <div class="d-none">
                                            <input type="text" name="path" placeholder="เส้นทาง" value="profile_edit.php" readonly="">
                                            <input type="text" name="id" placeholder="ไอดี" value="<?php echo $row['user_id']; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 col-sm-12 mb-1">
                                            <div class="">
                                                <label class="text-black" for="pname">คำนำหน้า:</label>
                                                <input type="text" class="form-control border-primary" name="pname" value="<?php echo $row["user_pname"]; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-1">
                                            <div class="">
                                                <label class="text-black" for="fname">ชื่อ:</label>
                                                <input type="text" class="form-control border-primary" id="floatingInput" name="fname" placeholder="ชื่อ" value="<?php echo $row["user_fname"]; ?>" required="" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-1">
                                            <div class="">
                                                <label class="text-black" for="floatingInput">นามสกุล:</label>
                                                <input type="text" class="form-control border-primary" id="floatingInput" name="lname" placeholder="นามสกุล" value="<?php echo $row["user_lname"]; ?>" required="" readonly>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="">
                                                <label class="text-black" for="floatingInput">วัน/เดือน/ปีเกิด:</label>
                                                <input type="text" class="form-control border-primary" id="datepicker" name="birthday" placeholder="วันเกิด" value="<?php echo $formattedTrainingDate; ?>" required="" readonly>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="">
                                                <label class="text-black" for="floatingInput">เพศ: </label>
                                                <input type="text" class="form-control border-primary" id="floatingInput" name="email" placeholder="อีเมล" value="<?php echo $row["user_sex"]; ?>" required="" readonly>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="">
                                                <label class="text-black" for="floatingInput">อีเมล:</label>
                                                <input type="text" class="form-control border-primary" id="floatingInput" name="email" placeholder="อีเมล" value="<?php echo $row["user_email"]; ?>" required="" readonly>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 my-1">
                                            <div class="">
                                                <label class="text-black" for="floatingInput">เบอร์โทร:</label>
                                                <input type="text" class="form-control border-primary" id="floatingInput" name="tel" placeholder="เบอร์โทร" value="<?php echo $row["user_tel"]; ?>" required="" readonly>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 my-1">
                                            <div class="">
                                                <label class="text-black" for="floatingInput">ที่อยู่:</label>
                                                <input type="text" class="form-control border-primary" row="3" id="floatingInput" name="contact" placeholder="ที่อยู่" value="<?php echo $row["user_contact"]; ?>" required="" readonly>
                                                
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 my-1 text-center">
                            <a class="btn btn-warning" href="profile_edit.php?user_id=<?php echo $row['user_id']; ?>">แก้ไข</a>
                            <a class="btn btn-secondary" href="home.php">กลับ</a>
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