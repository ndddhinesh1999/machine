<?php

$db_data_type = array("int" => "INT", "varchar" => "VARCHAR", "text" => "TEXT", "date" => "DATE", "datetime" => "DATETIME", "float" => "FLOAT", "tinyint" => "TINYINT");
function dataValidation($value)
{
	$dbc = db_connction();
	$value = trim(@htmlspecialchars($value));
	//if(get_magic_quotes_gpc()) { 
	$value = stripslashes($value);
	//}  
	$value = mysqli_real_escape_string($dbc, $value);
	return $value;
}

function dateDatabaseFormat($date)
{
	$date = implode('-', array_reverse(explode('/', $date)));
	return $date;
}
function dateGeneralFormat($date)
{
	$date = implode('/', array_reverse(explode('-', $date)));
	return $date;
}

function dateDisplayFormat($date)
{
	$date = date("F m, Y");
	return $date;
}

function fileUpload($file_name, $file_tmp_name, $file_rename, $path)
{
	// echo $file_tmp_name;exit;
	$file_rename     = preg_replace('/[^a-zA-Z0-9]/s', '-', $file_rename);
	$file_extn       = explode('.', $file_name);
	$file_name_space = str_replace(' ', '-', strtolower($file_rename));
	$file_new_name   = $file_name_space . '-' . uniqid() . '.' . $file_extn[1];
	//  echo $file_tmp_name,$path.$file_new_name;exit;
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
		// echo mkdir($path, 0770, true);exit;
	}
	if (move_uploaded_file($file_tmp_name, $path . $file_new_name)) {
		// echo 'upload';exit;
	} else {
		// echo 'Test';exit;
	}

	return $file_new_name;
}

function getRealIpAddr()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   // Check ip from share internet
	{
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   // To check ip is pass from proxy
	{
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function generateUniqId()
{
	$uniq_id_md5 = md5(uniqid());
	$uniq_id     = substr($uniq_id_md5, 0, 7) . generateRandomString(3) . substr($uniq_id_md5, 7, 4) . generateRandomString(5) . substr($uniq_id_md5, 11, 22);
	return $uniq_id;
}

function generateRandomString($length)
{
	$alphabet = "0123456789abcdefghijklmnopqrstuvwxyz";
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < $length; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}

function getFileName()
{
	$file_with_path = $_SERVER["PHP_SELF"];
	$parts = explode('/', $file_with_path);
	$file_name_extn =  $parts[count($parts) - 1];
	$file_name = explode('.', $file_name_extn);
	$file = $file_name[count($file_name) - 2];
	return $file;
}

function show_iage()
{
	$get_image = "SELECT  admin_users_image FROM  admin_users 
        WHERE admin_users_id = '" . $_SESSION[SESS . 'session_admin_users_id'] . "' ";
	list($count, $data) = selectRow($get_image);
	return $data;
}
function getRealPassword($password)
{
	$real_password = substr($password, 0, 7) . substr($password, 10, 4) . substr($password, 19, 21);
	return $real_password;
}

function generatePassword($password)
{
	$password = md5($password);
	$generate_password = substr($password, 0, 7) . generateRandomString(3) . substr($password, 7, 4) . generateRandomString(5) . substr($password, 11, 22);
	return $generate_password;
}

function sendMail($to, $subject, $message, $from)
{
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	// More headers
	$headers .= "From: $from" . "\r\n";
	mail($to, $subject, $message, $headers);
}
function createDateRangeArray($strDateFrom, $strDateTo)
{
	$aryRange = array();

	$iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2),     substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
	$iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2),     substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

	if ($iDateTo >= $iDateFrom) {
		array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry

		while ($iDateFrom < $iDateTo) {
			$iDateFrom += 86400; // add 24 hours
			array_push($aryRange, date('Y-m-d', $iDateFrom));
		}
	}
	return $aryRange;
}

function user_info($user_id, $user_lever)
{

	if (!empty($user_id) && !empty($user_lever)) {
		$where = '';
		if ($user_lever == 'company') {
			$where .= " AND admin_users_company_id = '" . $user_id . "' ";
		} else if ($user_lever == 'branch') {
			$where .= " AND admin_users_branch_id = '" . $user_id . "' ";
		} else if ($user_lever == 'employee') {
			$where .= " AND admin_users_employee_id = '" . $user_id . "' ";
		}
		$select = "SELECT * FROM  admin_users WHERE admin_users_delete_status = 0 $where ";
		list($num_row, $records) = selectRow($select);

		if ($num_row > 0) {
			echo 1;
			exit;
		} else {
			echo 2;
			exit;
		}
	}
}
function machine_detail()
{

	if (isset($_REQUEST['m_id']) && !empty($_REQUEST['m_id']) ? $_REQUEST['m_id'] : '') {
		$where = "AND machine_id ='" . $_REQUEST['m_id'] . "'";
	} else {
		$where = "";
	}
	$select = "SELECT * FROM machines 
	LEFT JOIN company ON company_id =machine_company_id
	WHERE machine_deleted_status = '0' AND  company_id ='" . $_SESSION[SESS . 'session_admin_users_company_id'] . "'  $where";
	list($row, $result) = selectRows($select);
	$array = array();
	$i = 0;
	if ($row > 1) {

		foreach ($result as $record) {
			$array[$i]['machine_id'] = $record['machine_id'];
			$array[$i]['machine_name'] = $record['machine_name'];
			$array[$i]['machine_model'] = $record['machine_model'];
			$array[$i]['machine_image'] = $record['machine_image'];
			$i++;
		}
	} else {
		foreach ($result as $record) {
			$array['machine_id'] = $record['machine_id'];
			$array['machine_name'] = $record['machine_name'];
			$array['machine_model'] = $record['machine_model'];
			$array['machine_image'] = $record['machine_image'];
		}
	}
	return $array;
}


function machine_type_detail()
{

	if (isset($_REQUEST['type']) && !empty($_REQUEST['type']) ? $_REQUEST['type'] : '') {
		$where = "AND category_id  ='" . $_REQUEST['type'] . "'";
	} else {
		$where = "";
	}
	$select = "SELECT * FROM categorys 
	LEFT JOIN company ON company_id =category_company_id
	WHERE category_deleted_status = '0' AND  company_id ='" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' $where";
	list($row, $result) = selectRows($select);
	$array = array();
	$i = 0;
	if ($row > 1) {

		foreach ($result as $record) {
			$array[$i]['category_id '] = $record['category_id'];
			$array[$i]['category_name'] = $record['category_name'];
			$i++;
		}
	} else {
		foreach ($result as $record) {
			$array['category_id'] = $record['category_id'];
			$array['category_name'] = $record['category_name'];
		}
	}
	return $array;
}

function companyDetails()
{
	return array('name' => 'GLOBE COMPONENTS (P) LTD', 'address' => 'CHENNAI -58', 'logo' => '../../assets/images/logos/gc.jpeg');
}
