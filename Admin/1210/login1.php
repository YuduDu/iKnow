<!DOCTYPE html><html lang="en"><head>	<meta charset="UTF-8">	<title>AdminLogin</title></head><?phprequire_once "../db_func.php";session_start();$_SESSION['admin']=null;if(isset($_POST['bttLogin'])){	$username = $_POST['username'];	$password =$_POST['password'];	$_SESSION['admin']=$_POST['username'];	$con = DBconnect();	$sql_login="select * from Admin";	$result_login=mysql_query($sql_login);	$res_login=mysql_fetch_assoc($result_login);	if($_SESSION['admin'] == 'admin'){		adminlogin($con,$_POST['username'],$_POST['password']);	}	else{		$sql_id="select * from Admin where username = '$username'";		$result_id=mysql_query($sql_id);		$row_id=mysql_fetch_assoc($result_id);		$id = $row_id['adminid'];		$_SESSION['admin'] = (int)$id;		$sql="select * from Shop where shopid= " . $_SESSION['admin'] . "";		shoplogin($con,$_POST['username'],$_POST['password']);	}}function adminlogin($con,$user,$paswd){	$sql_paswd = "SELECT * FROM Admin WHERE username = '$user'" ;	$result_paswd = mysql_query($sql_paswd,$con);	$password = mysql_fetch_array($result_paswd);	if ((string)$paswd==$password['password']){		//echo $paswd;		//echo "<script>window.location.href="main.html";</script>";		$url = "main.html";		echo ("<script>location.href='$url'</script>");		//echo "<script type='text/javascript'> window.location.href="'.main.html.'";</script>";	}	echo "<script type='text/javascript'> alert('密码错误');</script>";	echo "<script type='text/javascript'> window.history.go(-1);</script>";	mysql_close($con);}function shoplogin($con,$user,$paswd){	$sql_paswd = "SELECT * FROM Admin WHERE username = '$user'" ;	$result_paswd = mysql_query($sql_paswd,$con);	$password = mysql_fetch_array($result_paswd);	if ((string)$paswd==$password['password']){		//echo $paswd;		//echo "<script>window.location.href="main.html";</script>";		$url = "main_shop.html";		echo ("<script>location.href='$url'</script>");		//echo "<script type='text/javascript'> window.location.href="'.main.html.'";</script>";	}	echo "<script type='text/javascript'> alert('密码错误');</script>";	echo "<script type='text/javascript'> window.history.go(-1);</script>";	mysql_close($con);}function getid(){}?>