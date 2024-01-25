<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
if ($action == 'check_employee_number') {

    $where = ' WHERE employee_deleted_status = 0 ';
    $number = $_REQUEST['number'];
    $employee_id = $_REQUEST['employee_id'];
    if (!empty($employee_id)) {
        $where .= " AND employee_id != '" . $employee_id . "' ";
    }
    if (!empty($number)) {
        $where .= " AND employee_contact_no = '" . $number . "'  ";
        $select = "SELECT employee_contact_no FROM  employees $where ";
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

if ($action == 'check_employee') {
    $company_id = $_REQUEST['company_id'];
    $employee_code = $_REQUEST['employee_code'];
    if (!empty($company_id) && !empty($employee_code)) {
        $select = "SELECT employee_id FROM  employees WHERE employee_company_id = '" . $company_id . "'
        AND employee_code = '" . $employee_code . "' ";
        list($num_row, $records) = selectRow($select);
        if ($num_row > 0) {
            echo 1;
            exit;
        } else {
            echo 2;
            exit;
        }
    }
}


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
    $employee_id = $_REQUEST['employee_id'];
    $status = $_REQUEST['status'];
    $where = '';
    if (!empty($status) && $status == 'delete') {
        $where .= " employee_deleted_status = 1 ";
    } elseif (!empty($status) && $status == 'undo') {
        $where .= " employee_deleted_status = 0 ";
    }

    if (!empty($employee_id)) {
        $select_employee = "SELECT employee_code,employee_name FROM employees WHERE employee_id = '" . $employee_id . "' ";
        list($num_row, $records) = selectRow($select_employee);
        $update = "UPDATE   employees SET $where  WHERE employee_id=
'" . $employee_id . "' ";
        // echo $update;exit;
        $ids = update($update);

        if ($ids > 0) {
            $data = ((!empty($records['employee_code'])) ? $records['employee_code'] : '') . ' - ' . ((!empty($records['employee_name'])) ? ucfirst($records['employee_name']) : '');
        } else {
            $data = 2;
        }
        echo $data;
        exit;
    }
}
