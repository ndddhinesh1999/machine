<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';
    $machine=machine_detail();
    $list_autonomous = listautonomous();
    $listCompany = listCompany();
    $listBranch = listBranch();
    $listLabels = selectLabel();
    if (isset($_POST['add_autonomous'])) {
        insertautonomous();
    }

    if (isset($_GET['autonomous_id'])) {
        $edit_autonomous = editautonomous();
    }
    if (isset($_POST['update_autonomous'])) {
        updateautonomous();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
