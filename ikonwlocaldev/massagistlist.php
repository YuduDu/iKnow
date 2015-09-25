<?php
require_once "db_func.php";
if(isset($_POST['action'])&&$_POST['action']!=""){
	switch($_POST['action']){
		case 'get_massagist_list':getmassagistlist(); break;
		default:
	}
}

function getmassagistlist(){
	//echo "start";
	$con = DBconnect();
	$result = DBfetchall("SELECT shopid,phone,name,stars,intro,pic FROM MassagistDetail",$con);
	//echo "get row";
	//echo $getservice;
	//echo $result;
	$Arr = array();
	foreach ($result as $row){
		//echo $row;
		//$getshopname = mysql_query("select name from Shop where shopid=".$row[0].";" , $con);
		$row2=DBfetchone("select name,latitude,longtitude from Shop where shopid=".$row[0].";" , $con);
		//echo $row[0],$row[1];
		$a=array("massagistid"=>$row[1],"shopname"=>$row2[0],"name"=>$row[2],"stars"=>$row[3],"intro"=>$row[4],"pic"=>$row[5],"latitude"=>$row2[1],"longtitude"=>$row2[2]);
		//echo $a;
		array_push($Arr,$a);
	}
	echo json_encode($Arr);
}
?>
