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


    $insert_main = "INSERT INTO  preventive_main  SET 
    preventive_main_uniq_id                 = '" . $uniq_id . "',
    preventive_maine_machine_id             = '" . $machine_id . "',
    preventive_main_date                    = '" . date('Y-m-d') . "',
    preventive_main_company_id              ='" . $company_id . "',												
    preventive_main_added_by                ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
    preventive_main_added_on                =UNIX_TIMESTAMP(NOW()),
    preventive_main_added_ip                ='" . $ip . "'";

    $main_id = insert($insert_main);

    foreach ($_POST['activity_id'] as $get_activity) {
        $i = 0;
        foreach ($_REQUEST['activity_detail_id' . $get_activity] as $get_activity_detail) {
            $activity = $get_activity;
            $activity_detail = $get_activity_detail;
            $remark = $_POST['remarks' . $activity][$i];
            $before_image = '';
            $after_image = '';

            $paths = '../../uploads/preventive/' . date('Y') . '/' . date('m') . '/';

            if (!empty($_FILES["before_image" . $activity]["tmp_name"][$i])) {
                $nameOfFile = fileUpload($_FILES["before_image" . $activity]["name"][$i], $_FILES["before_image" . $activity]["tmp_name"][$i], 'before_image', $paths);
                $before_image = $paths . $nameOfFile;
            }
            if (!empty($_FILES["after_image" . $activity]["tmp_name"][$i])) {
                $nameOfFileAft = fileUpload($_FILES["after_image" . $activity]["name"][$i], $_FILES["after_image" . $activity]["tmp_name"][$i], 'after_image', $paths);
                $after_image = $paths . $nameOfFileAft;
            }
            if (!empty($remark) && !empty($before_image) && !empty($after_image)) {

                $insert = "INSERT INTO  preventives  SET 
                              preventive_uniq_id              = '" . $uniq_id . "',
                              preventive_machine_id           = '" . $machine_id . "',
                              preventive_activity_detail_id   = '" . $activity_detail . "',
                              preventives_main_id             = '" . $main_id . "',
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
    $select = "SELECT * FROM activitys
    WHERE activity_active_status='active' AND activity_deleted_status=0";
    list($row, $result) = selectRows($select);
    $array = array();
    $i = 0;
    foreach ($result as $record) {
        $array[$i]['activity_id'] = $record['activity_id'];
        $array[$i]['activity_name'] = $record['activity_name'];
        $select1 = "SELECT * FROM activity_details
        WHERE activity_detail_active_status='active' AND activity_detail_deleted_status=0 AND activity_detail_activity_id='" . $record['activity_id'] . "'";
        list($row, $result1) = selectRows($select1);
        $array1 = array();
        $j = 0;
        foreach ($result1 as $record1) {
            $array1[$j]['activity_detail_id'] = $record1['activity_detail_id'];
            $array1[$j]['activity_detail_name'] = $record1['activity_detail_name'];
            $array1[$j]['activity_details_plan'] = $record1['activity_details_plan'];
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
    if (isset($_REQUEST['from_date']) && isset($_REQUEST['to_date']) && !empty($_REQUEST['from_date'])  && !empty($_REQUEST['to_date'])) {
        $where .= "AND  preventive_main_date BETWEEN '" . dateDatabaseFormat($_REQUEST['from_date']) . "' AND '" . dateDatabaseFormat($_REQUEST['to_date']) . "'";
    }

    $select = "SELECT * FROM preventive_main 
    LEFT JOIN preventives ON preventive_id=preventives_main_id 
    WHERE preventive_main_deleted_status =0 $where";
    list($row, $result) = selectRows($select);
    $array = array();
    $i = 0;
    foreach ($result as $get) {
        $array[$i]['id'] = $get['preventive_main_date'];
        $array[$i]['date'] = $get['preventive_main_date'];
        $i++;
    }

    return $array;
}
