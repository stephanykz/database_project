<?php
$switch_session = $_POST["switch_session"];
$session_target_date = $_POST['session_target_date'];
$session_target_time =$_POST['session_target_time'];
$session_target_location = $_POST['session_target_location'];

$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
	$switchsql1 = "select @oldDate:= session_date, @oldStartTime:= session_start_time, @oldEndTime:= session_end_time, @oldLocation:= room from Sessions where session_name = '".$switch_session."';";
	$switchs1 = $pdo->prepare($switchsql1); 
	$switchs1->execute();
	$result1 = $switchs1->fetch(PDO::FETCH_ASSOC);

	$oldDate = $result1["@oldDate:= session_date"];
	$oldStartTime = $result1["@oldStartTime:= session_start_time"];
	$oldEndTime = $result1["@oldEndTime:= session_end_time"];
	$oldLocation = $result1["@oldLocation:= room"];

	$switchsql2 = "select @newEndTime:= session_end_time from Sessions where session_date = '".$session_target_date."' and session_start_time = '".$session_target_time."' and room = '".$session_target_location."';";
	$switchs2 = $pdo->prepare($switchsql2);  
	$switchs2->execute();
	$result2 = $switchs2->fetch(PDO::FETCH_ASSOC);

	$newEndTime = $result2["@newEndTime:= session_end_time"];

	$switchsql3 = "update Sessions 
					set session_date = '".$oldDate."', session_start_time = '".$oldStartTime."', session_end_time = '".$oldEndTime."', room = '".$oldLocation."'
					WHERE session_date = '".$session_target_date."' and session_start_time = '".$session_target_time."' and room = '".$session_target_location."';";
	$switchs3 = $pdo->prepare($switchsql3);  
	$switchs3->execute();

	$switchsql4 = "update Sessions
						  set session_date = '".$session_target_date."', session_start_time = '".$session_target_time."', session_end_time = '".$newEndTime."', room = '".$session_target_location."'
						  WHERE session_name = '".$switch_session."';";
	$switchs4 = $pdo->prepare($switchsql4);  
	$switchs4->execute();
		
		
?>