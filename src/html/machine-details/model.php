<?php

function search_get_branch($company_id)
{
    $select = "SELECT branch_id,branch_name,branch_code FROM  branches WHERE branch_deleted_status = 0 AND branch_company_id = '" . $company_id . "' ";
    list($num_row, $records) = selectRows($select);
    return $records;
}
function listCompany()
{
    $where = "WHERE company_deleted_status =0";

    $select = "SELECT company_id,company_code,company_name FROM   company
     $where  ORDER BY  company_id   DESC ";
    // echo $select;die;
    list($count, $result) = selectRows($select);
    return $result;
}

function listBranch()
{
    $where = "WHERE branch_deleted_status =0";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND branch_id > 0 ";
    } else {
        $where .= " AND branch_company_id = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' ";
    }

    $select = "SELECT branch_id,branch_name,branch_code
    FROM   branches
    $where  ORDER BY  branch_id  DESC ";
    // echo $select;die;
    list($count, $result) = selectRows($select);
    return $result;
}

function lastDateDetails()
{

    $machine = machine_detail();
    $where = '';
    if (!empty($machine['machine_id']) && !empty($machine['machine_id'])) {
        $where .= " AND  machine_id = '" . $machine['machine_id'] . "'";
    }

    $select = "SELECT machine_id,machine_name,max(daily.autonomous_date) as daily_date,max(weekly.autonomous_date) as weekly_date,
    max(pre.preventive_main_date) as pre_date,max(bre.year_breakdown_date) as bre_date,max(his.history_card_date) as his_date,max(pred.predictive_date) as pred_date
    FROM machines
    LEFT JOIN autonomous as daily ON daily.autonomous_machine_id=machine_id AND daily.autonomous_type='1' 
    LEFT JOIN autonomous as weekly ON weekly.autonomous_machine_id=machine_id AND weekly.autonomous_type='2' 
    LEFT JOIN preventive_main as pre ON pre.preventive_main_machine_id=machine_id  
    LEFT JOIN year_breakdown as bre ON bre.year_breakdown_machine_id=machine_id
    LEFT JOIN history_card as his ON his.history_card_machine_id=machine_id  
    LEFT JOIN predictive as pred ON pred.predictive_machine_id=machine_id 
    WHERE machine_deleted_status='0' $where";

    list($row, $record) = selectRow($select);

    $list_details = array("Autonomous Daily" => "autonomous-daily", "Autonomous Weekly" => "autonomous-weekly", "Preventive" => "preventive", "Break Down" => "breakdown", "History Card" => "history-card", "Predictive Check" => "predictive-check");
    $arrayData = array();
    $arrayData['machine_id'] = $record['machine_id'];
    $arrayData['machine_name'] = $record['machine_name'];
    $i = '0';
    $j = '2';
    $array = array();
    foreach ($list_details as $menu) {
        $array[$i]['labe'] = $menu;
        $array[$i]['date'] = $record[$j++];

        $arrayData['menu'] = $array;
        $i++;
    }
    return $arrayData;
}

function editmachine()
{
    $machine = machine_detail();
    $where = '';
    if (!empty($machine['machine_id']) && !empty($machine['machine_id'])) {
        $where .= "WHERE   machine_id = '" . $machine['machine_id'] . "'";
    }

    $edit_machine = "SELECT * FROM  machines
        LEFT JOIN categorys ON category_id=machine_type
						$where LIMIT 1";

    list($count, $result) = selectRow($edit_machine);

    return $result;
}
