
<?php
//echo "this is a test"
require_once 'lib/db_func.php';
session_start();

if(isset($_POST['custompassword'])&&$_POST['custompassword']!=null){
  //$id=$_POST['customid'];
    if($_SESSION["client"]=="customer")
    {
        $pd=$_POST['custompassword'];
        if($_SESSION["auth"]=="success") {
            $id = $_SESSION["phone"];
            signup($id,$pd);
        }
        else echo "signup denied";

    }

    //signup($_POST[form]);
}

function signup($id,$pd)//working fine
{

      $con = DBconnect();
      $checkid = 'select phone from Customer where Phone = "' . $id . '";';
      $result = DBfetchone($checkid, $con);
      if (!empty($result)) {
        echo "exist";
      }
      else {
        $sql = 'insert Customer (phone, password,signupdate) values ("' . $id . '","' . $pd .'",current_date());';
        $tmp = DBfetchall($sql, $con);
        echo 1;
      }
        mysql_close($con);
        session_destroy();
}

/*function signup1($form)//NOT FINISH
{
  //echo $form;
  $info = json_decode($form);//$form format better be ["key":"value","key2":"value2"]
  var_dump($info);
  foreach ($info as $row){
    echo $row;
    $tmp = join(",",array_keys($row));
    echo $tmp;
  }*/

 /* $con = DBconnect();
  $checkid = 'select phone from Customer where Phone = ' . $id . ';';

  if (!empty(
  DBquery($checkid, $con))
  ) {
    echo "exist";
  } else {

    $sql = 'insert Customer (phone, password) values (' . $id . ',"' . $pd . '");';
    //echo $sql;
    DBquery($sql, $con);
    //echo "1 record added";
    mysql_close($con);

  }*/
//}


?>