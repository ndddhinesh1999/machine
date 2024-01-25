<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';

    $listDesignation = listDesignation();
    $listDepartment = listDepartment();
    $listCompany = listCompany();
    $listBranch = listBranch();
    $listAttendance = listAttendance();
    
    $listAttendanceReport = listAppAttendanceReport();

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
