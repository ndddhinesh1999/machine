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

function listDesignation()
{
    $where = "WHERE designation_deleted_status = 0 ";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND designation_id  > 0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= " AND designation_company_id = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'branch') {
        $where .= " AND designation_company_id = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' ";
        $where .= " AND designation_branch_id = '" . $_SESSION[SESS . 'session_admin_users_branch_id'] . "' ";
    }

    $select = "SELECT designation_id,designation_name
    FROM   designations
    $where  ORDER BY  designation_id  DESC ";
    // echo $select;die;
    list($count, $result) = selectRows($select);
    return $result;
}
function listDepartment()
{
    $where = "WHERE department_deleted_status = 0 ";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND department_id   > 0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= " AND department_company_id = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'branch') {
        $where .= " AND department_company_id = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' ";
        $where .= " AND department_branch_id = '" . $_SESSION[SESS . 'session_admin_users_branch_id'] . "' ";
    }

    $select = "SELECT department_id ,department_name
    FROM   departments
    $where  ORDER BY  department_id   DESC ";
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

function listAttendance()
{
    // Search tds record form database table
    $where = " attendance_detail_deleted_status  = 0 ";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND attendance_detail_id  > 0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= " AND attendance_detail_company_id = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'branch') {
        $where .= " AND attendance_detail_company_id = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' ";
        $where .= " AND attendance_detail_branch_id  = '" . $_SESSION[SESS . 'session_admin_users_branch_id'] . "' ";
    }

    if (isset($_POST['search'])) {
        if (!empty($_REQUEST['search_company_id'])) {
            $where .= " AND  attendance_detail_company_id ='" . $_REQUEST['search_company_id'] . "'";
        }
        if (!empty($_REQUEST['search_branch_id'])) {
            $where .= " AND  attendance_detail_branch_id   ='" . $_REQUEST['search_branch_id'] . "'";
        }
        if (!empty($_REQUEST['search_designation_id'])) {
            $where .= " AND  employee_designation_id  ='" . $_REQUEST['search_designation_id'] . "'";
        }
        if (!empty($_REQUEST['search_department_id'])) {
            $where .= " AND  employee_department_id  ='" . $_REQUEST['search_department_id'] . "'";
        }

        if (!empty($_REQUEST['search_employee_name'])) {
            $where .= " AND  employee_name  LIKE '%" . dataValidation($_REQUEST['search_employee_name']) . "%' ";
        }
    }

    $select_records = "SELECT employee_code,branch_name,employee_name,department_name,designation_name,attendance_detail_date,attendance_detail_location,attendance_detail_time  FROM  attendance_detail
    LEFT JOIN  employees ON attendance_detail_emp_id=employee_id
    LEFT JOIN  branches ON branch_id=employee_branch_id 
    LEFT JOIN  departments ON department_id=employee_department_id
    LEFT JOIN  designations ON designation_id=employee_designation_id 
    LEFT JOIN  company ON company_id=employee_company_id
	 WHERE $where ";
    //  echo $select_records;exit;
    list($count, $result) = selectRows($select_records);
    return $result;
}

function listAppAttendanceReport()
{
    $where = '';
    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= "AND attendance_detail_deleted_status  =0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= "AND attendance_detail_deleted_status  =0 AND attendance_detail_company_id='" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' ";
    } else {
        $where .= "AND attendance_detail_deleted_status  =0 AND attendance_detail_branch_id='" . $_SESSION[SESS . 'session_admin_users_branch_id'] . "' ";
    }

    $from_date = date("Y-m-01");
    $to_date = date('Y-m-d');

    if (!empty($_REQUEST['from_date']) && !empty($_REQUEST['to_date'])) {
        $where .= "AND attendance_detail_date  BETWEEN '" . dateDatabaseFormat($_REQUEST['from_date']) . "' AND '" . dateDatabaseFormat($_REQUEST['to_date']) . "' ";
    } else {
        $where .= "AND attendance_detail_date  BETWEEN '" . dateDatabaseFormat($from_date) . "' AND '" . dateDatabaseFormat($to_date) . "' ";
    }

    if (!empty($_REQUEST['employee_id'])) {
        $where .= "AND attendance_detail_emp_id   = '" . $_REQUEST['employee_id'] . "'";
    }
    if (!empty($_REQUEST['search_branch_id'])) {
        $where .= "AND attendance_detail_branch_id  = '" . $_REQUEST['search_branch_id'] . "'";
    }

    $location = '';
    if ($_SESSION[SESS . 'session_admin_users_level'] == "attendance") {
        $location = " AND employee_location_id = '" . $_SESSION[SESS . 'session_admin_users_location_id'] . "' ";
    }
    // $query  = "SELECT * FROM attendance_detail
    //                   LEFT JOIN employees ON employee_id = attendance_detail_emp_id 
    //                   LEFT JOIN branches ON  branch_id = employee_branch_id 
    //                   LEFT JOIN designations ON designation_id = employee_designation_id
    //                   LEFT JOIN departments ON department_id   = employee_department_id
    //                   WHERE attendance_detail_source ='app' $where
    //                   GROUP BY attendance_detail_date , attendance_detail_emp_id 
    //                   ORDER BY attendance_detail_date DESC";


    $query = "SELECT *, (SELECT MAX(attendance_detail_datetime)  FROM attendance_detail 
    WHERE attendance_detail_emp_id = a.attendance_detail_emp_id AND attendance_detail_date = a.attendance_detail_date) as max ,  (SELECT MIN(attendance_detail_datetime)  FROM attendance_detail 
    WHERE attendance_detail_emp_id = a.attendance_detail_emp_id AND attendance_detail_date = a.attendance_detail_date) as min,
     CASE
     WHEN MAX(attendance_detail_datetime) != MIN(attendance_detail_datetime) THEN TIMEDIFF(MAX(attendance_detail_datetime), MIN(attendance_detail_datetime)) 
     ELSE ''
 END AS punch_status,
 GROUP_CONCAT(  attendance_detail_datetime ) as all_logs
    
    FROM attendance_detail a
               LEFT JOIN employees ON employee_id = attendance_detail_emp_id 
               LEFT JOIN branches ON  branch_id = employee_branch_id 
               LEFT JOIN designations ON designation_id = employee_designation_id
               LEFT JOIN departments ON department_id   = employee_department_id
               WHERE attendance_detail_source ='app'  
               GROUP BY attendance_detail_date , attendance_detail_emp_id 
               ORDER BY attendance_detail_date DESC";

    // echo $query;exit;
    list($rows, $results) = selectRows($query);

    $arrD = array();
    $s = 0;
    foreach ($results as $records) {

        $select_in = "SELECT attendance_detail_date, attendance_detail_time ,attendance_detail_location
                      FROM attendance_detail WHERE attendance_detail_emp_id = '" . $records['attendance_detail_emp_id'] . "'
                      AND attendance_detail_date = '" . $records['attendance_detail_date'] . "'
					  ORDER BY attendance_detail_datetime ASC LIMIT 1";
        list($rows, $in_result) = selectRows($select_in);

        $in_time = '-';
        $in_location = '-';

        foreach ($in_result as $record_in) {

            if (!empty($record_in['attendance_detail_time'])) {
                $in_time      = $record_in['attendance_detail_time'];
                $in_location  = $record_in['attendance_detail_location'];
            }
        }


        $select_out = "SELECT attendance_detail_date, attendance_detail_time ,attendance_detail_location
                      FROM attendance_detail WHERE attendance_detail_emp_id = '" . $records['attendance_detail_emp_id'] . "'
                      AND attendance_detail_date = '" . $records['attendance_detail_date'] . "' AND attendance_detail_time !='" . $in_time . "'
					  ORDER BY attendance_detail_datetime DESC LIMIT 1";
        list($rows, $out_result) = selectRows($select_out);

        $out_time = '-';
        $out_location = '-';

        foreach ($out_result as $record_out) {

            if (!empty($record_out['attendance_detail_time'])) {
                $out_time      = $record_out['attendance_detail_time'];
                $out_location  = $record_out['attendance_detail_location'];
            }
        }

        $select_all = "SELECT attendance_detail_date, attendance_detail_time ,attendance_detail_location, 
        attendance_detail_datetime, attendance_detail_check_status
        FROM attendance_detail  WHERE attendance_detail_emp_id = '" . $records['attendance_detail_emp_id'] . "'
        AND attendance_detail_date = '" . $records['attendance_detail_date'] . "' 
        GROUP BY attendance_detail_datetime
        ORDER BY attendance_detail_datetime ASC";
        list($rows, $result) = selectRows($select_all);


        $all_log = array();
        $i = 0;
        foreach ($result as $log_all_records) {
            if (!empty($records['attendance_detail_time'])) {
                $all_log[$i]['Sno']      = $i;
                $all_log[$i]['punchTime']      = $log_all_records['attendance_detail_time'];
                $all_log[$i]['punchLocation']  = $log_all_records['attendance_detail_location'];
                $all_log[$i]['punchStatus']    = $log_all_records['attendance_detail_check_status'];
                $i++;
            }
        }

        $arrD[$s]['employee_no'] = $records['employee_no'];
        $arrD[$s]['branch_name'] = $records['branch_name'];
        $arrD[$s]['employee_name'] = $records['employee_name'];
        $arrD[$s]['department_name'] = $records['department_name'];
        $arrD[$s]['designation_name'] = $records['designation_name'];
        $arrD[$s]['attendance_detail_date'] = $records['attendance_detail_date'];
        $arrD[$s]['attendance_detail_location'] = $in_location;
        $arrD[$s]['attendance_detail_location_out'] = $out_location;
        $arrD[$s]['in_time'] = $in_time;
        $arrD[$s]['out_time'] = $out_time;
        $arrD[$s]['all_log'] = $all_log;

        $s++;
    }

    return $arrD;
}
