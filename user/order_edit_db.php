<?php
include('../config.php');
session_start();

$targetDir = "slip/";

if (isset($_POST['edit'])) {
    if (!empty($_FILES["file"]["name"])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');


        if (in_array($fileType, $allowTypes)) {
            

            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                $update = $conn->query("UPDATE orders SET order_slip = '" . $fileName . "'  WHERE order_id = '$id' ");
                if ($update) {  
                    $_SESSION['editregtraining'] = "แก้ไขสลิป"; 
                    header('location: order_edit.php?order_id='.$id.'');
                    // // Include SweetAlert2 library and customize the alert
                    // echo '<script>';
                    // echo 'Swal.fire({';
                    // echo '  title: "สำเร็จ!",';
                    // echo '  text: "แก้ไขหลักฐานการชำระสำเร็จ",';
                    // echo '  icon: "success",';
                    // echo '  showConfirmButton: false,';
                    // echo '  timer: 1500';
                    // echo '}).then(() => {';
                    // echo '  window.location.href = "order_edit.php?order_id='.$id.' ";';
                    // echo '});';
                    // echo '</script>';
                    // // End of SweetAlert2 customization
                } else {
                    header("location: profile.php");
                }
            } else {
                $statusMsg = "Sorry, there was an eror uploading tour file.";
            }
        } else {
            $statusMsg = "Sorry, only JPG,JPEG, PNG & GIF files are aloowed to upload.";
        }
    } else {
        $statusMsg = "please select a file to upload.";
    }
}
?>