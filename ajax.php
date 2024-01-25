<?php
include 'src/includes/config.php';
include 'src/includes/utility_function.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

if ($action == 'check_user_name') {
    $where = "WHERE admin_users_delete_status=0 ";
    $user_name = $_REQUEST['user_name'];
    if (!empty($user_name)) {
        $where .= " AND admin_users_user_name = '" . $user_name . "' ";
        $select = "SELECT admin_users_user_name FROM  admin_users $where ";
        list($num_row, $records) = selectRows($select);
        if ($num_row > 0) {
            echo 1;
            exit;
        } else {
            echo 2;
            exit;
        }
    }
}

