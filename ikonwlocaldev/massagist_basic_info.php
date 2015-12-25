<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/28/15
 * Time: 11:21 PM
 */
require_once "lib/db_func.php";


if (isset($_POST["massaid"]) && $_POST["massaid"] != null) {

    basic_information($_POST["massaid"]);
}

function basic_information($massaid)
{
    $con = DBconnect();
    $result = DBfetchone2($con, "MassagistDetail", array("pic", "name", "shopid", "intro", "stars"), array("phone" => $massaid));
    $shopname = DBfetchone2($con, "Shop", array("name"), array("shopid" => $result["shopid"]));
    $result["shopname"] = $shopname["name"];
    unset($result["shopid"]);

    //echo json_encode($result);
    echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success', 'Content' => $result]]);
}