<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';
    $machine = machine_detail();
    $list_breakdown = listbreakdown();
    $listCompany = listCompany();
    $listBranch = listBranch();
    
    if (isset($_POST['add_breakdown'])) {
        insertbreakdown();
    }

    if (isset($_GET['year_breakdown_id'])) {
        $edit_breakdown = editbreakdown();
        // print_r($edit_breakdown);exit;
    }
    if (isset($_POST['update_breakdown'])) {
        updatebreakdown();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
