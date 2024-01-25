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

function listdesignation()
{
    // Search tds record form database table
    $where = " WHERE designation_id >0 ";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND designation_id  > 0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= " AND designation_company_id  = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "'  ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'branch') {
        $where .= " AND designation_branch_id  = '" . $_SESSION[SESS . 'session_admin_users_branch_id'] . "'  ";
    }

    if (!empty($_REQUEST['search_company_id'])) {
        $where .= " AND designation_company_id  = '" . $_REQUEST['search_company_id'] . "'  ";
    }

    if (!empty($_REQUEST['search_branch_id'])) {
        $where .= " AND designation_branch_id  = '" . $_REQUEST['search_branch_id'] . "'  ";
    }

    if (!empty($_REQUEST['search_designation_name'])) {
        $where .= " AND  designation_name LIKE '%" . $_REQUEST['search_designation_name'] . "%' ";
    }


    if (!empty($_REQUEST['designation_search_status'])) {
        if ($_REQUEST['designation_search_status'] == 1) {
            $where .= " AND designation_deleted_status='" . $_REQUEST['designation_search_status'] . "' ";
        } else {
            $where .= " AND designation_active_status='" . $_REQUEST['designation_search_status'] . "' AND designation_deleted_status = 0 ";
        }
    } else {
        $where .= "AND designation_active_status='active' AND designation_deleted_status = 0 ";
    }

    $select = "SELECT designation_id,designation_name,designation_active_status
                                     FROM   designations
                                    $where  ORDER BY  designation_id   DESC ";
    // echo $select;die;
    list($count, $result) = selectRows($select);
    return $result;
}


function insertdesignation()
{


    if (isset($_POST['add_designation'])) {



        $designation_name = dataValidation($_POST['designation_name']);
        $ip       = getRealIpAddr();
        $uniq_id =    generateUniqId();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }




        $get_designation = "SELECT  designation_name FROM   designations  WHERE designation_deleted_status=0 AND  designation_company_id ='" . $company_id . "' 
        AND designation_branch_id ='" . $branch_id . "' AND designation_name ='" . $designation_name . "'  ";
        list($num_row, $record_select) = selectRows($get_designation);
        // Checking required fields
        $request_fields = ((!empty($designation_name)));

        if ($num_row == 0) {
            if (!empty($request_fields)) {
                // designation insert into designationes table
                $insert_designation = "INSERT INTO designations  SET 
				  designation_name='" . $designation_name . "',
                  designation_branch_id='" . $branch_id . "',
                  designation_company_id='" . $company_id . "',
				  designation_uniq_id='" . $uniq_id . "',													
				  designation_added_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				  designation_added_on=UNIX_TIMESTAMP(NOW()),
				  designation_added_ip='" . $ip . "'";
                insert($insert_designation);

                header("Location:" . PROJECT_PATH . "src/html/designation/index.php?page=add&msg=1");
                exit();
            }
        } else {

            header("Location:" . PROJECT_PATH . "src/html/designation/index.php?page=add&msg=5");
            exit();
        }
    }
}

function editdesignation()
{
    if (isset($_GET['designation_id'])) {
        $edit_designation = "SELECT  designation_id ,designation_name,designation_company_id,designation_branch_id,designation_active_status,designation_deleted_status
					    FROM    designations  
						WHERE  designation_id ='" . dataValidation($_GET['designation_id']) . "'";
        // echo $edit_designation;die;
        list($count, $result) = selectRow($edit_designation);
        return $result;
    }
}

function updatedesignation()
{
    if (isset($_POST['update_designation'])) {

        $designation_name = dataValidation($_POST['designation_name']);
        $designation_id  = dataValidation($_POST['designation_id']);
        $designation_active_status = dataValidation($_POST['designation_active_status']);
        $ip       = getRealIpAddr();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }

        $get_designation = "SELECT  designation_name FROM   designations  WHERE designation_deleted_status=0 AND  designation_company_id ='" . $company_id . "' 
        AND designation_branch_id ='" . $branch_id . "' AND designation_name='" . $designation_name . "' AND designation_id != '" . $designation_id . "' ";
        list($num_row, $record_select) = selectRows($get_designation);
        // Checking required fields
        $request_fields = ((!empty($designation_name)));

        if ($num_row == 0) {
            if (!empty($request_fields)) {
                // designation insert into designationes table
                $update_designation = "UPDATE designations  SET 
				  designation_name='" . $designation_name . "',
                  designation_branch_id='" . $branch_id . "',
                  designation_company_id='" . $company_id . "',
				  designation_active_status='" . $designation_active_status . "',													
				  designation_modified_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				  designation_modified_on=UNIX_TIMESTAMP(NOW()),
				  designation_modified_ip='" . $ip . "' WHERE designation_id = '" . $designation_id . "' ";
                update($update_designation);
                header("Location:" . PROJECT_PATH . "src/html/designation/index.php?page=edit&designation_id=$designation_id&msg=2");
                exit();
            }
        } else {
            header("Location:" . PROJECT_PATH . "src/html/designation/index.php?page=edit&designation_id=$designation_id&msg=5");
            exit();
        }
    }
}
