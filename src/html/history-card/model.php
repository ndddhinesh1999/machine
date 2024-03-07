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

function listhistory_card()
{
    // Search tds record form database table
    $where = " WHERE history_card_id > 0 ";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND history_card_id  > 0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= " AND history_card_company_id  = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "'  ";
    }

    if (!empty($_REQUEST['search_history_card_name'])) {
        $where .= " AND  history_card_name LIKE '%" . $_REQUEST['search_history_card_name'] . "%' ";
    }

    if (!empty($_REQUEST['search_company_id'])) {
        $where .= " AND history_card_company_id  = '" . $_REQUEST['search_company_id'] . "'  ";
    }

    $machine = machine_detail();
    if (!empty($machine['machine_id']) && !empty($machine['machine_id'])) {
        $where .= " AND  history_card_machine_id = '" . $machine['machine_id'] . "'";
    }

    if (isset($_REQUEST['from_date']) && isset($_REQUEST['to_date']) && !empty($_REQUEST['from_date'])  && !empty($_REQUEST['to_date'])) {
        $where .= "AND  history_card_date BETWEEN '" . dateDatabaseFormat($_REQUEST['from_date']) . "' AND '" . dateDatabaseFormat($_REQUEST['to_date']) . "'";
    }

    if (!empty($_REQUEST['history_card_search_status'])) {
        if ($_REQUEST['history_card_search_status'] == 1) {
            $where .= " AND year_history_card_deleted_status='" . $_REQUEST['history_card_search_status'] . "' ";
        } else {
            $where .= " AND year_history_card_active_status='" . $_REQUEST['history_card_search_status'] . "' AND year_history_card_deleted_status = 0 ";
        }
    } else {
        $where .= "AND history_card_active_status='active' AND history_card_deleted_status = 0 ";
    }

    $select = "SELECT * FROM history_card 
    LEFT JOIN machines ON machine_id=history_card_machine_id
    $where ORDER BY history_card_id DESC ";
    list($count, $result) = selectRows($select);
    return $result;
}


function insertHistoryCard()
{


    if (isset($_POST['add_historycard'])) {


        $paths = '../../uploads/history-cards/' . date('Y') . '/' . date('m') . '/';

        $nameOfFile = fileUpload($_FILES["before_image"]["name"], $_FILES["before_image"]["tmp_name"], 'before_image', $paths);
        $before_image = $paths . $nameOfFile;

        $nameOfFileAft = fileUpload($_FILES["after_image"]["name"], $_FILES["after_image"]["tmp_name"], 'after_image', $paths);
        $after_image = $paths . $nameOfFileAft;

        $machine_id                 = dataValidation($_POST['machine_id']);
        $date                       = dateDatabaseFormat($_POST['date']);
        $nature_of_prob             = dataValidation($_POST['nature_of_prob']);
        $action_taken               = dataValidation($_POST['action_taken']);
        $attend_by                  = dataValidation($_POST['attend_by']);


        $ip = getRealIpAddr();
        $uniq_id = generateUniqId();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }
        $request_fields = !empty($date);


        if (!empty($request_fields)) {
            $insert_history_card = "INSERT INTO history_card  SET 
                                    history_card_uniq_id            ='" . $uniq_id . "',	
				                   history_card_machine_id          ='" . $machine_id . "',
                                   history_card_date                ='" . $date . "',
                                   history_card_problem             ='" . $nature_of_prob . "',
                                   history_card_planned             ='" . $action_taken . "',
                                   history_card_attended_by         ='" . $attend_by . "',
                                   history_card_before_image        ='" . $before_image . "',
                                   history_card_after_image         ='" . $after_image . "',
                                   history_card_company_id          ='" . $company_id . "',
				                   history_card_added_by            ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',													
				                   history_card_added_on            ='UNIX_TIMESTAMP(NOW())',
				                   history_card_added_ip            ='" . $ip . "'";

            insert($insert_history_card);

            header("Location:" . PROJECT_PATH . "src/html/history-card/index.php?page=add&msg=1");
            exit();
        }
    }
}

function edithistory_card()
{
    if (isset($_GET['history_card_id'])) {
        $edit = "SELECT * FROM    history_card  
         LEFT JOIN machines ON machine_id=history_card_machine_id
						WHERE  history_card_id ='" . dataValidation($_GET['history_card_id']) . "'";
        // echo $edit;die;
        list($count, $result) = selectRow($edit);
        return $result;
    }
}

function updatehistory_card()
{
    if (isset($_POST['update_historycard'])) {

        $breakImages = '';
        if (!empty($_FILES["before_image"]["tmp_name"])) {
            $paths = '../../uploads/history-cards/' . date('Y') . '/' . date('m') . '/';

            $nameOfFile = fileUpload($_FILES["before_image"]["name"], $_FILES["before_image"]["tmp_name"], 'before_image', $paths);
            $destinationBfr = $paths . $nameOfFile;
            $breakImages .= "history_card_before_image = '" . $destinationBfr . "' ,";
        }
        if (!empty($_FILES["after_image"]["tmp_name"])) {
            $paths = '../../uploads/history-cards/' . date('Y') . '/' . date('m') . '/';
            $nameOfFileAft = fileUpload($_FILES["after_image"]["name"], $_FILES["after_image"]["tmp_name"], 'after_image', $paths);
            $destinationAft = $paths . $nameOfFileAft;
            $breakImages .= "history_card_after_image = '" . $destinationAft . "' ,";
        }

        $history_card_id            = dataValidation($_POST['history_card_id']);
        $machine_id                 = dataValidation($_POST['machine_id']);
        $date                       = dateDatabaseFormat($_POST['date']);
        $nature_of_prob             = dataValidation($_POST['nature_of_prob']);
        $action_taken               = dataValidation($_POST['action_taken']);
        $attend_by                  = dataValidation($_POST['attend_by']);

        $ip       = getRealIpAddr();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }

        // Checking required fields
        if (0 == 0) {

            $update_history_card = "UPDATE history_card  SET 
				                   history_card_machine_id          ='" . $machine_id . "',
                                   history_card_date                ='" . $date . "',
                                   history_card_problem             ='" . $nature_of_prob . "',
                                   history_card_planned             ='" . $action_taken . "',
                                   history_card_attended_by         ='" . $attend_by . "',
                                   $breakImages
                                   history_card_company_id          ='" . $company_id . "',
				                   history_card_added_by            ='" . $_SESSION[SESS . 'session_admin_users_id'] . "',													
				                   history_card_added_on            ='UNIX_TIMESTAMP(NOW())',
				                   history_card_added_ip            ='" . $ip . "'
                                   WHERE history_card_id = '" . $history_card_id . "'";
            update($update_history_card);
            header("Location:" . PROJECT_PATH . "src/html/history-card/index.php?page=edit&history_card_id=$history_card_id&msg=2");
            exit();
        } else {
            header("Location:" . PROJECT_PATH . "src/html/history-card/index.php?page=edit&history_card_id=$history_card_id&msg=5");
            exit();
        }
    }
}
