<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';

    $list_designation = listdesignation();
    $listCompany = listCompany();
    $listBranch = listBranch();
    if (isset($_POST['add_designation'])) {
        insertdesignation();
    }

    if (isset($_GET['designation_id'])) {
        $edit_designation = editdesignation();
    }
    if (isset($_POST['update_designation'])) {
        updatedesignation();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
