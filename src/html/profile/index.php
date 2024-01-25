<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';
    
    if (isset($_POST['upload'])) {
        upload_image();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
