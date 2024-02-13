<?php
require_once('../../includes/config.php');
require_once('../../includes/customer_utility_function.php');


$term = isset($_REQUEST['term']) ? $_REQUEST['term'] : '';


$select = "SELECT machine_id,machine_name FROM machines WHERE 	machine_deleted_status=0 AND machine_active_status='active' AND machine_name LIKE '%" . $term . "%'";
list($row, $result) = selectRows($select);
// echo $select;exit;
$data = array();
foreach ($result as $record) {
    $data[] = array(
        'id' => $record['machine_id'],
        'value' => $record['machine_name']
    );
}

echo json_encode($data);
flush();
