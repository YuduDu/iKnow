<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>新增技师</title>

	<link href="../1210/css/style.css" rel="stylesheet" type="text/css" />
	<link href="../1210/css/select.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../1210/js/jquery.js"></script>
	<script type="text/javascript" src="../1210/js/jquery.idTabs.min.js"></script>
	<script type="text/javascript" src="../1210/js/select-ui.min.js"></script>
	<script type="text/javascript" src="../1210/editor/kindeditor.js"></script>

	<script type="text/javascript">
		KE.show({
			id : 'content7',
			cssPath : './index.css'
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(e) {
			$(".select3").uedSelect({
				width : 152
			});
		});
	</script>

</head>

<body class="sarchbody">
<?php
session_start();

	require_once "../db_func.php";
	$con = DBconnect();
	$get=mysql_query("SELECT name FROM Shop");
if((string)$_SESSION['admin']==null){
	$url = "../1210/login.php";
	?>
	<script type="text/javascript">
		alert("请登录！")
		window.location.href=location.href='../index.php';
	</script>
	<?php

}
?>
<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="../1210/index.html">首页</a></li>
		<li><a href="javascript:history.go(-1);">返回</a></li>
	</ul>
</div>

<div class="formbody">
	<form action="ad_insert_massagist.php" method="post">
		<div id="usual1" class="usual">
	<div class="formtitle"><span>技师信息</span></div>

	<ul class="forminfo">
		<li><label>姓名</label><input type = "text" name = "name" class="dfinput" /></li>
		<li><label>电话</label><input type = "text" name = "phone" class="dfinput" /></li>
		<li><label>密码</label><input type = "text" name = "password" class="dfinput" /></li>
		<li><label>商铺</label>
			<div class="vocation">
			<select class="select3"  name = "shop" >
				<option value="0">选择商家</option>
				<?php
				while($row = mysql_fetch_assoc($get))
				{
					?>
					<option value = "<?php echo($row['name'])?>" >
										<?php echo($row['name']) ?>
					</option>
									<?php
								}
								?>
			</select>
				</div>
		</li>

		<li><label>级别</label>
			<div class="vocation">
			<select class="select3"  name="level" >
								<option value="M">中级</option>
								<option value="H">高级</option>
								<option value="E">专家级</option>
			</select>
				</div>
		</li>
		<li><label>星级</label>
			<div class="vocation">
			<select class="select3" name="stars" >
				<option value="1"> 一级 </option>
				<option value="2"> 二级 </option>
				<option value="3"> 三级 </option>
				<option value="4"> 四级 </option>
				<option value="5"> 五级 </option>
			</select>
				</div>
		</li>
		<li><label>&nbsp;</label><input type="submit"  name="submit" class="scbtn" value="确认保存"/></li>
	</ul>
			</div>
	</form>
	</div>

<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$shop = $_POST['shop'];
$shop_id = get_shop_id($con,$shop);
$level=$_POST['level'];
$star=$_POST['stars'];
//	insert_massagist($con,$phone,$password);
//	insert_massagist_detail($con,$phone,$name,$shop_id);

if(isset($_POST['submit'])){



$sql_massagist = "INSERT INTO Massagist (phone, password) VALUES ('".$phone ."','".$password ."')";
$sql_massagist_detail = "INSERT INTO MassagistDetail (phone,name,shopid,level,stars) VALUES ('".$phone ."','".$name ."',". $shop_id .",'$level','$star')";
if(mysql_query($sql_massagist,$con) &&mysql_query($sql_massagist_detail,$con)){
			echo "<script type='text/javascript'> alert('添加成功');</script>";
		} else {
			echo "<script type='text/javascript'> alert('无法添加，请检查输入信息');</script>";
		}
}

function get_shop_id ($con, $shop){
	$sql_shop_name = "SELECT shopid FROM Shop WHERE name = '" .$shop ."';";
	$result = mysql_query($sql_shop_name,$con) or die("Fetch Error:" .mysql_error());
	$row = mysql_fetch_assoc($result);
	return $row['shopid'];
}
?>