<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>商家查询结果</title>
	<link href="./1210/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="./1210/js/jquery.js"></script>

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
	<?php
	require_once 'db_func.php';
	session_start();
	$_SESSION['shopid'] = $_POST['select_shop_s'];
	$con = DBconnect();
	$sql_shop_name = "SELECT * FROM Shop WHERE shopid =".$_POST['select_shop_s'];
	$result = mysql_query( $sql_shop_name, $con ) or die( "Fetch shop Error:" . mysql_error() );
	?>


<body>
<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="./1210/index.html">首页</a></li>
		<li><a href="javascript:history.back()">返回</a></li>
		<li><a href="#">商家查询结果</a> </li>
	</ul>
</div>
<div class="rightinfo">
	<div class="formtitle1"><span>商家详情</span></div>
	<table class="tablelist">
		<thead>
		<tr>
			<th>商家名称</th>
			<th>商家ID</th>
			<th>联系电话</th>
			<th>营业时间</th>
			<th>关门时间</th>
			<th>城市</th>
			<th>省份</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php
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
				<a href="ad_select_shop_delete.php"> 删除 </a>
		<?php
		echo "</th>" ."</tr>";}
		?>
		</tbody>
		</table>
	</div>
</body>










<!--	--><?php
//	require_once 'db_func.php';
//	session_start();
//	$_SESSION['shopid'] = $_POST['select_shop_s'];
//
//	$con = DBconnect();
//
//	if ( isset( $_POST['select_shop_s'] ) && $_POST['select_shop_s'] != null ) {
//		get_shop_by_name( $con, $_POST['select_shop_s'] );
//	}
//
//	function get_shop_by_name( $con, $shopid ){
//	$sql_shop_name = "SELECT * FROM Shop WHERE shopid = '$shopid'";
//	$result = mysql_query( $sql_shop_name, $con ) or die( "Fetch shop Error:" . mysql_error() );
//	echo "<center>";
//	echo "<TR>商家详情</TR>";
//	echo "<table border='1'>";
//	echo "<TR><TD>NAME</TD><TD>SHOPID</TD><TD>PHONE</TD><TD>OPEN</TD><TD>CLOSE</TD><TD>CITY</TD><TD>PROVINCE</TD><TD>ACTION</TD></TR>";
//	while ( $row = mysql_fetch_assoc( $result ) ) {
//	echo "<tr><td>";
//	echo $row['name'];
//	echo "</td><td>";
//	echo $row['shopid'];
//	echo "</td><td>";
//	echo $row['phone'];
//	echo "</td><td>";
//	echo $row['opentime'];
//	echo "</td><td>";
//	echo $row['closetime'];
//	echo "</td><td>";
//	echo $row['city'];
//	echo "</td><td>";
//	echo $row['province'];
//	echo "</td><td>";
//	?>
<!--	<a href="ad_select_shop_delete.php"> 删除 </a>-->
<!---->
<?php
//}
//echo "</table>";
//}?>
<!--	<center><a href="ad_select_shop.php" >返回 </a> </center>-->
