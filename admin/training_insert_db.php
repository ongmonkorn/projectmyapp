<?php
include('../config.php');
session_start();
$errors = array();
$statusMsg = "";

// $targetDir = "../images/";
$targetDir = "../user/slip/";


if (isset($_POST['insert_training'])) {
    if (!empty($_FILES["file"]["name"])) {
        $trainingName = mysqli_real_escape_string($conn, $_POST['training_name']);
        $details = mysqli_real_escape_string($conn, $_POST['training_details']);
        $limit = mysqli_real_escape_string($conn, $_POST['training_limit']);
        $budget = mysqli_real_escape_string($conn, $_POST['training_price']);
        $trainingDate = mysqli_real_escape_string($conn, $_POST['training_date']);
        $trainingEndDate = mysqli_real_escape_string($conn, $_POST['training_enddate']);
        $traininglecturer = mysqli_real_escape_string($conn, $_POST['training_lecturer']);
        $trainingPlace = mysqli_real_escape_string($conn, $_POST['training_place']);
        $fileName = basename($_FILES["file"]["name"]);
        // $fileName2 = basename($_FILES["file2"]["name"]);


        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');


        if (count($errors) == 0) {

            if (in_array($fileType, $allowTypes)) {

                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                    $insert = $conn->query("INSERT INTO training (training_name, training_details, training_limit, training_price, training_date, training_enddate, training_lecturer, training_place, training_budget) 
                    VALUES ('$trainingName', '$details', '$limit', '$budget', '$trainingDate', '$trainingEndDate', '$traininglecturer', '$trainingPlace', '" . $fileName . "') ");

                    if ($insert) {
                        $statusMsg = "The file <b>" . $fileName . "</b> has been uploaded successfully.";
                        $_SESSION['insertsuccess'] = "You are now logged in";
                        header('location: list_training.php');
                    } else {
                        $statusMsg = "file upload failed, please try again.";
                        array_push($errors, "Username or Email already exists");
                        $_SESSION['error'] = "Username or Email already exists";
                        header("location: regtraining.php");
                    }
                } else {
                    $statusMsg = "Sorry, there was an eror uploading tour file.";
                }
            } else {
                $FileName = "training.jpg";
                $insert = $conn->query("INSERT INTO training (training_name, training_details, training_limit, training_price, training_date, training_enddate, training_lecturer, training_place, training_image) 
                VALUES ('$trainingName', '$details', '$limit', '$budget', '$trainingDate', '$trainingEndDate', '$traininglecturer', '$trainingPlace', '" . $FileName . "') ");

                if ($insert) {
                    $_SESSION['success'] = "You are now logged in";
                    header('location: training_insert.php');
                }
            }
        } else {
            $statusMsg = "please select a file to upload.";
        }
    } else {
        $trainingName = mysqli_real_escape_string($conn, $_POST['training_name']);
        $details = mysqli_real_escape_string($conn, $_POST['training_details']);
        $limit = mysqli_real_escape_string($conn, $_POST['training_limit']);
        $budget = mysqli_real_escape_string($conn, $_POST['training_price']);
        $trainingDate = mysqli_real_escape_string($conn, $_POST['training_date']);
        $trainingEndDate = mysqli_real_escape_string($conn, $_POST['training_enddate']);
        $traininglecturer = mysqli_real_escape_string($conn, $_POST['training_lecturer']);
        $trainingPlace = mysqli_real_escape_string($conn, $_POST['training_place']);
        $FileName = "training.jpg";
        $insert = $conn->query("INSERT INTO training (training_name, training_details, training_limit, training_price, training_date, training_enddate, training_lecturer, training_place, training_image) 
    VALUES ('$trainingName', '$details', '$limit', '$budget', '$trainingDate', '$trainingEndDate', '$traininglecturer', '$trainingPlace', '" . $FileName . "') ");

        if ($insert) {
            $_SESSION['success'] = "You are now logged in";
            header('location: training_insert.php');
        }
    }
}
