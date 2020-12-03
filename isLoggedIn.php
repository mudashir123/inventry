<?php
session_start();
if (!isset($_SESSION['admin_id'])) { 
    header('Location: login.php'); 
}

if (isset($_SESSION['user_type'])) { 
    if($_SESSION['user_type'] != 'admin'){
        header('Location: index.php'); 
    }
}

?>