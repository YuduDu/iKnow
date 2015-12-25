<?php
require_once "lib/db_func.php";

date_default_timezone_set('America/Chicago');

require_once "vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


if (isset($_POST['action']) && $_POST['action'] != "") {
    switch ($_POST['action']) {
        case 'get_news': {

            $log = new Logger("news_info");
            $log->pushHandler(new StreamHandler("Log/customer/Info/news/" . date("Y-m-d", time()) . ".log", Logger::INFO));


            if (isset($_POST['pagenum']) && $_POST['pagenum'] != null && '/' < $_POST['pagenum'] && $_POST['pagenum'] < ':') {
                getnews($log, $_POST['pagenum']);
            } else getnews($log);
            break;
        }
        case 'get_recommand_service': {

            $log = new Logger("services_info");
            $log->pushHandler(new StreamHandler("Log/customer/Info/services/" . date("Y-m-d", time()) . ".log", Logger::INFO));


            if (isset($_POST["location"]) && $_POST['location'] != null) {
                //var_dump($_POST['location']);
                $location = (array)json_decode($_POST['location']);
                //var_dump($location);
                recommand_service($log, $location);
            } //else echo "Error: no location";
            else echo json_encode(["RespCode" => "000002", 'RespContent' => ['Status' => 'Error', 'Content' => 'No location!']]);
            break;
        }
        case 'get_recommand_massagist': {

            $log = new Logger("massagist_info");
            $log->pushHandler(new StreamHandler("Log/customer/Info/massagist/" . date("Y-m-d", time()) . ".log", Logger::INFO));


            if (isset($_POST["location"]) && $_POST['location'] != null) {
                //var_dump($_POST['location']);
                $location = (array)json_decode($_POST['location']);
                recommand_massagesit($log, $location);
            } //else echo "Error: no location";
            else echo json_encode(["RespCode" => "000002", 'RespContent' => ['Status' => 'Error', 'Content' => 'No location!']]);
            break;

        }
        case 'get_recommand_news': {

            $log = new Logger("news_info");
            $log->pushHandler(new StreamHandler("Log/customer/Info/news/" . date("Y-m-d", time()) . ".log", Logger::INFO));


            if (isset($_POST["location"]) && $_POST['location'] != null) {
                $location = (array)json_decode($_POST['location']);
                if (!isset($_POST['id'])) {
                    recommand_news($log, $location);
                } else recommand_news($log, $location, $_POST['id']);
            }//else echo "Error: no location";
            else echo json_encode(["RespCode" => "000002", 'RespContent' => ['Status' => 'Error', 'Content' => 'No location!']]);
            break;
        }
        case 'get_massagist_list': {
            $log = new Logger("massagist_info");
            $log->pushHandler(new StreamHandler("Log/customer/Info/massagist/" . date("Y-m-d", time()) . ".log", Logger::INFO));

            if (isset($_POST["location"]) && $_POST['location'] != null) {
                $location = (array)json_decode($_POST['location']);
                if (isset($_POST['pagenum']) && $_POST['pagenum'] != null && '/' < $_POST['pagenum'] && $_POST['pagenum'] < ':') {
                    getmassagistlist($log, $location, $_POST['pagenum']);
                } else getmassagistlist($log, $location);
            } //else echo "Error: no location";
            else echo json_encode(["RespCode" => "000002", 'RespContent' => ['Status' => 'Error', 'Content' => 'No location!']]);
            break;
        }
        case 'get_services_list': {

            $log = new Logger("services_info");
            $log->pushHandler(new StreamHandler("Log/customer/Info/services/" . date("Y-m-d", time()) . ".log", Logger::INFO));


            if (isset($_POST["location"]) && $_POST['location'] != null) {
                $location = (array)json_decode($_POST['location']);
                //echo "hehe1";
                if (isset($_POST["categoryid"]) && $_POST["categoryid"] != null) {
                    //echo "hehe2";
                    if ($_POST["categoryid"] == "null") {
                        if (isset($_POST['pagenum']) && $_POST['pagenum'] != null && '/' < $_POST['pagenum'] && $_POST['pagenum'] < ':') {
                            getserviceslist($log, $location, null, null, $_POST['pagenum']);
                        } else
                            getserviceslist($log, $location);
                    } else {
                        //getservicesbycategory($_POST["categoryid"]);

                        if (isset($_POST['pagenum']) && $_POST['pagenum'] != null && '/' < $_POST['pagenum'] && $_POST['pagenum'] < ':') {
                            getserviceslist($log, $location, $_POST["categoryid"], null, $_POST['pagenum']);
                        } else
                            getserviceslist($log, $location, $_POST["categoryid"]);
                    }
                } //else echo "Error: categoryid wrong";
                else echo json_encode(["RespCode" => "000002", 'RespContent' => ['Status' => 'Error', 'Content' => 'No CategoryId!']]);
            } //else echo "Error: no location";
            else echo json_encode(["RespCode" => "000002", 'RespContent' => ['Status' => 'Error', 'Content' => 'No location!']]);
            break;
        }
        case 'get_order_list': {

            $log = new Logger("order_info");
            $log->pushHandler(new StreamHandler("Log/customer/Info/orders/" . date("Y-m-d", time()) . ".log", Logger::INFO));


            if (isset($_POST['customid']) && $_POST['customid'] != null) {
                //var_dump($_POST['pagenum']);
                if (isset($_POST['pagenum']) && $_POST['pagenum'] != null && '/' < $_POST['pagenum'] && $_POST['pagenum'] < ':') {
                    getorderlist($log, $_POST['customid'], $_POST['pagenum']);
                } else
                    getorderlist($log, $_POST['customid']);
            } //else echo "Error: no customerid";
            else echo json_encode(["RespCode" => "000002", 'RespContent' => ['Status' => 'Error', 'Content' => 'No Customer Id!']]);
            break;
        }

        case 'massagist_get_services_list': {
            $log = new Logger("services_info");
            $log->pushHandler(new StreamHandler("Log/customer/Info/services/" . date("Y-m-d", time()) . ".log", Logger::INFO));

            if (isset($_POST["massaid"]) && $_POST["massaid"] != null) {
                if (isset($_POST['pagenum']) && $_POST['pagenum'] != null && '/' < $_POST['pagenum'] && $_POST['pagenum'] < ':') {
                    getserviceslist($log, null, null, $_POST["massaid"], $_POST["pagenum"]);
                } else
                    getserviceslist($log, null, null, $_POST["massaid"]);
            } else echo json_encode(["RespCode" => "000002", 'RespContent' => ['Status' => 'Error', 'Content' => 'No Massagist Id!']]);
        }
        default:
    }
}


function getorderlist($log, $customid = null, $pagenum = null)
{
    $perpagenum_orders = 10;
    $start = ($pagenum - 1) * $perpagenum_orders;
    $con = DBconnect();

    if ($pagenum != null) {
        $listinfo = DBfetchall2($con, "Order", array('orderid', 'servicename', 'shopid', 'shopname', 'status', 'unitprice'), array("customerid" => $customid), null, "order by time desc limit " . $start . "," . $perpagenum_orders);
        if ($listinfo != null) {
            $log->addInfo("User with ip " . $_SERVER["REMOTE_ADDR"] . "get orders list of customer " . $customid . " on page " . $pagenum . ".");
        } else {
            $log->addWarnning("Failed! User with ip " . $_SERVER["REMOTE_ADDR"] . "tried to get orders list of customer " . $customid . " on page " . $pagenum . ".");
        }
    } else $listinfo = DBfetchall2($con, "Order", array('orderid', 'servicename', 'shopid', 'shopname', 'status', 'unitprice'), array("customerid" => $customid));
    //var_dump($listinfo);
    if ($listinfo != null) {
        $log->addInfo("User with ip " . $_SERVER["REMOTE_ADDR"] . "get orders list of customer " . $customid . ".");
    } else {
        $log->addWarnning("Failed! User with ip " . $_SERVER["REMOTE_ADDR"] . "tried to get orders list of customer " . $customid . ".");
    }
    $list = array();
    foreach ($listinfo as $item) {
        $pic = DBfetchone2($con, "Shop", array("pic"), array("shopid" => $item['shopid']));
        if ($pic == null) {
            $log->addWarnning("Failed! User with ip " . $_SERVER["REMOTE_ADDR"] . "tried to get pic of shop " . $item['shopid'] . ".");
        }
        $item = array_merge($item, $pic);
        unset($item['shopid']);
        $list[] = $item;
    }
    //echo json_encode($list);
    echo json_encode(["RespCode" => "111111", 'RespContent' => ['Status' => 'Success', 'Content' => $list]]);

}

function recommand_news($log, $location, $id = null)
{
    //var_dump(is_int($id));
    $con = DBconnect();
    if ($id != null) {
        //$query = "SELECT * FROM Recommand_news WHERE id = ".$id.";";
        $result = DBfetchone2($con, 'Recommand_news', array('*'), array('id' => $id));
        if ($result == null) {
            $log->addWarnning("Failed! User with ip " . $_SERVER['REMOTE_ADDR'] . " tried to get recommanded new with id " . $id . ".");
        } else {
            $log->addInfo("User with ip " . $_SERVER['REMOTE_ADDR'] . " get recommanded new with id " . $id . ".");
        }
        //echo json_encode($result);
        echo json_encode(["RespCode" => "111111", 'RespContent' => ['Status' => 'Success', 'Content' => $result]]);
    } else {
        //$query = "SELECT id, title, pic FROM Recommand_news";
        $result = DBfetchall2($con, 'Recommand_news', array('id', 'title', 'pic'), $location);
        if ($result == null) {
            $log->addWarnning("Failed! User with ip " . $_SERVER['REMOTE_ADDR'] . " tried to get recommanded news list.");
        } else {
            $log->addInfo("User with ip " . $_SERVER['REMOTE_ADDR'] . " get recommanded news list.");
        }
        //echo json_encode($result);
        echo json_encode(["RespCode" => "111111", 'RespContent' => ['Status' => 'Success', 'Content' => $result]]);

    }

}

/*function getservicesbycategory($categoryid){
	//echo “hehe”;
	$con = DBconnect();
	$result = DBfetchall($query,$con);

	echo json_encode($arr);
}*/


/*function getserviceslistinfo_by_basicinfo($array,$con){
	$Arr = array();
	foreach ($array as $row){
		$row2 = DBfetchone2($con,"Shop",array("name","pic","latitude","longtitude"),array("shopid"=>$row["shopid"]));
		$a=array("serviceid"=>$row["serviceid"],"shopname"=>$row2["name"],"servicename"=>$row["name"],"price"=>$row["price"],"pic"=>$row2["pic"],"latitude"=>$row2["latitude"],"longtitude"=>$row2["longtitude"]);
		//var_dump($row2);
		array_push($Arr,$a);
	}
	return $Arr;
}*/

function getserviceslist($log, $location, $categoryid = null, $massaid = null, $pagenum = null)
{
    $perpagenum_services = 10;
    $start = ($pagenum - 1) * $perpagenum_services;

    $con = DBconnect();

    $Arr = null;

    if ($categoryid != null && $massaid == null) {
        $query1 = DBformquery_select("Shop", array("shopid", "name", "pic", "latitude", "longtitude"), (array)$location);
        $query1 = rtrim($query1, ';');
        $query2 = DBformquery_select("Service", array("serviceid", "shopid", "name", "price"), array("catid" => $categoryid));
        $query2 = rtrim($query2, ';');
        if ($pagenum != null) {
            //$condition = array_merge((array)$location,array("catid"=>$categoryid));
            $joinquery = DBformquery_join(array("a.serviceid", "a.name as servicename", "a.price", "b.name as shopname", "b.pic", "b.latitude", "b.longtitude"), "({$query2}) as a", "right join", "({$query1}) as b", "a.shopid = b.shopid", "limit " . $start . "," . $perpagenum_services);
            $warn = "Fail! User with ip " . $_SERVER['REMOTE_ADDR'] . "tried to get services list of categoryid " . $categoryid . " at location " . $location["city"] . " on page " . $pagenum . ".";
            $info = "User with ip " . $_SERVER['REMOTE_ADDR'] . "get services list of categoryid " . $categoryid . " at location " . $location["city"] . "on page " . $pagenum . ".";
        } else {
            //$condition = array_merge((array)$location,array("catid"=>$categoryid));
            //$result = DBfetchall2($con,"Service",array("serviceid","shopid","name","price"),$condition,"and");
            $joinquery = DBformquery_join(array("a.serviceid", "a.name as servicename", "a.price", "b.name as shopname", "b.pic", "b.latitude", "b.longtitude"), "({$query2}) as a", "right join", "({$query1}) as b", "a.shopid = b.shopid");
            $warn = "Fail! User with ip " . $_SERVER['REMOTE_ADDR'] . "tried to get services list of categoryid " . $categoryid . " at location " . $location["city"] . ".";
            $info = "User with ip " . $_SERVER['REMOTE_ADDR'] . "get services list of categoryid " . $categoryid . " at location " . $location["city"] . ".";

        }
        $Arr = DBfetchall($joinquery, $con);//$Arr = getserviceslistinfo_by_basicinfo($result,$con);
        if ($Arr == null) {
            $log->addWarnning($warn);
        } else {
            $log->addInfo($info);
        }
    } else if ($categoryid == null && $massaid == null) {
        $query1 = DBformquery_select("Shop", array("shopid", "name", "pic", "latitude", "longtitude"), (array)$location);
        $query1 = rtrim($query1, ';');

        if ($pagenum != null) {
            //$getservice = DBfetchall2($con,"Service",array("serviceid","shopid","name","price"),(array)$location,"and","limit ".$start.",".$perpagenum_services);
            $joinquery = DBformquery_join(array("a.serviceid", "a.name as servicename", "a.price", "b.name as shopname", "b.pic", "b.latitude", "b.longtitude"), "Service a", "right join", "({$query1}) as b", "a.shopid = b.shopid", "limit " . $start . "," . $perpagenum_services);
            $warn = "Fail! User with ip " . $_SERVER['REMOTE_ADDR'] . "tried to get services list of all at location " . $location["city"] . "on page " . $pagenum . ".";
        } else //$getservice = DBfetchall2($con,"Service",array("serviceid","shopid","name","price"),(array)$location,"and");
        {
            $joinquery = DBformquery_join(array("a.serviceid", "a.name as servicename", "a.price", "b.name as shopname", "b.pic", "b.latitude", "b.longtitude"), "Service a", "right join", "({$query1}) as b", "a.shopid = b.shopid");
        }
        //$Arr =getserviceslistinfo_by_basicinfo($getservice,$con);
        $Arr = DBfetchall($joinquery, $con);
        if ($Arr == null) {
            $log->addWarnning("Fail! User with ip " . $_SERVER['REMOTE_ADDR'] . "tried to get services list of all at location " . $location["city"] . ".");
        } else {
            $log->addInfo("User with ip " . $_SERVER['REMOTE_ADDR'] . "get services list of all at location " . $location["city"] . ".");
        }
    } else if ($categoryid == null && $massaid != null) {
        if ($pagenum != null) {
            $services = DBfetchall2($con, "Has_Service", array("serviceid", "amount"), array("masaid" => $massaid), "and", "order by amount desc limit " . $start . "," . $perpagenum_services);
            //var_dump($services);
        } else {
            $services = DBfetchall2($con, "Has_Service", array("serviceid", "amount"), array("masaid" => $massaid), null, "order by amount desc");

        }
        //var_dump($services);
        //echo "you are in there";
        $Arr = array();

        foreach ($services as $service) {
            //$condition = array_merge(,$location);
            $service_info = DBfetchone2($con, "Service", array("serviceid", "name", "duration", "price"), array("serviceid" => $service["serviceid"]), "and");
            $service_info["amount"] = $service["amount"];
            array_push($Arr, $service_info);
        }

        if ($Arr == null) {
            $log->addWarnning("Fail! User with ip " . $_SERVER['REMOTE_ADDR'] . "tried to get services list of massagist " . $massaid . " at location " . $location["city"] . ".");
        } else {
            $log->addInfo("User with ip " . $_SERVER['REMOTE_ADDR'] . "get services list of massagist " . $massaid . " at location " . $location["city"] . ".");
        }

    } else {
        //$Arr = "Get Service List Error: BackEnd Please Check your input! ";
        //echo json_encode(array("RespCode"=>"000003"));
        echo json_encode(["RespCode" => "000003", 'RespContent' => ['Status' => 'Failed', 'Content' => 'Get Service List Error: BackEnd Please Check your input!']]);
        $log->addError("Fail! Inputs wrong.");
        return;
    }

    //echo json_encode($Arr);
    echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success', 'Content' => $Arr]]);
}


function getnews($log, $pagenum = null)
{
    $con = DBconnect();
    $perpagenum_news = 5;
    $start = ($pagenum - 1) * $perpagenum_news;
    if ($pagenum != null) {
        $result = DBfetchall2($con, "news", array("*"), null, null, "order by id desc limit " . $start . "," . $perpagenum_news);
        if ($result == null) {
            $log->addWarnning("Failed! User with ip " . $_SERVER['REMOTE_ADDR'] . " tried to get news list of page " . $pagenum . ".");
        } else {
            $log->addInfo("User with ip " . $_SERVER['REMOTE_ADDR'] . " get news list of page " . $pagenum . ".");
        }
    } else {
        $result = DBfetchall2($con, "news", array("*"));
        if ($result == null) {
            $log->addWarnning("Failed! User with ip " . $_SERVER['REMOTE_ADDR'] . " tried to get news list of all. ");
        } else {
            $log->addInfo("User with ip " . $_SERVER['REMOTE_ADDR'] . " get news list of all. ");
        }
    }

    //var_dump($result);
    //echo json_encode($result);
    $Arr = array();
    foreach ($result as $row) {
        $a = array("newsid" => $row["id"], "newstitle" => $row["title"], "newscontent" => $row["content"], "pic" => $row["pic"]);
        array_push($Arr, $a);
    }
    //echo json_encode($Arr);
    echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success', 'Content' => $Arr]]);
}

function recommand_service($log, $location)
{
    $con = DBconnect();
    //var_dump($location);
    //$getservice = DBfetchall("SELECT serviceid, shopname, servicename, price, pic, latitude, longtitude FROM Recommand_service",$con);
    $getservice = DBfetchall2($con, 'Recommand_service', array("serviceid", "shopname", "servicename", "price", "pic", "latitude", "longtitude"), (array)$location);
    if ($getservice == null) {
        $log->addWarning("Failed! User with ip " . $_SERVER['REMOTE_ADDR'] . " tried to get recommanded services list at " . $location["city"] . ".");
    } else {
        $log->addInfo("User with ip " . $_SERVER['REMOTE_ADDR'] . "get recommanded services list at " . $location["city"] . ".");
    }
    //echo json_encode($getservice);
    echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success', 'Content' => $getservice]]);
}

function recommand_massagesit($log, $location)
{
    $con = DBconnect();
    //$result = DBfetchall("SELECT massagistid,shopname,name,stars,intro,pic,latitude,longtitude FROM Recommand_massagist",$con);
    $result = DBfetchall2($con, "Recommand_massagist", array("massagistid", "shopname", "name", "stars", "intro", "pic", "latitude", "longtitude"), (array)$location);
    if ($result == null) {
        $log->addWarning("Failed! User with ip " . $_SERVER['REMOTE_ADDR'] . " tried to get recommanded Massagists list at " . $location["city"] . ".");
    } else {
        $log->addInfo("User with ip " . $_SERVER['REMOTE_ADDR'] . "get recommanded Massagists list at " . $location["city"] . ".");
    }
    //echo json_encode($result);
    echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success', 'Content' => $result]]);


}

function getmassagistlist($log, $location, $pagenum = null)
{
    //echo "start";
    $perpagenum_massagist = 10;
    $start = ($pagenum - 1) * $perpagenum_massagist;

    $con = DBconnect();
    if ($pagenum != null) {
        $result = DBfetchall2($con, "MassagistDetail", array("shopid", "phone", "name", "stars", "intro", "pic"), (array)$location,"","limit " . $start . "," . $perpagenum_massagist);
        if ($result == null) {
            $log->addWarnning("Failed! User with ip " . $_SERVER['REMOTE_ADDR'] . " tried to get Massagists list of page " . $pagenum . " at location " . $location["city"] . ".");
        } else {
            $log->addInfo("User with ip " . $_SERVER['REMOTE_ADDR'] . " get Massagists list of page " . $pagenum . " at location " . $location["city"] . ".");
        }
    } else {
        $result = DBfetchall2($con, "MassagistDetail", array("shopid", "phone", "name", "stars", "intro", "pic"), (array)$location);
        if ($result == null) {
            $log->addWarnning("Failed! User with ip " . $_SERVER['REMOTE_ADDR'] . " tried to get massagists list of all at location " . $location["city"] . ".");
        } else {
            $log->addInfo("User with ip " . $_SERVER['REMOTE_ADDR'] . " get massagists list of all at location " . $location["city"] . ".");
        }
    }
    //echo "get row";
    //echo $getservice;
    //echo $result;
    $Arr = array();
    foreach ($result as $row) {
        //echo $row;
        //$getshopname = mysql_query("select name from Shop where shopid=".$row[0].";" , $con);
        $row2 = DBfetchone2($con, "Shop", array("name", "latitude", "longtitude"), array("shopid" => $row["shopid"]));
        //var_dump($row2);
        //echo $row[0],$row[1];
        //echo $row2["latitude"];
        $a = array("massagistid" => $row["phone"], "shopname" => $row2["name"], "name" => $row["name"], "stars" => $row["stars"], "intro" => $row["intro"], "pic" => $row["pic"], "latitude" => $row2["latitude"], "longtitude" => $row2["longtitude"]);
        //echo $a;
        //var_dump($a);
        array_push($Arr, $a);
    }
    //var_dump($Arr);
    //echo json_encode($Arr);
    echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success', 'Content' => $Arr]]);
}


?>
