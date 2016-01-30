<?php
	require_once "../db_func.php";
	$con = DBconnect();
	if(isset($_POST['is_delete_user'])){
		$id=$_POST['id'];
		$query="delete from Massagist WHERE phone = '$id'";
		mysql_query($query,$con);

	}
	if(isset($_POST['is_edit_user'])){
		$old_id=$_POST['old_id'];
		$id=$_POST['id'];
		$pwd=$_POST['pwd'];
		$levels=$_POST['levels'];
		$name_massa=$_POST['name_massa'];
		$stars=$_POST['stars'];

		$update_ma="update Massagist set phone = '$id' , password= '$pwd' WHERE phone = '$old_id'";
		$update_ma_detal="update MassagistDetail set level = '$levels', name ='$name_massa',stars='$stars' WHERE phone = '$old_id'";
		mysql_query($update_ma,$con);
		mysql_query($update_ma_detal,$con);

	}
	echo json_encode($_POST,true);
?>