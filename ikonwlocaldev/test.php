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


$phone = "12345678901";
$phone =  substr_replace($phone,"****",3,4);
echo $phone;

?>