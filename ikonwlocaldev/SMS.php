<?php
//载入ucpass类
require_once('lib/Ucpaas.class.php');

$options['accountsid']='8362ed001e1ffef7bf5a09e19f8ed652';
$options['token']='ba7311b0e0b7c03c839021bd1e0a724b';

$ucpass = new Ucpaas($options);

echo $ucpass->getDevinfo('json');

$appId = "a37682e59f2645f3b4b7aed3caf24689";
$templateId = "13695";
$t=0;
if(isset($_POST["phone"])&&$_POST["phone"]!="null"){
    session_start();
    $auth = rand(1000,9999);
    $_SESSION["auth"]=$auth;
    $to = $_POST["phone"];
    $param=$_SESSION["auth"];
    echo $ucpass->templateSMS($appId,$to,$templateId,$param);
}

if(isset($_POST["authnum"])&&$_POST["authnum"]!=""){
    if((int)$_POST["authnum"]==$_SESSION["auth"]){
        echo "success";
        session_destroy();
    }
    else {
        echo "fail";
        $t+=1;
        if($t>=3){
            echo "expired";
            session_destroy();
        }
    }

}


//$to = "13068776038";

//$param="12345";


