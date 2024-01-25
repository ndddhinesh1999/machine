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
    $designation_id = $_REQUEST['designation_id'];
    $status = $_REQUEST['status'];
    $where = '';
    if (!empty($status) && $status == 'delete') {
        $where .= " designation_deleted_status = 1 ";
    } elseif (!empty($status) && $status == 'undo') {
        $where .= " designation_deleted_status = 0 ";
    }

    if (!empty($designation_id)) {
        $select_designation = "SELECT designation_name FROM designations WHERE designation_id = '" . $designation_id . "' ";
        list($num_row, $records) = selectRow($select_designation);
        $update = "UPDATE   designations SET $where  WHERE designation_id=
'" . $designation_id . "' ";
        // echo $update;exit;
        $ids = update($update);

        if ($ids > 0) {
            $data = ((!empty($records['designation_name'])) ? ucfirst($records['designation_name']) : '');
        } else {
            $data = 2;
        }
        echo $data;
        exit;
    }
}
