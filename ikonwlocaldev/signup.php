
<?php
//echo "this is a test"
require_once 'lib/db_func.php';
session_start();

date_default_timezone_set('America/Chicago');

require_once "vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
//use Monolog\Handler\FirePHPHandler;

if(isset($_POST['custompassword'])&&$_POST['custompassword']!=null){
  //$id=$_POST['customid'];
    //set-up logger
    $logger=new Logger('signup');

    if($_SESSION["client"]=="customer")
    {
        $logger->pushHandler(new StreamHandler("Log/customer/signup/".date("Y-m-d",time()).".log",Logger::INFO));

        $pd=$_POST['custompassword'];
        if($_SESSION["auth"]=="success") {
            $id = $_SESSION["phone"];
            signup($logger,$id,$pd);
        }
        else {
            echo "signup denied";
            $logger->addError("Signup denied_Phone auth fail",array("phone"=>$_SESSION["phone"]));
        }

    }
    else{
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
        echo "exist";
          $logger->addNotice("Customer phone try duplicate signing up.",array("customer phone"=>$id));
      }
      else {
          $time = date("Y-m-d H:i:s", time());
        //$sql = 'insert Customer (phone, password,signupdate) values ("' . $id . '","' . $pd .'","'.$time.'");';
        //$tmp = DBfetchall($sql, $con);
          if(!empty(DBinsert("Customer",array("phone"=>$id,"password"=>$pd,"signupdate"=>$time),$con)))
          {
              echo 1;
              $logger->addInfo("Success",array("Customer phone"=>$id));
          }
          else{
              echo 0;
              $logger->addNotice("Fail_insert database fail",array("Customer phone"=>$id));
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