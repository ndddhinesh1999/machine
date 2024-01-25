<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';
if (isset($_SESSION[SESS . 'session_admin_users_unique_id'])) {
    include 'model.php';

   
    $showTable = showTable();
    $getLastModifyer = getLastModifyer();
    // echo "<pre>";
    // print_r($showTable);
    // exit;
    if (isset($_POST['save_information'])) {
        // echo "<pre>";
        // print_r($_POST);
        // exit;
        saveInformation();
    }

    if (isset($_REQUEST['download_file'])) {
        download_file();
    }
    if (isset($_POST['upload_data_base'])) {
        upload_file();
    }
    if (isset($_POST['update_db'])) {
       
        // echo "<pre>";
        // print_r($_POST);
        // exit;
        upload_db();
    }
    if (isset($_POST['create_tables'])) {
        // echo "<pre>";
        // print_r($_POST);
        // exit;
        create_tables();
    }
    

    include 'view.php';
} else {
    header("Location:../../../index.php");
}
