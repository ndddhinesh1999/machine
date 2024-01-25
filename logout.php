<?php
include 'src/includes/config.php';
include 'src/includes/utility_function.php';
$ip                          = getRealIpAddr();


foreach ($_SESSION as $key => $value) {
    if (strpos($key, SESS . '_') === 0) {
        unset($_SESSION[$key]);
    }
}
session_destroy();
header("Location:" . PROJECT_PATH);
exit();
