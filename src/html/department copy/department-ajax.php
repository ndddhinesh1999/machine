<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

if ($action == 'get_branch') {
    $company_id = $_REQUEST['company_id'];
    $select = "SELECT branch_id,branch_name,branch_code FROM  branches WHERE branch_deleted_status = 0 AND branch_company_id = '" . $company_id . "' ";
    list($num_row, $records) = selectRows($select);

    $array = '<option value=""> Select </option>';
    foreach ($records as $get) {
        $array    .= '<option value="' . $get['branch_id'] . '">' . $get['branch_code'] . '-' . $get['branch_name'] .  '</option>';
    }
    echo $array;
    exit;
}

if ($action == 'delete_record') {
    $department_id = $_REQUEST['department_id'];
    $status = $_REQUEST['status'];
    $where = '';
    if (!empty($status) && $status == 'delete') {
        $where .= " department_deleted_status = 1 ";
    } elseif (!empty($status) && $status == 'undo') {
        $where .= " department_deleted_status = 0 ";
    }

    if (!empty($department_id)) {
        $select_department = "SELECT department_name FROM departments WHERE department_id = '" . $department_id . "' ";
        list($num_row, $records) = selectRow($select_department);
        $update = "UPDATE   departments SET $where  WHERE department_id=
'" . $department_id . "' ";
        // echo $update;exit;
        $ids = update($update);

        if ($ids > 0) {
            $data = ((!empty($records['department_name'])) ? ucfirst($records['department_name']) : '');
        } else {
            $data = 2;
        }
        echo $data;
        exit;
    }
}
