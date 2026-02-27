<?php
include('../config.php');
session_start();
$errors = array();
$statusMsg = "";

$targetDir = "../images/upload/";

if (isset($_POST['change_img'])) {
    if (!empty($_FILES["file"]["name"])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');


        if (in_array($fileType, $allowTypes)) {
            

            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                $update = $conn->query("UPDATE user SET user_file = '" . $fileName . "'  WHERE user_id = '$id' ");
                if ($update) {
                    $statusMsg = "The file <b>" . $fileName . "</b> has been uploaded successfully.";
                    $_SESSION['imgsuccess'] = true;
                    header('location: user_edit.php?user_id='.$id.'');
                } else {
                    header("location: user_edit.php?user_id='.$id.'");
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
