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

function listautonomous()
{
    // Search tds record form database table
    $where = " WHERE autonomous_id > 0 AND autonomous_type = 2";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND autonomous_id  > 0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= " AND autonomous_company_id  = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "'  ";
    }

    if (!empty($_REQUEST['search_autonomous_name'])) {
        $where .= " AND  autonomous_name LIKE '%" . $_REQUEST['search_autonomous_name'] . "%' ";
    }

    if (!empty($_REQUEST['search_company_id'])) {
        $where .= " AND autonomous_company_id  = '" . $_REQUEST['search_company_id'] . "'  ";
    }



    if (!empty($_REQUEST['autonomous_search_status'])) {
        if ($_REQUEST['autonomous_search_status'] == 1) {
            $where .= " AND autonomous_deleted_status='" . $_REQUEST['autonomous_search_status'] . "' ";
        } else {
            $where .= " AND autonomous_active_status='" . $_REQUEST['autonomous_search_status'] . "' AND autonomous_deleted_status = 0 ";
        }
    } else {
        $where .= "AND autonomous_active_status='active' AND autonomous_deleted_status = 0 ";
    }

    $select = "SELECT * FROM autonomous $where GROUP BY autonomous_date ORDER BY autonomous_id DESC ";

    list($count, $result) = selectRows($select);
    return $result;
}

function selectLabel()
{
    $select = "SELECT * FROM autonomou_lables WHERE autonomou_lable_deleted_status=0
    AND autonomou_lable_type=1";
    list($rows, $results) = selectRows($select);

    return $results;
}

function insertautonomous()
{
    // echo "<pre>";
    // print_r($_FILES);
    // exit;
    // print_r($_POST);
    // exit;


    if (isset($_POST['add_autonomous'])) {

        $ip = getRealIpAddr();
        $uniq_id = generateUniqId();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }

        $insert_autonomous = "INSERT INTO autonomous  SET 
                              autonomous_type       ='2',
                              autonomous_company_id ='" . $company_id . "',
                              autonomous_uniq_id    ='" . $uniq_id . "',													
                              autonomous_added_by   ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
                              autonomous_added_on   =UNIX_TIMESTAMP(NOW()),
                              autonomous_added_ip   ='" . $ip . "'";
        $id = insert($insert_autonomous);

        for ($i = 0; $i < count($_POST['label_id']); $i++) {


            $paths = '../../uploads/autonomouss/' . date('Y') . '/';
            $nameOfFile = fileUpload($_FILES["autonomous_img"]["name"][$i], $_FILES["autonomous_img"]["tmp_name"][$i], 'autonomous-daily', $paths);
            $destination = 'uploads/autonomous/' . date('Y') . '/' . $nameOfFile;

            $autonomous_lable_id   = $_POST['label_id'][$i];
            $autonomous_date       = dateDatabaseFormat($_POST['autonomous_date'][$i]);
            $autonomous_file       = $destination;

            $get_autonomous = "SELECT  autonomous_detail_id  FROM   autonomous_detail
                               WHERE autonomous_detail_lable_id ='" . $autonomous_lable_id . "' AND  autonomous_detail_date ='" . $autonomous_date . "'
                               AND autonomous_detail_deleted_status = 0 ";
            //    echo $get_autonomous;exit;
            list($num_row, $record_select) = selectRows($get_autonomous);
            // Checking required fields
            $request_fields = !empty($autonomous_date);

            if ($num_row == 0) {
                if (!empty($request_fields)) {
                    $insert_autonomous_detail = "INSERT INTO autonomous_detail  SET 
				                   autonomous_detail_lable_id   ='" . $autonomous_lable_id . "',
                                   autonomous_detail_date       ='" . $autonomous_date . "',
                                   autonomous_detail_file       ='" . $autonomous_file . "',
                                   autonomous_detail_autonomous_id = '" . $id . "',
                                  
                                   autonomous_detail_company_id ='" . $company_id . "',
													
				                   autonomous_detail_added_by   ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				                   autonomous_detail_added_on   =UNIX_TIMESTAMP(NOW()),
				                   autonomous_detail_added_ip   ='" . $ip . "'";
                    insert($insert_autonomous_detail);
                }
            }
        }
        header("Location:" . PROJECT_PATH . "src/html/autonomous-weekly/index.php?page=add&msg=1");
        exit();
        // } else {

        //     header("Location:" . PROJECT_PATH . "src/html/autonomous/index.php?page=add&msg=5");
        //     exit();
        // }
    }
}

function editautonomous()
{
    if (isset($_GET['autonomous_id'])) {
        $edit = "SELECT * FROM  autonomous  
                 LEFT JOIN autonomous_detail ON autonomous_detail_autonomous_id =autonomous_id 
                 LEFT JOIN autonomou_lables ON autonomou_lable_id = autonomous_detail_lable_id  

                 WHERE  autonomous_detail_deleted_status = 0 
                 AND autonomous_id ='" . $_GET['autonomous_id'] . "'";

        list($count, $result) = selectRows($edit);
        $arrD['autonomous_id'] = $_GET['autonomous_id'];
        $arrD['deleted_status'] = $result[0]['autonomous_deleted_status'];

        $i = 0;
        foreach ($result as $records) {
            $arryData[$i]['label_id'] = $records['autonomous_detail_lable_id'];
            $arryData[$i]['label_part'] = $records['autonomou_lable_part'];
            $arryData[$i]['label_std'] = $records['autonomou_lable_standard'];

            $arryData[$i]['dates'] = $records['autonomous_detail_date'];
            $arryData[$i]['files'] = $records['autonomous_detail_file'];

            $i++;
        }
        $arrD['details']      = $arryData;
        return $arrD;
    }
}

function updateautonomous()
{
    if (isset($_POST['update_autonomous'])) {

        $autonomous_id = $_POST['autonomous_id'];
        $ip = getRealIpAddr();
        $uniq_id = generateUniqId();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }

        $sel = "SELECT autonomous_detail_id FROM  autonomous_detail WHERE  
                              autonomous_detail_autonomous_id       ='" . $autonomous_id . "'
                              AND autonomous_detail_deleted_status = 0";
        list($row, $res) = selectRow($sel);

        if ($row > 0) {

            for ($i = 0; $i < count($_POST['label_id']); $i++) {


                $paths = '../../uploads/autonomouss/' . date('Y') . '/';
                $nameOfFile = fileUpload($_FILES["autonomous_img"]["name"][$i], $_FILES["autonomous_img"]["tmp_name"][$i], 'autonomous-daily', $paths);
                $destination = 'uploads/autonomous/' . date('Y') . '/' . $nameOfFile;

                $autonomous_lable_id   = $_POST['label_id'][$i];
                $autonomous_date       = dateDatabaseFormat($_POST['autonomous_date'][$i]);
                $autonomous_file       = $destination;



                $request_fields = !empty($autonomous_date);


                if (!empty($request_fields)) {
                    $update = "UPDATE autonomous_detail  SET 
				                  
                                   autonomous_detail_date       ='" . $autonomous_date . "',
                                   autonomous_detail_file       ='" . $autonomous_file . "',
                                   autonomous_detail_modified_by   ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				                   autonomous_detail_modified_on   =UNIX_TIMESTAMP(NOW()),
				                   autonomous_detail_modified_ip   ='" . $ip . "'
                                   WHERE autonomous_detail_autonomous_id = '" . $autonomous_id . "'
                                   AND  autonomous_detail_lable_id   ='" . $autonomous_lable_id . "'    ";
                    update($update);
                }
            }


            header("Location:" . PROJECT_PATH . "src/html/autonomous-weekly/index.php?page=edit&autonomous_id=$autonomous_id&msg=2");
            exit();
        } else {
            header("Location:" . PROJECT_PATH . "src/html/autonomous-weekly");
            exit();
        }
    }
}
