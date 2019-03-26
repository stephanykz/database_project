<?php
$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
$switch_session = $_POST["switch_session"];
$session_target_date = $_POST['session_target_date'];
$session_target_time =$_POST['session_target_time'];
$session_target_location = $_POST['session_target_location'];

			$switchsql = "select @oldDate:= session_date, @oldStartTime:= session_start_time, @oldEndTime:= session_start_time, @oldLocation:= room from Sessions where session_name = $switch_session;
						  select @newEndTime:= session_end_time from Sessions where session_date = $session_target_date and session_start_time = $session_target_time and room = $session_target_location;

						  update Sessions
						  set session_date = @oldDate, session_start_time = @oldStartTime, session_end_time = @oldEndTime, session_location = @oldLocation
						  WHERE session_date = $session_target_date and session_start_time = $session_target_time and room = $session_target_location;
						  
						  update Sessions
						  set session_date = $session_target_date, session_start_time = $session_target_time, session_end_time = @newEndTime, room = $session_target_location
						  WHERE session_name = $switch_session;";
			$switchs = $pdo->prepare($switchsql);  
			$switchs->execute();
		
		?>