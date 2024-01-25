<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';

    $list_category = listcategory();
    $listCompany = listCompany();
    $listBranch = listBranch();
    if (isset($_POST['add_category'])) {
        insertcategory();
    }

    if (isset($_GET['category_id'])) {
        $edit_category = editcategory();
    }
    if (isset($_POST['update_category'])) {
        updatecategory();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
