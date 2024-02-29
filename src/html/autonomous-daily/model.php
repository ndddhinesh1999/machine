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
    $where = " WHERE autonomous_id > 0 ";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND autonomous_id  > 0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= " AND autonomous_company_id  = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "'  ";
    }

    if (!empty($_REQUEST['search_autonomous_name'])) {
        $where .= " AND  autonomous_name LIKE '%" . $_REQUEST['search_autonomous_name'] . "%' ";
    }
    if (!empty($_REQUEST['from_date']) && !empty($_REQUEST['to_date'])) {
        $where .= " AND  autonomous_date BETWEEN '" . dateDatabaseFormat($_REQUEST['from_date']) . "'  AND '" . dateDatabaseFormat($_REQUEST['to_date']) . "'";
    }
    if (!empty($_REQUEST['m_id']) && !empty($_REQUEST['m_id'])) {
        $where .= " AND  autonomous_machine_id = '" . $_REQUEST['m_id'] . "'";
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

    $select = "SELECT * FROM autonomous $where AND autonomous_type ='1' GROUP BY autonomous_date ORDER BY autonomous_id DESC ";
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

        $select = "SELECT autonomous_id FROM autonomous 
        WHERE autonomous_date = '" . dateDatabaseFormat($_POST['autonomous_date']) . "' ";
        list($row, $result) = selectRow($select);
        if ($row == 0) {

            $insert_autonomous = "INSERT INTO autonomous  SET 
                              autonomous_machine_id ='" . $_POST['machine_id'] . "',
                              autonomous_type       ='1',
                              autonomous_date       = '" . dateDatabaseFormat($_POST['autonomous_date']) . "',
                              autonomous_company_id ='" . $company_id . "',
                              autonomous_uniq_id    ='" . $uniq_id . "',													
                              autonomous_added_by   ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
                              autonomous_added_on   =UNIX_TIMESTAMP(NOW()),
                              autonomous_added_ip   ='" . $ip . "'";

            $id = insert($insert_autonomous);

            for ($i = 0; $i < count($_POST['label_id']); $i++) {


                $paths = '../../uploads/autonomous/' . date('Y') . '/';

                $nameOfFile = fileUpload($_FILES["before_images"]["name"][$i], $_FILES["before_images"]["tmp_name"][$i], 'before_images', $paths);
                $before_image_path = 'uploads/autonomous/' . date('Y') . '/' . $nameOfFile;

                $nameOfFileBfr = fileUpload($_FILES["after_images"]["name"][$i], $_FILES["after_images"]["tmp_name"][$i], 'after_images', $paths);
                $after_image_path = 'uploads/autonomous/' . date('Y') . '/' . $nameOfFileBfr;


                $autonomous_lable_id   = $_POST['label_id'][$i];
                $remark = $_POST['autonomous_remark'][$i];

                $get_autonomous = "SELECT  autonomous_detail_id  FROM   autonomous_detail
                               WHERE autonomous_detail_lable_id ='" . $autonomous_lable_id . "' AND autonomous_detail_autonomous_id='" . $id . "'
                               AND autonomous_detail_deleted_status = 0 ";

                list($num_row, $record_select) = selectRows($get_autonomous);
                // Checking required fields

                if ($num_row == 0) {

                    $insert_autonomous_detail = "INSERT INTO autonomous_detail  SET 
                                   autonomous_detail_autonomous_id      = '" . $id . "',
				                   autonomous_detail_lable_id           ='" . $autonomous_lable_id . "',
                                   autonomous_detail_before_image       ='" . $before_image_path . "',
                                   autonomous_detail_before_remarks     ='" . $remark . "',
                                   autonomous_detail_after_image        ='" . $after_image_path . "',
                         
                                   autonomous_detail_company_id         ='" . $company_id . "',
				                   autonomous_detail_added_by           ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				                   autonomous_detail_added_on           =UNIX_TIMESTAMP(NOW()),
				                   autonomous_detail_added_ip           ='" . $ip . "'";

                    insert($insert_autonomous_detail);
                }
            }
            header("Location:" . PROJECT_PATH . "src/html/autonomous-daily/index.php?page=add&msg=1");
            exit();
        } else {

            header("Location:" . PROJECT_PATH . "src/html/autonomous-daily/index.php?page=add&msg=5");
            exit();
        }
    }
}

function editautonomous()
{
    if (isset($_GET['autonomous_id'])) {
        $edit = "SELECT * FROM  autonomous  
                 LEFT JOIN machines ON machine_id = autonomous_machine_id
                 LEFT JOIN autonomous_detail ON autonomous_detail_autonomous_id =autonomous_id 
                 WHERE  autonomous_detail_deleted_status = 0  AND       autonomous_type ='1'
                 AND autonomous_id ='" . $_GET['autonomous_id'] . "' AND autonomous_deleted_status=0";

        list($count, $result) = selectRow($edit);

        if ($count > 0) {

            $arrD['machine_id']  = $result['machine_id'];
            $arrD['machine_name']  = $result['machine_name'];
            $arrD['autonomous_id']  = $result['autonomous_id'];
            $arrD['deleted_status'] = $result['autonomous_deleted_status'];
            $arrD['dates'] = $result['autonomous_date'];

            $edit = "SELECT * FROM  autonomous_detail  
            LEFT JOIN autonomou_lables ON autonomou_lable_id = autonomous_detail_lable_id  
            WHERE  autonomous_detail_deleted_status = 0 
            AND autonomous_detail_autonomous_id ='" . $result['autonomous_id'] . "' ORDER BY autonomous_detail_id ASC";

            list($count, $result) = selectRows($edit);

            $i = 0;
            $arrayData = array();
            foreach ($result as $records) {
                $arrayData[$i]['label_id'] = $records['autonomous_detail_lable_id'];
                $arrayData[$i]['label_part'] = $records['autonomou_lable_part'];
                $arrayData[$i]['label_std'] = $records['autonomou_lable_standard'];
                $arrayData[$i]['before_image'] = $records['autonomous_detail_before_image'];
                $arrayData[$i]['after_image'] = $records['autonomous_detail_after_image'];
                $arrayData[$i]['remark'] = $records['autonomous_detail_before_remarks'];


                $i++;
            }
            $arrD['details']      = $arrayData;
            return $arrD;
        } else {
            return array();
        }
    }
}

function updateautonomous()
{

    // print_r($_POST);exit;



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
        $select = "SELECT autonomous_id FROM autonomous 
        WHERE autonomous_date = '" . dateDatabaseFormat($_POST['autonomous_date']) . "'
        AND autonomous_id != '" . $autonomous_id . "' ";
        list($row, $result) = selectRow($select);

        if ($row == 0) {
            $sel = "SELECT autonomous_detail_id FROM  autonomous_detail WHERE  
                              autonomous_detail_autonomous_id       ='" . $autonomous_id . "'
                              AND autonomous_detail_deleted_status = 0";
            list($row, $res) = selectRow($sel);

            if ($row > 0) {

                for ($i = 0; $i < count($_POST['label_id']); $i++) {

                    $include = '';
                    $paths = '../../uploads/autonomous/' . date('Y') . '/';
                    $image_path = '';
                    if (!empty($_FILES["before_images"]["tmp_name"][$i])) {

                        $nameOfFile = fileUpload($_FILES["before_images"]["name"][$i], $_FILES["before_images"]["tmp_name"][$i], 'before_images', $paths);
                        $before_image_path = 'uploads/autonomous/' . date('Y') . '/' . $nameOfFile;
                        $image_path .= "autonomous_detail_before_image= '" . $before_image_path . "',";
                    }

                    if (!empty($_FILES["after_image"]["tmp_name"][$i])) {
                        $nameOfFileBfr = fileUpload($_FILES["after_images"]["name"][$i], $_FILES["after_images"]["tmp_name"][$i], 'after_images', $paths);
                        $after_image_path = 'uploads/autonomous/' . date('Y') . '/' . $nameOfFileBfr;
                        $image_path .= "autonomous_detail_after_image = '" . $after_image_path . "'";
                    }
                    $autonomous_lable_id   = $_POST['label_id'][$i];
                    $remark = $_POST['autonomous_remark'][$i];

                    $update = "UPDATE autonomous_detail  SET 
                                   autonomous_detail_before_remarks     ='" . $remark . "',
                                   $image_path
                                   autonomous_detail_modified_by   ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				                   autonomous_detail_modified_on   =UNIX_TIMESTAMP(NOW()),
				                   autonomous_detail_modified_ip   ='" . $ip . "'
                                   WHERE autonomous_detail_autonomous_id = '" . $autonomous_id . "'
                                   AND  autonomous_detail_lable_id   ='" . $autonomous_lable_id . "' ";

                    update($update);
                }
                header("Location:" . PROJECT_PATH . "src/html/autonomous-daily/index.php?page=edit&autonomous_id=$autonomous_id&msg=2");
                exit();
            } else {
                header("Location:" . PROJECT_PATH . "src/html/autonomous-daily");
                exit();
            }
        } else {
            header("Location:" . PROJECT_PATH . "src/html/autonomous-daily/index.php?page=edit&autonomous_id=$autonomous_id&msg=5");
            exit();
        }
    }
}

function pdfList()
{


    $where = "";
    if (isset($_REQUEST['from_date']) && isset($_REQUEST['to_date']) && !empty($_REQUEST['from_date'])  && !empty($_REQUEST['to_date'])) {
        $where .= "AND  autonomous_date BETWEEN '" . dateDatabaseFormat($_REQUEST['from_date']) . "' AND '" . dateDatabaseFormat($_REQUEST['to_date']) . "'";
    }

    $select = "SELECT * FROM  autonomous  
                 LEFT JOIN machines ON machine_id = autonomous_machine_id
                 WHERE  autonomous_deleted_status=0  AND  autonomous_type ='1' $where ORDER BY autonomous_date ASC";

    list($count, $record) = selectRows($select);

    $arrD = array();
    $i = 0;
    if ($count > 0) {
        foreach ($record as $result) {
            $arrD[$i]['machine_id']  = $result['machine_id'];
            $arrD[$i]['machine_name']  = $result['machine_name'];
            $arrD[$i]['autonomous_id']  = $result['autonomous_id'];
            $arrD[$i]['deleted_status'] = $result['autonomous_deleted_status'];
            $arrD[$i]['dates'] = $result['autonomous_date'];

            $select_details = "SELECT * FROM  autonomous_detail  
            LEFT JOIN autonomou_lables ON autonomou_lable_id = autonomous_detail_lable_id  
            WHERE  autonomous_detail_deleted_status = 0 
            AND autonomous_detail_autonomous_id ='" . $result['autonomous_id'] . "' ORDER BY autonomous_detail_id ASC";
            list($count, $result_details) = selectRows($select_details);

            $j = 0;
            $arrayData = array();
            foreach ($result_details as $records) {
                $arrayData[$j]['label_id'] = $records['autonomous_detail_lable_id'];
                $arrayData[$j]['label_part'] = $records['autonomou_lable_part'];
                $arrayData[$j]['label_std'] = $records['autonomou_lable_standard'];
                $arrayData[$j]['before_image'] = $records['autonomous_detail_before_image'];
                $arrayData[$j]['after_image'] = $records['autonomous_detail_after_image'];
                $arrayData[$j]['remark'] = $records['autonomous_detail_before_remarks'];
                $j++;
            }
            $arrD[$i]['details']      = $arrayData;
            $i++;
        }
        return $arrD;
    }
}
