<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	<title>技师查询结果</title>	<link href="../1210/css/style.css" rel="stylesheet" type="text/css" /><!--	<script type="text/javascript" src="../1210/js/jquery.js"></script>-->	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>	<script src="ad_select_ma.js"></script>	<script type="text/javascript">		$(document).ready(function(){			$(".click").click(function(){				$(".tip").fadeIn(200);			});			$(".tiptop a").click(function(){				$(".tip").fadeOut(200);			});			$(".sure").click(function(){				$(".tip").fadeOut(100);			});			$(".cancel").click(function(){				$(".tip").fadeOut(100);			});		});	</script><body><div class="place">	<span>位置：</span>	<ul class="placeul">		<li><a href="../1210/index.html">首页</a></li>		<li><a href="javascript:history.back()">返回</a></li>		<li><a href="#">客户查询结果</a> </li>	</ul></div><?phprequire_once "../db_func.php";$con=DBconnect();if(isset($_POST['ad_select_massa'])){	$shopid=$_POST['ad_select_massa'];	$sql= "select * from MassagistDetail,Massagist WHERE MassagistDetail.phone=Massagist.phone and shopid=$shopid";	$result = mysql_query( $sql, $con );	?><div class="rightinfo">	<div class="formtitle1"><span>技师详情</span></div>	<table class="tablelist">		<thead>	<tr>		<th>注册ID(手机号)</th>		<th>姓名</th><!--		<th>密码</th>-->		<th>星级</th>		<th>介绍</th>		<th>级别</th>		<th>城市</th>		<th>省市</th><!--		<th>历史订单</th>-->		<th>删除</th>		<th>编辑</th>	</tr>	</thead>		<tbody>	<?php	while ($row = mysql_fetch_assoc($result)){		?>		<tr class="user-form">			<th class="phone" ><?php echo $row['phone'];?></th>			<th class="name"><?php echo $row['name'];?></th><!--			<th class="pwd"> --><?php //echo $row['password'];?><!--</th>-->			<th class="stars"><?php echo $row['stars'];?></th>			<th class="intro"><?php echo mb_substr($row['intro'],0,25,'utf-8');echo "...";?></th>			<th class="level"><?php echo $row['level'];?></th>			<th class="city"><?php echo $row['city'];?></th>			<th class="province"><?php echo $row['province'];?></th><!--			<th > <input type="button" value="历史订单" class = "order-btn"> </th>-->			<th>				<input type="button" value="删除" class = "delete-btn">			</th>			<th>				<input type="button" value="编辑" class = "edit-btn">				<input type="button" value="保存" class = "save-btn">			</th>			<input type="hidden" value="<?php echo $row['phone'];?>" class = "old_id">		</tr>		<?php	}//end of while}//end of if?>		</tbody>	</table>	</div></body><?phpif(isset($_POST['is_delete_user'])){	$id=$_POST['id'];	$query="delete from Massagist WHERE phone = '$id'";	mysql_query($query,$con);}if(isset($_POST['is_edit_user'])){	$old_id=$_POST['old_id'];	$id=$_POST['id'];	$pwd=$_POST['pwd'];	$levels=$_POST['levels'];	$name_massa=$_POST['name'];	$stars=$_POST['stars'];	$update_ma="update Massagist set phone = '$id'  WHERE phone = '$old_id'";	$update_ma_detal="update MassagistDetail set level = '$levels', name ='$name_massa',stars='$stars' WHERE phone = '$old_id'";	mysql_query($update_ma,$con);	mysql_query($update_ma_detal,$con);}if(isset($_POST['is_order_user'])){	$mid=$_POST['id'];	echo $mid;	?><?php}