<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	<title>商家新增服务</title>	<link href="../1210/css/style.css" rel="stylesheet" type="text/css" /></head><?phpsession_start();require_once "../db_func.php";$con = DBconnect();$get=mysql_query("SELECT name FROM Shop");$get_catid = mysql_query("SELECT name FROM Category");?><body><div class="place">	<span>位置：</span>	<ul class="placeul">		<li><a href="../1210/index.html">首页</a></li>		<li><a href="javascript:history.go(-1);">返回</a></li>	</ul></div><div class="formbody">	<form action="s_service_add.php" method="post" name="ad_insert_service_shop">		<div class="formtitle"><span>选择商家及服务</span></div>		<ul class="forminfo"><!--			<li><label>商家</label>--><!--				<select name = "shop">--><!--					<option value="0">Please Select</option>--><!--					--><?php//					while($row = mysql_fetch_assoc($get))//					{//						?><!--						<option value = "--><?php //echo($row['name'])?><!--" >--><!--							--><?php //echo($row['name']) ?><!--						</option>--><!--						--><?php//					}//					?><!--				</select>--><!--			</li>-->			<li><label>选择服务类型</label>				<select name = "catid_name">					<option value="0">Please Select</option>					<?php					while($row = mysql_fetch_assoc($get_catid)) {						?>						<option value="<?php echo( $row['name'] ) ?>">							<?php echo( $row['name'] ) ?>						</option>						<?php					}					?>				</select>			</li>			<li><label>服务项目</label><input type = "text" name = "name" class="dfinput" /></li>			<li><label>项目描述</label><input type = "text" name = "shortdesc" class="dfinput" /></li>			<li><label>价   格</label><input type = "text" name = "price" class="dfinput"/></li>			<li><label>功能描述</label><input type = "text" name = "funcdesc" class="dfinput" /></li>			<li><label>项目介绍</label><input type = "text" name = "intro" class="dfinput" /></li>			<li><label>价格(high)</label><input type = "text" name = "price_high" class="dfinput" /></li>			<li><label>价格(expert)</label><input type = "text" name = "price_expert" class="dfinput" /></li>			<li><label>服务时长</label><input type = "text" name = "duration" class="dfinput" /></li>			<li><label>&nbsp;</label><input type="submit"  class="btn" name="ad_insert_service_shop_submit" value="确认保存"/>				<label>&nbsp;</label><input type="reset" class="btn" name ="ad_insert_service_shop_reset"/></li>		</ul></div></body></html><?phpif(isset($_POST['ad_insert_service_shop_submit'])&&$_POST['ad_insert_service_shop_submit']!=""){//		echo "SHOPID:" .$shop_id ."<br>";//		echo "CATID:" .$catid_id ."<br>";	$catid_name = $_POST['catid_name'];//FOR SHOP	$catid_id = get_cat_id($con,$catid_name);//	$shop_name = $_POST['shop'];	$shop_id = $_SESSION['admin'];	$name=$_POST['name'];	$sd=$_POST['shortdesc'];	$p=$_POST['price'];	$fd=$_POST['funcdesc'];	$intr=$_POST['intro'];	$ph=$_POST['price_high'];	$pe=$_POST['price_expert'];	$d=$_POST['duration'];	insert_serveice_shop($con,$shop_id,$name,$sd,$p,$fd,$intr,$ph,$pe,$d,$catid_id);}function get_cat_id($con,$catid_name){	$sql_catid = "SELECT catid FROM Category WHERE name = '" .$catid_name ."';";	$result = mysql_query($sql_catid,$con) or die ("ERROR:" .mysql_errno());	$row = mysql_fetch_assoc($result);	return $row['catid'];}function get_shop_id($con, $shop_name){	$sql_shopid = "SELECT shopid FROM Shop WHERE name ='" .$shop_name ."';";	$result = mysql_query($sql_shopid,$con) or die ("ERROR:" .mysql_errno());	$row = mysql_fetch_assoc($result);	return $row['shopid'];}function insert_serveice_shop($con,$shopid,$name, $sd,$price,$fd,$intro,$p_h,$p_e,$duration,$catid){	$sql="select * from Service";	$result_row = mysql_query($sql,$con);	$num_rows = mysql_num_rows($result_row);	$serviceid=$num_rows+1;	$sql_service_shop = "INSERT INTO Service (serviceid, shopid, name, shortdesc, price, funcdesc, intro, catid, price_high, price_expert, duration)  VALUES ($serviceid,'$shopid','$name','$sd','$price','$fd','$intro','$catid','$p_h','$p_e','$duration');";	//$result = mysql_query($sql_service_shop,$con);	if (mysql_query( $sql_service_shop,$con)) {		echo "<script type='text/javascript'> alert('添加成功');</script>";	} else {		echo "<script type='text/javascript'> alert('无法插入，请检查输入信息');</script>";	}}?>