
    <?php


    include('../config.php');
    session_start();

    if (isset($_POST['edit'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $pname = mysqli_real_escape_string($conn, $_POST['pname']);
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $sex = mysqli_real_escape_string($conn, $_POST['sex']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);

        $sql = "SELECT * FROM user WHERE user_email = '$email' AND user_id <> '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['emailerror'] = "อีเมลถูกใช้ไปแล้ว";
            header('location: profile_edit.php?user_id=' . $id . '');
        } else {
            $query = "UPDATE user SET 
            user_pname = '$pname', 
            user_fname = '$fname',
            user_lname = '$lname', 
            user_tel = '$tel', 
            user_sex = '$sex', 
            user_email = '$email',
            user_contact = '$contact', 
            user_birthday ='$birthday' 
            WHERE user_id = '$id' ";
            $result = mysqli_query($conn, $query);
            $_SESSION['editsuccess'] = "แก้ไขข้อมูลสำเร็จ";
            header('location: profile_edit.php?user_id=' . $id . '');
            // echo '<script>';
            // echo 'Swal.fire({';
            // echo '  title: "สำเร็จ!",';
            // echo '  text: "แก้ไขข้อมูลส่วนตัวสำเร็จ",';
            // echo '  icon: "success",';
            // echo '  showConfirmButton: false,';
            // echo '  timer: 1500';
            // echo '}).then(() => {';
            // echo '  window.location.href = "profile_edit.php?user_id=' . $id . ' ";';
            // echo '});';
            // echo '</script>';
        }
    }
    ?>

    