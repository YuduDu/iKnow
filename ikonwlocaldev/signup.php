
<?php
//echo "this is a test"
require_once 'db_func.php';
if($_POST){
	$id=$_POST['customid'];
	$pd=$_POST['custompassword'];
	signup($id,$pd);
    //signup($_POST[form]);
}

function signup($id,$pd)//working fine
{

  $con = DBconnect();
  $checkid = 'select phone from Customer where Phone = ' . $id . ';';

  if (!empty(DBfetchone($checkid, $con))
  ) {
    echo "exist";
  } else {

    $sql = 'insert Customer (phone, password,signupdate) values (' . $id . ',"' . $pd .'",current_date());';
    //echo $sql;
    DBfetchall($sql, $con);
    //echo "1 record added";
    mysql_close($con);

  }
}

function signup1($form)//NOT FINISH
{
  //echo $form;
  $info = json_decode($form);//$form format better be ["key":"value","key2":"value2"]
  var_dump($info);
  foreach ($info as $row){
    echo $row;
    $tmp = join(",",array_keys($row));
    echo $tmp;
  }

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
}


?>