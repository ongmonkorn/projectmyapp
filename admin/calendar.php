<?php

include('../config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ปฏิทิน</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="../calendar/fonts/icomoon/style.css">

    <link href='../calendar/fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='../calendar/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../calendar/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="../calendar/css/style.css">
    <style>
        /* เพิ่ม CSS เพื่อกำหนดขนาด title */
        .fc-title {
            font-size: 8px;
            /* ขนาดตัวอักษรของ title */
        }
    </style>
</head>

<body>
    <?php include('menu.php'); ?>
    <div class="content p-2">
        <div id='calendar'></div>
    </div>
    <?php include('footer.php'); ?>

    <!-- <script src="../calendar/js/jquery-3.3.1.min.js"></script> -->
    <script src="../calendar/js/popper.min.js"></script>
    <script src="../calendar/js/bootstrap.min.js"></script>

    <script src='../calendar/fullcalendar/packages/core/main.js'></script>
    <script src='../calendar/fullcalendar/packages/interaction/main.js'></script>
    <script src='../calendar/fullcalendar/packages/daygrid/main.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid'],
                defaultDate: '2024-05-01',
                locale: 'th',
                editable: true,
                eventLimit: true,
                events: [<?php
                            $result = $conn->query("SELECT * FROM training");
                            while ($row = $result->fetch_assoc()) {
                                echo "{";
                                echo "title: '" . $row['training_name'] . "',";
                                echo "start: '" . $row['training_date'] . "',";
                                echo "end: '" . $row['training_enddate'] . "',";     // วันที่สิ้นสุด
                                echo "},";
                            }
                            ?>]
            });

            calendar.render();
        });

    </script>
    <script src="../calendar/js/main.js"></script>
</body>

</html>