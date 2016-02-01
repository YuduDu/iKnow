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
		$a=array("newsid"=>$row["id"],"newstitle"=>$row["title"],"newscontent"=>$row["content"],"pic"=>$row["pic"]);
		array_push($Arr,$a);
	}
	echo json_encode($Arr);
}
?>
