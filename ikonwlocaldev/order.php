<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/15/15
 * Time: 4:58 PM
 */
require_once "db_func.php";
require_once('stripe-config.php');
\Stripe\Stripe::setApiKey("sk_test_pijvVr7Jl5AjrLIymIx2qETk");
session_start();

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
    $massagistlist_query = "select masaid from Has_Service where serviceid = ".(int)$_SESSION['serviceid'];
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
    echo "begin charge: Taking token now";
    $token = $_POST['submit'];
    //make payment with stripe
    $con = DBconnect();
    echo "begin charge: ";
    charge($token);
    //place the order into database
    placeorder($con);

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

//get massagist information
function getmassagist_info($info,$array_id){

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
function charge($token){
    //echo "start:";
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
            $_SESSION['status']="UNCOMMENT";
        }
    }

}
//insert order information into database
function placeorder($con){

    $test = $_SESSION;
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

    //get order time
    $info["time"]= date("Y-m-d H:i:s", time());

    //get servicename from service using serviceid
    $info = DBfetchone2($con,"Service",array('name'),array("serviceid"=>$test['serviceid']));
    $info["servicename"]=$info["name"];
    unset($info["name"]);
    $test = array_merge($test,$info);

    //echo "before place order to database: ".var_dump($test);

    $orderid = DBinsert('Order',$test,$con);

    if(isset($orderid)){
        echo "success";
    }
    //else echo "hehe";
    session_destroy();
}







