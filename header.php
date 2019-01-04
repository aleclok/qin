<?php
session_start();
//error_reporting(0);
date_default_timezone_set('Asia/Taipei');
require_once "config.php";
require_once "function.php";

$mysqli = new mysqli(_DB_HOST, _DB_ID, _DB_PW, _DB_NAME);
if ($mysqli->connect_error) {
    die('無法連上資料庫 (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");

