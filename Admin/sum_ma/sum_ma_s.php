<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	<title>技师统计</title>	<link href="../1210/css/style.css" rel="stylesheet" type="text/css" />	<script type="text/javascript" src="../1210/js/jquery.js"></script>	<script type="text/javascript">		$(document).ready(function(){			$(".click").click(function(){				$(".tip").fadeIn(200);			});			$(".tiptop a").click(function(){				$(".tip").fadeOut(200);			});			$(".sure").click(function(){				$(".tip").fadeOut(100);			});			$(".cancel").click(function(){				$(".tip").fadeOut(100);			});		});	</script></head><?phpsession_start();require_once "../db_func.php";if((string)$_SESSION['admin']==null){	$url = "../1210/login.php";	?>	<script type="text/javascript">		alert("请登录！")		window.location.href=location.href='../index.php';	</script>	<?php}$shopid=$_SESSION['admin'];$con=DBconnect();$sql_ma = "select MassagistDetail.`name` as name, MassagistDetail.phone, Shop.name as name_shop from MassagistDetail,Shop where MassagistDetail.`shopid`=Shop.shopid and MassagistDetail.shopid=$shopid ";$cur_date= date("Y-m-d");$cur_year= (int)substr($cur_date,0,4);$cur_month= (int)substr($cur_date,5,2);?><body><div class="place">	<span>位置：</span>	<ul class="placeul">		<li><a href="../1210/index.html">首页</a></li>	</ul></div><?php$ma_name = array();$result_ma        = mysql_query( $sql_ma );$nr_ma        = mysql_num_rows( $result_ma );for ( $i = 0; $i < $nr_ma; $i ++ ){	$r = mysql_fetch_array( $result_ma );	?>	<div class="rightinfo">		<div class="formtitle1"><span> <?php echo $r['name'];?></span></div>		<table class="tablelist">			<thead>			<tr>				<th>所属商家</th>				<th>总服务项目</th>				<th>历史订单数</th>				<th>本月订单数</th>				<th>历史收益</th>				<th>本月收益</th>			</tr>			</thead>			<?php			//总服务项目			$sql_has_svs="select count(*) as total_service from Has_Service where masaid=" .$r['phone'] ." group by masaid";			$rs_has_svs=mysql_query($sql_has_svs);			$sum_has_svs = mysql_fetch_assoc($rs_has_svs);			//历史订单数			$sql_all_order="select sum(amount) as amount_total, COUNT(*) as order_total from `Order` where massaid=" .$r['phone']. " AND status in ('UNCOMMENT','DONE')";			$rs_all_order=mysql_query($sql_all_order);			$sum_all_order=mysql_fetch_assoc($rs_all_order);			//本月订单数			$sql_cur="select  sum(amount) as amount_total, COUNT(*) as order_total from `Order` where massaid=" .$r['phone']. " AND status in ('UNCOMMENT','DONE') and YEAR(time)= $cur_year and MONTH(time)=$cur_month";			$rs_cur_order=mysql_query($sql_cur);			$sum_cur_order=mysql_fetch_assoc($rs_cur_order);			?>			<td> <?php echo $r['name_shop'];?></td>			<td> <?php if($sum_has_svs['total_service']){					echo $sum_has_svs['total_service'];				}				else{					echo "0";				}				?>			</td>			<td> <?php echo $sum_all_order['order_total'];?></td>			<td> <?php echo $sum_cur_order['order_total'];?></td>			<td> <?php				if($sum_all_order['amount_total']){					echo $sum_all_order['amount_total'];				}				else{					echo "0.00";				}				?>			</td>			<td> <?php				if($sum_cur_order['amount_total']){					echo $sum_cur_order['amount_total'];				}				else{					echo "0.00";				}				?>			</td>			<tbody>			</tbody>		</table>	</div>	<?php}?><script type="text/javascript">	$('.tablelist tbody tr:odd').addClass('odd');</script></body></html>