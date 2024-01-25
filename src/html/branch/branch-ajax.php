<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

if ($action == 'check_branch_name') {
    $where = ' WHERE branch_deleted_status=0 ';
    $branch_name = $_REQUEST['branch_name'];
    $company_id = $_REQUEST['company_id'];
    $branch_id = $_REQUEST['branch_id'];

    if (!empty($branch_name)) {
        $where .= " AND branch_name =  '" . $branch_name . "' ";
    }
    if (!empty($company_id)) {
        $where .= " AND branch_company_id =  '" . $company_id . "' ";
    }
    if (!empty($branch_id)) {
        $where .= " AND branch_id  !=  '" . $branch_id . "' ";
    }
    if (!empty($company_id) && (!empty($branch_name))) {

        $select = "SELECT branch_name FROM  branches $where ";
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


if ($action == 'check_branch_email') {
    $where = ' WHERE branch_deleted_status = 0 ';
    $branch_email = $_REQUEST['branch_email'];
    $branch_id = $_REQUEST['branch_id'];

    if (!empty($branch_id)) {
        $where .= " AND branch_id != '" . $branch_id . "' ";
    }
    if (!empty($branch_email)) {
        $select = "SELECT branch_id FROM  branches $where AND branch_email = '" . $branch_email . "' ";

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
if ($action == 'check_branch_code') {


    $where = ' WHERE branch_deleted_status = 0 ';
    $company_id = $_REQUEST['company_id'];
    $data_code = $_REQUEST['branch_code'];
    $branch_id = $_REQUEST['branch_id'];

    if (!empty($employee_id)) {
        $where .= " AND branch_id != '" . $branch_id . "' ";
    }
    if (!empty($data_code)) {
        $where .= " AND branch_code = '" . $data_code . "' AND branch_company_id = '" . $company_id . "'  ";
        $select = "SELECT branch_code FROM  branches $where ";

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

if ($action == 'delete_record') {
    $branch_id = $_REQUEST['branch_id'];
    $status = $_REQUEST['status'];
    $where = '';
    if (!empty($status) && $status == 'delete') {
        $where .= " branch_deleted_status = 1 ";
    } elseif (!empty($status) && $status == 'undo') {
        $where .= " branch_deleted_status = 0 ";
    }

    if (!empty($branch_id)) {
        $select_branch = "SELECT branch_code,branch_name FROM branches WHERE branch_id = '" . $branch_id . "' ";
        list($num_row, $records) = selectRow($select_branch);
        $update = "UPDATE   branches SET $where  WHERE branch_id=
'" . $branch_id . "' ";
        // echo $update;exit;
        $ids = update($update);

        if ($ids > 0) {
            $data = ((!empty($records['branch_code'])) ? $records['branch_code'] : '') . ' - ' . ((!empty($records['branch_name'])) ? ucfirst($records['branch_name']) : '');
        } else {
            $data = 2;
        }
        echo $data;
        exit;
    }
}
