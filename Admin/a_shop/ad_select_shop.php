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
</head>
<body>
<?php
require_once '../db_func.php';
	$con = DBconnect();
	$_SESSION['shopid'] = null;
	$select_all_m_shop = "SELECT * FROM Shop ";
?>
</body>

<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="../1210/index.html">首页</a></li>
		<li><a href="javascript:history.go(-1);">返回</a></li>
	</ul>
</div>

<div class="formbody">
	<form id="select_shop_form" action="ad_select_shop_action.php" method="post">
		<div class="formtitle"><span>选择商家</span></div>
		<ul class="forminfo">
			<li><label>商家名称</label>
				<select id="select_shop" name="select_shop_s">
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
			<li><label></label><input name = "" type="submit" class="btn" value="查询"/>
				<label></label><input name = "" type = "reset" class="btn" value="重置"/> </li>
