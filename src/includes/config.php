<?php

// define('PROJECT_PATH', 'https://arasoftwares.com/ara-attendance/');
// define('ACTIVE_PATH', 'arasoftwares.com/ara-attendance');

// define('PROJECT_PATH', 'http://dev.arasoftwares.in/ara-attendance/');
// define('ACTIVE_PATH', 'dev.arasoftwares.in/ara-attendance/');

define('PROJECT_PATH', 'http://localhost/machine/');
define('ACTIVE_PATH', 'localhost/machine/');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();
session_start();

define("TZ_TIMEZONE", "Asia/Kolkata"); // Time zone
// Timezone Setting
date_default_timezone_set(TZ_TIMEZONE);

//LIVE SERVER 
// define("HOST_NAME", "localhost");
// define("USERNAME", "arasoft_attend");
// define("PASSWORD","uYyt8MeNEfSr");
// define("DATABASE", "arasoft_attend");

//DEV SERVER
// define("HOST_NAME", "localhost");
// define("USERNAME", "devaras_attenda");
// define("PASSWORD","wgoTyLoxXP1a");
// define("DATABASE", "devaras_attendance");

//LOCAL
define("HOST_NAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "machine_org");


// Database connection
function db_connction()
{

    $connection = mysqli_connect(HOST_NAME, USERNAME, PASSWORD);
    $error = mysqli_error($connection);
    if (!$connection) {
        print("Error Occurred: " . $error);
    }
    mysqli_select_db($connection, DATABASE);
    return $connection;
}

define("PROJECT_TITLE", "ara-Attendance");
define("PROJECT_NAME", "ara-Attendance");
define("PRODUCT_NAME", "ara-Attendance");

// Define Session variables Prefix
define("SESS", "Ara-Attendance");

$inactive = 10000;
// check to see if $_SESSION["timeout"] is set
if (isset($_SESSION["timeout"])) {
    // calculate the session's "time to live"
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactive) {
        session_destroy();
        header("Location:" . PROJECT_PATH . "/");
        exit();
    }
}
$_SESSION["timeout"] = time();
//Common Query Function
function insert($query)
{
    $dbc = db_connction();
    if (!empty($query)) {
        $res = mysqli_query($dbc, $query);
        $id  = mysqli_insert_id($dbc);
        mysqli_close($dbc);
        if ($id > 0) {
            return $id;
        } else {
            return 0;
        }
    }
    return 0;
}
function update($query)
{
    $dbc = db_connction();
    if (!empty($query)) {
        $res  = mysqli_query($dbc, $query);
        $cnt  = mysqli_affected_rows($dbc);
        mysqli_close($dbc);
        if ($cnt > 0) {
            return $cnt;
        } else {
            return 0;
        }
    }
    return 0;
}
function selectRow($query)
{
    $dbc = db_connction();
    if (!empty($query)) {
        $res   = mysqli_query($dbc, $query);
        $cnt   = mysqli_num_rows($res);
        $data  = mysqli_fetch_array($res);
        mysqli_close($dbc);
        if (!empty($data)) {
            return array($cnt, $data);
        } else {
            return array(0, array());
        }
    }
    return array(0, array());
}
function selectRows($query)
{
    $dbc = db_connction();
    if (!empty($query)) {
        $res  = mysqli_query($dbc, $query);
        //echo $$query;
        //echo "<br>";
        $cnt  = mysqli_num_rows($res);
        if ($cnt > 0) {
            $data = array();
            while ($rec = mysqli_fetch_array($res)) {
                $data[]    = $rec;
            }
            mysqli_close($dbc);
            return array($cnt, $data);
        } else {
            return array(0, array());
        }
    }
    return array(0, array());
}


function selectAsscRow($query)
{
    $dbc = db_connction();
    if (!empty($query)) {
        $res   = mysqli_query($dbc, $query);
        $cnt   = mysqli_num_rows($res);
        $data  = mysqli_fetch_assoc($res);
        mysqli_close($dbc);
        if (!empty($data)) {
            return array($cnt, $data);
        } else {
            return array(0, array());
        }
    }
    return array(0, array());
}

function selectAsscRows($query)
{
    $dbc = db_connction();
    if (!empty($query)) {
        $res  = mysqli_query($dbc, $query);
        $cnt  = mysqli_num_rows($res);
        if ($cnt > 0) {
            $data = array();
            while ($rec = mysqli_fetch_assoc($res)) {
                $data[]    = $rec;
            }
            mysqli_close($dbc);
            return array($cnt, $data);
        } else {
            return array(0, array());
        }
    }
    return array(0, array());
}

$_SESSION["timeout"] = time();
