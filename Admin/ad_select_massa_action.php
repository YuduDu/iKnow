<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>技师查询结果</title>
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
<body>
<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="./1210/index.html">首页</a></li>
		<li><a href="javascript:history.back()">返回</a></li>
		<li><a href="#">技师查询结果</a> </li>
	</ul>
</div>

<div class="rightinfo">
	<div class="formtitle1"><span>技师详情</span></div>
	<table class="tablelist">
		<thead>
		<tr>
			<th>姓名</th>
			<th>等级</th>
			<th>所属商家</th>
			<!--				<th>星&nbsp &nbsp级</th>-->
			<th>操&nbsp &nbsp作</th>
			<th>历史订单</th>
		</tr>
		</thead>

		<tbody>
		<?php
		require_once "db_func.php";
		session_start();
		$_SESSION['masaid'] = $_POST['ad_select_massa'];
		$con = DBconnect();

		$sql_massagist = "SELECT * FROM MassagistDetail WHERE phone = " .$_POST['ad_select_massa'];
		$result = mysql_query( $sql_massagist, $con ) or die( "Fetch massaid Error:" . mysql_error() );
		$sql_massagist_order = "SELECT * FROM massagist_appt WHERE massaid = " .$_POST['ad_select_massa'];
		$result_order = mysql_query( $sql_massagist_order, $con ) or die ( "Fetch massa order Error" . mysql_errno() );
		while ( $row = mysql_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>";
			echo $row['name'];
			echo "</td>" ."<td>";
			echo $row['stars'];
			echo "</td>" ."<td>";
			echo $row['shopid'];
			echo "</td>" ."<td>";
			?>
		<a href="ad_select_massa_delete.php"> 删除 </a>
			<?php
			echo "</td>" ."<td>";
			?>
		<a href="ad_select_massa_order.php">订单详情</a>
			<?php
			echo "</th>" ."</tr>";
		}
		?>

		</tbody>
	</table>
</div>
</body>


<?php
//require_once "db_func.php";
//session_start();
//$_SESSION['masaid'] = $_POST['ad_select_massa'];
//$con = DBconnect();
//
//if ( isset( $_POST['ad_select_massa'] ) && $_POST['ad_select_massa'] != null ) {
//	get_massagist_by_phone( $con, $_POST['ad_select_massa'] );
//}
//
//function get_massagist_by_phone( $con, $phone ){
//	$sql_massagist = "SELECT * FROM MassagistDetail WHERE phone = '$phone'";
//	$result = mysql_query( $sql_massagist, $con ) or die( "Fetch massaid Error:" . mysql_error() );
//	$sql_massagist_order = "SELECT * FROM massagist_appt WHERE massaid = '$phone'";
//	$result_order = mysql_query( $sql_massagist_order, $con ) or die ( "Fetch massa order Error" . mysql_errno() );
//	echo "<center>";
//	echo "<TR>技师详情</TR>";
//	echo "<table border='1'>";
//	echo "<TR><TD>NAME</TD><TD>STARS</TD><TD>SHOP</TD><TD>ACTION</TD><TD>ORDER</TD></TR>";
//	while ( $row = mysql_fetch_assoc( $result ) ) {
//	echo "<tr><td>";
//	echo $row['name'];
//	echo "</td><td>";
//	echo $row['stars'];
//	echo "</td><td>";
//	echo $row['shopid'];
//	echo "</td><td>";
//?>
<!--<a href="ad_select_massa_delete.php"> 删除 </a>-->
<!--<td>-->
<!--	<a href="ad_select_massa_order.php">订单详情</a>-->
<!--</td>-->
<?php
//}
//echo "</table>";
//}
//?>
<!---->
<!--<center><a href="ad_select_massa.php">返回</a></center>-->

