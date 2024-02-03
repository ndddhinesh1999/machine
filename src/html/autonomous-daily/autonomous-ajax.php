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
    $autonomous_id = $_REQUEST['autonomous_id'];
    $status = $_REQUEST['status'];
    $where = '';
    if (!empty($status) && $status == 'delete') {
        $where .= " autonomous_deleted_status = 1 ";
    } elseif (!empty($status) && $status == 'undo') {
        $where .= " autonomous_deleted_status = 0 ";
    }

    if (!empty($autonomous_id)) {
        $select_autonomous = "SELECT autonomous_name FROM autonomouss WHERE autonomous_id = '" . $autonomous_id . "' ";
        list($num_row, $records) = selectRow($select_autonomous);
        $update = "UPDATE   autonomouss SET $where  WHERE autonomous_id=
'" . $autonomous_id . "' ";
        // echo $update;exit;
        $ids = update($update);

        if ($ids > 0) {
            $data = ((!empty($records['autonomous_name'])) ? ucfirst($records['autonomous_name']) : '');
        } else {
            $data = 2;
        }
        echo $data;
        exit;
    }
}
