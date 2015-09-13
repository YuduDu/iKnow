<?php
require_once "db_func.php";
if(isset($_POST['action'])&&$_POST['action']!=""){
	switch($_POST['action']){
		case 'get_news':getnews(); break;
		default:
	}
}

function getnews(){
	$con=DBconnect();
	$result = DBfetchall("SELECT * FROM news",$con);
	//var_dump($result);
	//echo json_encode($result);
	$Arr = array();
	foreach($result as $row){
		$a=array("newsid"=>$row[0],"newstitle"=>$row[1],"newscontent"=>$row[2],"url"=>$row[3],"pic"=>$row[4]);
		array_push($Arr,$a);
	}
	echo json_encode($Arr);
}
?>
