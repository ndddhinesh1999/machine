<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';

    $list_branch = listbranch();
    $listCompany = listCompany();
    if (isset($_POST['add_branch'])) {
        insertbranch();
    }

    if (isset($_GET['branch_id'])) {
        $edit_branch = editbranch();
    }
    if (isset($_POST['update_branch'])) {
        updatebranch();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
