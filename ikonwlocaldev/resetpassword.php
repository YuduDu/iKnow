<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 11/12/15
 * Time: 3:29 PM
 */

require_once 'lib/db_func.php';

date_default_timezone_set('America/Chicago');

require_once "vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

session_start();

if (isset($_POST['new_password']) && $_POST['new_password'] != null) {
    if (isset($_SESSION["client"])) {

        $log = new Logger("services_info");
        $log->pushHandler(new StreamHandler("Log/" . strtolower($_SESSION["client"]) . "/passwordreset/" . date("Y-m-d", time()) . ".log", Logger::INFO));

        $pd = $_POST['new_password'];
        if ($_SESSION["auth"] == "success") {
            $id = $_SESSION["phone"];
            reset_password($log, $id, $pd);
        }
        //else echo "reset denied";
        else echo json_encode([
            'RespCode' => 000005,
            'RespContent' => [
                'Status' => 'Failed',
                'Content' => "Reset Denied, Auth Failed!"
            ]
        ]);
    }
    else
        echo json_encode([
            'RespCode' => 000005,
            'RespContent' => [
                'Status' => 'Failed',
                'Content' => "Session Error"
            ]
        ]);
}
else{
    echo json_encode([
        'RespCode' => 000002,
        'RespContent' => [
            'Status' => 'Failed',
            'Content' => 'Parameter missing'
        ]
    ]);
}



function reset_password($log, $id, $pd)//working fine
{
   $con = DBconnect();
   //$checkid = 'select phone from Customer where Phone = "' . $id . '";';
   //$result = DBfetchone($checkid, $con);

  if (DBupdate($con, $_SESSION["client"], array("password" => (string)$pd), array("phone" => $id))) {
      $log->addInfo("User with ip " . $_SERVER["REMOTE_ADDR"] . " reset the password of massagist " . $id . ".");
      //echo 111111;
     echo json_encode([
          'RespCode' => 111111,
          'RespContent' => [
              'Status' => 'Success',
              'Content' => 'Password reset succeed.'
          ]
      ]);
   } else {
       $log->addWarn("Fail! User with ip " . $_SERVER["REMOTE_ADDR"] . " failed to reset the password of massagist " . $id . ".");
       //echo 000000;
       echo json_encode([
           'RespCode' => 000000,
           'RespContent' => [
               'Status' => 'Failed',
               'Content' => "Password reset Failed."
           ]
       ]);
   }

   mysql_close($con);
   session_destroy();
}

