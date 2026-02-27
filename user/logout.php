
<?php
    include('../config.php');
    session_start();
    unset($_SESSION['user_id']);
    if (!isset($_SESSION['user-id'])) {
      $_SESSION['logout'] = "logout";
      header("Location: login.php");
    }
   
  