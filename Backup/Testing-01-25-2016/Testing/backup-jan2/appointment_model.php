<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/14/15
 * Time: 12:10 AM
 */

		$mid = $_POST['mid'];

	  if(isset($_POST['mid'])&&$_POST['mid']!=""){
          get_avaliable_hours($_POST['mid']);
      }


		 function get_avaliable_hours($mid){
             $con = mysql_connect("gene.rnet.missouri.edu","iKnow_team","iknowteam");
             if (!$con){
                 die("Cound't connect: "   . mysql_error());
             }

             $db_selected = mysql_select_db("iKnow_dev", $con);
             if (!$db_selected){
                 die ("Cannot use test_db : " . mysql_error());
             }

             //$sql1 = "SELECT start FROM iKnow_dev.massagist_appt WHERE mid = $mid";

             $sql1 = "SELECT * FROM massagist_appt WHERE mid = " .$mid .";";
             //echo $sql1;

             $result = mysql_query($sql1,$con) or die("Fetch Error:" .mysql_error());
             //echo count($result);
             $dic = array();
             while ($row = mysql_fetch_assoc($result)){
                 $rows[] = $row;
             }//DBFetchall
             //var_dump($rows);
             //print_r(array_values($rows));

             //echo json_encode($rows);


             // $appt_start = mysql_fetch_assoc($result);
             //  var_dump($appt_start);
             // echo json_encode($appt_start);
             if (!empty($rows)){
                 echo json_encode($rows);
             }
             else
                 echo "None";
         }

	?>

