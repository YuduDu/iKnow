
<?php

	require_once "db_func.php";
	session_start();
	$name = $_POST['user'];
	$password = $_POST['password'];

	$_SESSION["logintime"] = NULL;
	$con = DBconnect();
	if(isset($_POST['user'])&&$_POST['user']!=null){
		if(isset($_POST['password'])&&$_POST['password']!=null){
			adminlogin($con,$_POST['user'],$_POST['password']);
		}
	}

	function adminlogin($con,$user,$paswd){
		echo "Welcom: " .$_POST['user'];

		$sql_paswd = "SELECT password FROM Admin WHERE username = '$user'" ;
		$result_paswd = mysql_query($sql_paswd,$con);

		$password = mysql_fetch_assoc($result_paswd);
		//print_r(mysql_fetch_assoc($result_pasws));
		var_dump($password);
//		var_dump($paswd);
		if ((string)$paswd==$password['password']){
			?>
			<head>
				<meta charset="UTF-8">
				<title>Admin_index</title>
			</head>
			<body>
				<center>
					<a href="http://localhost:8888/Admin/admin_index.html">Admin_index</a>
				</center>
			</body>
<?php
			//header('Location:' .$admin_index_url);
			echo "Login Success";
		}
		else echo "Invalid password";
		mysql_close($con);
	}
?>