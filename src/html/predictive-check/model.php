<?php
function CreateData()
{
    $ip = getRealIpAddr();
    $uniq_id =    generateUniqId();
    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $company_id = dataValidation($_POST['company_id']);
        $branch_id = dataValidation($_POST['branch_id']);
    } else {
        $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
        $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
    }
    $machine_id = $_POST['machine_id'];



    $insert_main = "INSERT INTO  predictive  SET 
    predictive_uniq_id                 = '" . $uniq_id . "',
    predictive_machine_id             = '" . $machine_id . "',
    predictive_date                    = '" . dateDatabaseFormat($_POST['date']) . "',
    predictive_company_id              ='" . $company_id . "',												
    predictive_added_by                ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
    predictive_added_on                =UNIX_TIMESTAMP(NOW()),
    predictive_added_ip                ='" . $ip . "'";

    $main_id = insert($insert_main);
    $select_machine = "SELECT * FROM `machines` WHERE machine_deleted_status =0 AND machine_id='" . $machine_id . "' AND  machine_previously_maintanance >'" . dateDatabaseFormat($_POST['date']) . "' ORDER BY machine_previously_maintanance DESC LIMIT 1";

    list($row, $result) = selectRow($select_machine);
    if ($row > 0) {
        $update_machine = "UPDATE machines SET machine_previously_maintanance='" . $result['machine_previously_maintanance'] . "' WHERE  machine_id='" . $machine_id . "' ";
    } else {
        $update_machine = "UPDATE machines SET machine_previously_maintanance='" . dateDatabaseFormat($_POST['date']) . "' WHERE machine_id='" . $machine_id . "' ";
    }
    update($update_machine);

    foreach ($_POST['activity_id'] as $get_activity) {
        $i = 0;
        foreach ($_REQUEST['activity_detail_id' . $get_activity] as $get_activity_detail) {
            $activity = $get_activity;
            $activity_detail = $get_activity_detail;
            $remark = $_POST['remarks' . $activity][$i];
            $before_image = '';
            $after_image = '';

            $paths = '../../uploads/predictive/' . date('Y') . '/' . date('m') . '/';

            if (!empty($_FILES["before_image" . $activity]["tmp_name"][$i])) {
                $nameOfFile = fileUpload($_FILES["before_image" . $activity]["name"][$i], $_FILES["before_image" . $activity]["tmp_name"][$i], 'before_image', $paths);
                $before_image = $paths . $nameOfFile;
            }
            if (!empty($_FILES["after_image" . $activity]["tmp_name"][$i])) {
                $nameOfFileAft = fileUpload($_FILES["after_image" . $activity]["name"][$i], $_FILES["after_image" . $activity]["tmp_name"][$i], 'after_image', $paths);
                $after_image = $paths . $nameOfFileAft;
            }
            if (!empty($remark) && !empty($before_image) && !empty($after_image)) {

                $insert = "INSERT INTO  predictive_detail  SET 
                              preventive_uniq_id              = '" . $uniq_id . "',
                              preventive_machine_id           = '" . $machine_id . "',
                              preventive_activity_detail_id   = '" . $activity_detail . "',
                              predictive_detail_predictive_id = '" . $main_id . "',
                              preventive_before_text          ='" . $remark . "' ,
                              preventive_before_file          ='" . $before_image . "' ,
                              preventive_after_file           ='" . $after_image . "' ,
                                
                              preventive_company_id           ='" . $company_id . "',												
                              preventive_added_by             ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
                              preventive_added_on             =UNIX_TIMESTAMP(NOW()),
                              preventive_added_ip             ='" . $ip . "'";
                insert($insert);
            }
            $i++;
        }
    }
    // }
    header("location:index.php");
    exit;
}

function actively()
{
    $select = "SELECT * FROM predictive_labels
    WHERE 	predictive_label_active_status='active' AND	predictive_label_deleted_status=0";

    list($row, $result) = selectRows($select);
    $array = array();
    $i = 0;
    foreach ($result as $record) {
        $array[$i]['activity_id'] = $record['predictive_label_id'];
        $array[$i]['activity_name'] = $record['predictive_label_name'];
        $select1 = "SELECT * FROM predictive_label_details
        WHERE predictive_label_detail_active_status='active' AND predictive_label_detail_deleted_status=0 AND predictive_label_detail_predictive_label_id='" . $record['predictive_label_id'] . "'";

        list($row, $result1) = selectRows($select1);
        $array1 = array();
        $j = 0;
        foreach ($result1 as $record1) {
            $array1[$j]['activity_detail_id'] = $record1['predictive_label_detail_id'];
            $array1[$j]['activity_detail_name'] = $record1['predictive_label_detail_name'];
            $array1[$j]['activity_details_plan'] = $record1['predictive_label_details_plan'];
            $j++;
        }
        $array[$i]['details'] = $array1;
        $i++;
    }
    return $array;
}

function preventive_list()
{

    $where = "";

    $machine = machine_detail();
    if (!empty($machine['machine_id']) && !empty($machine['machine_id'])) {
        $where .= " AND  predictive_machine_id = '" . $machine['machine_id'] . "'";
    }

    if (isset($_REQUEST['from_date']) && isset($_REQUEST['to_date']) && !empty($_REQUEST['from_date'])  && !empty($_REQUEST['to_date'])) {
        $where .= "AND  predictive_date BETWEEN '" . dateDatabaseFormat($_REQUEST['from_date']) . "' AND '" . dateDatabaseFormat($_REQUEST['to_date']) . "'";
    }

    $select = "SELECT * FROM predictive 
    LEFT JOIN predictive_detail ON preventive_id=predictive_detail_predictive_id 
    WHERE predictive_deleted_status =0 $where";
    list($row, $result) = selectRows($select);
    $array = array();
    $i = 0;
    foreach ($result as $get) {
        $array[$i]['id'] = $get['predictive_id'];
        $array[$i]['date'] = $get['predictive_date'];
        $i++;
    }

    return $array;
}
function preventive_edit()
{
    $where = "";

    $machine = machine_detail();
    if (!empty($machine['machine_id']) && !empty($machine['machine_id'])) {
        $where .= " AND  predictive_machine_id = '" . $machine['machine_id'] . "'";
    }

    if (isset($_REQUEST['from_date']) && isset($_REQUEST['to_date']) && !empty($_REQUEST['from_date'])  && !empty($_REQUEST['to_date'])) {
        $where .= "AND  predictive_date BETWEEN '" . dateDatabaseFormat($_REQUEST['from_date']) . "' AND '" . dateDatabaseFormat($_REQUEST['to_date']) . "'";
    }

    $select = "SELECT * FROM predictive 
    LEFT JOIN machines ON machine_id=predictive_machine_id
    WHERE predictive_deleted_status =0 AND predictive_id='" . $_REQUEST['id'] . "' $where";

    list($count, $result) = selectRow($select);
    $arrD = array();

    $arrD['machine_id']  = $result['machine_id'];
    $arrD['machine_name']  = $result['machine_name'];
    $arrD['predictive_id ']  = $result['predictive_id'];
    $arrD['deleted_status'] = $result['predictive_deleted_status'];
    $arrD['date'] = $result['predictive_date'];

    return $arrD;
}

function details($machine_id, $activity_detail_id)
{
    $select_details = "SELECT * FROM  predictive_detail  
    LEFT JOIN predictive_label_details ON  predictive_label_detail_id = preventive_activity_detail_id  
    LEFT JOIN predictive_labels ON  predictive_label_id = predictive_label_detail_predictive_label_id   
    WHERE   predictive_label_detail_id ='" . $activity_detail_id . "'   ORDER BY preventive_activity_detail_id ASC";
    list($row, $records) = selectRow($select_details);

    $arrayData = array();
    if ($row > 0) {
        $arrayData['activity_detail_id']            = $records['predictive_label_detail_id'];
        $arrayData['activity_detail_name']          = $records['predictive_label_detail_name'];
        $arrayData['activity_details_plan']         = $records['predictive_label_details_plan'];
        $arrayData['preventive_before_text']        = $records['preventive_before_text'];
        $arrayData['preventive_before_file']        = $records['preventive_before_file'];
        $arrayData['preventive_after_file']         = $records['preventive_after_file'];
    }

    return $arrayData;
}


function preventive_pdf_list()
{

    $where = "";

    $machine = machine_detail();
    if (!empty($machine['machine_id']) && !empty($machine['machine_id'])) {
        $where .= " AND  predictive_machine_id = '" . $machine['machine_id'] . "'";
    }

    if (isset($_REQUEST['from_date']) && isset($_REQUEST['to_date']) && !empty($_REQUEST['from_date'])  && !empty($_REQUEST['to_date'])) {
        $where .= "AND  predictive_date BETWEEN '" . dateDatabaseFormat($_REQUEST['from_date']) . "' AND '" . dateDatabaseFormat($_REQUEST['to_date']) . "'";
    }

    $select = "SELECT * FROM predictive 
    LEFT JOIN machines ON machine_id=predictive_machine_id
    WHERE predictive_deleted_status =0 $where";

    list($count, $record) = selectRows($select);
    $arrD = array();
    $k = 0;
    foreach ($record as $result) {
        $arrD[$k]['deleted_status'] = $result['predictive_deleted_status'];
        $arrD[$k]['dates'] = $result['predictive_date'];

        if ($count > 0) {
            $select_activity = "SELECT * FROM  predictive_detail  
            LEFT JOIN predictive_label_details ON  predictive_label_detail_id = preventive_activity_detail_id  
            LEFT JOIN predictive_labels ON  predictive_label_id = predictive_label_detail_predictive_label_id   
            WHERE  preventive_deleted_status = 0 
            AND predictive_detail_predictive_id ='" . $result['predictive_id'] . "' GROUP BY  predictive_label_id  ORDER BY predictive_label_id ASC";

            list($row, $result_activity) = selectRows($select_activity);
            $i = 0;
            $arrLabel = array();
            foreach ($result_activity as $get) {
                $select_details = "SELECT * FROM  predictive_detail  
            LEFT JOIN predictive_label_details ON  predictive_label_detail_id = preventive_activity_detail_id  
            LEFT JOIN predictive_labels ON  predictive_label_id = predictive_label_detail_predictive_label_id   
            WHERE  preventive_deleted_status = 0 
            AND predictive_detail_predictive_id ='" . $result['predictive_id'] . "' AND predictive_label_id='" . $get['predictive_label_id'] . "'   ORDER BY preventive_activity_detail_id ASC";

                list($row, $result_details) = selectRows($select_details);
                $j = 0;
                $arrayData = array();
                foreach ($result_details as $records) {
                    $arrayData[$j]['activity_detail_id']           = $records['predictive_label_detail_id'];
                    $arrayData[$j]['activity_detail_name']         = $records['predictive_label_detail_name'];
                    $arrayData[$j]['activity_details_plan']        = $records['predictive_label_details_plan'];
                    $arrayData[$j]['preventive_before_text']       = $records['preventive_before_text'];
                    $arrayData[$j]['preventive_before_file']       = $records['preventive_before_file'];
                    $arrayData[$j]['preventive_after_file']        = $records['preventive_after_file'];
                    $j++;
                }

                $arrLabel[$i]['activity_id'] = $get['predictive_label_id'];
                $arrLabel[$i]['activity_name'] = $get['predictive_label_name'];
                $arrLabel[$i]['activity_details'] = $arrayData;
                $i++;
            }
            $arrD[$k]['details']      = $arrLabel;
        }
        $k++;
    }

    return $arrD;
}