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
session_start();
if($_SESSION['admin']==null){
	$url = "../1210/login.php";
	?>
	<script type="text/javascript">
		alert("请登录！")
		window.location.href=location.href='../1210/login.php';
	</script>
	<?php

}
?>

<body>
<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="../1210/index.html">首页</a></li>
		<li><a href="javascript:history.go(-1);">返回</a></li>
	</ul>
</div>
<div class="formbody">
	<form id = "select_order" action = "ad_select_order_action.php" method="post">
		<div class="formtitle"><span>选择订单</span></div>
		<ul class="forminfo">
			<li><label>月份</label>
				<select name = "month" id = "month">
					<option value="">月</option>
					<option value = "01" > 一月 </option>
					<option value = "02" > 二月 </option>
					<option value = "03" > 三月 </option>
					<option value = "04" > 四月 </option>
					<option value = "05" > 五月 </option>
					<option value = "06" > 六月 </option>
					<option value = "07" > 七月 </option>
					<option value = "08" > 八月 </option>
					<option value = "09" > 九月 </option>
					<option value = "10" > 十月 </option>
					<option value = "11" > 十一月 </option>
					<option value = "12" > 十二月 </option>
				</select>
			</li>

			<li><label>年份</label>
				<select name = "year" id = "year">
					<option value="">年</option>
					<option value = "2015" > 2015 </option>
					<option value = "2016" > 2016 </option>
					<option value = "2017" > 2017 </option>
					<option value = "2018" > 2018 </option>
					<option value = "2019" > 2019 </option>
					<option value = "2020" > 2020 </option>
					<option value = "2021" > 2021 </option>
					<option value = "2022" > 2022 </option>
					<option value = "2023" > 2023 </option>
					<option value = "2024" > 2024 </option>
					<option value = "2025" > 2025 </option>
					<option value = "2026" > 2026 </option>
				</select>
			</li>
			<li><label></label><input name="" type="submit" class="btn" value="查询"/>
			<label></label><input name="" type="reset" class="btn" value="重置"/></li>
</body>
</html>














<!--<center>-->
<!--	<form id = "select_order" action = "ad_select_order_action.php" method="post">-->
<!--	<p>订单查询:</p>-->
<!--		<p>月份:-->
<!--			<select name = "month" id = "month">-->
<!--				<option value = "01" > January </option>-->
<!--				<option value = "02" > February </option>-->
<!--				<option value = "03" > March </option>-->
<!--				<option value = "04" > April </option>-->
<!--				<option value = "05" > May </option>-->
<!--				<option value = "06" > June </option>-->
<!--				<option value = "07" > July </option>-->
<!--				<option value = "08" > August </option>-->
<!--				<option value = "09" > September </option>-->
<!--				<option value = "10" > October </option>-->
<!--				<option value = "11" > November </option>-->
<!--				<option value = "12" > December </option>-->
<!--		</select>-->
<!--		</p>-->
<!--		<p>年份:-->
<!--			<select name = "year" id = "year">-->
<!--				<option value = "2015" > 2015 </option>-->
<!--				<option value = "2016" > 2016 </option>-->
<!--				<option value = "2017" > 2017 </option>-->
<!--				<option value = "2018" > 2018 </option>-->
<!--				<option value = "2019" > 2019 </option>-->
<!--				<option value = "2020" > 2020 </option>-->
<!--				<option value = "2021" > 2021 </option>-->
<!--				<option value = "2022" > 2022 </option>-->
<!--				<option value = "2023" > 2023 </option>-->
<!--				<option value = "2024" > 2024 </option>-->
<!--				<option value = "2025" > 2025 </option>-->
<!--				<option value = "2026" > 2026 </option>-->
<!--			</select>-->
<!--		</p>-->
<!--	<input type="submit"/>-->
<!--	<input type="reset"/>-->
<!--	</form>-->
<!--</center>-->