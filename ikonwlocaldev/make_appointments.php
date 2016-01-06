<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 12/16/15
 * Time: 1:22 PM
 */


require_once "lib/db_func.php";
require_once "lib/general.php";
require_once "appointments.php";

date_default_timezone_set('America/Chicago');

session_start();


function make_appointment($con)
{
    //return "haha";
    if (check_attribute(['orderid', 'shopid', 'massaid', 'time', 'serviceid', 'customerid', 'type'], 'session')) {

        $orderid = $_SESSION['orderid'];
        $service_start = $_SESSION['time'];
        $shopid = $_SESSION['shopid'];
        $serviceid = $_SESSION['serviceid'];
        $service_time = form_service_time($con, $service_start, $serviceid);

        switch ($_SESSION['type']) {
            case "visiting": {
                //echo "visiting";
                if (isset($_SESSION['address']) && $_SESSION['address'] != null) {
                    $time_block = get_time_block($con, $shopid);
                    $blocked_time = get_blocked_time($service_time, $time_block);

                    $appointment = [
                        'orderid' => $orderid,
                        'massaid' => $_SESSION['massaid'],
                        'service_start' => $service_time[0],
                        'service_end' => $service_time[1],
                        'serviceid' => $serviceid,
                        'customerid' => $_SESSION['customerid'],
                        'block_start' => $blocked_time[0],
                        'block_end' => $blocked_time[1],
                        'type' => 'VISITING',
                        'address' => $_SESSION['address']
                    ];
                } else {
                    //echo "no address";
                    echo json_encode(['RespCode' => 000002, 'RespContent' => ['Status' => 'Failed', 'Content' => 'Missing Parameter: address.']]);
                    return false;
                }
                break;
            }
            case "shop": {
                //echo "shop";
                $appointment = [
                    'orderid' => $orderid,
                    'massaid' => $_SESSION['massaid'],
                    'service_start' => $service_time[0],
                    'service_end' => $service_time[1],
                    'serviceid' => $serviceid,
                    'customerid' => $_SESSION['customerid'],
                    'block_start' => $service_time[0],
                    'block_end' => $service_time[1],
                    'type' => 'SHOP'
                ];
                break;
            }
            default: {
                //echo "appointment type wrong.";
                echo json_encode(['RespCode' => 000003, 'RespContent' => ['Status' => 'Failed', 'Content' => 'Wrong Parameter: type.']]);
                return false;
                break;
            }

        }

        //return $appointment;

        if (isset($appointment)) {
            if (DBinsert('massagist_appt', $appointment, $con)) {
                return true;
            } else return false;
        }


    } else {
        //echo "parameter missed";
        echo json_encode(['RespCode' => 000002, 'RespContent' => ['Status' => 'Failed', 'Content' => 'Missing Parameter in Session.']]);
        return false;
    }


}





