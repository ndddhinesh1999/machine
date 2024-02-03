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

function listdepartment()
{
    // Search tds record form database table
    $where = " WHERE department_id > 0 ";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND department_id  > 0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= " AND department_company_id  = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "'  ";
    }

    if (!empty($_REQUEST['search_department_name'])) {
        $where .= " AND  department_name LIKE '%" . $_REQUEST['search_department_name'] . "%' ";
    }

    if (!empty($_REQUEST['search_company_id'])) {
        $where .= " AND department_company_id  = '" . $_REQUEST['search_company_id'] . "'  ";
    }



    if (!empty($_REQUEST['department_search_status'])) {
        if ($_REQUEST['department_search_status'] == 1) {
            $where .= " AND department_deleted_status='" . $_REQUEST['department_search_status'] . "' ";
        } else {
            $where .= " AND department_active_status='" . $_REQUEST['department_search_status'] . "' AND department_deleted_status = 0 ";
        }
    } else {
        $where .= "AND department_active_status='active' AND department_deleted_status = 0 ";
    }

    $select = "SELECT department_id,department_name,department_active_status
                                     FROM   departments
                                    $where  ORDER BY  department_id   DESC ";
    // echo $select;die;
    list($count, $result) = selectRows($select);
    return $result;
}


function insertdepartment()
{


    if (isset($_POST['add_breakdown'])) {



        // $department_name = dataValidation($_POST['department_name']);
        $ip       = getRealIpAddr();
        $uniq_id =    generateUniqId();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }
        echo "<pre>";
print_r($_POST);exit;
        // $get_department = "SELECT  department_name FROM   add_breakdown  WHERE department_deleted_status=0 AND  department_company_id ='" . $company_id . "' 
        // AND department_name = '" . $department_name . "' ";
        // list($num_row, $record_select) = selectRows($get_department);
        // Checking required fields
        // $request_fields = ((!empty($department_name)));

        if (0 == 0) {
            if (!empty($request_fields)) {
                // department insert into departmentes table
                $insert_department = "INSERT INTO year_breakdown  SET 
				    year_breakdown_machine_id='" . $_POST['machine_id'] . "',
                    year_breakdown_date='" . $_POST['date'] . "',
                    year_breakdown_problem  ='" . $_POST['problem'] . "',
                    year_breakdown_downtime_from='" . $_POST[''] . "',
                    year_breakdown_downtime_to	='" . $_POST[''] . "',
                    year_breakdown_root_case='" . $_POST['root_cause'] . "',
                    year_breakdown_planned='" . $_POST[''] . "',
                    year_breakdown_purchase='" . $_POST['purchase'] . "',
                    year_breakdown_attended_by='" . $_POST['attended_by'] . "',
                    year_breakdown_before_image='" . $_POST[''] . "',
                    year_breakdown_before_text='" . $_POST[''] . "',
                    year_breakdown_after_image='" . $_POST[''] . "',
                    year_breakdown_after_text='" . $_POST[''] . "',

                    year_breakdown_company_id='" . $company_id . "',
				    year_breakdown_uniq_id='" . $uniq_id . "',													
				    year_breakdown_added_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				    year_breakdown_added_on=UNIX_TIMESTAMP(NOW()),
				    year_breakdown_added_ip='" . $ip . "'";
                insert($insert_department);

                header("Location:" . PROJECT_PATH . "src/html/department/index.php?page=add&msg=1");
                exit();
            }
        } else {

            header("Location:" . PROJECT_PATH . "src/html/department/index.php?page=add&msg=5");
            exit();
        }
    }
}

function editdepartment()
{
    if (isset($_GET['department_id'])) {
        $edit_department = "SELECT  department_id ,department_name,department_company_id,department_active_status,department_deleted_status
					    FROM    departments  
						WHERE  department_id ='" . dataValidation($_GET['department_id']) . "'";
        // echo $edit_department;die;
        list($count, $result) = selectRow($edit_department);
        return $result;
    }
}

function updatedepartment()
{
    if (isset($_POST['update_department'])) {

        $department_name = dataValidation($_POST['department_name']);
        $department_id  = dataValidation($_POST['department_id']);
        $department_active_status = dataValidation($_POST['department_active_status']);
        $ip       = getRealIpAddr();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }

        $get_department = "SELECT  department_name FROM   departments  WHERE department_deleted_status=0 AND  department_company_id ='" . $company_id . "' 
        AND department_name = '" . $department_name . "' 
        AND department_id != '" . $department_id . "' ";


        list($num_row, $record_select) = selectRows($get_department);
        // Checking required fields
        $request_fields = ((!empty($department_name)));

        if ($num_row == 0) {
            if (!empty($request_fields)) {
                // department insert into departmentes table
                $update_department = "UPDATE departments  SET 
				  department_name='" . $department_name . "',
                  department_company_id='" . $company_id . "',
				  department_active_status='" . $department_active_status . "',													
				  department_modified_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				  department_modified_on=UNIX_TIMESTAMP(NOW()),
				  department_modified_ip='" . $ip . "' WHERE department_id = '" . $department_id . "' ";
                update($update_department);
                header("Location:" . PROJECT_PATH . "src/html/department/index.php?page=edit&department_id=$department_id&msg=2");
                exit();
            }
        } else {
            header("Location:" . PROJECT_PATH . "src/html/department/index.php?page=edit&department_id=$department_id&msg=5");
            exit();
        }
    }
}
