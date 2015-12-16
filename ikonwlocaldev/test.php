<?php

/*require_once "vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$logger = new Logger('test');
$logger->pushHandler(new StreamHandler('./test.log', Logger::WARNING));

// add records to the log
$logger->addWarning('Foo');
$logger->addError('Bar');*/
//var_dump($_SERVER['REMOTE_ADDR']);
//$con = DBconnect();

//$result = DBfetchall2($con,)

$response['RespCode']=111111;
$response['RespContent']=['Status'=>'Success','OrderId'=>12345];
echo json_encode($response);

?>