<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/20/15
 * Time: 10:32 PM
 */
	//database function set
    require_once "lib/db_func.php";


    //monolog configure
    require_once "vendor/autoload.php";
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    use Monolog\Handler\FirePHPHandler;

    //time-zone setup
    date_default_timezone_set('America/Chicago');


  	if(isset($_POST['pass'])&&$_POST['pass']!=null){
        $form=$_POST['pass'];
        //echo $form;
        //$pd=$_POST['custompassword'];

        $logger = new Logger('login');
        $logger->pushHandler(new StreamHandler('Log/customer/login/'.date("Y-m-d", time()).'.log',Logger::INFO));
        $logger->pushHandler(new FirePHPHandler());
        login($form,$logger);
    }

	function login($form,$logger){
        $con=DBconnect();
        $char=json_decode($form,true);
        //var_dump($char);
        //$query='select password from Customer where Phone = "'.(string)$char["phone"].'";';
        //$pdw=DBfetchone($query,$con);
        $pdw = DBfetchone2($con,"Customer",array("password"),array("phone"=>$char["phone"]));
       // echo $pdw["password"];
        if ($pdw!=null&&(string)$char["password"]==$pdw["password"]){
            $logger->addInfo("User ".$char["phone"]." login successfully.");
            //echo "success";
            //echo "111111";
            echo json_encode(['RespCode'=>'111111','RespContent'=>['Status'=>'Success','Content'=>['CustomerId'=>$char["phone"]]]]);
        }
        else if($pdw==null){
            //echo "Fail";
            echo json_encode(['RespCode'=>'000000','RespContent'=>['Status'=>'Failed','Content'=>['CustomerId'=>$char["phone"],'text'=>'Phone Number not exist!']]]);
            $logger->addInfo("Fail. Phone Number ".$char["phone"]."not exist");
        }
        else
        {
            //echo "Fail";
            echo json_encode(['RespCode'=>'000000','RespContent'=>['Status'=>'Failed','Content'=>'Password wrong!']]);
            $logger->addInfo("Fail. Phone ".$char["phone"]."'s password Wrong");
        }
        //echo date("Y-m-d H:i:s", time());
        //else echo "000000";
        mysql_close($con);
    }
?>