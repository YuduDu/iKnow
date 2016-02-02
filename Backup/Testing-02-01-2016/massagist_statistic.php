<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 11/4/15
 * Time: 1:47 PM
 */

require_once "lib/db_func.php";
if (isset($_POST["massaid"]) && $_POST["massaid"] != null) {
    basic_statistic($_POST["massaid"]);

}

function basic_statistic($massaid)
{

    $con = DBconnect();
    $result = DBfetchall2($con, "Has_Service", array("sum(amount) as ordernum", "sum(money) as money"), array("masaid" => $massaid));
    //echo json_encode($result);
    if($result != null)
    {
        echo json_encode([
            'RespCode' => 111111,
            'RespContent' => [
                'Status' => 'Success',
                'Content' => $result
            ]
        ]);
    }
    else{
        echo json_encode(['RespCode' => '000004', 'RespContent' => ['Status' => 'Error', 'Content' => "Make sure the massaid is right. Something Wrong when get information from MassagistDetail table. no data return."]]);
    }
}