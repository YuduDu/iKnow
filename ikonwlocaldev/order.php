<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/15/15
 * Time: 4:58 PM
 */
require_once "db_func.php";

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
        $result = DBselectonekey($para,$massagistids,"phone","MassagistDetail",$con);
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
    $_SESSION['amount']=calculate();
    var_dump($_SESSION);
    placeorder();
}


//get massagist information
function getmassagist_info($info,$array_id){

}
//calculate the amount of the order
function calculate(){
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

