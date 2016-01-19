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
		<li><a href="#">推荐技师详情</a> </li>
	</ul>
</div>
<div class="rightinfo">

	<div class="formtitle1"><span>推荐技师详情</span></div>

	<table class="tablelist">
		<thead>
		<tr>
			<th>技师姓名</th>
			<th>所属店铺</th>
			<th>技师编号</th>
			<th>星&nbsp &nbsp级</th>
			<th>城&nbsp &nbsp市</th>
			<th>操&nbsp &nbsp作</th>
		</tr>
		</thead>
		<tbody>

		<?php
		require_once "../configs.php";
		require_once "../db_func.php";
		$con = DBconnect();
		$sql = "SELECT * FROM Recommand_massagist";
		$result = mysql_query($sql,$con);
		while ($row = mysql_fetch_assoc($result)){
			echo "<tr class='news-form'>";
			echo "<td>";
			echo $row['name'] ;
			echo "</td>" ."<td>";
			echo $row['shopname'] ;
			echo "</td>" . "<td>" ;
			echo $row['massagistid'];
			echo "</td>" ."<td>";
			echo $row['stars'];
			echo "</td>" ."<td>";
			echo $row['city'];
			echo "</td>" ."<td>"
			?>
			<button type="button" class="delete-ma-btn">删除</button>
			<?php
			echo "</th>";
		?>
		<input type="hidden" value="<?php echo $row['massagistid'];?>" class = "massagistid">
		</tr>
		<?php
		}
		?>
		<tr>
			<th colspan="6" style="text-align:center;"><a href="rcmd_add/rcmd_add_massa.php">添加推荐技师</a></th>
		</tr>

		</tbody>
</table>

	</div>