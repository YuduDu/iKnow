<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8">
	<title>客户查询结果</title>
</head>

<?php
require_once 'configs.php';
require_once 'db_func.php';
$_SESSION['customer_phone'] = $_POST['ad_select_customer'];
	var_dump($_SESSION);
$con = DBconnect();

if ( isset( $_POST['ad_select_customer'] ) && $_POST['ad_select_customer'] != null ) {
	get_customer_by_phone( $con, $_POST['ad_select_customer'] );

}

function get_customer_by_phone( $con, $phone ){
	$sql= "SELECT * FROM Customer WHERE phone = '$phone'";
	$result = mysql_query( $sql, $con );
	echo "<center>";
	echo "<TR>客户详情</TR>";
	echo "<table border='1'>";
	echo "<tr><td>PHONE</td><td>SIGNUPDATE</td><td>COUNTRY</td><td>ACTION</td><td>ODRERID</td></tr>";
	while ( $row = mysql_fetch_assoc( $result ) ){
	echo "<tr><td>";
	echo $row['phone'];
	echo "</td><td>";
	echo $row['signupdate'];
	echo "</td><td>";
	echo $row['Country'];
	echo "</td><td>";

	?>
		<a href="delete.php">删除 </a>
		<a href="edit.php">修改 </a>
		<td>
			<a href="ad_select_custom_order.php">订单详情</a>
		</td>
<?php
	}
echo "</table>";
}
