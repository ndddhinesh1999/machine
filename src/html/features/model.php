<?php
function showTable()
{

    $show_table = " SHOW tables";
    list($count, $data) = selectRows($show_table);
    $array_data = array();
    if ($count > 0) {
        $i = 0;
        for ($i = 0; $i < count($data); $i++) {
            $array_data[$i]['table_name'] = $data[$i][0];
            $table_name = $data[$i][0];
            if (!empty($table_name) && $table_name != NULL) {
                $count = "SELECT COUNT(*) as row_count FROM $table_name";
                list($count_data, $data_count) = selectRow($count);
                $number_of_count = $data_count['row_count'];
                $select_colom = "SHOW COLUMNS FROM  $table_name ";
                list($colum_count, $colum_data) = selectRows($select_colom);
                if ($colum_count > 0) {
                    if (!empty($colum_data) && $colum_data != NULL) {
                        $array_data[$i]['colom_name'] = $colum_data;
                        $array_data[$i]['row_count'] = $number_of_count;
                    }
                }
            }
        }
    }
    return $array_data;
    exit;
}

function saveInformation()
{
    // echo "<pre>";
    // print_r($_POST);
    // exit;
    $truncate = isset($_POST['truncate']) ? $_POST['truncate'] : '';
    $drop = isset($_POST['drop']) ? $_POST['drop'] : '';
    if (!empty($truncate)) {
        for ($i = 0; $i < count($truncate); $i++) {
            $truncate_table_name = $truncate[$i];
            if (!empty($table_name)) {
                $ubdate = "TRUNCATE TABLE $truncate_table_name ";
                $dbc = db_connction();
                mysqli_query($dbc, $ubdate);
            }
        }
    }

    if (!empty($drop)) {
        for ($j = 0; $j < count($drop); $j++) {
            $drop_table_name = $drop[$j];
            if (!empty($drop_table_name)) {
                $ubdate = "DROP TABLE $drop_table_name ";
                $dbc = db_connction();
                mysqli_query($dbc, $ubdate);
            }
        }
    }
    header("Location:index.php");
    exit;
}

function download_file()
{
    $fileName = 'devaraso_attendance.sql';
    $filePath = '../../assets/database/devaraso_attendance.sql';
    if (!empty($fileName) && file_exists($filePath)) {
        // Define headers 
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");

        // Read the file 
        readfile($filePath);
        exit;
    } else {
        echo 'The file does not exist.';
    }
}

function upload_file()
{


    $user_id                    = $_SESSION[SESS . 'session_admin_users_id'];
    $user_name                    = $_SESSION[SESS . 'admin_users_user_name'];
    $company_id                    = $_SESSION[SESS . 'session_admin_users_company_id'];
    $branch_id                   = $_SESSION[SESS . 'session_admin_users_branch_id'];
    $current_date               = date('Y-m-d H:i:s');
    $ip       = getRealIpAddr();
    $uniq_id =    generateUniqId();
    unlink("../../assets/database/devaraso_attendance.sql");
    $target_path = "../../assets/database/";
    $target_path = $target_path . basename($_FILES['database']['name']);
    if (move_uploaded_file($_FILES['database']['tmp_name'], $target_path)) {
        rename("../../assets/database/$target_path", "../../assets/database/devaraso_attendance.sql");
        // 2 file upload
        $add_details = "INSERT INTO  login_and_database_details SET
        login_and_databas_uniq_id = '" . $uniq_id . "',
        login_and_databas_user_name = '" . $user_name . "',
        login_and_databas_user_id	 = '" . $user_id . "',
        login_and_databas_update_date_time = '" . $current_date . "',
        login_and_databas_type = '2',
        login_and_databas_company_id = '" . $company_id . "',
        login_and_databas_branch_id = '" . $branch_id . "',
        login_and_databas_added_by = '" . $user_id . "',
        login_and_databas_added_on = UNIX_TIMESTAMP(NOW()),
        login_and_databas_added_ip = '" . $ip . "'  ";
        insert($add_details);
        header("location:index.php");
        exit;
    }
}
function getLastModifyer()
{
    $select_record = "SELECT login_and_databas_id ,login_and_databas_user_name as user_name,login_and_databas_update_date_time as update_date
    FROM `login_and_database_details` WHERE login_and_databas_deleted_status = 0 AND login_and_databas_type = 2 ORDER BY login_and_databas_id DESC LIMIT 1 ";
    list($count, $data) = selectRow($select_record);
    if ($count > 0) {
        return $data;
        exit;
    }
}

function  upload_db(){

    $table_name=$_POST['table_name'];
    $field_name=$_POST['field_name'];
    $hidden_field_name=$_POST['hidden_field_name'];
    $type=$_POST['type'];
    $hidden_type=$_POST['hidden_type'];
    $length=$_POST['length'];
    $hidden_length=$_POST['hidden_length'];
    $default=$_POST['default'];
    $hidden_default=$_POST['hidden_default'];
}

function create_tables(){
    $table_name=$_POST['create_table_name'];
    $field_name=$_POST['field_name'];
    $type=$_POST['type'];
    $length=$_POST['length'];
    $default=$_POST['default'];
$set='';
    for($i=0;$i<count($field_name);$i++){
if(!empty($default[$i])){
    $df=' DEFAULT ' .'  '." '$default[$i]' ";
}else{
    $df='';
}
if($type[$i]=='date' && $type[$i]=='datetime'){
    $set_type= $type[$i] . ' - ' .' NOT NULL ';
}else{
    $set_type= $type[$i] . '  '. '('.$length[$i].') NOT NULL';
}
$set.=" $field_name[$i] $set_type $df ,";
    }
    
$result= substr($set,0,-1);
    $creat_table="CREATE TABLE $table_name ($result) ";
    // echo $creat_table;exit;
    $dbc = db_connction();
    mysqli_query($dbc, $creat_table);

    $user_id                    = $_SESSION[SESS . 'session_admin_users_id'];
    $user_name                    = $_SESSION[SESS . 'admin_users_user_name'];
    $company_id                    = $_SESSION[SESS . 'session_admin_users_company_id'];
    $branch_id                   = $_SESSION[SESS . 'session_admin_users_branch_id'];
    $current_date               = date('Y-m-d H:i:s');
    $ip       = getRealIpAddr();
    $uniq_id =    generateUniqId();

    // 3 create table
    $add_details = "INSERT INTO  login_and_database_details SET
    login_and_databas_uniq_id = '" . $uniq_id . "',
    login_and_databas_user_name = '" . $user_name . "',
    login_and_databas_user_id	 = '" . $user_id . "',
    login_and_databas_update_date_time = '" . $current_date . "',
    login_and_databas_type = '3',
    login_and_databas_company_id = '" . $company_id . "',
    login_and_databas_branch_id = '" . $branch_id . "',
    login_and_databas_added_by = '" . $user_id . "',
    login_and_databas_added_on = UNIX_TIMESTAMP(NOW()),
    login_and_databas_added_ip = '" . $ip . "'  ";
    insert($add_details);
    header("location:index.php");
    exit;
}