<?php
require_once "header.php";
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_POST["x"], false);
$op1 =  trim($obj->id);
if ($op1 != ''){
	$pp1 = $obj->nextrecord;
	$pp2 = $obj->perpage;
	$hotel_county = $obj->id_cnt;
	$hotel_type = $obj->id_type;
	$hotel_room = $obj->id_room;
	$hotel_price_low = $obj->id_low;
	$hotel_price_hi = $obj->id_hi;
	$where   = "where ((`hotel_price_low` >= '{$hotel_price_low}' and `hotel_price_low` <= '{$hotel_price_hi}') or (`hotel_price_hi` >= '{$hotel_price_low}' and `hotel_price_hi` <= '{$hotel_price_hi}') or (`hotel_price_low` <= '{$hotel_price_low}' and `hotel_price_hi` >= '{$hotel_price_hi}'))";
	if ($hotel_county !=''){
		$where   .= " and `hotel_county` = '{$hotel_county}'" ;
	}

	if ($hotel_type !=''){
		$where   .= " and `hotel_type` = '{$hotel_type}'" ;
	}		

	if ($hotel_room !=''){
		$where   .= " and `hotel_room` like '%{$hotel_room}%'" ;
	}	
       //$result = $mysqli->query("SELECT `hotel_title`,`hotel_room`,`hotel_sn` FROM ".$obj->table ." where `hotel_title` like '%{$op1}%'")  or die($mysqli->connect_error);
$result = $mysqli->query("SELECT count(*) as total from hotel $where") or die($mysqli->connect_error);
$data=mysqli_fetch_assoc($result);
$hint = $data['total'] ;	
//$outp = array($hint);
$outp = $hint  ;

}else{
$outp = "";
}
//echo json_encode($outp);
echo $outp;

?>