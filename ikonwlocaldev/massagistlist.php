<?php
require_once "db_func.php";
if(isset($_POST['action'])&&$_POST['action']!=""){
	switch($_POST['action']){
		case 'get_massagist_list':getmassagistlist(); break;
		default:
	}
}

function getmassagistlist(){
	$con = DBconnect();
	$getmassagist = mysql_query("SELECT shopid,phone,name,stars,intro,pic FROM MassagistDetail",$con);
	//echo $getservice;
	$Arr = array();
	while($row=mysql_fetch_row($getmassagist)){
		$getshopname = mysql_query("select name from Shop where shopid=".$row[0].";" , $con);
		$row2=mysql_fetch_array($getshopname);
		//echo $row[0],$row[1];
		$a=array("massagistid"=>$row[1],"shopname"=>$row2[0],"name"=>$row[2],"stars"=>$row[3],"intro"=>$row[4],"pic"=>$row[5]);
		//echo $a;
		array_push($Arr,$a);
	}
	echo json_encode($Arr);
}
?>
