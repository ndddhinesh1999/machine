<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';
    $machine = machine_detail();
    $list_history_card = listhistory_card();
    $listCompany = listCompany();
    $listBranch = listBranch();
    if (isset($_POST['add_historycard'])) {
        insertHistoryCard();
    }

    if (isset($_GET['history_card_id'])) {
        $edit_history_card = edithistory_card();
    }
    if (isset($_POST['update_historycard'])) {
        updatehistory_card();
    }

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
