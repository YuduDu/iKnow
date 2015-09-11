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
	$result = mysql_query("SELECT * FROM news",$con);
	$Arr = array();
	while($row=mysql_fetch_row($result)){
		$a=array("newsid"=>$row[0],"newstitle"=>$row[1],"newscontent"=>$row[2],"url"=>$row[3],"pic"=>$row[4]);
		array_push($Arr,$a);
	}
	echo json_encode($Arr);
}
?>
