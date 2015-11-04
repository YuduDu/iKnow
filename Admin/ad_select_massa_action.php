<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>技师查询详情</title>
</head>
<?php
require_once "db_func.php";
session_start();
$_SESSION['masaid'] = $_POST['ad_select_massa'];
var_dump( $_SESSION );
$con = DBconnect();

if ( isset( $_POST['ad_select_massa'] ) && $_POST['ad_select_massa'] != null ) {
	get_massagist_by_phone( $con, $_POST['ad_select_massa'] );
}

function get_massagist_by_phone( $con, $phone ){
$sql_massagist = "SELECT * FROM MassagistDetail WHERE phone = '$phone'";
$result = mysql_query( $sql_massagist, $con ) or die( "Fetch massaid Error:" . mysql_error() );
$sql_massagist_order = "SELECT * FROM massagist_appt WHERE massaid = '$phone'";
$result_order = mysql_query( $sql_massagist_order, $con ) or die ( "Fetch massa order Error" . mysql_errno() );
echo "<center>";
echo "<TR>技师详情</TR>";
echo "<table border='1'>";
echo "<TR><TD>NAME</TD><TD>STARS</TD><TD>SHOP</TD><TD>ACTION</TD><TD>ORDER</TD></TR>";
while ( $row = mysql_fetch_assoc( $result ) ) {
echo "<tr><td>";
echo $row['name'];
echo "</td><td>";
echo $row['stars'];
echo "</td><td>";
echo $row['shopid'];
echo "</td><td>";

?>
<a href="delete.php"> 删除 </a>
<a href="edit.php"> 修改 </a>
<td>
	<a href="ad_select_massa_order.php">订单详情</a>
</td>
<?php
}
echo "</table>";
}