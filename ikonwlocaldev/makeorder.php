<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/15/15
 * Time: 4:58 PM
 */
require_once "lib/db_func.php";
require_once "appointment_succ.php";
require_once('stripe-config.php');
require_once "update.php";
\Stripe\Stripe::setApiKey("sk_test_pijvVr7Jl5AjrLIymIx2qETk");
session_start();

date_default_timezone_set('America/Chicago');
if(isset($_POST['basic_order'])&&$_POST['basic_order']!=NULL)
{

    $_SESSION['customerid']= null;
    $_SESSION['serviceid'] = null;
    $_SESSION['massaid'] = null;
    $_SESSION['time'] = null;
    $_SESSION['amount'] = null;
    $_SESSION['unitprice'] = null;
    $_SESSION['qty'] = 1;
    $_SESSION["level"] = "M";
    $_SESSION['status'] = "UNPAID";
    //$_SESSION['starttime']=null;


    $basic_order_parameter = json_decode($_POST['basic_order']);
    foreach($basic_order_parameter as $key => $val){
        $_SESSION[$key]=$val;
    }
    $con=DBconnect();
    //var_dump($_SESSION);
    //echo "hehe";
    //需要重构,将DBFetchall切换成DBfetchall2,将获取技师信息封装,或使用massagistDetail里面的现成函数

    $massagistlist_query = "select masaid from Has_Service where serviceid = ".$_SESSION['serviceid'].";";
    $massagistlist = DBfetchall($massagistlist_query,$con);

    if($massagistlist!=null){
        $massagistids = array();
        foreach($massagistlist as $massa){
            array_push($massagistids,$massa['masaid']);
        }
        $para=array("pic", "name", "stars", "intro", "phone", "level");
        $result = DBselectsUseonekey($para,$massagistids,"phone","MassagistDetail",$con);
        echo json_encode($result);
        //echo $para;
    }
    else echo "NULL";


}

if(isset($_POST['order'])&&$_POST['order']!=NULL)
{
    $order_parameter =json_decode($_POST['order']);
    $con=DBconnect();
    foreach($order_parameter as $key => $val){
        $_SESSION[$key]=$val;
    }
    $_SESSION['amount']=calculateamount($con);
    //var_dump($_SESSION);
    echo $_SESSION['amount'];
    //echo "after order info: ".var_dump($_SESSION);
    //test place order function here
    //placeorder();
}



if(isset($_POST['submit'])&&$_POST['submit']!=null)
{
    //take the hidden token of card information from $_post
    //echo "begin charge: Taking token now";
    $token = $_POST['submit'];
    //make payment with stripe
    $con = DBconnect();
    //place the order into database
    if(placeorder($con)==TRUE) {
        //make appointment

        $result = make_appointment($con);
        if ($result  == true) {
            //echo "begin charge: ";
            charge($token, $con);
        }
        else echo $result;
    }
    else echo "Place order wrong!";
    //else echo "000000";



}

//get unitprice by massaid
function getlevel($con){
    $level = DBselectsUseonekey(array("level"),array($_SESSION["massaid"]),"phone","MassagistDetail",$con);
    return $level[0]["level"];
}

//get unitprice by massaid
function getunitprice($con){
    switch($_SESSION["level"]){
        case "M":$para = array("price");break;
        case "H":$para = array("price_high");break;
        case "E":$para = array("price_expert");break;
        default;
    }
    $unitprice = DBselectsUseonekey($para,array($_SESSION["serviceid"]),"serviceid",Service,$con);
    return $unitprice[0][$para[0]];
}

//calculate the amount of the order
function calculateamount($con){
    if($_SESSION['massaid']!=NULL)
    {
        $_SESSION["level"] = getlevel($con);
    }
    $_SESSION["unitprice"]=(float)getunitprice($con);
    $amount = $_SESSION['unitprice']*$_SESSION['qty'];
    return $amount;

}


//make payment with stripe
function charge($token,$con){
    //
    //"start:";
    $phone = $_SESSION["customerid"];
    //echo "In charge function now!!  ";
    $customer = \Stripe\Customer::create(array(
        'card'  => $token,
        'description' => $phone
    ));
    //echo "customer information done, token has been used.";
    $money=$_SESSION['amount']*100;

    $charge = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount'   => $money,
        'currency' => 'usd'
    ));

    //echo "charge status:".$charge["status"];
    if(isset($charge["error"])){
        return json_encode($charge);
    }
    else{
        if(isset($charge)&&$charge["status"]=="succeeded"){
            //$_SESSION['status']="UNCOMMENT";
            updateorder_status($con,"UNCOMMENT");
            updateServiceAmount($_SESSION["massaid"],$_SESSION["serviceid"]);
            session_destroy();
        }
    }

}

function updateorder_status($con,$status){
    $query = "update `Order` set status = '".$status."' where orderid = '".$_SESSION['orderid']."';";
    if(mysql_query($query,$con))
    {
        echo "success";
        //echo "111111";
    }else{
        echo "OrderUpdateFail: ".mysql_error();
        //echo "000000";
    }

}
//insert order information into database
function placeorder($con){

    $test = $_SESSION;


    //get order time
    $time = date("Y-m-d H:i:s", time());
    //echo $time;
    $test["time"]= $time;
    //unset starttime setted in appointment function
    unset($test["starttime"]);
    unset($test["duration"]);
    unset($test["endtime"]);
    //get shopid and massagistname from MassagistDetail using massaid
    $info = DBfetchone2($con,"MassagistDetail",array('shopid','name'),array("phone"=>$test['massaid']));
    $info["massagistname"]=$info["name"];
    unset($info["name"]);
    $test = array_merge($test,$info);

    //get shopname from "Shop" using Shopid
    $info = DBfetchone2($con,"Shop", array('name'),array("shopid"=>$test['shopid']));
    $info["shopname"]=$info["name"];
    unset($info["name"]);
    $test = array_merge($test,$info);

    //get servicename from service using serviceid
    $info = DBfetchone2($con,"Service",array('name'),array("serviceid"=>$test['serviceid']));
    $info["servicename"]=$info["name"];
    unset($info["name"]);
    $test = array_merge($test,$info);

    //echo "before place order to database: ".var_dump($test);

    $orderid = DBinsert('Order',$test,$con);
    $_SESSION["orderid"] = $orderid;

    if(isset($orderid)){
        return True;
    }
    else return False;
    //else echo "hehe";

}







