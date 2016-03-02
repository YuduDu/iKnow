<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>技师新增服务</title>
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


<?php
session_start();
if((string)$_SESSION['admin']==null){
	$url = "../1210/login.php";
	?>
	<script type="text/javascript">
		alert("请登录！")
		window.location.href=location.href='../index.php';
	</script>
	<?php

}
	require_once "../db_func.php";
	$con = DBconnect();

?>
<body class="sarchbody">

<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="../1210/index.html">首页</a></li>
		<li><a href="javascript:history.go(-1);">返回</a></li>
	</ul>
</div>

<div class="formbody">

	<form action="ad_insert_service_massa.php" method="post" name="ad_insert_service_massa">
		<div id="usual1" class="usual">
		<div class="formtitle"><span>选择技师及服务</span></div>
			<ul class="forminfo">

			<li><label>技师姓名</label>
				<div class="vocation">
				<select name = "massa" class="select3">

					<?php
					$massagist = "SELECT * FROM MassagistDetail";
					$ma_name = array();
					$rsm=mysql_query($massagist);
					$nrm=mysql_num_rows($rsm);
					echo "<option disabled selected> -- 选择技师 -- </option>";
					for ( $a = 0; $a < $nrm; $a ++ ) {
						$rm = mysql_fetch_array( $rsm );
						$ma_name[ $a ] = $rm['name'];
						echo "<option value= " .$rm["phone"] .">".$rm["name"]."</option>";
					}
					unset( $ma_name );
					?>
				</select>
					</div>
			</li>

			<li><label>选择服务类型</label>
				<div class="vocation">
				<select name = "service" class="select3">
					<?php
					$service ="SELECT * FROM Service";
					$service_name = array();
					$rs        = mysql_query($service);
					$nr        = mysql_num_rows($rs);
					echo "<option disabled selected> -- 选择服务项目 -- </option>";
					for ( $i = 0; $i < $nr; $i ++ ) {
						$r = mysql_fetch_array( $rs );
						$service_name[ $i ] = $r['name'];
						echo "<option value= " .$r["serviceid"] .">".$r["name"]."</option>";
					}
					unset( $service_name );
					?>
				</select>
					</div>
			</li>
			<li><label></label><input name = "submit" type="submit" class="btn" value="添加"/></li>
			</ul>
			</div>
	</form>

</div>

</body>
</html>
<?php

if(isset($_POST['submit'])){
	$mid= $_POST['massa'] ;
	$sid= $_POST['service'];
	$hass = mysql_query("select * from Has_Service");
	$num_rows = mysql_num_rows($hass);
	$hsid=$num_rows+123;
	$insert="insert into Has_Service(hsid, masaid, serviceid) VALUES ($hsid,$mid,$sid)";
	if (mysql_query($insert,$con)) {
		echo "<script type='text/javascript'> alert('添加成功');</script>";
		?>

		<?php
	} else {
		echo "<script type='text/javascript'> alert('无法添加，请检查输入信息');</script>";
		?>
		<?php
	}

}
?>