<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';
    $machine = machine_detail();
    $actively_details = actively();
    if (isset($_POST['save'])) {
        CreateData();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
