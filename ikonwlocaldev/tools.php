<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/30/15
 * Time: 2:46 PM
 */


//将一个数组添加到另一个数组里面
function addtoarray($target,$tmp){
    foreach(array_keys($tmp) as $t){
        $target[$t] = $tmp[$t];
    }
    return $target;
}