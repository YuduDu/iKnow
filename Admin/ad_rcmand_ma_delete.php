<!DOCTYPE html><html lang="en"><head>	<meta charset="UTF-8">	<title>删除推荐技师</title></head><?php	require_once "db_func.php";	$con = DBconnect();	$select_rcmand_ma = "SELECT * FROM Recommand_massagist ";?><center>	<body>	<form id="delete_rcmand_ma" action="?delete_rcmand_ma" method="post">		<select id="delete_rcmand_ma" name="delete_rcmand_ma">			<?php			$massa_name = array();			$rs = mysql_query($select_rcmand_ma);			$nr = mysql_num_rows($rs);			echo "<option disabled selected> -- select a massagist -- </option>";			for ($i=0; $i<$nr; $i++){				$r = mysql_fetch_array($rs);				echo "<option>".$r["name"]."</option>";			}			?>		</select>		</br>		<input type="submit"/>		<input type="reset"/>	</form>	</body></center><?phpif (isset($_POST['delete_rcmand_ma'])) {	$name = $_POST['delete_rcmand_ma'];	$sql = "DELETE FROM Recommand_massagist WHERE name= '$name'" ;	if (mysql_query($sql,$con)) {		echo "<script type='text/javascript'> alert('删除成功');</script>";	} else {		echo "<script type='text/javascript'> alert('无法删除，请检查输入信息');</script>";	}}?>