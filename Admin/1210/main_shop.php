<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	<title>欢迎进入iKnow管理系统</title></head><?phpsession_start();if((string)$_SESSION['admin']==null){	$url = "../1210/login.php";	?>	<script type="text/javascript">		alert("请登录！");		window.location.href=location.href='../1210/login.php';	</script>	<?php}?><frameset rows="88,*,31" cols="*" frameborder="no" border="0" framespacing="0">	<frame src="top_shop.html" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />	<frameset cols="187,*" frameborder="no" border="0" framespacing="0">		<frame src="left_shop.html" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />		<frame src="index.html" name="rightFrame" id="rightFrame" title="rightFrame" />	</frameset>	<frame src="footer.html" name="bottomFrame" scrolling="No" noresize="noresize" id="bottomFrame" title="bottomFrame" /></frameset><noframes><body>	</body></noframes></html>