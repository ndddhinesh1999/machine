<?php

include 'src/includes/config.php';
include 'src/includes/utility_function.php';

// $conn = $connection;
// $db = DATABASE;

if (!isset($_SESSION[SESS . 'session_admin_users_uniq_id'])) {
    // Model page
    require_once 'model.php';

    $financial_years = financialYears();

    if (isset($_POST['admin_users_login'])) {
        // User login function		
        adminUserAuthentication();
    }
    // View page	 
    require_once 'view.php';
} else {
    header("Location:" . PROJECT_PATH . "/src/html/home");
    exit();
}
