<?php
include('../config.php');
session_start();

$targetDir = "../user/slip/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_FILES["file"]["name"])) {
        $id = mysqli_real_escape_string($conn, $_POST['training_id']);
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');


        if (in_array($fileType, $allowTypes)) {


            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                $update = $conn->query("UPDATE training SET training_budget = '" . $fileName . "'  WHERE training_id = '$id' ");
                if ($update) {
                    $_SESSION['edit_slip'] = 1;
                    header('location: training_edit.php?training_id=' . $id);
                } else {
                    $_SESSION['error_image'];
                    header('location: training_edit.php?training_id=' . $id);
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
