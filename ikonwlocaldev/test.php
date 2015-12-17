<?php

/*rquire_once_once "vendor/autoload.php";
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

//rquire_once 'lib\general.php';
//rquire_once 'lib\db_func.php';
//rquire_once 'appointments.php';
require_once "make_appointments.php";
require_once "lib/db_func.php";
require_once "appointments.php";
require_once "lib/general.php";

session_start();

$_SESSION['orderid']='111111';
$_SESSION['shopid']='2';
$_SESSION['massaid']='15136352580';
$_SESSION['time']='2015-12-24 10:00:00';
$_SESSION['serviceid']='42';
$_SESSION['customerid']='1';
$_SESSION['type']='VISITING';
$_SESSION['address']="this is a test";

$con = DBconnect();
$result = make_appointment($con);
var_dump($result);
session_destroy();

?>