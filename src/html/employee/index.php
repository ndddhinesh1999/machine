<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';

if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
  
    include 'model.php';
    echo "dfdf";exit;
    $listCompany = listCompany();
    $listBranch = listBranch();
    $listDesignation = listDesignation();
    $listDepartment = listDepartment();
    $listEmployee = listEmployee();

    if (isset($_POST['add_employee'])) {
        addemployee();
    }

    if (isset($_GET['employee_id'])) {
        $edit_employee = editemployee();
    }
    if (isset($_POST['update_employee'])) {
        updateemployee();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
