
<?php
//echo "this is a test"
require_once 'db_func.php';
if($_POST){
	$id=$_POST['customid'];
	$pd=$_POST['custompassword'];
	signup($id,$pd); 
}

function signup($id,$pd){
  //echo $id.$pd;
$con =DBconnect();
$checkid='select Phone from Customer where Phone = '.$id.';';
//echo $checkid;
$checkresult = mysql_query($checkid,$con);
$row=mysql_fetch_array($checkresult);
if(!empty($row)){
  echo "exist";
}
else{
  $sql='insert Customer (Phone, password) values ('.$id.',"'.$pd.'");';
  //echo $sql;

  if (!mysql_query($sql,$con))
    {
    die('Error: 1' . mysql_error());
    }
  }
  //echo "1 record added";
  mysql_close($con);

  }
?>