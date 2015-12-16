<?php 
		$mid = $_POST['mid'];
		
	  if(isset($_POST['mid'])&&$_POST['mid']!=""){
    		get_avaliable_hours($_POST['mid']);
		}
	

		 function get_avaliable_hours($mid){
		 	$con = mysql_connect("gene.rnet.missouri.edu","iKnow_team","iknowteam");
	   		if (!$con){
	   		die("Cound't connect: "   . mysql_error());
	   		}
	  
	   		$db_selected = mysql_select_db("iKnow", $con);
	   		if (!$db_selected){
	   			die ("Can\'t use test_db : " . mysql_error());
	   		}

	    	//$sql1 = "SELECT start FROM iKnow_dev.massagist_appt WHERE mid = $mid";
	    	
	    	$sql1 = "SELECT * FROM massagist_appt WHERE massaid = ".$mid .";";
	    	//echo $sql1;

		  	$result = mysql_query($sql1,$con) or die("Fetch Error:" .mysql_error());

		  	while ($row = mysql_fetch_assoc($result)){
		  		$rows[] = $row;
				//var_dump($rows);
		  	}//DBFetchall 

//		 	if (!empty($rows)){
		 		echo json_encode($rows);
//		 	}
//		 	else
//				echo "None";
		 }

	?>
	
