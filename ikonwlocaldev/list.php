<?php
require_once "db_func.php";
if(isset($_POST['action'])&&$_POST['action']!=""){
	switch($_POST['action']){
		case 'get_news':getnews(); break;
		case 'get_recommand_service':recommand_service(); break;
		case 'get_recommand_massagist':recommand_massagesit(); break;
		case 'get_massagist_list':getmassagistlist(); break;
		case 'get_services_list':getserviceslist(); break;
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

function recommand_service(){
	$con =DBconnect();
	$getservice = DBfetchall("SELECT serviceid, shopname, servicename, price, pic, latitude, longtitude FROM Recommand_service",$con);
	echo json_encode($getservice);
}

function recommand_massagesit(){
	$con = DBconnect();
	$result = DBfetchall("SELECT massagistid,shopname,name,stars,intro,pic,latitude,longtitude FROM Recommand_massagist",$con);
	echo json_encode($result);


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
		$row2=DBfetchone("select name,latitude,longtitude from Shop where shopid=".$row["shopid"].";" , $con);
		//echo $row[0],$row[1];
		$a=array("massagistid"=>$row["phone"],"shopname"=>$row2["name"],"name"=>$row["name"],"stars"=>$row["stars"],"intro"=>$row["intro"],"pic"=>$row["pic"],"latitude"=>$row2["latitude"],"longtitude"=>$row2["longtitude"]);
		//echo $a;
		array_push($Arr,$a);
	}
	echo json_encode($Arr);
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
