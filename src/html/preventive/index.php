<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';
    $machine = machine_detail();
    $actively_details = actively();
    $preventive_list = preventive_list();
    if (isset($_POST['save'])) {
        CreateData();
    }

    if (isset($_REQUEST['page']) && !empty($_REQUEST['page'] == 'edit')) {
       $preventive_edit= preventive_edit();
    }
    include 'view.php';
} else {
    header("Location:../../../index.php");
}
