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
	$getservice = mysql_query("SELECT serviceid,shopid,name,price FROM Service",$con);
	$Arr = array();
	while($row=mysql_fetch_row($getservice)){
		$getshopname = mysql_query("select name,pic from Shop where shopid=".$row[1].";" , $con);
		$row2=mysql_fetch_array($getshopname);
		$a=array("serviceid"=>$row[0],"shopname"=>$row2[0],"servicename"=>$row[2],"price"=>$row[3],"pic"=>$row2[1]);
		array_push($Arr,$a);
	}
	echo json_encode($Arr);
}
?>
