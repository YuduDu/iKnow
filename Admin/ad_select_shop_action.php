<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8">
	<title>商家查询结果</title>
	<?php
	if ( isset( $_POST['select_massagist_shop'] ) && $_POST['select_massagist_shop'] != null ) {
		get_shop_by_name( $con, $_POST['select_massagist_shop'] );
	}


	function get_shop_by_name( $con, $name ){
	$sql_shop_name = "SELECT * FROM Shop WHERE name = '$name'";
	$result = mysql_query( $sql_shop_name, $con ) or die( "Fetch massaid Error:" . mysql_error() );
	echo "<center>";
	echo "<TR>商家详情</TR>";
	echo "<table border='1'>";
	echo "<TR><TD>NAME</TD><TD>SHOPID</TD><TD>PHONE</TD><TD>OPEN</TD><TD>CLOSE</TD><TD>CITY</TD><TD>PROVINCE</TD><TD>ACTION</TD></TR>";
	while ( $row = mysql_fetch_assoc( $result ) ) {
	echo "<tr><td>";
	echo $row['name'];
	echo "</td><td>";
	echo $row['shopid'];
	echo "</td><td>";
	echo $row['phone'];
	echo "</td><td>";
	echo $row['opentime'];
	echo "</td><td>";
	echo $row['closetime'];
	echo "</td><td>";
	echo $row['city'];
	echo "</td><td>";
	echo $row['province'];
	echo "</td><td>";
	?>
	<a href="delete.php"> 删除 </a>
	<a href="edit.php"> 修改 </a>
<?php
}
echo "</table>";
}