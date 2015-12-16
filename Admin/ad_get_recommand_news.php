<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>身知道黄河路门诊部</title>
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
		<li><a href="javascript:history.back()">系统推荐</a></li>
		<li><a href="#">推荐新闻详情</a> </li>
	</ul>
</div>
<div class="rightinfo">

	<div class="formtitle1"><span>推荐新闻详情</span></div>

	<table class="tablelist">
		<thead>
		<tr>
			<th align="center">推荐文章</th>

			<th align="center">显示图片</th>
			<th align="center">操&nbsp &nbsp作</th>
		</tr>
		</thead>
		<tbody>

		<?php
		require_once "./configs.php";
		require_once "./db_func.php";
		$con = DBconnect();
		$sql = "SELECT * FROM Recommand_news";
		$result = mysql_query($sql,$con);
		while ($row = mysql_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>";
			echo $row['title'];
			echo "</td>" ."<td>";
			echo '<img src = "' .$row['pic'] .'" width="102" height="62"/> ';
			?>

		<?php
			echo "</td>" . "<td>" ;
			?>

		<?php
			?>
			<a href="ad_rcmand_ma_delete.php">删除</a>
			<?php
			echo "</td>" ."</tr>";
		}
		?>

		</tbody>
	</table>
</div>