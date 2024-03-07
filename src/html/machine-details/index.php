<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';



    $machine_insert_json = insert_machine_detail(isset($_REQUEST['m_id']) && !empty($_REQUEST['m_id']) ? $_REQUEST['m_id'] : '');
    $machine = machine_detail();

    $listCompany = listCompany();
    $listBranch = listBranch();
    $lastDateDetails = lastDateDetails();
    if (isset($_POST['update_department'])) {
        updatedepartment();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
