<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/8/15
 * Time: 12:37 PM
 */

//use for get more comments in massagistDetail page.
require_once "lib/db_func.php";

if (isset($_POST["pagenum"]) && $_POST["pagenum"] != "" && isset($_POST["massaid"]) && $_POST["massaid"] != "") {
    $con = DBconnect();
    $id = (String)$_POST["massaid"];
    $pagelimit = 5;
    $comment_list = get_more_comment($con, array("date", "customerid", "stars", "content"), array("massaid" => $id), $_POST["pagenum"], $pagelimit);
    //echo json_encode($comment_list);
    echo json_encode([
        'RespCode' => 111111,
        'RespContent' => [
            'Status' => 'Success',
            'Content' => $comment_list
        ]
    ]);
}

function get_more_comment($con, $Info_array, $keypair_array, $page, $perpagenum)
{
    $start = ($page - 1) * $perpagenum;
    //echo $page." ".$perpagenum." ".$start;
    $comments = DBfetchall2($con, "Comment", $Info_array, $keypair_array, "order by date desc limit " . $start . "," . $perpagenum);
    return $comments;
}