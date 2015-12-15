<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin_index</title>
</head>
<body>

</body>
<?php
	require_once "db_func.php";
	session_start();
	$name = $_POST['user'];
	$password = $_POST['password'];

	$_SESSION["logintime"] = NULL;
	$con = DBconnect();
	echo '<center>Welcom: ' .$_POST['user'] .'</center>';

	if(isset($_POST['user'])&&$_POST['user']!=null){
		if(isset($_POST['password'])&&$_POST['password']!=null){
			adminlogin($con,$_POST['user'],$_POST['password']);
		}
		else{
			echo "请输入用户名";
		}
	}

	function adminlogin($con,$user,$paswd){



		$sql_paswd = "SELECT password FROM Admin WHERE username = '$user'" ;
		$result_paswd = mysql_query($sql_paswd,$con);

		$password = mysql_fetch_assoc($result_paswd);

		if ((string)$paswd==$password['password']){
			?>
				<center>
					<a href = "http://localhost:8888/Admin/admin_index.html">管理系统 </a>
				</center>
				<center>
					<a href = "http://localhost:8888/Admin/login.html">注销 </a>
				</center>

<?php
			//header('Location:' .$admin_index_url);
			echo '<center>' ."Login Success" .'</center>';
		}
		else echo "Invalid password";
		mysql_close($con);
	}
?>