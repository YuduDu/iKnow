<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/15/15
 * Time: 4:58 PM
 */
require_once "db_func.php";

session_start();
//$_SESSION['timeout'] = time();

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
   // var_dump($_SESSION);
    //echo "begin:";
    $basic_order_parameter = json_decode($_POST['basic_order']);
    foreach($basic_order_parameter as $key => $val){
        $_SESSION[$key]=$val;
    }
    $con=DBconnect();
    $massagistlist_query = "select masaid from Has_Service where serviceid = ".(int)$_SESSION['serviceid'];
    $massagistlist = DBfetchall($massagistlist_query,$con);
    //var_dump($massagistlist);
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
    //var_dump($_SESSION);

}

if(isset($_POST['order'])&&$_POST['order']!=NULL)
{
    $order_parameter = json_decode($_POST['order']);
    foreach($order_parameter as $key => $val){
        $_SESSION[$key]=$val;
    }

    //var_dump($_SESSION);
    $con=DBconnect();
    if($_SESSION['massaid']!=NULL)
    {
    $_SESSION["level"] = getlevel($con);
    }
    //echo "level:".$_SESSION["level"];
    $_SESSION["unitprice"]=getunitprice($con);
    $_SESSION['amount']=calculateamount();
    //var_dump($_SESSION);
    echo $_SESSION['amount'];
    //placeorder();
}

if(isset($_POST['submit'])&&$_POST['submit']!=null)
{
    $order_parameter = json_decode($_POST['submit']);
    foreach($order_parameter as $key => $val){
        $_SESSION[$key]=$val;
    }

    //var_dump($_SESSION);
    $con=DBconnect();
    $_SESSION["level"] = getlevel($con);
    //echo "level:".$_SESSION["level"];
    $_SESSION["unitprice"]=getunitprice($con);
    $_SESSION['amount']=calculateamount();
    //var_dump($_SESSION);
    echo $_SESSION['amount'];
    placeorder();

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
    //var_dump($para);
    $unitprice = DBselectsUseonekey($para,array($_SESSION["serviceid"]),"serviceid",Service,$con);
    return $unitprice[0][$para[0]];
}

//get massagist information
function getmassagist_info($info,$array_id){

}
//calculate the amount of the order
function calculateamount(){
    $amount = $_SESSION['unitprice']*$_SESSION['qty'];
    return $amount;

}

//insert order information into database
function placeorder(){
    session_destroy();
}

//make payment with stripe
function charge(){


}



/*
if(isset($_POST["order"])&&$_POST["order"]!=NUll)
{
    $order_parameter = json_decode($_POST["order"]);
   // $_SESSION[
    foreach($basic_order_parameter as $key => $val){
        $_SESSION[$key]=$val;
    }
    $_SESSION["amount"]=$_SESSION["qty"]*$_SESSION["price"];
}

var_dump($_SESSION);




*/

