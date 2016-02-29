<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 2/24/16
 * Time: 3:11 PM
 */
require_once "lib/db_func.php";
require_once('lib/Ucpaas.class.php');


$appId = "6e747503-f31b-4260-acbe-0b498a175f2b";
$appSecret = "d9ee1587-02e4-4098-a356-b2d987914923";
$jsonStr = file_get_contents("php://input");
echo "Test start: \n";
$msg = json_decode($jsonStr);
// webhook字段文档: http://beecloud.cn/doc/php.php#webhook
// 验证签名
$sign = md5($appId . $appSecret . $msg->timestamp);
if ($sign != $msg->sign) {
    // 签名不正确
    exit();
}
// 此处需要验证购买的产品与订单金额是否匹配:
// 验证购买的产品与订单金额是否匹配的目的在于防止黑客反编译了iOS或者Android app的代码，
// 将本来比如100元的订单金额改成了1分钱，开发者应该识别这种情况，避免误以为用户已经足额支付。
// Webhook传入的消息里面应该以某种形式包含此次购买的商品信息，比如title或者optional里面的某个参数说明此次购买的产品是一部iPhone手机，
// 开发者需要在客户服务端去查询自己内部的数据库看看iPhone的金额是否与该Webhook的订单金额一致，仅有一致的情况下，才继续走正常的业务逻辑。
// 如果发现不一致的情况，排除程序bug外，需要去查明原因，防止不法分子对你的app进行二次打包，对你的客户的利益构成潜在威胁。
// 如果发现这样的情况，请及时与我们联系，我们会与客户一起与这些不法分子做斗争。而且即使有这样极端的情况发生，
// 只要按照前述要求做了购买的产品与订单金额的匹配性验证，在你的后端服务器不被入侵的前提下，你就不会有任何经济损失。
if($msg->transaction_type == "PAY") {
    //付款信息
    //支付状态是否变为支付成功
    //messageDetail 参考文档
    switch ($msg->channel_type) {
        case "WX":
            break;
        case "ALI":
            if($msg->messageDetail->trade_status =="TRADE_SUCCESS"){
                $con = DBconnect();
                $orderid = $msg->transaction_id;
                $totalfeeInDB = DBfetchone2($con,'Order',['amount'],['orderid'=>$orderid]);
                $totalfee = $msg->total_fee;
                if($totalfee==$totalfeeInDB){
                    echo 'success';
                    updateorder_status($con,'UNCOMMENT');
                    SMS_confirm($orderid);
                }
            }
            break;
        case "UN":
            break;
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
        //echo json_encode(['RespCode' => '000000', 'RespContent' => ['Status' => 'Failed', 'Content' => 'OrderUpdateFail: ' . mysql_error()]]);
        return false;
    }

}

function SMS_confirm($orderid){

    $options['accountsid'] = '8362ed001e1ffef7bf5a09e19f8ed652';
    $options['token'] = 'ba7311b0e0b7c03c839021bd1e0a724b';

    $con = DBconnect();
    //$serviceid = $_SESSION['serviceid'];
    $parameter1 = DBfetchone2($con,"Order",["customerid","servicename","massaid","shopid"],["orderid"=>$orderid]);
    $service = $parameter1["servicename"];
    $to_customer = $parameter1["customerid"];
    $to_massagist = $parameter1["massaid"];
    $shopid = $parameter1["shopid"];
    $shop = DBfetchone2($con,"Shop",["address","phone"],["shopid"=>$shopid]);
    $contact = $shop["phone"];
    $appt = DBfetchone2($con,"massagist_appt",["type","address","service_start"],["orderid"=>$orderid]);
    $time = $appt["service_start"];
    if($appt["type"]=="VISITING"){
        $address = $appt["address"];
    }
    elseif($appt["type"] == "SHOP"){
        $address = $shop["address"];
    }
    else{
        $address = "有误，请立即联系商家";
    }

    $param_customer = $to_customer.",".$orderid.",".$time.",".$service.",".$address.",".$contact;

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
