<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>身知道黄河路门诊部</title>
	<link href="../1210/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../1210/js/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="rcmd.js"></script>

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
		<li><a href="../1210/index.html">首页</a></li>
		<li><a href="javascript:history.back()">系统推荐</a></li>
		<li><a href="#">推荐服务详情</a> </li>
	</ul>
</div>
<div class="rightinfo">

	<div class="formtitle1"><span>推荐服务详情</span></div>

	<table class="tablelist">
		<thead>
		<tr>
			<th>服务编号</th>
			<th>所属店铺</th>
			<th>服务类型</th>
			<th>价&nbsp &nbsp格</th>
			<th>城&nbsp &nbsp市</th>
			<th>操&nbsp &nbsp作</th>
		</tr>
		</thead>
		<tbody>

		<?php
		require_once "../configs.php";
		require_once "../db_func.php";
		$con = DBconnect();
		$sql = $sql = "SELECT * FROM Recommand_service";
		$result = mysql_query($sql,$con);
		while ($row = mysql_fetch_assoc($result)){
				echo "<tr class='news-form'><td>";
				echo $row['serviceid'];
				echo "</td><td>";
				echo $row['shopname'];
				echo "</td><td>";
				echo $row['servicename'];
				echo "</td><td>";
				echo $row['price'];
				echo "</td>" ."<td>";
				echo $row['city'];
				echo "</td>" ."<td>";
			?>

		<?php
			?>
			<button type="button" class="delete-service-btn">删除</button>
			<?php
			echo "</td>" ;

		?>
		<input type="hidden" value="<?php echo $row['serviceid'];?>" class = "serviceid">
		</tr>

		<?php
		}
		?>
		<tr>
			<th colspan="6" style="text-align:center;"><a href="rcmd_add/rcmd_add_service.php">添加推荐服务</a></th>
		</tr>

		</tbody>
	</table>
</div>