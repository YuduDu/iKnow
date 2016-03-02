<?php
if (!session_id())
{
	session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>商家查询</title>
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
require_once '../db_func.php';

if((string)$_SESSION['admin']==null){
	$url = "../1210/login.php";
	?>
	<script type="text/javascript">
		alert("请登录！")
		window.location.href=location.href='../index.php';
	</script>
	<?php

}

	$con = DBconnect();
	$_SESSION['shopid'] = null;
	$select_all_m_shop = "SELECT * FROM Shop ";
?>


<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="../1210/index.html">首页</a></li>
		<li><a href="javascript:history.go(-1);">返回</a></li>
	</ul>
</div>

<div class="formbody">
	<div id="usual1" class="usual">

	<form id="select_shop_form" action="ad_select_shop_action.php" method="post">
		<div class="formtitle"><span>选择商家</span></div>
		<ul class="seachform1">
			<li><label>商家名称</label></li>
			<div class="vocation">
				<select id="select_shop" name="select_shop_s" class="select3">
					<?php
					$shop_name = array();
					$rs        = mysql_query( $select_all_m_shop );
					$nr        = mysql_num_rows( $rs );
					echo "<option disabled selected> -- 选择店面 -- </option>";
					for ( $i = 0; $i < $nr; $i ++ ) {
						$r = mysql_fetch_array( $rs );
						$shop_name[ $i ] = $r['name'];
						echo "<option value= " .$r["shopid"] .">".$r["name"]."</option>";
					}
					unset( $shop_name );
					?>
				</select>
			<label><input name = "" type="submit" class="btn" value="查询"/></label>
<!--			<label><input name = "" type = "reset" class="btn" value="重置"/></label>-->
			</div>
		</ul>
		</form>
		</div>
	</div>

</body>