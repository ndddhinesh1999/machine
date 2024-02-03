<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';

    $list_details = array("Autonomous Daily" => "autonomous-daily", "Autonomous Weekly" => "autonomous-weekly", "Preventive" => "preventive", "Break Down" => "breakdown", "History Card" => "history_card", "Predictive Check" => "predictive_check");

    $machine = machine_detail(isset($_REQUEST['m_id']) && !empty($_REQUEST['m_id']) ? $_REQUEST['m_id'] : '');
// print_r($machine);exit;
    // $list_department = listdepartment();
    $listCompany = listCompany();
    $listBranch = listBranch();
    if (isset($_POST['add_department'])) {
        insertdepartment();
    }

    if (isset($_GET['department_id'])) {
        $edit_department = editdepartment();
    }
    if (isset($_POST['update_department'])) {
        updatedepartment();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
