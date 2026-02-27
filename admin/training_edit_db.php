


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <?php

    include('../config.php');
    session_start();

    if (isset($_POST['edit_training'])) {
        $id = mysqli_real_escape_string($conn, $_POST['training_id']);
        $trainingName = mysqli_real_escape_string($conn, $_POST['training_name']);
        $details = mysqli_real_escape_string($conn, $_POST['training_details']);
        $limit = mysqli_real_escape_string($conn, $_POST['training_limit']);
        $budget = mysqli_real_escape_string($conn, $_POST['training_price']);
        $trainingDate = mysqli_real_escape_string($conn, $_POST['training_date']);
        $trainingDate2 = mysqli_real_escape_string($conn, $_POST['training_enddate']);
        $traininglecturer = mysqli_real_escape_string($conn, $_POST['training_lecturer']);
        $trainingPlace = mysqli_real_escape_string($conn, $_POST['training_place']);


        $update = $conn->query("UPDATE training SET 
                training_name = '$trainingName', 
                training_details = '$details',
                training_limit = '$limit',
                training_price = '$budget',
                training_date = '$trainingDate',
                training_enddate = '$trainingDate2',
                training_lecturer = '$traininglecturer',
                training_place = '$trainingPlace'
                WHERE training_id = $id");

        if ($update) {
            $_SESSION['editsuccess'] = 0;
            header('location: training_edit.php?training_id=' . $id);
        } else {
            $_SESSION['error'] = "Error updating training";
            header("location: training_edit.php");
        }
    } else {
        $_SESSION['error'] = "Error uploading file";
        header("location: training_edit.php");
    }

    ?>


