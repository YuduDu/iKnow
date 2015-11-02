<?php
//载入ucpass类
require_once('lib/Ucpaas.class.php');

$options['accountsid']='8362ed001e1ffef7bf5a09e19f8ed652';
$options['token']='ba7311b0e0b7c03c839021bd1e0a724b';

$ucpass = new Ucpaas($options);

echo $ucpass->getDevinfo('json');

$appId = "a37682e59f2645f3b4b7aed3caf24689";
$to = "13068776038";
$templateId = "13695";
$param="12345";

echo $ucpass->templateSMS($appId,$to,$templateId,$param);
