<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>商家查询结果</title>
	<link href="../1210/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../1210/js/jquery.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

	<script src="ad_select_shop.js"></script>

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
	require_once '../db_func.php';
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
		<li><a href="../1210/index.html">首页</a></li>
		<li><a href="javascript:history.back()">返回</a></li>
		<li><a href="#">商家查询结果</a> </li>
	</ul>
</div>
<div class="rightinfo">
	<div class="formtitle1"><span>商家详情</span></div>
	<table class="tablelist">
		<thead>
		<tr>
			<th>商家ID</th>
			<th>商家名称</th>
			<th>联系电话</th>
			<th>营业时间</th>
			<th>关门时间</th>
			<th>城市</th>
			<th>省份</th>
			<th>删除</th>
			<th>编辑</th>
		</tr>
		</thead>
		<tbody>
		<?php
		while ( $row = mysql_fetch_assoc( $result ) ) {
		?>
		<tr class="shop_select_form">
			<th class="shopid"><?php echo $row['shopid']; ?> </th>
			<th class="name"><?php echo $row['name']; ?> </th>
			<th class="phone"><?php echo $row['phone']; ?> </th>
			<th class="opentime"><?php echo $row['opentime']; ?> </th>
			<th class="closetime"><?php echo $row['closetime']; ?> </th>
			<th class="city"><?php echo $row['city'];?> </th>
			<th class="province"><?php echo $row['province'];?></th>
			<th>
				<input type="button" value="删除" class = "delete-btn">
			</th>
			<th>
				<input type="button" value="编辑" class = "edit-btn">
				<input type="button" value="保存" class = "save-btn">
			</th>
				<input type="hidden" value="<?php echo $row['shopid'];?>" class = "old_id">

<!--//				echo "<tr><td>";-->
<!--//				echo $row['shopid'];-->
<!--//				echo "</td><td>";-->
<!--//				echo $row['name'];-->
<!--//				echo "</td><td>";-->
<!--//				echo $row['phone'];-->
<!--//				echo "</td><td>";-->
<!--//				echo $row['opentime'];-->
<!--//				echo "</td><td>";-->
<!--//				echo $row['closetime'];-->
<!--//				echo "</td><td>";-->
<!--//				echo $row['city'];-->
<!--//				echo "</td><td>";-->
<!--//				echo $row['province'];-->
<!--//				echo "</td><td>";-->
<!--//				?>-->
<!--				<a href="ad_select_shop_delete.php"> 删除 </a>-->
		<?php
		}
		?>
		</tbody>
		</table>
	</div>
</body>
