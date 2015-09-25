<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/17/15
 * Time: 2:42 PM
 */
require_once "db_func.php";
if(isset($_POST['action'])&&$_POST['action']!=""){
    switch($_POST['action']){
        case 'get_recommand_service':recommand_service(); break;
        case 'get_recommand_massagist':recommand_massagesit(); break;
        default:
    }
}

function recommand_service(){
    $con =DBconnect();
    $getservice = DBfetchall("SELECT serviceid, shopname, servicename, price, pic, latitude, longtitude FROM Recommand_service",$con);
    $Arr = array();
    foreach ($getservice as $row){
        $a=array("serviceid"=>$row[0],"shopname"=>$row[1],"servicename"=>$row[2],"price"=>$row[3],"pic"=>$row[4],"latitude"=>$row[5],"longtitude"=>$row[6]);
        //var_dump($row2);
        array_push($Arr,$a);
    }
    echo json_encode($Arr);
}

function recommand_massagesit(){
    $con = DBconnect();
    $result = DBfetchall("SELECT massagistid,shopname,name,stars,intro,pic,latitude,longtitude FROM Recommand_massagist",$con);
    //echo "get row";
    //echo $getservice;
    //echo $result;
    $Arr = array();
    foreach ($result as $row){

        $a=array("massagistid"=>$row[0],"shopname"=>$row[1],"name"=>$row[2],"stars"=>$row[3],"intro"=>$row[4],"pic"=>$row[5],"latitude"=>$row[6],"longtitude"=>$row[7]);
        //echo $a;
        array_push($Arr,$a);
    }
    echo json_encode($Arr);

}
?>
