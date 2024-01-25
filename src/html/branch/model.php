<?php

function listCompany()
{
    $where = "WHERE company_deleted_status =0";

    $select = "SELECT company_id,company_code,company_name FROM   company
     $where  ORDER BY  company_id   DESC ";
    // echo $select;die;
    list($count, $result) = selectRows($select);
    return $result;
}


function listbranch()
{
    // Search tds record form database table
    $where = "WHERE branch_id>0";


    if (!empty($_REQUEST['search_branch_name'])) {
        $where .= " AND  branch_name LIKE '%" . $_REQUEST['search_branch_name'] . "%' ";
    }
    if (!empty($_REQUEST['search_company_id'])) {
        $where .= " AND branch_company_id='" . $_REQUEST['search_company_id'] . "' ";
    } else {
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $where .= " AND branch_id > 0 ";
        } else {
            $where .= " AND branch_company_id='" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' ";
        }
    }
    if (!empty($_REQUEST['branch_search_status'])) {
        if ($_REQUEST['branch_search_status'] == 1) {
            $where .= " AND branch_deleted_status='" . $_REQUEST['branch_search_status'] . "' ";
        } else {
            $where .= " AND branch_active_status='" . $_REQUEST['branch_search_status'] . "' AND  branch_deleted_status = 0 ";
        }
    } else {
        $where .= "AND branch_active_status='active' AND  branch_deleted_status = 0 ";
    }

    $select = "SELECT branch_id,branch_name,branch_code,branch_location,branch_active_status
                                     FROM   branches
                                    $where  ORDER BY  branch_id  DESC ";
    // echo $select;
    // die;
    list($count, $result) = selectRows($select);
    return $result;
}


function insertbranch()
{


    if (isset($_POST['add_branch'])) {


        $branch_code = dataValidation($_POST['branch_code']);
        $branch_name = dataValidation($_POST['branch_name']);
        $branch_location = dataValidation($_POST['branch_location']);
        $branch_address = dataValidation($_POST['branch_address']);
        $branch_contact_person = dataValidation($_POST['branch_contact_person']);
        $branch_contact_no = dataValidation($_POST['branch_contact_no']);
        $branch_email = dataValidation($_POST['branch_email']);
        $branch_pin_code = dataValidation($_POST['branch_pin_code']);
        $ip       = getRealIpAddr();
        $uniq_id =    generateUniqId();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
        }



        $select_branch_no = "SELECT MAX(branch_id) as nomax FROM branches WHERE branch_company_id = '" . $company_id . "' ";
        list($counts, $data) = selectRow($select_branch_no);

        if ($counts > 0) {
            $data_code = 'B' . sprintf("%03d", $data['nomax'] + 1);
        } else {
            $data_code = 'B001';
        }

        // Checking required fields
        $request_fields = ((!empty($branch_name)));

        $select = "SELECT * FROM  branches WHERE branch_deleted_status=0 AND branch_name=  '" . $branch_name . "' AND branch_company_id ='" . $company_id . "'";
        list($num_row, $records) = selectRows($select);

        if ($num_row == 0) {
            if (!empty($request_fields)) {

                // Branch insert into branches table
                $insert_branch = "INSERT INTO branches  SET 
                  branch_code='" . $data_code . "',
				  branch_name='" . $branch_name . "',
				  branch_location='" . $branch_location . "',
				  branch_address='" . $branch_address . "',
				  branch_contact_person='" . $branch_contact_person . "',
				  branch_contact_no='" . $branch_contact_no . "',
				  branch_email='" . $branch_email . "',
                  branch_pin_code='" . $branch_pin_code . "',
                  branch_company_id='" . $company_id . "',
				  branch_uniq_id='" . $uniq_id . "',													
				  branch_added_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				  branch_added_on=UNIX_TIMESTAMP(NOW()),
				  branch_added_ip='" . $ip . "'";
                $branch_id =  insert($insert_branch);

                $insert_admin_users = " INSERT INTO admin_users SET 
                admin_users_unique_id ='" . $uniq_id . "',
				admin_users_title='" . $branch_name . "',
				admin_users_user_name='" . $branch_email . "',
				admin_users_password='" . md5("Admin123") . "',
                admin_users_pass='Admin123',
				admin_users_level='branch',
				admin_users_company_id='" . $company_id . "',
				admin_users_branch_id='" . $branch_id . "',
				admin_users_added_by = '" .  $_SESSION[SESS . 'session_admin_users_id']  . "',
				admin_users_added_on = UNIX_TIMESTAMP(NOW()),
				admin_users_added_ip = '" . $ip . "'    ";
                insert($insert_admin_users);

                header("Location:" . PROJECT_PATH . "src/html/branch/index.php?page=add&msg=1");
                exit();
            }
        } else {

            header("Location:" . PROJECT_PATH . "src/html/branch/index.php?page=add&msg=6");
            exit();
        }
    }
}

function editbranch()
{
    if (isset($_GET['branch_id'])) {
        $edit_branch = "SELECT  branch_id,branch_code,branch_name,branch_location,branch_address,branch_contact_person,branch_contact_no,branch_email,branch_pin_code,branch_company_id,branch_uniq_id,branch_active_status,branch_deleted_status
					    FROM   branches  
						WHERE  branch_id ='" . dataValidation($_GET['branch_id']) . "'";
        // echo $edit_branch;die;
        list($count, $result) = selectRow($edit_branch);
        return $result;
    }
}

function updatebranch()
{
    if (isset($_POST['update_branch'])) {

        $branch_code = dataValidation($_POST['branch_code']);
        $branch_name = dataValidation($_POST['branch_name']);
        $branch_location = dataValidation($_POST['branch_location']);
        $branch_address = dataValidation($_POST['branch_address']);
        $branch_contact_person = dataValidation($_POST['branch_contact_person']);
        $branch_contact_no = dataValidation($_POST['branch_contact_no']);
        $branch_email = dataValidation($_POST['branch_email']);
        $branch_pin_code = dataValidation($_POST['branch_pin_code']);
        $ip                                   = getRealIpAddr();

        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
        }
        $get_company = "SELECT  company_name FROM   company  WHERE  company_id ='" . $company_id . "'";
        list($count, $record_select) = selectRow($get_company);
        $first_two_data = substr($record_select['company_name'], 0, 2);
        $data_branch = substr($branch_code, 2);

        $data_code = strtoupper($first_two_data . $data_branch);
        $branch_id  = dataValidation($_POST['branch_id']);

        $branch_active_status = dataValidation($_POST['branch_active_status']);

        $where = " WHERE branch_deleted_status = 0 AND branch_code = '" . $data_code . "' AND branch_company_id = '" . $company_id . "' AND branch_id         != '" . $branch_id . "' ";
        $select_code = "SELECT branch_code FROM  branches $where ";
        list($get_rows, $records) = selectRows($select_code);

        if ($get_rows == 0) {
            $select = "SELECT * FROM  branches WHERE branch_deleted_status=0 AND branch_name='" . $_POST['branch_name'] . "' AND branch_active_status = '" . $branch_active_status . "' AND  branch_id != '" . $branch_id . "' AND branch_company_id='" . $company_id . "' ";
            list($num_row, $record_select) = selectRow($select);
            if ($num_row == 0) {
                if (!empty($branch_id)) {
                    $update = "UPDATE branches SET	
				branch_name='" . $branch_name . "',
				branch_location='" . $branch_location . "',
				branch_address='" . $branch_address . "',
				branch_contact_person='" . $branch_contact_person . "',
				branch_contact_no='" . $branch_contact_no . "',
				branch_email='" . $branch_email . "',
                branch_pin_code='" . $branch_pin_code . "',
                branch_company_id='" . $company_id . "',
				branch_modified_by    = '" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				branch_active_status     	  = '" . $branch_active_status . "',
				branch_modified_on    =  UNIX_TIMESTAMP(NOW()),
				branch_modified_ip    = '" . $ip . "'  	
				WHERE   branch_id         = '" . $branch_id . "'";
                    update($update);

                    $update_admin_users = "UPDATE admin_users SET 
                admin_users_user_name='" . $branch_email . "',
                admin_users_title='" . $branch_name . "',
                admin_users_modified_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
                admin_users_modified_on='UNIX_TIMESTAMP(NOW())',
                admin_users_modified_ip='" . $ip . "' 
                WHERE admin_users_branch_id='" . $branch_id . "' AND admin_users_level='branch' ";
                    update($update_admin_users);

                    header("Location:" . PROJECT_PATH . "src/html/branch/index.php?page=edit&branch_id=$branch_id&msg=2");
                    exit();
                }
            } else {
                header("Location:" . PROJECT_PATH . "src/html/branch/index.php?page=edit&branch_id=$branch_id&msg=6");
                exit();
            }
        } else {
            header("Location:" . PROJECT_PATH . "src/html/branch/index.php?page=edit&branch_id=$branch_id&msg=5");
            exit();
        }
    }
}
