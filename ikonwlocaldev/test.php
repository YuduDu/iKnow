<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/15/15
 * Time: 4:58 PM
 */
require_once "lib/db_func.php";
$stars=1;
$star = 5;
$new_stars = ceil(($stars*9+$star)/10);
echo $new_stars;