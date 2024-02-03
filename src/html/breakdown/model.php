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

function listbreakdown()
{
    // Search tds record form database table
    $where = " WHERE year_breakdown_id > 0 ";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND year_breakdown_id  > 0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= " AND year_breakdown_company_id  = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "'  ";
    }

    if (!empty($_REQUEST['search_breakdown_name'])) {
        $where .= " AND  breakdown_name LIKE '%" . $_REQUEST['search_breakdown_name'] . "%' ";
    }

    if (!empty($_REQUEST['search_company_id'])) {
        $where .= " AND year_breakdown_company_id  = '" . $_REQUEST['search_company_id'] . "'  ";
    }



    if (!empty($_REQUEST['breakdown_search_status'])) {
        if ($_REQUEST['breakdown_search_status'] == 1) {
            $where .= " AND year_breakdown_deleted_status='" . $_REQUEST['breakdown_search_status'] . "' ";
        } else {
            $where .= " AND year_breakdown_active_status='" . $_REQUEST['breakdown_search_status'] . "' AND year_breakdown_deleted_status = 0 ";
        }
    } else {
        $where .= "AND year_breakdown_active_status='active' AND year_breakdown_deleted_status = 0 ";
    }

    $select = "SELECT * FROM year_breakdown $where ORDER BY year_breakdown_id DESC ";

    list($count, $result) = selectRows($select);
    return $result;
}


function insertbreakdown()
{
    // echo strtotime($_POST['breakdown_date']);exit;
    // print_r($_POST);
    // exit;


    if (isset($_POST['add_breakdown'])) {

        $paths = '../uploads/breakdowns/' . date('Y') . '/';
        $nameOfFile = fileUpload($_FILES["bfr_breakdown_img"]["name"], $_FILES["bfr_breakdown_img"]["tmp_name"], 'bfr_breakdown', $paths);
        $destinationBfr = 'uploads/breakdowns/' . date('Y') . '/' . $nameOfFile;

        $nameOfFileAft = fileUpload($_FILES["aft_breakdown_img"]["name"], $_FILES["aft_breakdown_img"]["tmp_name"], 'aft_breakdown', $paths);
        $destinationAft = 'uploads/breakdowns/' . date('Y') . '/' . $nameOfFileAft;


        $machine_id              = dataValidation($_POST['machine_id']);
        $breakdown_date          = dateDatabaseFormat($_POST['breakdown_date']);
        $nature_of_prob          = dataValidation($_POST['nature_of_prob']);
        $downtime_from           = date('Y-m-d H:i', strtotime($_POST['downtime_from']));
        $downtime_to             = date('Y-m-d H:i', strtotime($_POST['downtime_to']));
        $breakdown_root_cause    = dataValidation($_POST['breakdown_root_cause']);
        $breakdown_action_taken  = dataValidation($_POST['breakdown_action_taken']);
        $breakdown_spare         = dataValidation($_POST['breakdown_spare']);
        $attend_by               = dataValidation($_POST['attend_by']);
        $bfr_breakdown_descript  = dataValidation($_POST['bfr_breakdown_descript']);
        $bfr_breakdown_img       = $destinationBfr;
        $aft_breakdown_descript  = dataValidation($_POST['aft_breakdown_descript']);
        $aft_breakdown_img       = $destinationAft;


        $ip = getRealIpAddr();
        $uniq_id = generateUniqId();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }


        // $get_breakdown = "SELECT  year_breakdown_id  FROM   year_breakdown
        // WHERE year_breakdown_machine_id=$machine_id AND  year_breakdown_company_id ='" . $company_id . "' 
        // AND breakdown_name = '" . $breakdown_name . "' ";
        // list($num_row, $record_select) = selectRows($get_breakdown);
        // // Checking required fields
        $request_fields = !empty($breakdown_date);

        // if ($num_row == 0) {
        if (!empty($request_fields)) {
            $insert_breakdown = "INSERT INTO year_breakdown  SET 
				                   year_breakdown_machine_id        ='" . $machine_id . "',
                                   year_breakdown_date              ='" . $breakdown_date . "',
                                   year_breakdown_problem           ='" . $nature_of_prob . "',
                                   year_breakdown_downtime_from     ='" . $downtime_from . "',
                                   year_breakdown_downtime_to       ='" . $downtime_to . "',
                                   year_breakdown_root_case         ='" . $breakdown_root_cause . "',
                                   year_breakdown_planned           ='" . $breakdown_action_taken . "',
                                   year_breakdown_purchase          ='" . $breakdown_spare . "',
                                   year_breakdown_attended_by       ='" . $attend_by . "',
                                   year_breakdown_before_image      ='" . $bfr_breakdown_img . "',
                                   year_breakdown_before_text       ='" . $bfr_breakdown_descript . "',
                                   year_breakdown_after_image       ='" . $aft_breakdown_img . "',
                                   year_breakdown_after_text        ='" . $aft_breakdown_descript . "',

                                   year_breakdown_company_id ='" . $company_id . "',
				                   year_breakdown_uniq_id    ='" . $uniq_id . "',													
				                   year_breakdown_added_by   ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				                   year_breakdown_added_on   =UNIX_TIMESTAMP(NOW()),
				                   year_breakdown_added_ip   ='" . $ip . "'";
            insert($insert_breakdown);

            header("Location:" . PROJECT_PATH . "src/html/breakdown/index.php?page=add&msg=1");
            exit();
        }
        // } else {

        //     header("Location:" . PROJECT_PATH . "src/html/breakdown/index.php?page=add&msg=5");
        //     exit();
        // }
    }
}

function editbreakdown()
{
    if (isset($_GET['year_breakdown_id'])) {
        $edit = "SELECT * FROM    year_breakdown  
						WHERE  year_breakdown_id ='" . dataValidation($_GET['year_breakdown_id']) . "'";
        // echo $edit_breakdown;die;
        list($count, $result) = selectRow($edit);
        // print_r($result);exit;
        return $result;
    }
}

function updatebreakdown()
{
    if (isset($_POST['update_breakdown'])) {

        // echo $_FILES["breakdown_img"]["tmp_name"];exit;
        // print_r($_FILES);exit;
        $breakdownImage = '';
        if (!empty($_FILES["breakdown_img"]["tmp_name"])) {
            $paths = '../../uploads/breakdowns/' . date('Y') . '/';
            $nameOfFile = fileUpload($_FILES["breakdown_img"]["name"], $_FILES["breakdown_img"]["tmp_name"], 'breakdowns', $paths);
            $destination = 'uploads/breakdowns/' . date('Y') . '/' . $nameOfFile;

            $breakdownImage = " breakdown_image='" . $destination . "',";
        }

        $breakdown_name = dataValidation($_POST['breakdown_name']);
        $macine_model = dataValidation($_POST['macine_model']);
        $breakdown_system = dataValidation($_POST['breakdown_system']);
        $breakdown_sno = dataValidation($_POST['breakdown_sno']);
        $breakdown_number = dataValidation($_POST['breakdown_number']);
        $breakdown_manufac_year = dataValidation($_POST['breakdown_manufac_year']);
        $breakdown_location = dataValidation($_POST['breakdown_location']);
        $breakdown_prev_maintanance = dataValidation($_POST['breakdown_prev_maintanance']);
        $breakdown_planned_maintanance = dataValidation($_POST['breakdown_planned_maintanance']);
        $breakdown_x_axis = dataValidation($_POST['breakdown_x_axis']);
        $breakdown_y_axis = dataValidation($_POST['breakdown_y_axis']);
        $breakdown_z_axis = dataValidation($_POST['breakdown_z_axis']);
        $breakdown_tools_storage_capacity = dataValidation($_POST['breakdown_tools_storage_capacity']);

        $year_breakdown_id  = dataValidation($_POST['year_breakdown_id']);
        $year_breakdown_active_status = dataValidation($_POST['year_breakdown_active_status']);
        $ip       = getRealIpAddr();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }

        $get_breakdown = "SELECT  breakdown_name FROM   breakdowns  WHERE year_breakdown_deleted_status=0 AND  year_breakdown_company_id ='" . $company_id . "' 
        AND breakdown_name = '" . $breakdown_name . "' 
        AND year_breakdown_id != '" . $year_breakdown_id . "' ";


        list($num_row, $record_select) = selectRows($get_breakdown);
        // Checking required fields
        $request_fields = ((!empty($breakdown_name)));

        if ($num_row == 0) {
            if (!empty($request_fields)) {
                // breakdown insert into breakdownes table
                $update_breakdown = "UPDATE breakdowns  SET 
				                   breakdown_name                     ='" . $breakdown_name . "',
                                   breakdown_model                    ='" . $macine_model . "',
                                   breakdown_system                   ='" . $breakdown_system . "',
                                   breakdown_serial_number            ='" . $breakdown_sno . "',
                                   breakdown_number                   ='" . $breakdown_number . "',
                                   $breakdownImage
                                   breakdown_year_of_manufacture      ='" . $breakdown_manufac_year . "',
                                   breakdown_location                 ='" . $breakdown_location . "',
                                   breakdown_previously_maintanance   ='" . $breakdown_prev_maintanance . "',
                                   breakdown_planned_maintanance      ='" . $breakdown_planned_maintanance . "',
                                   breakdown_x_axis                   ='" . $breakdown_x_axis . "',
                                   breakdown_y_axis                   ='" . $breakdown_y_axis . "',
                                   breakdown_z_axis                   ='" . $breakdown_z_axis . "',
                                   breakdown_total_storage_capacity   ='" . $breakdown_tools_storage_capacity . "',


                  year_breakdown_company_id='" . $company_id . "',
				  year_breakdown_active_status='" . $year_breakdown_active_status . "',													
				  breakdown_modified_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				  breakdown_modified_on=UNIX_TIMESTAMP(NOW()),
				  breakdown_modified_ip='" . $ip . "' WHERE year_breakdown_id = '" . $year_breakdown_id . "' ";
                update($update_breakdown);
                header("Location:" . PROJECT_PATH . "src/html/breakdown/index.php?page=edit&year_breakdown_id=$year_breakdown_id&msg=2");
                exit();
            }
        } else {
            header("Location:" . PROJECT_PATH . "src/html/breakdown/index.php?page=edit&year_breakdown_id=$year_breakdown_id&msg=5");
            exit();
        }
    }
}
