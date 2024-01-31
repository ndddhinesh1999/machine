<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';

    $list_machine = listmachine();
    $listCompany = listCompany();
    $listBranch = listBranch();
    if (isset($_POST['add_machine'])) {
        insertmachine();
    }

    if (isset($_GET['machine_id'])) {
        $edit_machine = editmachine();
    }
    if (isset($_POST['update_machine'])) {
        updatemachine();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
