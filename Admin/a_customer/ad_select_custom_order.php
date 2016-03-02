<?php
//if (!session_id())
//{
	session_start();
if((string)$_SESSION['admin']==null){
	$url = "../1210/login.php";
	?>
	<script type="text/javascript">
		alert("请登录！")
		window.location.href=location.href='../1210/login.php';
	</script>
<?php

}
//}
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>客户订单详情</title>
		<link href="../1210/css/style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../1210/js/jquery.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				$(".click").click(function(){
					$(".tip").fadeIn(200);
				});
				$(".tiptop a").click(function(){
					$(".tip").fadeOut(200);
				});
				$(".sure").click(function(){
					$(".tip").fadeOut(100);
				});
				$(".cancel").click(function(){
					$(".tip").fadeOut(100);
				});
			});
		</script>
	</head>
<?php
	require_once '../db_func.php';
	$customid = $_SESSION['customer_phone'];
	$con = DBconnect();
	$sql= "SELECT * FROM `Order` WHERE customerid = $customid and status != 'UNPAID' ; ";
	$result = mysql_query( $sql,$con );
?>

	<body>
	<div class="place">
		<span>位置：</span>
		<ul class="placeul">
			<li><a href="../1210/index.html">首页</a></li>
			<li><a href="ad_select_custm.php">选择客户</a></li>
			<li><a href="javascript:history.back()">返回</a></li>
			<li><a href="#">客户查询结果</a> </li>
		</ul>
	</div>

	<div class="rightinfo">
		<div class="formtitle1"><span>订单详情</span></div>
		<table class="tablelist">
			<thead>
			<tr>
				<th>订单号</th>
				<th>服务商家</th>
				<th>服务技师</th>
				<th>服务内容</th>
				<th>技师级别</th>
				<th>数量</th>
				<th>订单状态</th>
				<th>优惠券</th>
				<th>所付金额</th>
			</tr>
			</thead>
			<tbody>
			<?php
			while ($row = mysql_fetch_assoc($result)){
				echo "<tr><td>";
				echo  $row['orderid'];
				echo "</td><td>";
				echo $row['shopname'];
				echo "</td><td>";
				echo get_massatist_name($con,$row['massaid']);
				echo "</td><td>";
				echo get_service_name($con,$row['serviceid']);
				echo "</td><td>";
				echo $row['level'];
				echo "</td><td>";
				echo $row['qty'];
				echo "</td><td>";
				echo $row['status'];
				echo "</td><td>";
				echo $row['promotion'];
				echo "</td><td>";
				echo $row['amount'];
				echo "</td></tr>";

			}
			?>
			</tbody>
		</table>

	</div>

<?php
//require_once 'db_func.php';
//$customid = $_SESSION['customer_phone'];
//$con = DBconnect();
//get_custom_order_detail($con,$customid);
//
//function get_custom_order_detail($con,$customid){
//	echo "<br>";
//	$sql= "SELECT * FROM `Order` WHERE customerid = $customid";
//	$result = mysql_query( $sql, $con );
//	echo "<center>";
//	echo "Customer: " .$customid ."<TR>历史订单</TR>";
//	echo "<table border='1'>";
//	echo "<tr><td>ODRERID</td><td>SHOP</td><td>MASSAGIST</td><td>SERVICE</td><td>LEVEL</td><td>QTY</td><td>STATUS</td><td>PROMOTION</td><td>AMOUNT</td></tr>";
//
//	while ($row = mysql_fetch_assoc($result)){
//		echo "<tr><td>";
//		echo  $row['orderid'];
//		echo "</td><td>";
//		echo $row['shopname'];
//		echo "</td><td>";
//		echo get_massatist_name($con,$row['massaid']);
//		echo "</td><td>";
//		echo get_service_name($con,$row['serviceid']);
//		echo "</td><td>";
//		echo $row['level'];
//		echo "</td><td>";
//		echo $row['qty'];
//		echo "</td><td>";
//		echo $row['status'];
//		echo "</td><td>";
//		echo $row['promotion'];
//		echo "</td><td>";
//		echo $row['amount'];
//		echo "</td></tr>";
//	}
//}

function get_massatist_name($con, $massagistid){
	$sql= "SELECT name FROM MassagistDetail WHERE phone = '$massagistid'";
	$result = mysql_query( $sql, $con );
	$row = mysql_fetch_assoc($result);
	return $row['name'];
}

function get_service_name($con,$serviceid){
	$sql= "SELECT name FROM Service WHERE serviceid = '$serviceid'";
	$result = mysql_query( $sql, $con );
	$row = mysql_fetch_assoc($result);
	return $row['name'];
}