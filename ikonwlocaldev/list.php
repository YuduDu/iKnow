<?php
require_once "db_func.php";


if(isset($_POST['action'])&&$_POST['action']!=""){
	switch($_POST['action']){
		case 'get_news':
		{
			if(isset($_POST['pagenum'])&&$_POST['pagenum']!=null&&'/'<$_POST['pagenum']&&$_POST['pagenum']<':')
			{
				getnews($_POST['pagenum']);
			}
			else getnews();
			break;
		}
		case 'get_recommand_service':
		{
			if(isset($_POST["location"])&&$_POST['location']!=null)
			{
				//var_dump($_POST['location']);
				$location = json_decode($_POST['location']);
				//var_dump($location);
				recommand_service($location);
			}
			break;
		}
		case 'get_recommand_massagist':
		{
			if(isset($_POST["location"])&&$_POST['location']!=null)
			{
				//var_dump($_POST['location']);
				$location = json_decode($_POST['location']);
				recommand_massagesit($location);
			}break;

		}
		case 'get_recommand_news':
		{
			if(isset($_POST["location"])&&$_POST['location']!=null) {
				$location = json_decode($_POST['location']);
				if (!isset($_POST['id'])) {
					recommand_news($location);
				}
			}
			else recommand_news($location, $_POST['id']);
			//recommand_news();
			break;
		}
		case 'get_massagist_list':
		{
			if(isset($_POST["location"])&&$_POST['location']!=null) {
				$location = json_decode($_POST['location']);
				if (isset($_POST['pagenum']) && $_POST['pagenum'] != null && '/' < $_POST['pagenum'] && $_POST['pagenum'] < ':') {
					getmassagistlist($location,$_POST['pagenum']);
				} else getmassagistlist($location);
			}
			break;
		}
		case 'get_services_list':
		{
			if(isset($_POST["location"])&&$_POST['location']!=null) {
				$location = json_decode($_POST['location']);
				//echo "hehe1";
				if (isset($_POST["categoryid"]) && $_POST["categoryid"] != null) {
					//echo "hehe2";
					if ($_POST["categoryid"] == "null") {
						if (isset($_POST['pagenum']) && $_POST['pagenum'] != null && '/' < $_POST['pagenum'] && $_POST['pagenum'] < ':') {
							getserviceslist($location,null, null, $_POST['pagenum']);
						} else
							getserviceslist($location);
					} else {
						//getservicesbycategory($_POST["categoryid"]);

						if (isset($_POST['pagenum']) && $_POST['pagenum'] != null && '/' < $_POST['pagenum'] && $_POST['pagenum'] < ':') {
							getserviceslist($location,$_POST["categoryid"], null, $_POST['pagenum']);
						} else
							getserviceslist($location,$_POST["categoryid"]);
					}
				} else echo "Error: categoryid wrong";
			}
			break;
		}
		case 'get_order_list':{
			if(isset($_POST['customid'])&&$_POST['customid']!=null){
				//var_dump($_POST['pagenum']);
				if(isset($_POST['pagenum'])&&$_POST['pagenum']!=null&&'/'<$_POST['pagenum']&&$_POST['pagenum']<':')
				{getorderlist($_POST['customid'],$_POST['pagenum']);}
				else
				getorderlist($_POST['customid']);
			}
			else echo "Error: no customerid";
			break;}
		case 'massagist_get_services_list':
		{
			if(isset($_POST["massaid"])&&$_POST["massaid"]!=null){
				if(isset($_POST['pagenum'])&&$_POST['pagenum']!=null&&'/'<$_POST['pagenum']&&$_POST['pagenum']<':')
				{
					getserviceslist(null,null,$_POST["massaid"],$_POST["pagenum"]);
				}
				else
				getserviceslist(null,null,$_POST["massaid"]);
			}
		}
		default:
	}
}


function getorderlist($customid = null,$pagenum = null){
	$perpagenum_orders=10;
	$start = ($pagenum-1)*$perpagenum_orders;
	$con = DBconnect();

	if($pagenum!=null){
		$listinfo = DBfetchall2($con,"Order",array('orderid','servicename','shopid','shopname','status','unitprice'),array("customerid"=>$customid),null,"order by time desc limit ".$start.",".$perpagenum_orders);

	}
	else $listinfo = DBfetchall2($con,"Order",array('orderid','servicename','shopid','shopname','status','unitprice'),array("customerid"=>$customid));
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
function recommand_news($location, $id=null){
	//var_dump(is_int($id));
	$con = DBconnect();
	if($id!=null){
		//$query = "SELECT * FROM Recommand_news WHERE id = ".$id.";";
		$result = DBfetchone2($con,'Recommand_news',array('*'),array('id'=>$id));
		echo json_encode($result);
	}
	else{
		//$query = "SELECT id, title, pic FROM Recommand_news";
		$result = DBfetchall2($con,'Recommand_news',array('id','title','pic'),$location,"and");
		echo json_encode($result);

	}

}
/*function getservicesbycategory($categoryid){
	//echo “hehe”;
	$con = DBconnect();
	$result = DBfetchall($query,$con);

	echo json_encode($arr);
}*/


function getserviceslistinfo_by_basicinfo($array,$con){
	$Arr = array();
	foreach ($array as $row){
		$row2 = DBfetchone2($con,"Shop",array("name","pic","latitude","longtitude"),array("shopid"=>$row["shopid"]));
		$a=array("serviceid"=>$row["serviceid"],"shopname"=>$row2["name"],"servicename"=>$row["name"],"price"=>$row["price"],"pic"=>$row2["pic"],"latitude"=>$row2["latitude"],"longtitude"=>$row2["longtitude"]);
		//var_dump($row2);
		array_push($Arr,$a);
	}
	return $Arr;
}

function getserviceslist($location, $categoryid =null, $massaid = null, $pagenum=null){
	$perpagenum_services=10;
	$start = ($pagenum-1)*$perpagenum_services;

	$con =DBconnect();

	if ($categoryid!=null&&$massaid==null){
		$query1 = DBformquery_select("Shop",array("shopid","name","pic","latitude","longtitude"),(array)$location,"and");
		$query1=rtrim($query1,';');
		$query2 = DBformquery_select("Service",array("serviceid","shopid","name","price"),array("catid"=>$categoryid));
		$query2 = rtrim($query2,';');
		if($pagenum!=null){
			//$condition = array_merge((array)$location,array("catid"=>$categoryid));
			$joinquery = DBformquery_join(array("a.serviceid","a.name as servicename","a.price","b.name as shopname","b.pic","b.latitude","b.longtitude"),"({$query2}) as a","right join","({$query1}) as b","a.shopid = b.shopid","limit ".$start.",".$perpagenum_services);
		}
		else{
			//$condition = array_merge((array)$location,array("catid"=>$categoryid));
			//$result = DBfetchall2($con,"Service",array("serviceid","shopid","name","price"),$condition,"and");
			$joinquery = DBformquery_join(array("a.serviceid","a.name as servicename","a.price","b.name as shopname","b.pic","b.latitude","b.longtitude"),"({$query2}) as a","right join","({$query1}) as b","a.shopid = b.shopid");

		} $Arr = DBfetchall($joinquery,$con);//$Arr = getserviceslistinfo_by_basicinfo($result,$con);
	}
	else if($categoryid==null && $massaid==null)
	{
		$query1 = DBformquery_select("Shop",array("shopid","name","pic","latitude","longtitude"),(array)$location,"and");
		$query1=rtrim($query1,';');
		if($pagenum!=null){
			//$getservice = DBfetchall2($con,"Service",array("serviceid","shopid","name","price"),(array)$location,"and","limit ".$start.",".$perpagenum_services);
			$joinquery = DBformquery_join(array("a.serviceid","a.name as servicename","a.price","b.name as shopname","b.pic","b.latitude","b.longtitude"),"Service a","right join","({$query1}) as b","a.shopid = b.shopid","limit ".$start.",".$perpagenum_services);

		}
		else //$getservice = DBfetchall2($con,"Service",array("serviceid","shopid","name","price"),(array)$location,"and");
			$joinquery = DBformquery_join(array("a.serviceid","a.name as servicename","a.price","b.name as shopname","b.pic","b.latitude","b.longtitude"),"Service a","right join","({$query1}) as b","a.shopid = b.shopid");
		//$Arr =getserviceslistinfo_by_basicinfo($getservice,$con);
		$Arr = DBfetchall($joinquery,$con);
	}
	else if($categoryid==null&&$massaid!=null)
	{
		if($pagenum!=null){
			$services = DBfetchall2($con,"Has_Service",array("serviceid","amount"),array("masaid"=>$massaid),"and","order by amount desc limit ".$start.",".$perpagenum_services);
			//var_dump($services);
		}
		else
		{
			$services = DBfetchall2($con,"Has_Service",array("serviceid","amount"),array("masaid"=>$massaid),null,"order by amount desc");

		}
		//var_dump($services);
		//echo "you are in there";
		$Arr = array();
		foreach ($services as $service){
			//$condition = array_merge(,$location);
			$service_info = DBfetchone2($con,"Service",array("serviceid","name","duration","price"),array("serviceid"=>$service["serviceid"]),"and");
			$service_info["amount"]=$service["amount"];
			array_push($Arr,$service_info);
		}
	}
	else{
		$Arr = "Get Service List Error: BackEnd Please Check your input! ";
	}

	echo json_encode($Arr);
}



function getnews($pagenum=null){
	$con=DBconnect();
	$perpagenum_news=5;
	$start = ($pagenum-1)*$perpagenum_news;
	if($pagenum!=null)
	{
		$result = DBfetchall2($con,"news",array("*"),null,null,"order by id desc limit ".$start.",".$perpagenum_news);
	}
	else $result = DBfetchall2($con,"news",array("*"));
	//var_dump($result);
	//echo json_encode($result);
	$Arr = array();
	foreach($result as $row){
		$a=array("newsid"=>$row["id"],"newstitle"=>$row["title"],"newscontent"=>$row["content"],"pic"=>$row["pic"]);
		array_push($Arr,$a);
	}
	echo json_encode($Arr);
}

function recommand_service($location){
	$con =DBconnect();
	//var_dump($location);
	//$getservice = DBfetchall("SELECT serviceid, shopname, servicename, price, pic, latitude, longtitude FROM Recommand_service",$con);
	$getservice = DBfetchall2($con,'Recommand_service',array("serviceid","shopname", "servicename", "price", "pic", "latitude", "longtitude"),(array)$location,"and");
	echo json_encode($getservice);
}

function recommand_massagesit($location){
	$con = DBconnect();
	//$result = DBfetchall("SELECT massagistid,shopname,name,stars,intro,pic,latitude,longtitude FROM Recommand_massagist",$con);
	$result = DBfetchall2($con,"Recommand_massagist",array("massagistid","shopname","name","stars","intro","pic","latitude","longtitude"),(array)$location,"and");
	echo json_encode($result);


}

function getmassagistlist($location, $pagenum=null){
	//echo "start";
	$perpagenum_massagist=10;
	$start = ($pagenum-1)*$perpagenum_massagist;

	$con = DBconnect();
	if($pagenum!=null){
		$result = DBfetchall2($con,"MassagistDetail",array("shopid","phone","name","stars","intro","pic"),(array)$location,"and","limit ".$start.",".$perpagenum_massagist);
	}
	else
	$result = DBfetchall2($con,"MassagistDetail",array("shopid","phone","name","stars","intro","pic"),(array)$location,"and");
	//echo "get row";
	//echo $getservice;
	//echo $result;
	$Arr = array();
	foreach ($result as $row){
		//echo $row;
		//$getshopname = mysql_query("select name from Shop where shopid=".$row[0].";" , $con);
		$row2=DBfetchone2($con,"Shop",array("name","latitude","longtitude"),array("shopid"=>$row["shopid"]));
		//var_dump($row2);
		//echo $row[0],$row[1];
		//echo $row2["latitude"];
		$a=array("massagistid"=>$row["phone"],"shopname"=>$row2["name"],"name"=>$row["name"],"stars"=>$row["stars"],"intro"=>$row["intro"],"pic"=>$row["pic"],"latitude"=>$row2["latitude"],"longtitude"=>$row2["longtitude"]);
		//echo $a;
		//var_dump($a);
		array_push($Arr,$a);
	}
	//var_dump($Arr);
	echo json_encode($Arr);
}







?>
