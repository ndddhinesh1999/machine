<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';


$password = $_REQUEST['password'];
if (!empty($password)) {
    $newpass = md5($password);
    $query = "SELECT admin_users_password from admin_users WHERE admin_users_delete_status = 0 AND admin_users_password='" . $newpass . "' AND 
    admin_users_id ='" . $_SESSION[SESS . 'session_admin_users_id'] . "' ";
    list($num_rows, $arr_data) = selectRow($query);
    // echo $query;
    // exit;
    if ($num_rows > 0) {
        $data = 2;
    } else {
        $data = 1;
    }
} else {
    $data = 3;
}
echo $data;
exit;
