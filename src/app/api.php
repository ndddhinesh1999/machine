<?php
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: *");
header("Access-Control-Allow-Headers: OPTIONS,X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding,Token");
header("Access-Control-Allow-Methods: *");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'firebase/php-jwt/src/BeforeValidException.php';
include_once 'firebase/php-jwt/src/ExpiredException.php';
include_once 'firebase/php-jwt/src/SignatureInvalidException.php';
include_once 'firebase/php-jwt/src/JWT.php';
require_once('../includes/config.php');
require_once('../includes/utility_function.php');
require_once('../includes/customer_utility_function.php');


use \Firebase\JWT\JWT;

define('baseURL', PROJECT_PATH);
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: *");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}
define('skey', 'VerySecureKey1234');
$jsonData = true;
$action = (isset($_REQUEST['action'])) ? dataValidation($_REQUEST['action']) : '';
if (empty($action)) {
    http_response_code(500);
    echo json_encode(array("Action cannot be empty"));
    exit;
}
function convertFromMinutes($job_duration)
{
    $hours = (int)($job_duration / 60);
    $minutes = $job_duration - ($hours * 60);
    return $hours . ':' . $minutes;
}
$result = $action;
switch ($action) {
    case 'login':
    case 'getToken':
    case 'emailExist':
    case 'forgotPassword':
    case 'report':
    case 'test':
        break;
    default:
        if (!isValidToken()) {
            http_response_code(500);
            echo "Permission Denied";
            exit;
        }
}
switch ($action) {
    case 'test':
        $jsonData = testing();
        break;
    case 'login':
        $jsonData = loginAuth();
        break;
    case 'getToken':
        $jsonData = getToken();
        break;
    case 'getLoginInfo':
        $jsonData = getLoginInfo();
        break;
    case 'changePassword':
        $jsonData = changePassword();
        break;
    case 'forgotPassword':
        $jsonData = forgotPassword();
        break;
    case 'updateToken':
        $jsonData = updateToken();
        break;
    case 'emailExist':
        $jsonData = emailExist();
        break;
    case 'listEmployee':
        $jsonData = listEmployee();
        break;
    case 'registerFace':
        $jsonData = registerFace();
        break;
    case 'updateAttendance':
        $jsonData = updateAttendance();
        break;
    case 'updateAttendanceMultiple':
        $jsonData = updateAttendanceMultiple();
        break;
    case 'updateMissingAttendance':
        $jsonData = updateMissingAttendance();
        break;
    case 'faceRemove':
        $jsonData = employeeFaceRemove();
        break;
    case 'branches':
        $jsonData = branches();
        break;
    case 'lastAttendanceEntry':
        $jsonData = lastAttendanceEntry();
        break;
}

function investigate()
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $url = "https://";
    else
        $url = "http://";
    // Append the host(domain name, ip) to the URL.   
    $url .= $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    return $uri;
}
function isValidToken()
{
    $token = getToken();
    if (empty($token)) {
        return false;
    }
    $userInfo = getLoginInfo();
    if (empty($userInfo)) {
        return false;
    }
    return true;
}
function getToken()
{
    $headers = $_SERVER;
    if (!isset($headers["HTTP_TOKEN"])) {
        return '';
    }
    $token = $headers['HTTP_TOKEN'];
    if (empty($token)) {
        return '';
    }
    return $token;
}
function getLoginInfo()
{
    try {
        $decoded = JWT::decode(getToken(), skey, array('HS256'));
        return $decoded;
    } catch (exception $e) {
        return '';
    }
}
function dateAppFormat($date)
{
    $date = implode('-', array_reverse(explode('-', $date)));
    return $date;
}
function testing()
{
    $selectAttendance = "SELECT attendance_detail_id FROM attendance_detail 
                         WHERE attendance_detail_deleted_status = 0 ";
    list($row_att, $result) = selectRow($selectAttendance);

    foreach ($result as $records) {
        hrLogPush($records['attendance_detail_id']);
    }
}
function loginAuth()
{

    $now = strtotime('2023-01-01');
    $your_date = strtotime('2026-12-31');
    $datediff = $your_date - $now;
    $count_date = round($datediff / (60 * 60 * 24));


    $data = json_decode(file_get_contents("php://input"));

    $login_id = isset($data->login_id) ? $data->login_id : '';
    $password = isset($data->password) ? $data->password : '';
    $app_type = isset($data->app_type) ? $data->app_type : '';
    if (empty($app_type)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "App Type Cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (empty($login_id)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Username cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (empty($password)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Password cannot be empty", 'data' => $data);
        return $result_json;
    }
    $query = "";
    $where = "";
    if ($app_type == 'user') {
        $where = " AND admin_users_level IN ('employee', 'branch', 'admin','company') ";
    }
    $query = " SELECT admin_users_id, admin_users_title, admin_users_user_name, admin_users_level, admin_users_password, admin_users_company_id,
	                  admin_users_notification_token AS notification_token, admin_users_employee_id, admin_users_face_data,
	                  admin_users_face_register_status, admin_users_face_scan_status, admin_users_branch_id,branch_latitude,branch_longitude
				FROM admin_users 
				LEFT JOIN branches ON branch_id=admin_users_branch_id
			    WHERE admin_users_user_name ='" . dataValidation($login_id) . "'  $where
			    AND admin_users_delete_status = 0 LIMIT 1";

    list($row, $result_ary) = selectRow($query);

    if ($row > 0) {

        $input_pass = md5($password);

        $db_pass = $result_ary['admin_users_password'];
        if ($db_pass == $input_pass) {
            $user_id    = (int)$result_ary['admin_users_id'];
            http_response_code(200);
            $jsonData = array(
                'userId' => (int)$user_id,
                'userName' => $result_ary["admin_users_user_name"],
                'title' => ucfirst($result_ary["admin_users_title"]),
                'level' => $result_ary["admin_users_level"],
                'master_id' => $result_ary["admin_users_employee_id"],
                'company_id' => $result_ary["admin_users_company_id"],
                'branch_id' => $result_ary["admin_users_branch_id"],
                'notification_token' => $result_ary["notification_token"],
                'branch_latitude' => $result_ary["branch_latitude"],
                'branch_longitude' => $result_ary["branch_longitude"],
                'register_status' => $result_ary["admin_users_face_register_status"],
                'scan_status' => $result_ary["admin_users_face_scan_status"],
                'face_data' => $result_ary["admin_users_face_data"]
            );

            $jwt = JWT::encode($jsonData, skey);
            $data = array('key' => $jwt);
            $result_json = array('status' => true, 'status_code' => 200, 'message' => "Login Successfully", 'data' => $data);
            return $result_json;
        } else {
            http_response_code(203);
            $data = array();
            $result_json = array('status' => false, 'status_code' => 203, 'message' => "Invalid Password", 'data' => $data);
            return $result_json;
        }
    } else {
        http_response_code(203);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 203, 'message' => "Invalid User Details..!", 'data' => $data);
        return $result_json;
    }
}
function branches()
{
    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'PUT':
            return  updateBranchDetails();
            break;
        case 'GET':
            return getBranchDetails();
            break;
        default:
            return 'Request method not allowed';
            break;
    }
}
function getBranchDetails()
{
    $branch_id   = (isset($_REQUEST['branch_id'])) ? $_REQUEST['branch_id'] : '';

    $select = "SELECT branch_id,branch_code,branch_name,branch_location,branch_latitude,branch_longitude,
    branch_address,branch_contact_no,branch_company_id,branch_deleted_status
    FROM branches
    WHERE branch_deleted_status=0 AND branch_id=$branch_id ";

    list($row, $result_ary) = selectRow($select);

    if (!empty($result_ary['branch_id'])) {
        if ((int)$result_ary['branch_deleted_status'] == 0) {
            $jsonData = array(
                'branch_id' => (int)$result_ary['branch_id'],
                'branch_code' => $result_ary['branch_code'],
                'branch_name' => $result_ary['branch_name'],
                'branch_location' => $result_ary['branch_location'],
                'branch_latitude' => $result_ary['branch_latitude'],
                'branch_longitude' => $result_ary['branch_longitude'],
                'branch_address' => $result_ary['branch_address'],
                'branch_contact_no' => $result_ary['branch_contact_no'],
                'branch_company_id' => $result_ary['branch_company_id']
            );
            return $jsonData;
        } else {
            return "This Record Already Deleted..";
        }
    } else {
        return  "Something Went Wrong";
    }
}
function updateBranchDetails()
{
    $branchId     = (isset($_REQUEST['branch_id'])) ? $_REQUEST['branch_id'] : '';
    $latitude     = (isset($_REQUEST['latitude'])) ? $_REQUEST['latitude'] : '';
    $longitude = (isset($_REQUEST['longitude'])) ? $_REQUEST['longitude'] : '';
    if (empty($branchId)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Branch ID cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (empty($latitude)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Latitude cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (empty($longitude)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Longitude cannot be empty", 'data' => $data);
        return $result_json;
    }
    $select = "SELECT branch_id FROM branches WHERE branch_deleted_status = 0 AND branch_id=" . $branchId . " ";
    list($row, $result_ary) = selectRow($select);


    if (!empty($result_ary['branch_id'])) {
        $update = "UPDATE branches SET 
                   branch_modified_on   = UNIX_TIMESTAMP(NOW()),
                   branch_latitude	    = '" . $latitude . "',
                   branch_longitude     = '" . $longitude . "'
                   WHERE branch_id	    = '" . $branchId . "'";
        update($update);

        http_response_code(200);
        $data = array();
        $result_json = array('status' => true, 'status_code' => 200, 'message' => "Location Successfully Added", 'data' => $data);
        return $result_json;
    } else {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Something Went Wrong", 'data' => $data);
        return $result_json;
    }
}
function changePassword()
{
    $data = json_decode(file_get_contents("php://input"));
    $ip = getRealIpAddr();
    $login_info = getLoginInfo();
    $login_id = $login_info->userId;
    $old_password = $data->old_password;
    $new_password = $data->new_password;
    $confirm_password = $data->confirm_password;
    if (empty($login_id)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "User Id cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (empty($old_password)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Old Password cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (empty($new_password)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "New Password cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (empty($confirm_password)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Confirm Password cannot be empty", 'data' => $data);
        return $result_json;
    }
    $select1 = "SELECT * FROM admin_users WHERE  admin_users_delete_status = 0 AND admin_users_id = '" . $login_id . "'   ";
    list($row, $result_ary) = selectRow($select1);
    if ($row > 0) {
        $input_pass = md5($old_password);
        $db_pass = $result_ary['admin_users_password'];

        if ($input_pass != $db_pass) {
            http_response_code(500);
            $data = array();
            $result_json = array('status' => false, 'status_code' => 500, 'message' => "Old Password not Valid", 'data' => $data);
            return $result_json;
        }
        if (!empty($result_ary['admin_users_id'])) {
            if ($new_password == $confirm_password) {
                $update = "UPDATE admin_users SET 
					   admin_users_password		 = '" . md5($confirm_password) . "',
					   admin_users_modified_on	 = UNIX_TIMESTAMP(NOW()),
					   admin_users_modified_by	 = '" . $login_id . "',
					   admin_users_modified_ip	 = '" . $ip . "'
					   WHERE admin_users_id		 = '" . $login_id . "'";
                update($update);
                http_response_code(200);
                $data = array();
                $result_json = array('status' => true, 'status_code' => 200, 'message' => "Password Successfully Changed", 'data' => $data);
                return $result_json;
            } else {
                http_response_code(500);
                $data = array();
                $result_json = array('status' => false, 'status_code' => 500, 'message' => "New Password and Confirm Password Not Matched", 'data' => $data);
                return $result_json;
            }
        }
    } else {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Invalid User", 'data' => $data);
        return $result_json;
    }
}
function forgotPassword()
{
    $data = json_decode(file_get_contents("php://input"));
    $user_name = $data->user_name;
    if (empty($user_name)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "User Name cannot be empty", 'data' => $data);
        return $result_json;
    }
    $select1 = "SELECT * FROM admin_users WHERE admin_users_user_name = '" . $user_name . "' AND admin_users_delete_status = 0  ";
    list($row, $result_ary) = selectRow($select1);

    if (!empty($result_ary['admin_users_id'])) {
        $user_id = $result_ary['admin_users_id'];
        $password = rand(111111, 999999);
        $update = "UPDATE admin_users SET admin_users_password = '" . generatePassword($password) . "' WHERE admin_users_id ='" . $user_id . "'";
        update($update);

        http_response_code(200);
        $msg = 'Hello <strong>' . ucfirst($result_ary['admin_users_title']) . '</strong>,<br/><br/>Your Password hass been changed. Password : <strong>' . $password . '</strong><br/><br/><br/>Thanks<br/>.';
        sendMail($result_ary['admin_users_user_name'], 'Forgot Password', $msg, '');
        $data = array();
        $result_json = array('status' => true, 'status_code' => 200, 'message' => "Password Successfully Changed", 'data' => $data);
        return $result_json;
    } else {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Invalid User", 'data' => $data);
        return $result_json;
    }
}
function updateToken()
{
    $data = json_decode(file_get_contents("php://input"));
    $ip = getRealIpAddr();
    $login_info = getLoginInfo();
    $login_id = $login_info->userId;
    $app_token = $data->app_code;
    if (empty($login_id)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "User Id cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (empty($app_token)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Token cannot be empty", 'data' => $data);
        return $result_json;
    }
    $update = "UPDATE admin_users SET admin_users_notification_token	 = '" . $app_token . "' WHERE admin_users_id	  = '" . $login_id . "'";
    insert($update);

    http_response_code(200);
    $data = array();
    $result_json = array('status' => true, 'status_code' => 200, 'message' => "Token Successfully Changed", 'data' => $data);
    return $result_json;
}
function emailExist()
{
    $employee_email    = (isset($_REQUEST['employee_email'])) ? $_REQUEST['employee_email'] : '';
    $select_profile =    "SELECT * FROM admin_users
						 WHERE admin_users_delete_status = 0  
						 AND admin_users_email = '" . $employee_email . "'  ";
    list($row, $record_profile) = selectRow($select_profile);
    if (!empty($record_profile['admin_users_id'])) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Email Already Exits....", 'data' => $data);
        return $result_json;
    } else {
        http_response_code(200);
        $data = array();
        $result_json = array('status' => true, 'status_code' => 200, 'message' => "No Record Found", 'data' => $data);
        return $result_json;
    }
}
function employeeFaceRemove()
{
    $emp_id  = $_REQUEST['id'];
    if (empty($emp_id)) {
        http_response_code(200);
        return array('http_statu_code' => 400, "api_data" =>  (object) array(), "date_time" => date('d/m/Y H:i:s'), "api_msg" => "Primary Id cannot be empty.");
    }
    $update = "UPDATE admin_users SET admin_users_face_data	= '' WHERE admin_users_employee_id  = '" . $emp_id     . "'";
    $update_id = update($update);

    if ($update_id > 0) {
        http_response_code(200);
        $data = array('admin_users_employee_id' => (int)$emp_id);
        return array('http_statu_code' => 200, "api_data" => $data, "date_time" => date('d/m/Y H:i:s'), "api_msg" => "Face Removed Successful ");
    } else if ($update_id == 0) {
        http_response_code(200);
        return array('http_statu_code' => 400, "api_data" =>  (object) array(), "date_time" => date('d/m/Y H:i:s'), "api_msg" => "No Changes");
    } else {
        http_response_code(200);
        return array('http_statu_code' => 400, "api_data" =>  (object) array(), "date_time" => date('d/m/Y H:i:s'), "api_msg" => "Something Went Wrong");
    }
}
function listEmployee()
{
    $login_info = getLoginInfo();

    $login_id         = $login_info->userId;
    $level            = $login_info->level;
    $register_status  = $login_info->register_status;
    $scan_status      = $login_info->scan_status;
    $branch_id        = $login_info->branch_id;
    $face_type        = $_REQUEST['face_type'];
    if (empty($login_id)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Login ID cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (($register_status + $scan_status) <= 0) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Permission Denied", 'data' => $data);
        return $result_json;
    }
    if (empty($face_type)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Face Type cannot be empty", 'data' => $data);
        return $result_json;
    }
    if ($face_type == 'pending') {
        $where = " AND admin_users_face_data = '' ";
    } else if ($face_type == 'complete') {
        $where = " AND admin_users_face_data != '' ";
    }
    if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
        $where .= " AND employee_name LIKE '%" . $_REQUEST['name'] . "%' ";
    }
    if (isset($_REQUEST['code']) && $_REQUEST['code'] != '') {
        $where .= " AND employee_code LIKE '%" . $_REQUEST['code'] . "%' ";
    }
    $select_employee = "SELECT employees.*, department_name, designation_name, admin_users_face_data,admin_users_image, employee_branch_id FROM employees 
                        LEFT JOIN departments ON department_id = employee_department_id
                        LEFT JOIN designations ON designation_id = employee_designation_id
                        LEFT JOIN admin_users ON admin_users_employee_id = employee_id 
                        WHERE employee_deleted_status = 0 
                        AND admin_users_level = 'employee' $where AND employee_branch_id = '" . $branch_id . "'
                        ORDER BY employee_name ASC";

    list($row, $result_employee) = selectRows($select_employee);
    $arrayData = array();
    $sno = 0;
    foreach ($result_employee as $record_employee) {

        $arrayData[$sno]['employee_id']       = (int)$record_employee['employee_id'];
        $arrayData[$sno]['employee_code']       = $record_employee['employee_code'];
        $arrayData[$sno]['employee_name']     = $record_employee['employee_name'];
        $arrayData[$sno]['department_name']   = $record_employee['department_name'];
        $arrayData[$sno]['designation_name']  = $record_employee['designation_name'];
        $arrayData[$sno]['branch_id']         = $record_employee['employee_branch_id'];
        $arrayData[$sno]['face_data']         = $record_employee['admin_users_face_data'];
        $arrayData[$sno]['image_url']         = $record_employee['admin_users_image'];
        $sno = $sno + 1;
    }
    http_response_code(200);
    $result_json = array('status' => true, 'status_code' => 200, 'message' => "Employee List", 'data' => $arrayData);
    return $result_json;
}
function registerFace()
{
    $login_info = getLoginInfo();
    $login_id   = $login_info->userId;
    $level      = $login_info->level;
    $master_id  = $login_info->master_id;
    $register_status  = $login_info->register_status;

    $ip = getRealIpAddr();
    $data = json_decode(file_get_contents("php://input"));

    $face_data = $data->face_data;
    $employee_id = $data->employee_id;
    $imageUrl = $data->image_url;
    if (empty($login_id)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Login ID cannot be empty", 'data' => $data);
        return $result_json;
    }
    if ($register_status == 0) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Permission Denied", 'data' => $data);
        return $result_json;
    }
    if (empty($face_data)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Face Data cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (empty($employee_id)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Employee ID cannot be empty", 'data' => $data);
        return $result_json;
    }
    $update = "UPDATE admin_users SET admin_users_face_data 	= '" . $face_data . "',
	           admin_users_image 	    = '" . $imageUrl . "',
			   admin_users_modified_by 	= '" . $login_id . "',
    		   admin_users_modified_on	= UNIX_TIMESTAMP(NOW()),
			   admin_users_modified_ip 	= '" . $ip . "'
			   WHERE admin_users_employee_id  = '" . $employee_id . "' AND admin_users_level = 'employee' ";
    $update_id = update($update);
    if ($update_id > 0) {
        http_response_code(200);
        $data = array('face_data' => $face_data);
        $result_json = array('status' => true, 'status_code' => 200, 'message' => "Successfully Updated", 'data' => $data);
        return $result_json;
    } else {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Something went wrong", 'data' => $data);
        return $result_json;
    }
}
function updateAttendance()
{
    $login_info = getLoginInfo();
    $login_id   = $login_info->userId;
    $level      = $login_info->level;
    $master_id  = $login_info->master_id;
    $branch_id  = $login_info->branch_id;
    $ip = getRealIpAddr();



    if (empty($login_id)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Login ID cannot be empty", 'data' => $data);
        return $result_json;
    }
    $data = json_decode(file_get_contents("php://input"));

    $employee_id   = isset($data->employee_id) ? $data->employee_id : '';
    $added_by      = isset($data->added_by)    ? $data->added_by : '';
    $guid          = isset($data->guid)        ? $data->guid : '';
    $lat           = isset($data->lat)         ? $data->lat : '';
    $long          = isset($data->long)        ? $data->long : '';
    $compnayId     = isset($data->company_id)  ? $data->company_id : '';
    $branchId      = isset($data->branch_id)   ? $data->branch_id : '';
    $location      = isset($data->location)    ? $data->location : '';
    $status        = isset($data->status)      ? $data->status : '';
    $dateTime      = isset($data->datetime)    ? $data->datetime : '';


    if (empty($employee_id)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Employee ID cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (empty($dateTime)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Date and Time cannot be empty", 'data' => $data);
        return $result_json;
    }

    $datetime    = date('Y-m-d H:i:s', strtotime($dateTime));
    $date_arr    = explode(" ", $datetime);
    $log_date    = $date_arr[0];
    $log_time    = $date_arr[1];


    $select = "SELECT attendance_detail_id FROM attendance_detail WHERE attendance_detail_uniq_id = '" . $guid . "' ";
    list($row, $record) = selectRow($select);

    if (!empty($record['attendance_detail_id'])) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Already Exist", 'data' => $data);
        return $result_json;
    }
    $insert = "INSERT INTO attendance_detail  SET   
               attendance_detail_uniq_id 	     = '" . $guid . "',
               attendance_detail_emp_id 	     = '" . $employee_id . "',
               attendance_detail_date 	         = '" . $log_date . "',
               attendance_detail_time 	         = '" . $log_time . "',
               attendance_detail_check_status    = '" . $status . "',
               attendance_detail_datetime 	     = '" . $datetime . "',
               attendance_detail_lat 	         = '" . $lat . "',
               attendance_detail_long 	         = '" . $long . "',
               attendance_detail_company_id      = '" . $compnayId . "',
               attendance_detail_branch_id       = '" . $branchId . "',
               attendance_detail_location        = '" . !empty($location) ? $location : '-' . "',
               attendance_detail_source 	     = 'app',
			   attendance_detail_added_by 	     = '" . $added_by . "'  ";

    $insert_id = insert($insert);
    if ($insert_id > 0) {

        hrLogPush($insert_id);

        http_response_code(200);
        $data = array('id' => $insert_id, 'logtime' => $datetime);
        $result_json = array('status' => true, 'status_code' => 200, 'message' => "Successfully Updated", 'data' => $data);
        return $result_json;
    } else {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Something went wrong", 'data' => $data);
        return $result_json;
    }
}
function updateAttendanceMultiple()
{
    $login_info = getLoginInfo();
    $login_id   = $login_info->userId;
    $level      = $login_info->level;
    $master_id  = $login_info->master_id;
    $ip = getRealIpAddr();
    $data = json_decode(file_get_contents("php://input"), true);

    if (empty($login_id)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Login ID cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (empty($data['arr'])) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Dataset Cannot Be Empty", 'data' => $data);
        return $result_json;
    }

    $added_by = $data['added_by'];
    $arr      = $data['arr'];

    $success = 0;
    $failure = 0;
    $total = count($arr);
    $data  = array();
    $sno   = 0;
    foreach ($arr as $get1) {
        $guid = $get1['guid'];
        $employee_id = $get1['employee_id'];
        $lat = $get1['lat'];
        $long = $get1['long'];
        $datetime = date('Y-m-d H:i:s', strtotime($get1['datetime']));
        $date_arr = explode(" ", $datetime);
        $log_date = $date_arr[0];
        $log_time = $date_arr[1];
        $select = "SELECT attendance_detail_id FROM attendance_detail WHERE attendance_detail_uniq_id = '" . $guid . "' ";
        list($row, $record) = selectRow($select);
        if (empty($record['attendance_detail_id'])) {
            $insert = "INSERT INTO attendance_detail  SET   
                       attendance_detail_uniq_id 	= '" . $guid . "',
                       attendance_detail_emp_id 	= '" . $employee_id . "',
                       attendance_detail_date 	    = '" . $log_date . "',
                       attendance_detail_time 	    = '" . $log_time . "',
                       attendance_detail_datetime 	= '" . $datetime . "',
                       attendance_detail_lat 	    = '" . $lat . "',
                       attendance_detail_long 	    = '" . $long . "',
                       attendance_detail_source 	= 'app',
        			   attendance_detail_added_by 	= '" . $added_by . "'  ";

            $insert_id = insert($insert);
            if ($insert_id > 0) {

                hrLogPush($insert_id);

                $success = $success + 1;
                $data[$sno]['employee_id'] = (int)$employee_id;
                $data[$sno]['guid'] = $guid;
                $data[$sno]['lat'] = $lat;
                $data[$sno]['long'] = $long;
                $data[$sno]['datetime'] = $datetime;
                $data[$sno]['status'] = 'sucess';
                $sno = $sno + 1;
            } else {
                $failure = $failure + 1;
                $data[$sno]['employee_id'] = (int)$employee_id;
                $data[$sno]['guid'] = $guid;
                $data[$sno]['lat'] = $lat;
                $data[$sno]['long'] = $long;
                $data[$sno]['datetime'] = $datetime;
                $data[$sno]['status'] = 'failure';
                $sno = $sno + 1;
            }
        } else {
            $total = $total - 1;
            $data[$sno]['employee_id'] = (int)$employee_id;
            $data[$sno]['guid'] = $guid;
            $data[$sno]['lat'] = $lat;
            $data[$sno]['long'] = $long;
            $data[$sno]['datetime'] = $datetime;
            $data[$sno]['status'] = 'exist';
            $sno = $sno + 1;
        }
    }
    http_response_code(200);
    $result_json = array('status' => true, 'status_code' => 200, 'message' => "Successfully Updated", 'data' => $data);
    return $result_json;
}

function lastAttendanceEntry()
{
    switch ($_SERVER["REQUEST_METHOD"]) {

        case 'GET':
            if (isset($_REQUEST['type']) && !empty($_REQUEST['type']) == 'all') {
                return getAttendanceEntry();
            } else {
                return getLastAttendanceEntry();
            }
            break;
        default:
            return 'Request method not allowed';
            break;
    }
}

function getLastAttendanceEntry()
{

    if (empty($_REQUEST['empId'])) {
        http_response_code(203);
        return  "Employee Id cannot be empty";
    }
    $select_last_entry  = "SELECT * FROM attendance_detail
						   WHERE attendance_detail_source ='app' 
                           AND attendance_detail_emp_id = '" . $_REQUEST['empId'] . "'
					       ORDER BY attendance_detail_datetime DESC LIMIT 1";

    list($rows, $array_result) = selectRows($select_last_entry);

    $arrD = array();

    if ($rows > 0) {
        foreach ($array_result as $records) {

            if (date('Y-m-d') == $records['attendance_detail_date']) {
                $arrD['id']            =  $records['attendance_detail_id'];
                $arrD['employeeId']    =  $records['attendance_detail_emp_id'];
                $arrD['status']        =  $records['attendance_detail_check_status'];
                $arrD['empDeviceId']   =  $records['attendance_detail_emp_device_id'];
                $arrD['date']          =  $records['attendance_detail_date'];
                $arrD['time']          =  $records['attendance_detail_time'];
                $arrD['dateTime']      =  $records['attendance_detail_datetime'];
                $arrD['lat']           =  $records['attendance_detail_lat'];
                $arrD['long']          =  $records['attendance_detail_long'];
                $arrD['source']        =  $records['attendance_detail_source'];
                $arrD['location']      =  $records['attendance_detail_location'];
            } else {
                $arrD['id']            =   '';
                $arrD['employeeId']    =  $_REQUEST['empId'];
                $arrD['status']        =   '';
                $arrD['empDeviceId']   =   '';
                $arrD['date']          =   '';
                $arrD['time']          =   '';
                $arrD['dateTime']      =   '';
                $arrD['lat']           =   '';
                $arrD['long']          =   '';
                $arrD['source']        =   '';
                $arrD['location']      =   '';
            }
        }
    } else {
        $arrD['id']            =   '';
        $arrD['employeeId']    =  $_REQUEST['empId'];
        $arrD['status']        =   '';
        $arrD['empDeviceId']   =   '';
        $arrD['date']          =   '';
        $arrD['time']          =   '';
        $arrD['dateTime']      =   '';
        $arrD['lat']           =   '';
        $arrD['long']          =   '';
        $arrD['source']        =   '';
        $arrD['location']      =   '';
    }

    http_response_code(200);
    return $arrD;
}


function getAttendanceEntry()
{
    $login_info = getLoginInfo();
    $empId = $login_info->master_id;

    $where = '';
    if (!empty($empId)) {
        $where = "AND attendance_detail_emp_id = '" . $empId . "'";
    }
    if (!empty($_REQUEST['fromDate']) && !empty($_REQUEST['toDate'])) {
        $where = "AND attendance_detail_date BETWEEN '" . $_REQUEST['fromDate'] . "' AND '" . $_REQUEST['toDate'] . "'";
    }
    $select_last_entry  = "SELECT * FROM attendance_detail
                           LEFT JOIN employees ON employee_id = attendance_detail_emp_id
						   WHERE attendance_detail_source ='app' 
                           $where ORDER BY attendance_detail_datetime DESC";
    list($rows, $array_result) = selectRows($select_last_entry);

    $arrD = array();
    $s = 0;
    if (count($array_result) > 0) {

        foreach ($array_result as $records) {

            $arrD[$s]['id']            =  $records['attendance_detail_id'];
            $arrD[$s]['employeeId']    =  $records['attendance_detail_emp_id'];
            $arrD[$s]['name']          =  $records['employee_name'];
            $arrD[$s]['status']        =  $records['attendance_detail_check_status'];
            $arrD[$s]['empDeviceId']   =  $records['attendance_detail_emp_device_id'];
            $arrD[$s]['date']          =  $records['attendance_detail_date'];
            $arrD[$s]['time']          =  $records['attendance_detail_time'];
            $arrD[$s]['dateTime']      =  $records['attendance_detail_datetime'];
            $arrD[$s]['lat']           =  $records['attendance_detail_lat'];
            $arrD[$s]['long']          =  $records['attendance_detail_long'];
            $arrD[$s]['source']        =  $records['attendance_detail_source'];
            $arrD[$s]['location']      =  $records['attendance_detail_location'];


            $s++;
        }
        http_response_code(200);
        return $arrD;
    }
    http_response_code(200);
    return "No Data";
}

function updateMissingAttendance()
{
    $login_info = getLoginInfo();
    $login_id   = $login_info->userId;
    $level      = $login_info->level;
    $employee_id  = $login_info->master_id;
    $branchId  = $login_info->branch_id;
    $compnayId = $login_info->company_id;

    $ip = getRealIpAddr();
    $uniq_id = generateUniqId();

    $data = json_decode(file_get_contents("php://input"));
    //	print_r($data); exit;
    if (empty($login_id)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Login ID cannot be empty", 'data' => $data);
        return $result_json;
    }

    $currentDate = date("Y-m-d H:i:s");

    $guid = $data->guid;
    $in_guid = $data->inGuid;
    $lat = $data->lat;
    $long = $data->long;
    $in_time = $data->inTime;
    $out_time = $data->outTime;

    $in_datetime = date('Y-m-d H:i:s', strtotime($data->inDatetime));
    $in_date_arr = explode(" ", $in_datetime);
    $in_log_date = $in_date_arr[0];
    $in_log_time = $in_date_arr[1];

    $out_datetime = date('Y-m-d H:i:s', strtotime($data->outDatetime));
    $out_date_arr = explode(" ", $out_datetime);
    $out_log_date = $out_date_arr[0];
    $out_log_time = $out_date_arr[1];

    $location = isset($data->location) ? $data->location : '';
    if (empty($employee_id)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Employee ID cannot be empty", 'data' => $data);
        return $result_json;
    }
    if (empty($in_datetime) && empty($out_datetime)) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Date and Time cannot be empty", 'data' => $data);
        return $result_json;
    }

    if ($in_datetime >= $currentDate && $out_datetime >= $currentDate) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Select Less than Current Date and Time", 'data' => $data);
        return $result_json;
    }
    $select = "SELECT attendance_detail_id FROM attendance_detail WHERE attendance_detail_uniq_id = '" . $guid . "' ";
    list($row, $record) = selectRow($select);
    if (!empty($record['attendance_detail_id'])) {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Already Exist", 'data' => $data);
        return $result_json;
    }

    if (!empty($in_time)) {
        $insert_in = "INSERT INTO attendance_detail  SET   
                      attendance_detail_uniq_id 	  = '" . $in_guid . "',
                      attendance_detail_emp_id 	      = '" . $employee_id . "',
                      attendance_detail_date 	      = '" . $in_log_date . "',
                      attendance_detail_time 	      = '" . $in_log_time . "',
                      attendance_detail_check_status  = 'in',
                      attendance_detail_datetime 	  = '" . $in_datetime . "',
                      attendance_detail_lat 	      = '" . $lat . "',
                      attendance_detail_long 	      = '" . $long . "',
                      attendance_detail_company_id    = '" . $compnayId . "',
                      attendance_detail_branch_id     = '" . $branchId . "',
                      attendance_detail_location      = '" . !empty($location) ? $location : '-' . "',
                      attendance_detail_type          ='1',
                      attendance_detail_source 	      = 'app',
                      attendance_detail_added_by 	  = '" . $login_id . "'  ";

        insert($insert_in);
    }
    if (!empty($out_time)) {
        $insert = "INSERT INTO attendance_detail  SET   
                           attendance_detail_uniq_id 	     = '" . $guid . "',
                           attendance_detail_emp_id 	     = '" . $employee_id . "',
                           attendance_detail_date 	         = '" . $out_log_date . "',
                           attendance_detail_time 	         = '" . $out_log_time . "',
                           attendance_detail_check_status    = 'out',
                           attendance_detail_datetime 	     = '" . $out_datetime . "',
                           attendance_detail_lat 	         = '" . $lat . "',
                           attendance_detail_long 	         = '" . $long . "',
                           attendance_detail_company_id      = '" . $compnayId . "',
                           attendance_detail_branch_id       = '" . $branchId . "',
                           attendance_detail_location        = '" . $location . "',
                           attendance_detail_type            ='1',
                           attendance_detail_source 	     = 'app',
						   attendance_detail_added_by 	     = '" . $login_id . "'  ";


        $insert_id = insert($insert);
    }
    if ($insert_id > 0) {
        http_response_code(200);
        $data = array('id' => $insert_id);
        $result_json = array('status' => true, 'status_code' => 200, 'message' => "Successfully Updated", 'data' => $data);
        return $result_json;
    } else {
        http_response_code(500);
        $data = array();
        $result_json = array('status' => false, 'status_code' => 500, 'message' => "Something went wrong", 'data' => $data);
        return $result_json;
    }
}




echo json_encode($jsonData, JSON_PRETTY_PRINT);
