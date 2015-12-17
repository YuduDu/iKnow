
<?php
//echo "this is a test"
require_once 'lib/db_func.php';


date_default_timezone_set('America/Chicago');

require_once "vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
//use Monolog\Handler\FirePHPHandler;

session_start();

if(isset($_POST['custompassword'])&&$_POST['custompassword']!=null){
    //$id=$_POST['customid'];
    //set-up logger
    $logger=new Logger('signup');


    if($_SESSION["client"]=="Customer")
    {
        $logger->pushHandler(new StreamHandler("Log/customer/signup/".date("Y-m-d",time()).".log",Logger::INFO));

        $pd=$_POST['custompassword'];
        if($_SESSION["auth"]=="success") {
            $id = $_SESSION["phone"];
            signup($logger,$id,$pd);
        }
        else {
           // echo "signup denied";
            echo json_encode([
                'RespCode'=>000005,
                'RespContent'=>[
                    'Status'=>'Failed',
                    'Content'=>'Sign up Denied, Auth not pass!'
                ]
            ]);
            $logger->addError("Signup denied_Phone auth fail",array("phone"=>$_SESSION["phone"]));
        }

    }
    else{
        //echo "";
        $logger->pushHandler(new StreamHandler("Log/customer/signup/critical.log",Logger::CRITICAL));
        $logger->addCritical("Uncustomer client trying signup!",array("phone"=>$_SESSION["phone"],"phone auth"=>$_SESSION["auth"]));
    }

    //signup($_POST[form]);
}

function signup($logger,$id,$pd)//working fine
{

    $con = DBconnect();
    //$checkid = 'select phone from Customer where Phone = "' . $id . '";';
    //$result = DBfetchone($checkid, $con);
    $result = DBfetchone2($con,Customer,array("phone"),array("Phone"=>$id));
    if (!empty($result)) {
       // echo "exist";
        echo json_encode([
            'RespCode'=>000005,
            'RespContent'=>[
                'Status'=>'Failed',
                'Content'=>'Phone number already been signed up.'
            ]
        ]);
        $logger->addNotice("Customer phone ".$id." try duplicate signing up.");
    }
    else {
        $time = date("Y-m-d H:i:s", time());
        //$sql = 'insert Customer (phone, password,signupdate) values ("' . $id . '","' . $pd .'","'.$time.'");';
        //$tmp = DBfetchall($sql, $con);
        $return=DBinsert("Customer",array("phone"=>$id,"password"=>$pd,"signupdate"=>$time),$con);
        //var_dump($return);
        if((string)$return=="false")
        {

            //echo 0;
            echo json_encode([
                'RespCode'=>000000,
                'RespContent'=>[
                    'Status'=>'Failed',
                    'Content'=>'Sign up Failed, please try again.'
                ]
            ]);
            $logger->addNotice("Fail_insert database fail. Customer phone: ".$id);
        }
        else{
            //echo 1;
            echo json_encode([
                'RespCode'=>111111,
                'RespContent'=>[
                    'Status'=>'Success',
                    'Content'=>'Sign up succeed!'
                ]
            ]);
            $logger->addInfo("Sign up successfully. Customer phone: ".$id);

        }
    }
    mysql_close($con);
    session_destroy();
}

/*function signup1($form)//NOT FINISH
{
  //echo $form;
  $info = json_decode($form);//$form format better be ["key":"value","key2":"value2"]
  var_dump($info);
  foreach ($info as $row){
    echo $row;
    $tmp = join(",",array_keys($row));
    echo $tmp;
  }*/

/* $con = DBconnect();
 $checkid = 'select phone from Customer where Phone = ' . $id . ';';

 if (!empty(
 DBquery($checkid, $con))
 ) {
   echo "exist";
 } else {

   $sql = 'insert Customer (phone, password) values (' . $id . ',"' . $pd . '");';
   //echo $sql;
   DBquery($sql, $con);
   //echo "1 record added";
   mysql_close($con);

 }*/
//}


?>