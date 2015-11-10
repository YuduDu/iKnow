<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/18/15
 * Time: 2:15 PM
 */
//----------------DELETE--------------------------
	require_once('JsonRpcClient.php');
    //echo "begin:";
	$loginClient = new JsonRpcClient('http://user-api.simplybook.me'.'/login/');
	$token = $loginClient->getToken('iknowapp','c811aac9e7e190e39dca2011d580ee2c708288c94e0774786844444cdc603445');
    echo "token is here:" . $token;
	$client = new JsonRpcClient('http://user-api.simplybook.me'.'/',array(
        'headers'=>array(
            'X-Company-Login:'.'iknowapp',
			'X-Token:' . $token
		)
    ));
    $services = $client->getEventList();
    var_dump($services);
    $performers = $client->getUnitList();
    echo "Performers' here:";
    var_dump($performers);

    $additionalFields = array('c811aac9e7e190e39dca2011d580ee2c708288c94e0774786844444cdc603445'=>'value1','caa0795253d94ee2e65a56b9b203420f4a78b78c8c6437db3ab69e78fd039d79'=>'value2');
    $clientData = array('name'=>'Yudu','email'=>'hehe@hehe.hehe','phone'=>'11111');
    $bookingsInfo = $client->book(2,2,"2015-09-18","10:00:00",$clientData,$additionalFields);
if ($bookingsInfo->require_confirm) {
    foreach ($bookingsInfo->bookings as $booking) {
        $sign = md5($booking->id . $booking->hash . c811aac9e7e190e39dca2011d580ee2c708288c94e0774786844444cdc603445);
        $result = $client->confirmBooking($booking->id, $sign);
        echo '
Confirm result
';
        var_dump($result);
    }
}
?>