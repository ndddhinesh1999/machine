<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';

    $list_company = listcompany();

    if (isset($_POST['add_company'])) {
        insertcompany();
    }

    if (isset($_GET['company_id'])) {
        $edit_company = editcompany();
    }
    if (isset($_POST['update_company'])) {
        updatecompany();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
