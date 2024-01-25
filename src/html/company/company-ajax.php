<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

if ($action == 'check_company_name') {
    $where = ' WHERE company_deleted_status=0 ';
    $company_name = $_REQUEST['company_name'];
    $company_id = $_REQUEST['company_id'];

    if (!empty($company_name)) {
        $where .= " AND company_name =  '" . $company_name . "' ";
    }
    if (!empty($company_id)) {
        $where .= " AND company_id !=  '" . $company_id . "' ";
    }

    if (!empty($company_name)) {

        $select = "SELECT company_name FROM  company $where ";
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
    $company_id = $_REQUEST['company_id'];
    $status = $_REQUEST['status'];
    $where = '';
    if (!empty($status) && $status == 'delete') {
        $where .= " company_deleted_status = 1 ";
    } elseif (!empty($status) && $status == 'undo') {
        $where .= " company_deleted_status = 0 ";
    }

    if (!empty($company_id)) {
        $select_company = "SELECT company_code,company_name FROM company WHERE company_id = '" . $company_id . "' ";
        list($num_row, $records) = selectRow($select_company);
        $update = "UPDATE   company SET $where  WHERE company_id=
'" . $company_id . "' ";
        // echo $update;exit;
        $ids = update($update);

        if ($ids > 0) {
            $data = ((!empty($records['company_code'])) ? $records['company_code'] : '') . ' - ' . ((!empty($records['company_name'])) ? ucfirst($records['company_name']) : '');
        } else {
            $data = 2;
        }
        echo $data;
        exit;
    }
}
