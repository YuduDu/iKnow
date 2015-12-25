<?php
require_once "lib/db_func.php";
if(isset($_POST['action'])&&$_POST['action']!=""){
	switch($_POST['action']){
		case 'get_services_list':getserviceslist(); break;
		default:
	}
}

function getserviceslist(){
	$con =DBconnect();
	$getservice = DBfetchall("SELECT serviceid,shopid,name,price FROM Service",$con);
	$Arr = array();
	foreach ($getservice as $row){
		$row2 = DBfetchone("select name,pic,latitude,longtitude from Shop where shopid=".$row["shopid"].";" , $con);
		$a=array("serviceid"=>$row["serviceid"],"shopname"=>$row2["name"],"servicename"=>$row["name"],"price"=>$row["price"],"pic"=>$row2["pic"],"latitude"=>$row2["latitude"],"longtitude"=>$row2["longtitude"]);
		//var_dump($row2);
		array_push($Arr,$a);
	}
	echo json_encode($Arr);
}
?>
