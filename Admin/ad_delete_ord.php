<!DOCTYPE html><html lang="en"><head>	<meta charset="UTF-8">	<title>删除订单</title></head><?phprequire_once "configs.php";require_once "db_func.php";$con = DBconnect();get_all_shop($con);function get_all_shop($con){	$sql = "SELECT * FROM `Order` LEFT JOIN MassagistDetail ON Order.massaid = MassagistDetail.phone;";	$result = mysql_query($sql,$con);	echo "<center>";	echo "<table border='1'>";	echo "<tr>所有订单</tr>";	echo "<tr><td>订单号</td><td>客户账号</td><td>技师姓名</td><td>时间</td><td>操作</td></tr>";	while ($row = mysql_fetch_assoc($result)){		echo "<tr>". "<td>";		echo $row['orderid'] ;		echo "</td>" ."<td>";		echo $row['customerid'] ;		echo "</td>" ."<td>";		echo $row['massagistname'] ;		echo "</td>" ."<td>";		echo $row['time'] ;		echo "</td>" ."<td>";		?>		<a href="ad_rcmand_ma_delete.php">删除</a>		<?php	}	echo "</table>";}?><a href="javascript:history.go(-1);">返回</a>