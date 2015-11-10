<?php

$to = "12315dyd@gmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "test@php.com";
$headers = "From: $from";
var_dump(mail($to,$subject,$message,$headers));
echo "Mail Sent.";

?>