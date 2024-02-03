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
function category()
{

    $select = "SELECT category_id,category_name,category_active_status FROM categorys 
    WHERE category_deleted_status = 0 AND category_active_status = 'active' ORDER BY  category_id   DESC ";

    list($count, $result) = selectRows($select);
    $array = array();
    $i = 0;
    foreach ($result as $record) {
        $array[$i]['category_id'] = $record['category_id'];
        $array[$i]['category_name'] = $record['category_name'];
        $array[$i]['category_active_status'] = $record['category_active_status'];
        $i++;
    }
    return $array;
}



function listmachine()
{
    // Search tds record form database table
    $where = " WHERE machine_id > 0 ";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND machine_id  > 0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= " AND machine_company_id  = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "'  ";
    }

    if (!empty($_REQUEST['search_machine_name'])) {
        $where .= " AND  machine_name LIKE '%" . $_REQUEST['search_machine_name'] . "%' ";
    }

    if (!empty($_REQUEST['search_company_id'])) {
        $where .= " AND machine_company_id  = '" . $_REQUEST['search_company_id'] . "'  ";
    }



    if (!empty($_REQUEST['machine_search_status'])) {
        if ($_REQUEST['machine_search_status'] == 1) {
            $where .= " AND machine_deleted_status='" . $_REQUEST['machine_search_status'] . "' ";
        } else {
            $where .= " AND machine_active_status='" . $_REQUEST['machine_search_status'] . "' AND machine_deleted_status = 0 ";
        }
    } else {
        $where .= "AND machine_active_status='active' AND machine_deleted_status = 0 ";
    }

    $select = "SELECT machine_id,machine_name,machine_active_status
                                     FROM   machines
                                    $where  ORDER BY  machine_id   DESC ";
    // echo $select;die;
    list($count, $result) = selectRows($select);
    return $result;
}


function insertmachine()
{


    if (isset($_POST['add_machine'])) {

        $paths = '../../uploads/machines/' . date('Y') . '/';
        $nameOfFile = fileUpload($_FILES["machine_img"]["name"], $_FILES["machine_img"]["tmp_name"], 'machines', $paths);
        $destination = 'uploads/machines/' . date('Y') . '/' . $nameOfFile;

        $machine_type = dataValidation($_POST['machine_type']);
        $machine_name = dataValidation($_POST['machine_name']);
        $macine_model = dataValidation($_POST['macine_model']);
        $machine_system = dataValidation($_POST['machine_system']);
        $machine_sno = dataValidation($_POST['machine_sno']);
        $machine_number = dataValidation($_POST['machine_number']);
        $machine_manufac_year = dataValidation($_POST['machine_manufac_year']);
        $machine_location = dataValidation($_POST['machine_location']);
        $machine_prev_maintanance = dataValidation($_POST['machine_prev_maintanance']);
        $machine_planned_maintanance = dataValidation($_POST['machine_planned_maintanance']);
        $machine_x_axis = dataValidation($_POST['machine_x_axis']);
        $machine_y_axis = dataValidation($_POST['machine_y_axis']);
        $machine_z_axis = dataValidation($_POST['machine_z_axis']);
        $machine_tools_storage_capacity = dataValidation($_POST['machine_tools_storage_capacity']);



        $ip = getRealIpAddr();
        $uniq_id = generateUniqId();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }


        $get_machine = "SELECT  machine_name FROM   machines  WHERE machine_deleted_status=0 AND  machine_company_id ='" . $company_id . "' 
        AND machine_name = '" . $machine_name . "' ";
        list($num_row, $record_select) = selectRows($get_machine);
        // Checking required fields
        $request_fields = ((!empty($machine_name)));

        if ($num_row == 0) {
            if (!empty($request_fields)) {
                $insert_machine = "INSERT INTO machines  SET 
                                   machine_name                     ='" . $machine_type . "',
				                   machine_name                     ='" . $machine_name . "',
                                   machine_model                    ='" . $macine_model . "',
                                   machine_system                   ='" . $machine_system . "',
                                   machine_serial_number            ='" . $machine_sno . "',
                                   machine_number                   ='" . $machine_number . "',
                                   machine_image                    ='" . $destination . "',
                                   machine_year_of_manufacture      ='" . $machine_manufac_year . "',
                                   machine_location                 ='" . $machine_location . "',
                                   machine_previously_maintanance   ='" . $machine_prev_maintanance . "',
                                   machine_planned_maintanance      ='" . $machine_planned_maintanance . "',
                                   machine_x_axis                   ='" . $machine_x_axis . "',
                                   machine_y_axis                   ='" . $machine_y_axis . "',
                                   machine_z_axis                   ='" . $machine_z_axis . "',
                                   machine_total_storage_capacity   ='" . $machine_tools_storage_capacity . "',

                                   machine_company_id ='" . $company_id . "',
				                   machine_uniq_id    ='" . $uniq_id . "',													
				                   machine_added_by   ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				                   machine_added_on   =UNIX_TIMESTAMP(NOW()),
				                   machine_added_ip   ='" . $ip . "'";

                insert($insert_machine);

                header("Location:" . PROJECT_PATH . "src/html/machine/index.php?page=add&msg=1");
                exit();
            }
        } else {

            header("Location:" . PROJECT_PATH . "src/html/machine/index.php?page=add&msg=5");
            exit();
        }
    }
}

function editmachine()
{
    if (isset($_GET['machine_id'])) {
        $edit_machine = "SELECT * FROM    machines  
						WHERE  machine_id ='" . dataValidation($_GET['machine_id']) . "'";
        // echo $edit_machine;die;
        list($count, $result) = selectRow($edit_machine);
        // print_r($result);exit;
        return $result;
    }
}

function updatemachine()
{
    if (isset($_POST['update_machine'])) {

        // echo $_FILES["machine_img"]["tmp_name"];exit;
        // print_r($_FILES);exit;
        $machineImage = '';
        if (!empty($_FILES["machine_img"]["tmp_name"])) {
            $paths = '../../uploads/machines/' . date('Y') . '/';
            $nameOfFile = fileUpload($_FILES["machine_img"]["name"], $_FILES["machine_img"]["tmp_name"], 'machines', $paths);
            $destination = 'uploads/machines/' . date('Y') . '/' . $nameOfFile;

            $machineImage = " machine_image='" . $destination . "',";
        }

        $machine_name = dataValidation($_POST['machine_name']);
        $macine_model = dataValidation($_POST['macine_model']);
        $machine_system = dataValidation($_POST['machine_system']);
        $machine_sno = dataValidation($_POST['machine_sno']);
        $machine_number = dataValidation($_POST['machine_number']);
        $machine_manufac_year = dataValidation($_POST['machine_manufac_year']);
        $machine_location = dataValidation($_POST['machine_location']);
        $machine_prev_maintanance = dataValidation($_POST['machine_prev_maintanance']);
        $machine_planned_maintanance = dataValidation($_POST['machine_planned_maintanance']);
        $machine_x_axis = dataValidation($_POST['machine_x_axis']);
        $machine_y_axis = dataValidation($_POST['machine_y_axis']);
        $machine_z_axis = dataValidation($_POST['machine_z_axis']);
        $machine_tools_storage_capacity = dataValidation($_POST['machine_tools_storage_capacity']);

        $machine_id  = dataValidation($_POST['machine_id']);
        $machine_active_status = dataValidation($_POST['machine_active_status']);
        $ip       = getRealIpAddr();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }

        $get_machine = "SELECT  machine_name FROM   machines  WHERE machine_deleted_status=0 AND  machine_company_id ='" . $company_id . "' 
        AND machine_name = '" . $machine_name . "' 
        AND machine_id != '" . $machine_id . "' ";


        list($num_row, $record_select) = selectRows($get_machine);
        // Checking required fields
        $request_fields = ((!empty($machine_name)));

        if ($num_row == 0) {
            if (!empty($request_fields)) {
                // machine insert into machinees table
                $update_machine = "UPDATE machines  SET 
				                   machine_name                     ='" . $machine_name . "',
                                   machine_model                    ='" . $macine_model . "',
                                   machine_system                   ='" . $machine_system . "',
                                   machine_serial_number            ='" . $machine_sno . "',
                                   machine_number                   ='" . $machine_number . "',
                                   $machineImage
                                   machine_year_of_manufacture      ='" . $machine_manufac_year . "',
                                   machine_location                 ='" . $machine_location . "',
                                   machine_previously_maintanance   ='" . $machine_prev_maintanance . "',
                                   machine_planned_maintanance      ='" . $machine_planned_maintanance . "',
                                   machine_x_axis                   ='" . $machine_x_axis . "',
                                   machine_y_axis                   ='" . $machine_y_axis . "',
                                   machine_z_axis                   ='" . $machine_z_axis . "',
                                   machine_total_storage_capacity   ='" . $machine_tools_storage_capacity . "',


                  machine_company_id='" . $company_id . "',
				  machine_active_status='" . $machine_active_status . "',													
				  machine_modified_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				  machine_modified_on=UNIX_TIMESTAMP(NOW()),
				  machine_modified_ip='" . $ip . "' WHERE machine_id = '" . $machine_id . "' ";
                update($update_machine);
                header("Location:" . PROJECT_PATH . "src/html/machine/index.php?page=edit&machine_id=$machine_id&msg=2");
                exit();
            }
        } else {
            header("Location:" . PROJECT_PATH . "src/html/machine/index.php?page=edit&machine_id=$machine_id&msg=5");
            exit();
        }
    }
}
