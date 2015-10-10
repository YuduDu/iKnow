<?php
require_once "db_func.php";
if(isset($_POST['action'])&&$_POST['action']!=""){
	switch($_POST['action']){
		case 'get_news':getnews(); break;
		case 'get_recommand_service':recommand_service(); break;
		case 'get_recommand_massagist':recommand_massagesit(); break;
		case 'get_recommand_news':{
			if(!isset($_POST['id'])) {
				//echo "hehe";
				recommand_news();
			}
			else recommand_news($_POST['id']);
			//recommand_news();
		}break;
		case 'get_massagist_list':getmassagistlist(); break;
		case 'get_services_list':
		{
			//echo "hehe1";
			if(isset($_POST["categoryid"])&&$_POST["categoryid"]!=null){
				//echo "hehe2";
				if($_POST["categoryid"]=="null"){
					getserviceslist();
				}
				else
					getservicesbycategory($_POST["categoryid"]);
			}
			else echo "Error: categoryid wrong";

		}break;
		case 'get_order_list':{
			if(isset($_POST['customid'])&&$_POST['customid']!=null){
				getorderlist($_POST['customid']);
			}
			else echo "Error: no customerid";
		}break;
		/*case 'get_services_by_category':
		{


		}break;*/
		default:
	}
}


function getorderlist($customid = null){
	$con = DBconnect();
	$listinfo = DBfetchall2($con,"Order",array('orderid','servicename','shopid','shopname','status','unitprice'),array("customerid"=>$customid));
	//var_dump($listinfo);
	$list=array();
	foreach($listinfo as $item) {
		$pic = DBfetchone2($con, "Shop", array("pic"), array("shopid" => $item['shopid']));
		$item=array_merge($item,$pic);
		unset($item['shopid']);
		$list[]=$item;
	}
	echo json_encode($list);

}
function recommand_news($id=null){
	//var_dump(is_int($id));
	$con = DBconnect();
	if($id!=null){
		//$query = "SELECT * FROM Recommand_news WHERE id = ".$id.";";
		$result = DBfetchone2($con,'Recommand_news',array('*'),array('id'=>$id));
		echo json_encode($result);
	}
	else{
		//$query = "SELECT id, title, pic FROM Recommand_news";
		$result = DBfetchall2($con,'Recommand_news',array('id','title','pic'));
		echo json_encode($result);

	}

}
function getservicesbycategory($categoryid){
	//echo “hehe”;
	$con = DBconnect();
	$query = "SELECT serviceid,shopid,name,price FROM Service WHERE catid=".$categoryid.";";
	//$getcatname = "SELECT name FROM Category WHERE catid = ".$categoryid.";";
//	$catname = DBfetchone($getcatname,$con);
	$result = DBfetchall($query,$con);
	$arr = getserviceslistinfo_by_basicinfo($result,$con);
//	$return=array($catname["name"]=>$arr);
	echo json_encode($arr);
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
	$Arr =getserviceslistinfo_by_basicinfo($getservice,$con);
	echo json_encode($Arr);
}

function getserviceslistinfo_by_basicinfo($array,$con){
	$Arr = array();
	foreach ($array as $row){
		$row2 = DBfetchone("select name,pic,latitude,longtitude from Shop where shopid=".$row["shopid"].";" , $con);
		$a=array("serviceid"=>$row["serviceid"],"shopname"=>$row2["name"],"servicename"=>$row["name"],"price"=>$row["price"],"pic"=>$row2["pic"],"latitude"=>$row2["latitude"],"longtitude"=>$row2["longtitude"]);
		//var_dump($row2);
		array_push($Arr,$a);
	}
	return $Arr;
}
?>
