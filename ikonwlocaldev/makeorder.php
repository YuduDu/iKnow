<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/15/15
 * Time: 4:58 PM
 */
require_once "lib/db_func.php";
require_once "make_appointments.php";
require_once "update.php";
require_once('lib/Ucpaas.class.php');



date_default_timezone_set('America/Chicago');

require_once "vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$detail_log_info = array();
$i = 0;

session_start();

if (isset($_POST['basic_order']) && $_POST['basic_order'] != NULL) {

    $_SESSION['customerid'] = null;
    $_SESSION['serviceid'] = null;
    $_SESSION['massaid'] = null;
    $_SESSION['time'] = null;
    $_SESSION['amount'] = null;
    $_SESSION['unitprice'] = null;
    $_SESSION['qty'] = 1;
    $_SESSION["level"] = "M";
    $_SESSION['status'] = "UNPAID";
    $_SESSION['type'] = null;
    $_SESSION['orderid'] = null;
    $_SESSION['shopid'] = null;
    //$_SESSION['starttime']=null;

    $basic_order_parameter = json_decode($_POST['basic_order']);
    foreach ($basic_order_parameter as $key => $val) {
        $_SESSION[$key] = $val;
    }
    $con = DBconnect();
    //var_dump($_SESSION);
    //echo "hehe";
    //Done-(需要重构,将DBFetchall切换成DBfetchall2,将获取技师信息封装,或使用massagistDetail里面的现成函数)

    //$massagistlist_query = "select masaid from Has_Service where serviceid = ".$_SESSION['serviceid'].";";
    //$massagistlist = DBfetchall($massagistlist_query,$con);

    $massagistlist = DBfetchall2($con, "Has_Service", array("masaid"), array("serviceid" => $_SESSION['serviceid']));

    if ($massagistlist != null) {
        //$log->addInfo("User with ip ".$_SERVER["REMOTE_ADDR"]." get massagistlist of");

        $massagistids = array();
        foreach ($massagistlist as $massa) {
            array_push($massagistids, $massa['masaid']);
        }
        $para = array("pic", "name", "stars", "intro", "phone", "level");
        $result = DBselectsUseonekey($para, $massagistids, "phone", "MassagistDetail", $con);
        if ($result != null) {
            array_push($detail_log_info, array("type" => "Info", "Info" => "User with ip " . $_SERVER["REMOTE_ADDR"] . " get massagist list of service " . $_SESSION['serviceid'] . "."));
        } else {
            array_push($detail_log_info, array("type" => "Warn", "Info" => "Failed! User with ip " . $_SERVER["REMOTE_ADDR"] . " tried to get massagist list of service " . $_SESSION['serviceid'] . "."));
        }
        //echo json_encode($result);
        echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success', 'Content' => $result]]);
        //echo $para;
    } //else echo "NULL";
    else echo json_encode(['RespCode' => '000000', 'RespContent' => ['Status' => 'Failed', 'Content' => 'Null Massagist list']]);
}


if (isset($_POST['order']) && $_POST['order'] != NULL) {
    $order_parameter = json_decode($_POST['order']);
    $con = DBconnect();
    foreach ($order_parameter as $key => $val) {
        $_SESSION[$key] = $val;
    }
    $_SESSION['amount'] = calculateamount($con);
    //var_dump($_SESSION);
    //echo $_SESSION['amount'];
    echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success', 'Content' => $_SESSION['amount']]]);
    //echo "after order info: ".var_dump($_SESSION);
    //test place order function here
    //placeorder();
}


if (isset($_POST['submit']) && $_POST['submit'] != null) {
    $log = new Logger("Orders");
    $log->pushHandler(new StreamHandler("Log/customer/Orders/" . date("Y-m-d", time()) . "/summary.log", Logger::INFO));

    //take the hidden token of card information from $_post
    //echo "begin charge: Taking token now";
    $token = $_POST['submit'];
    //make payment with stripe
    $con = DBconnect();
    //place the order into database
    if (placeorder($con) == TRUE) {
        //make appointment
        $log->addInfo("User with ip " . $_SERVER["REMOTE_ADDR"] . "placed order succeeded. Orderid " . $_SESSION['orderid'] . ".");
        $result = make_appointment($con);
        if ($result == true) {
            //echo "begin charge: ";
            charge($log, $token, $con);
        } //else echo $result;
        else echo json_encode(['RespCode' => '000000', 'RespContent' => ['Status' => 'Failed', 'Content' => $result]]);
    } //else echo "Place order wrong!";
    else echo json_encode(['RespCode' => '000000', 'RespContent' => ['Status' => 'Failed', 'Content' => "Place Order Wrong!"]]);
    //else echo "000000";


}

//get unitprice by massaid
function getlevel($con)
{
    $level = DBselectsUseonekey(array("level"), array($_SESSION["massaid"]), "phone", "MassagistDetail", $con);
    return $level[0]["level"];
}

//get unitprice by massaid
function getunitprice($con)
{
    switch ($_SESSION["level"]) {
        case "M":
            $para = array("price");
            break;
        case "H":
            $para = array("price_high");
            break;
        case "E":
            $para = array("price_expert");
            break;
        default;
    }
    $unitprice = DBselectsUseonekey($para, array($_SESSION["serviceid"]), "serviceid", Service, $con);
    return $unitprice[0][$para[0]];
}

//calculate the amount of the order
function calculateamount($con)
{
    if ($_SESSION['massaid'] != NULL) {
        $_SESSION["level"] = getlevel($con);
    }
    $_SESSION["unitprice"] = (float)getunitprice($con);
    $amount = $_SESSION['unitprice'] * $_SESSION['qty'];
    array_push($GLOBALS['detail_log_info'], array("type" => "Info", 'Info' => "User with ip " . $_SERVER['REMOTE_ADDR'] . " calculate the amount " . $amount . ".", "array" => $_SESSION));
    return $amount;

}


//make payment with stripe
function charge($log, $token, $con)
{
    //

    //"start:";
    $phone = $_SESSION["customerid"];
    //echo "In charge function now!!  ";
    $customer = \Stripe\Customer::create(array(
        'card' => $token,
        'description' => $phone
    ));
    //echo "customer information done, token has been used.";
    $money = $_SESSION['amount'] * 100;

    $charge = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount' => $money,
        'currency' => 'usd'
    ));


    //echo "charge status:".$charge["status"];
    if (isset($charge["error"])) {
        return json_encode($charge);
        array_push($GLOBALS["detail_log_info"], array("type" => "Alert", "Info" => "User with ip " . $_SERVER["REMOTE_ADDR"] . ". Failed to get shopid and Massagistname from MassagistDetail table.", "array" => array("massaid" => $test['massaid'])));
        $detail_log = new Logger("Order_detail");
        $detail_log->pushHandler(new StreamHandler("Log/customer/Orders/" . date("Y-m-d", time()) . "/" . $_SESSION["orderid"] . ".log", Logger::INFO));
        logging($detail_log);
    } else {
        if (isset($charge) && $charge["status"] == "succeeded") {


            array_push($GLOBALS["detail_log_info"], array("type" => "Notice", "Info" => "User with ip " . $_SERVER["REMOTE_ADDR"] . ". Charge Succeeded", "array" => array("money(*100)" => $money)));
            //$_SESSION['status']="UNCOMMENT";
            $log->addInfo("User with ip " . $_SERVER["REMOTE_ADDR"] . "Charged order " . $_SESSION["orderid"] . " succeeded.");
            updateServiceAmount($_SESSION["massaid"], $_SESSION["serviceid"]);
            if (updateMoneyAmount($_SESSION["massaid"], $_SESSION["serviceid"],$_SESSION['amount'])&& SMS_confirm() && updateorder_status($con, "UNCOMMENT")){
                echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success','Content'=>'updateOrder_status + SMS confirm + Money Amount']]);
            }
            logging();
            session_destroy();
        }
    }

}

function updateorder_status($con, $status)
{
    $query = "update `Order` set status = '" . $status . "' where orderid = '" . $_SESSION['orderid'] . "';";
    if (mysql_query($query, $con)) {
        array_push($GLOBALS["detail_log_info"], array("type" => "Info", "Info" => "Set Order status to " . $status . " in Order table succeeded. "));
        //echo "success";
        return true;
        //echo "111111";

        //$log->addInfo("")
    } else {
        array_push($GLOBALS["detail_log_info"], array("type" => "Error", "Info" => "Failed to set Order status to " . $status . " in Order table. "));
        //echo "OrderUpdateFail: ".mysql_error();
        //echo "000000";
        echo json_encode(['RespCode' => '000000', 'RespContent' => ['Status' => 'Failed', 'Content' => 'OrderUpdateFail: ' . mysql_error()]]);
        return false;
    }

}

//insert order information into database
function placeorder($con)
{

    $test = $_SESSION;

    unset($test["time"]);
    unset($test["type"]);
    unset($test["address"]);
    unset($test["orderid"]);
    unset($test["shopid"]);
    //get order time
    $time = date("Y-m-d H:i:s", time());
    //echo $time;
    $test["time"] = $time;
    //get shopid and massagistname from MassagistDetail using massaid
    $info = DBfetchone2($con, "MassagistDetail", array('shopid', 'name'), array("phone" => $test['massaid']));
    if ($info != null) {
        array_push($GLOBALS["detail_log_info"], array("type" => "Info", "Info" => "User with ip " . $_SERVER["REMOTE_ADDR"] . ". Get shopid and Massagistname from MassagistDetail table."));
    } else {
        array_push($GLOBALS["detail_log_info"], array("type" => "Error", "Info" => "User with ip " . $_SERVER["REMOTE_ADDR"] . ". Failed to get shopid and Massagistname from MassagistDetail table.", "array" => array("massaid" => $test['massaid'])));
    }
    $info["massagistname"] = $info["name"];
    unset($info["name"]);
    $test = array_merge($test, $info);
    $_SESSION['shopid'] = $test['shopid'];
    //get shopname from "Shop" using Shopid
    $info = DBfetchone2($con, "Shop", array('name'), array("shopid" => $test['shopid']));
    if ($info != null) {
        array_push($GLOBALS["detail_log_info"], array("type" => "Info", "Info" => "User with ip " . $_SERVER["REMOTE_ADDR"] . ". Get shop name from Shop table."));
    } else {
        array_push($GLOBALS["detail_log_info"], array("type" => "Error", "Info" => "User with ip " . $_SERVER["REMOTE_ADDR"] . ". Failed to get Shop name from Shop table.", "array" => array("shopid" => $test['shopid'])));
    }
    $info["shopname"] = $info["name"];
    unset($info["name"]);
    $test = array_merge($test, $info);

    //get servicename from service using serviceid
    $info = DBfetchone2($con, "Service", array('name'), array("serviceid" => $test['serviceid']));
    if ($info != null) {
        array_push($GLOBALS["detail_log_info"], array("type" => "Info", "Info" => "User with ip " . $_SERVER["REMOTE_ADDR"] . ". Get service name from Service table."));
    } else {
        array_push($GLOBALS["detail_log_info"], array("type" => "Error", "Info" => "User with ip " . $_SERVER["REMOTE_ADDR"] . ". Failed to get service name from Service table.", "array" => array("serviceid" => $test['serviceid'])));
    }
    $info["servicename"] = $info["name"];
    unset($info["name"]);
    $test = array_merge($test, $info);

    //echo "before place order to database: ".var_dump($test);

    $orderid = DBinsert('Order', $test, $con);
    //var_dump($orderid);
    if (is_int($orderid)) {
        array_push($GLOBALS["detail_log_info"], array("type" => "Notice", "Info" => "User with ip " . $_SERVER["REMOTE_ADDR"] . ". Order created!", "array" => array("orederid" => $orderid)));
        //$detail_log = new Logger("Order_detail");
        //$detail_log->pushHandler(new StreamHandler("Log/customer/Orders/".date("Y-m-d",time())."/".(string)$orderid.".log",Logger::INFO));
        $_SESSION["orderid"] = $orderid;
        return True;

    } else {
        array_push($GLOBALS["detail_log_info"], array("type" => "ALERT", "Info" => "User with ip " . $_SERVER["REMOTE_ADDR"] . ". Failed to create Order", "array" => array("information" => $test)));
        //$detail_log = new Logger("Order_detail");
        //$detail_log->pushHandler(new StreamHandler("Log/customer/Orders/".date("Y-m-d",time())."/FailedOrder.log",Logger::INFO));

        return False;
    }

    // echo $_SESSION["orderid"];
    //logging();

    /*if(isset($orderid)){
        return True;
    }
    else return False;*/
    //else echo "hehe";

}

function logging()
{
    $logger = new Logger("Order_detail");
    $logger->pushHandler(new StreamHandler("Log/customer/Orders/" . date("Y-m-d", time()) . "/" . $_SESSION["orderid"] . ".log", Logger::INFO));
    //echo $_SESSION["orderid"];
    $tmp = $GLOBALS["detail_log_info"];

    foreach ($tmp as $log) {
        //var_dump($log);
        //$tmp1 = $log["type"];
        //var_dump($tmp1);
        switch ($log["type"]) {
            case (string)"Info": {
                if (isset($log["array"])) {
                    $logger->addInfo($log["Info"], $log["array"]);
                } else {
                    $logger->addInfo($log["Info"]);
                }

            }
                break;
            case (string)"Warn": {
                if (isset($log["array"])) {
                    $logger->addWarning($log["Info"], $log["array"]);
                } else {
                    $logger->addWarning($log["Info"]);
                }
            }
                break;
            case (string)"Alert": {
                if (isset($log["array"])) {
                    $logger->addAlert($log["Info"], $log["array"]);
                } else {
                    $logger->addAlert($log["Info"]);
                }

            }
                break;
            case (string)"Error": {
                if (isset($log["array"])) {
                    $logger->addError($log["Info"], $log["array"]);
                } else {
                    $logger->addError($log["Info"]);
                }

            }
                break;
            case (string)"Notice": {
                if (isset($log["array"])) {
                    $logger->addNotice($log["Info"], $log["array"]);
                } else {
                    $logger->addNotice($log["Info"]);
                }

            }
                break;
            default:
                //echo "wrong";
                break;
        }
    }

    //$GLOBALS["detail_log_info"]=array();
}



function SMS_confirm(){

    $options['accountsid'] = '8362ed001e1ffef7bf5a09e19f8ed652';
    $options['token'] = 'ba7311b0e0b7c03c839021bd1e0a724b';

    $con = DBconnect();
    $phone = $_SESSION['customerid'];
    $to_customer = $phone;


    $to_massagist = $_SESSION["massaid"];


    $orderid = $_SESSION['orderid'];
    $time = $_SESSION['time'];
    //$serviceid = $_SESSION['serviceid'];
    $shopid = $_SESSION['shopid'];
    $parameter1 = DBfetchone2($con,"Order",["servicename"],["orderid"=>$orderid]);
    $service = $parameter1["servicename"];
    $shop = DBfetchone2($con,"Shop",["address","phone"],["shopid"=>$shopid]);
    $contact = $shop["phone"];
    $appt = DBfetchone2($con,"massagist_appt",["type","address"],["orderid"=>$orderid]);
    if($appt["type"]=="VISITING"){
        $address = $appt["address"];
    }
    elseif($appt["type"] == "SHOP"){
        $address = $shop["address"];
    }
    else{
        $address = "有误，请立即联系商家";
    }

    $param_customer = $phone.",".$orderid.",".$time.",".$service.",".$address.",".$contact;

    $param_massagist = $to_massagist.",".$orderid.",".$time.",".$service.",".$address.",".$phone;

    if(SMS_customer($options,$to_customer,$param_customer) && SMS_massagist($options,$to_massagist,$param_massagist)){
            return true;
    }

}
//亲爱的{1}，你有一笔新的订单：订单号：{2}，服务时间：{3}，服务项目：{4}，地点：{5}，客户电话：{6}。
function SMS_massagist($options,$to,$param){
    $ucpass = new Ucpaas($options);

    $ucpass->getDevinfo('json');
    $appId = "a37682e59f2645f3b4b7aed3caf24689";
    $templateId ="18698";
    $to = "13068776038";
    $result = json_decode($ucpass->templateSMS($appId, $to, $templateId, $param));
    if ($result->resp->respCode == "000000") {
        //echo "success";
        return true;
    } else //echo $result->resp->respCode;
    {
        echo json_encode([
            'RespCode' => '000005',
            'RespContent' => [
                'Status' => 'Failed',
                'Content' => "Massagist".$result->resp->respCode
            ]
        ]);
        return false;
    }

}

#亲爱的{1}，你已经成功下单并预约：订单号：{2}，预约时间：{3}，服务项目：{4}，地址：{5}，联系电话：{6 }
function SMS_customer($options,$to,$param){
    $ucpass = new Ucpaas($options);

    $ucpass->getDevinfo('json');
    $appId = "a37682e59f2645f3b4b7aed3caf24689";
    $templateId ="18699";
    //form message parameters:

    $result = json_decode($ucpass->templateSMS($appId, $to, $templateId, $param));
    if ($result->resp->respCode == "000000") {
        //echo "success";
        return true;
    } else //echo $result->resp->respCode;
    {
        echo json_encode([
            'RespCode' => '000005',
            'RespContent' => [
                'Status' => 'Failed',
                'Content' => "Customer ".$result->resp->respCode
            ]
        ]);
        return false;
    }
}



