<?php

function listcompany()
{
    // Search tds record form database table
    $where = "WHERE company_id > 0 ";


    if (!empty($_REQUEST['search_comapny_name'])) {
        $where .= " AND  company_name LIKE '%" . $_REQUEST['search_comapny_name'] . "%' ";
    }

    if (!empty($_REQUEST['comapny_search_status'])) {

        if ($_REQUEST['comapny_search_status'] == 1) {
            $where .= " AND company_deleted_status='" . $_REQUEST['comapny_search_status'] . "' ";
        } else {
            $where .= " AND company_active_status='" . $_REQUEST['comapny_search_status'] . "' AND company_deleted_status =0 ";
        }
    } else {
        $where .= " AND company_active_status='active' AND company_deleted_status =0 ";
    }

    $select = "SELECT company_id,company_code,company_name,company_email,company_contact_no,company_license_expiry_date,company_active_status
                                     FROM   company
                                    $where  ORDER BY  company_id   DESC ";
    // echo $select;die;
    list($count, $result) = selectRows($select);
    return $result;
}


function insertcompany()
{


    if (isset($_POST['add_company'])) {



        $company_name = dataValidation($_POST['company_name']);
        $company_email = dataValidation($_POST['company_email']);
        $company_contact_no = dataValidation($_POST['company_contact_no']);
        $company_license_expiry_date = dataValidation($_POST['company_license_expiry_date']);
        $company_owner_name = dataValidation($_POST['company_owner_name']);
        $company_owner_contact_no = dataValidation($_POST['company_owner_contact_no']);
        $company_pin_code = dataValidation($_POST['company_pin_code']);
        $company_address = dataValidation($_POST['company_address']);
        $ip                                   = getRealIpAddr();
        $uniq_id =    generateUniqId();
        $first_three_digits = substr($company_name, 0, 3);
        $value = strtoupper(trim($first_three_digits));

        $select_company_no = "SELECT MAX(company_id)   as nomax FROM company ";
        list($counts, $data) = selectRow($select_company_no);

        if ($counts > 0) {
            $company_code = $value . sprintf("%03d", $data['nomax'] + 1);
        } else {
            $company_code = $value . '001';
        }


        $select = "SELECT * FROM  company WHERE company_deleted_status = 0 AND company_name=  '" . $company_name . "'";
        list($num_row, $record_select) = selectRows($select);

        if ($num_row == 0) {
            $insert_company = "INSERT INTO  company  SET 
                  company_code='" . $company_code . "',
				  company_name='" . $company_name . "',
				  company_email='" . $company_email . "',
				  company_contact_no='" . $company_contact_no . "',
				  company_owner_name='" . $company_owner_name . "',
				  company_owner_contact_no='" . $company_owner_contact_no . "',
				  company_license_expiry_date='" . dateDatabaseFormat($company_license_expiry_date) . "',
                  company_address='" . $company_address . "',
                  company_pin_code='" . $company_pin_code . "',
				  company_uniq_id='" . $uniq_id . "',													
				  company_added_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				  company_added_on=UNIX_TIMESTAMP(NOW()),
				  company_added_ip='" . $ip . "'";
            $company_id =  insert($insert_company);

            $insert_admin_users = " INSERT INTO admin_users SET 
                admin_users_unique_id ='" . $uniq_id . "',
				admin_users_title='" . $company_name . "',
				admin_users_user_name='" . $company_code . "',
				admin_users_password='" . md5("Admin123") . "',
                admin_users_pass='Admin123',
				admin_users_level='company',
				admin_users_company_id='" . $company_id . "',
				admin_users_added_by = '" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				admin_users_added_on = UNIX_TIMESTAMP(NOW()),
				admin_users_added_ip = '" . $ip . "'    ";
            insert($insert_admin_users);

            header("Location:" . PROJECT_PATH . "src/html/company/index.php?page=add&msg=1");
            exit();
        } else {

            header("Location:" . PROJECT_PATH . "src/html/company/index.php?page=add");
            exit();
        }
    }
}

function editcompany()
{
    if (isset($_GET['company_id'])) {
        $edit_branch = "SELECT  company_id,company_code,company_name,company_email,company_contact_no,company_license_expiry_date,company_owner_name,company_active_status,company_owner_contact_no,company_pin_code,company_address,company_deleted_status
        FROM   company  
						WHERE  company_id ='" . dataValidation($_GET['company_id']) . "'";
        // echo $edit_branch;die;
        list($count, $result) = selectRow($edit_branch);
        return $result;
    }
}

function updatecompany()
{
    if (isset($_POST['update_company'])) {

        $company_id = dataValidation($_POST['company_id']);
        $company_name = dataValidation($_POST['company_name']);
        $company_email = dataValidation($_POST['company_email']);
        $company_contact_no = dataValidation($_POST['company_contact_no']);
        $company_license_expiry_date = dataValidation($_POST['company_license_expiry_date']);
        $company_owner_name = dataValidation($_POST['company_owner_name']);
        $company_owner_contact_no = dataValidation($_POST['company_owner_contact_no']);
        $company_pin_code = dataValidation($_POST['company_pin_code']);
        $company_address = dataValidation($_POST['company_address']);
        $company_active_status = dataValidation($_POST['company_active_status']);
        $ip                                   = getRealIpAddr();
        $uniq_id =    generateUniqId();


        $select = "SELECT * FROM  company WHERE company_deleted_status = 0 AND company_name=  '" . $company_name . "' AND company_id != '" . $company_id . "' ";

        list($num_row, $record_select) = selectRows($select);
        if ($num_row == 0) {
            if (!empty($company_id)) {
                $update_company = "UPDATE company  SET 
				  company_name='" . $company_name . "',
				  company_email='" . $company_email . "',
				  company_contact_no='" . $company_contact_no . "',
				  company_owner_name='" . $company_owner_name . "',
				  company_owner_contact_no='" . $company_owner_contact_no . "',
				  company_license_expiry_date='" . dateDatabaseFormat($company_license_expiry_date) . "',
                  company_address='" . $company_address . "',
                  company_pin_code='" . $company_pin_code . "',
                  company_active_status='" . $company_active_status . "',
				  company_uniq_id='" . $uniq_id . "',													
				  company_modified_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				  company_modified_on=UNIX_TIMESTAMP(NOW()),
				  company_modified_ip='" . $ip . "' WHERE company_id = '" . $company_id . "' ";
                update($update_company);
                $update_admin_users = "UPDATE admin_users SET
				                      admin_users_title='" . $company_name . "',
                                      admin_users_modified_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
                                      admin_users_modified_on='UNIX_TIMESTAMP(NOW())',
                                      admin_users_modified_ip='" . $ip . "'
                                      WHERE admin_users_company_id='" . $company_id . "' AND admin_users_level='company' ";
                update($update_admin_users);
                header("Location:" . PROJECT_PATH . "src/html/company/index.php?page=edit&company_id=$company_id&msg=2");
                exit();
            }
        } else {
            header("Location:" . PROJECT_PATH . "src/html/company/index.php?page=edit&company_id=$company_id");
            exit();
        }
    }
}
