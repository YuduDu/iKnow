<?php
require_once "db_func.php";
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
		$row2 = DBfetchone("select name,pic,latitude,longtitude from Shop where shopid=".$row[1].";" , $con);
		$a=array("serviceid"=>$row[0],"shopname"=>$row2[0],"servicename"=>$row[2],"price"=>$row[3],"pic"=>$row2[1],"latitude"=>$row2[2],"longtitude"=>$row2[3]);
		//var_dump($row2);
		array_push($Arr,$a);
	}
	echo json_encode($Arr);
}
?>
