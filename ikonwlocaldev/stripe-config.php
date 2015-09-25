<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/14/15
 * Time: 4:10 PM
 */
require_once "stripe-php-3.3.0/init.php";

$stripe = array(
    "secret-key" => "sk_test_pijvVr7Jl5AjrLIymIx2qETk",
    "publishable-key"=>"pk_test_XOAM8G6tnBANFHGUKpqRRvx0"
);
\Stripe\Stripe::setApiKey($stripe['secret_key']);
echo "hehe";
?>