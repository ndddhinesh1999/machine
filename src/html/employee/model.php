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
    Category
    $where = "WHERE branch_deleted_status = 0 ";

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



function listEmployee()
{
    $where = " employee_id > 0 ";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND employee_id > 0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= " AND employee_company_id = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'branch') {
        $where .= " AND employee_company_id = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' ";
        $where .= " AND employee_branch_id  = '" . $_SESSION[SESS . 'session_admin_users_branch_id'] . "' ";
    }

    if (isset($_POST['search'])) {
        if (!empty($_REQUEST['search_company_id'])) {
            $where .= " AND  employee_company_id ='" . $_REQUEST['search_company_id'] . "'";
        }
        if (!empty($_REQUEST['search_branch_id'])) {
            $where .= " AND  employee_branch_id   ='" . $_REQUEST['search_branch_id'] . "'";
        }
        if (!empty($_REQUEST['search_designation_id'])) {
            $where .= " AND  employee_designation_id  ='" . $_REQUEST['search_designation_id'] . "'";
        }
        if (!empty($_REQUEST['search_department_id'])) {
            $where .= " AND  employee_department_id  ='" . $_REQUEST['search_department_id'] . "'";
        }

        if (!empty($_REQUEST['search_employee_status'])) {
            if ($_REQUEST['search_employee_status'] == 1) {
                $where .= " AND  employee_deleted_status ='" . $_REQUEST['search_employee_status'] . "' ";
            } else {
                $where .= " AND  employee_active_status ='" . $_REQUEST['search_employee_status'] . "' AND employee_deleted_status = 0";
            }
        }


        if (!empty($_REQUEST['search_employee_name'])) {
            $where .= " AND  employee_name  LIKE '%" . dataValidation($_REQUEST['search_employee_name']) . "%' ";
        }
    } else {
        $where .= " AND  employee_active_status ='active' AND employee_deleted_status = 0 ";
    }

    $select_employee = "SELECT *  FROM   employees
    LEFT JOIN  branches ON branch_id=employee_branch_id 
    LEFT JOIN  departments ON department_id=employee_department_id
    LEFT JOIN  designations ON designation_id=employee_designation_id 
    LEFT JOIN  company ON company_id=employee_company_id
	 WHERE $where ";
    //  echo $select_employee;exit;
    list($count, $result) = selectRows($select_employee);
    return $result;
}

function addemployee()
{
    $ip = getRealIpAddr();
    $uniq_id =    generateUniqId();


    $employee_name             = dataValidation($_POST['employee_name']);
    $employee_date_of_birth    = dataValidation($_POST['employee_date_of_birth']);
    $employee_gender           = dataValidation($_POST['employee_gender']);
    $employee_designation_id   = dataValidation($_POST['employee_designation_id']);
    $employee_department_id    = dataValidation($_POST['employee_department_id']);
    $employee_contact_no       = dataValidation($_POST['employee_contact_no']);
    $employee_email            = dataValidation($_POST['employee_email']);
    $employee_date_of_join     = dataValidation($_POST['employee_date_of_join']);
    $employee_address          = dataValidation($_POST['employee_address']);
    $employee_register_status  = dataValidation($_POST['employee_register_status']);
    $employee_scan_status      = dataValidation($_POST['employee_scan_status']);
    $employee_lock_status      = dataValidation($_POST['employee_lock_status']);
    $employee_lock_days        = isset($_POST['employee_lock_days']) ? dataValidation($_POST['employee_lock_days']) : '';


    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $company_id = dataValidation($_POST['employee_company_id']);
        $branch_id  = dataValidation($_POST['employee_branch_id']);
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
        $branch_id  = dataValidation($_POST['employee_branch_id']);
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'branch') {
        $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
        $branch_id  = $_SESSION[SESS . 'session_admin_users_branch_id'];
    }


   

    $select = "SELECT MAX(employee_id) as nomax FROM employees WHERE  employee_company_id = '" . $company_id . "'  ";
    list($counts, $data) = selectRow($select);

    if ($counts > 0) {
        $employee_code = 'E' . sprintf("%03d", $data['nomax'] + 1);
    } else {
        $employee_code =  'E001';
    }

    $where = " WHERE employee_deleted_status = 0 AND employee_contact_no = '" . $employee_contact_no . "'   ";

    $select_code = "SELECT employee_contact_no FROM  employees $where  ";
    list($num_row, $records) = selectRows($select_code);
    if ($num_row == 0) {

        $insert_employee = "INSERT INTO employees SET 
                            employee_uniq_id 		   = '" . $uniq_id . "',
                            employee_code			   = '" . $employee_code . "',
                            employee_name			   = '" . $employee_name . "',
                            employee_date_of_birth	   = '" . dateDatabaseFormat($employee_date_of_birth) . "',
                            employee_gender			   = '" . $employee_gender . "',
                            employee_designation_id    = '" . $employee_designation_id . "',
                            employee_department_id	   = '" . $employee_department_id . "',
                            employee_contact_no		   = '" . $employee_contact_no . "',
                            employee_email			   = '" . $employee_email . "',
                            employee_date_of_join 	   = '" . dateDatabaseFormat($employee_date_of_join) . "',
                            employee_address		   = '" . $employee_address . "',
                            employee_register_status   = '" . $employee_register_status . "',
                            employee_scan_status	   = '" . $employee_scan_status . "',
                            employee_lock_status	   = '" . $employee_lock_status . "',
                            employee_lock_days		   = '" . $employee_lock_days . "',
                            employee_company_id		   = '" . $company_id . "',
                            employee_branch_id 		   = '" . $branch_id . "',
                            employee_added_by	       = '" . $_SESSION[SESS . 'session_admin_users_id'] . "',
                            employee_added_on	       = UNIX_TIMESTAMP(NOW()),
                            employee_added_ip	       = '" . $ip . "' ";
        $employee_id = insert($insert_employee);

        $admin_users_password = 'emp123';

        $insert_user = "INSERT INTO admin_users SET 
                        admin_users_unique_id             ='" . $uniq_id . "',
				        admin_users_title                 ='" . $employee_name . "',
				        admin_users_user_name             ='" . $employee_contact_no . "',
				        admin_users_password              ='" . md5($admin_users_password) . "' ,
				        admin_users_pass                  ='" . $admin_users_password . "' ,
				        admin_users_level                 ='employee',
				        admin_users_branch_id             ='" . $branch_id . "',
				        admin_users_employee_id           ='" . $employee_id . "',
				        admin_users_company_id            ='" . $company_id . "',
                        admin_users_face_register_status  ='" . $employee_register_status . "',
                        admin_users_face_scan_status      ='" . $employee_scan_status . "',
				        admin_users_added_by              ='" . $_SESSION[SESS . 'session_admin_users_id'] . "' ,
				        admin_users_added_on              =UNIX_TIMESTAMP(NOW()),
				        admin_users_added_ip              = '" . $ip . "' ";
        insert($insert_user);

        header("Location:index.php?page=add&msg=1");
        exit();
    } else {
        header("Location:index.php?page=add&msg=5");
        exit();
    }
}

function editemployee()
{
    $edit = "SELECT * FROM employees 
    WHERE employee_id  ='" . $_GET['employee_id'] . "'   ";
    list($count, $result) = selectRow($edit);
    return $result;
}

function updateemployee()
{
    $ip = getRealIpAddr();
    $uniq_id                   = generateUniqId();
    $employee_id               = dataValidation($_POST['employee_id']);
    $employee_code             = dataValidation($_POST['employee_code']);
    $employee_name             = dataValidation($_POST['employee_name']);
    $employee_date_of_birth    = dataValidation($_POST['employee_date_of_birth']);
    $employee_gender           = dataValidation($_POST['employee_gender']);
    $employee_designation_id   = dataValidation($_POST['employee_designation_id']);
    $employee_department_id    = dataValidation($_POST['employee_department_id']);
    $employee_contact_no       = dataValidation($_POST['employee_contact_no']);
    $employee_email            = dataValidation($_POST['employee_email']);
    $employee_date_of_join     = dataValidation($_POST['employee_date_of_join']);
    $employee_address          = dataValidation($_POST['employee_address']);
    $employee_register_status  = dataValidation($_POST['employee_register_status']);
    $employee_scan_status      = dataValidation($_POST['employee_scan_status']);
    $employee_lock_status      = dataValidation($_POST['employee_lock_status']);
    $employee_lock_days        = isset($_POST['employee_lock_days']) ? dataValidation($_POST['employee_lock_days']) : '';
    $employee_face_data        = dataValidation($_POST['employee_face_data']);

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $company_id = dataValidation($_POST['employee_company_id']);
        $branch_id        = dataValidation($_POST['employee_branch_id']);
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
        $branch_id        = dataValidation($_POST['employee_branch_id']);
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'branch') {
        $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
        $branch_id        = $_SESSION[SESS . 'session_admin_users_branch_id'];
    }
    // echo $branch_id;exit;


    $where = " WHERE employee_deleted_status = 0 AND employee_contact_no = '" . $employee_contact_no . "'   AND employee_id != '" . $employee_id . "' ";

    $select_code = "SELECT employee_contact_no FROM  employees $where  ";
    list($num_row, $records) = selectRows($select_code);

    if ($num_row == 0) {


        $update_employee = "UPDATE employees SET 
                            employee_uniq_id 	     = '" . $uniq_id . "',
                            employee_code			 = '" . $employee_code . "',
                            employee_name			 = '" . $employee_name . "',
                            employee_date_of_birth   = '" . dateDatabaseFormat($employee_date_of_birth) . "',
                            employee_gender			 = '" . $employee_gender . "',
                            employee_designation_id  = '" . $employee_designation_id . "',
                            employee_department_id	 = '" . $employee_department_id . "',
                            employee_contact_no		 = '" . $employee_contact_no . "',
                            employee_email			 = '" . $employee_email . "',
                            employee_date_of_join 	 = '" . dateDatabaseFormat($employee_date_of_join) . "',
                            employee_address		 = '" . $employee_address . "',
                            employee_register_status = '" . $employee_register_status . "',
                            employee_scan_status	 = '" . $employee_scan_status . "',
                            employee_clear_face_data = '" . $employee_face_data . "',
                            employee_lock_status	 = '" . $employee_lock_status . "',
                            employee_lock_days		 = '" . $employee_lock_days . "',
                            employee_company_id		 = '" . $company_id . "',
                            employee_branch_id 		 = '" . $branch_id . "',
                            employee_added_by	     = '" . $_SESSION[SESS . 'session_admin_users_id'] . "',
                            employee_added_on	     = UNIX_TIMESTAMP(NOW()),
                            employee_added_ip	     = '" . $ip . "' 
                            WHERE employee_id = '" . $employee_id . "' ";
        update($update_employee);


        if ($employee_face_data == 'yes') {
            $face_data = '';
        } else {
            $select_face_data = "SELECT admin_users_face_data FROM admin_users
        WHERE  admin_users_employee_id='" . $employee_id . "' AND admin_users_delete_status = 0 ";
            list($count3, $result3) = selectRow($select_face_data);
            $face_data = $result3['admin_users_face_data'];
        }

        $update_user = "UPDATE admin_users SET 
				admin_users_title='" . $employee_name . "',
				admin_users_user_name='" . $employee_contact_no . "',
				admin_users_branch_id='" . $branch_id . "',
				admin_users_employee_id='" . $employee_id . "',
				admin_users_company_id='" . $company_id . "',
                admin_users_face_register_status='" . $employee_register_status . "',
                admin_users_face_scan_status='" . $employee_scan_status . "',
                admin_users_face_data='" . $face_data . "',
				admin_users_modified_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "' ,
				admin_users_modified_on =UNIX_TIMESTAMP(NOW()),
				admin_users_modified_ip = '" . $ip . "' 
                WHERE admin_users_employee_id = '" . $employee_id . "' ";
        // echo $update_user;exit;
        update($update_user);
        header("Location:index.php?page=edit&employee_id=$employee_id&msg=2");
        exit();
    } else {
        header("Location:index.php?page=edit&employee_id=$employee_id&msg=5");
        exit();
    }
}
