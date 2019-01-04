<?php
require_once "header.php";
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
$result = $mysqli->query("SELECT count(*) as total from hotel") or die($mysqli->connect_error);
$data=mysqli_fetch_assoc($result);
$hint = $data['total'] ;

// Output "no suggestion" if no hint was found or output correct values 
echo $hint == "" ? "查無資料" : $hint;
?>