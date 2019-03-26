<?php
include("nav.php");
?>
<div class="wrapper">
<h2>Conference Schedule</h2>

<p>Here is the complete conference schedule!</p>

<table><tr><th>Session Date</th><th>Session Name</th><th>Session Start Time</th><th>Session End Time</th><th>Room</th><th>Conference Name</th><th>Speaker First Name</th><th>Speaker Last Name</th></tr>

<?php
$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$session_sql = "Select * from Sessions ORDER BY session_date, session_start_time;";
$sessions = $pdo->prepare($session_sql);
$sessions->execute(); 

foreach($sessions as $session){
?>

    <tr>
    	<td><?php echo $session["session_date"];?></td>
    	<td><?php echo $session["session_name"];?></td>
    	<td><?php echo $session["session_start_time"];?></td>
    	<td><?php echo $session["session_end_time"];?></td>
    	<td><?php echo $session["room"];?></td>
    	<td><?php echo $session["conference_name"];?></td>
    	<td><?php echo $session["speaker_first_name"];?></td>
    	<td><?php echo $session["speaker_last_name"];?></td>
    </tr>

<?php 
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<h4> Update Session Schedule </h4>
		<span> Update Which Session: </span>
    	<select name='switch_session'>
    		<option value = '0' selected = 'selected'>Update ...</option>
		    <?php
		    	$session_name_sql = "Select DISTINCT session_name from Sessions";
		    	$sessionsAvailables = $pdo->prepare($session_name_sql);
		    	$sessionsAvailables->execute();
		    	foreach($sessionsAvailables as $sessionsAvailable){
		    	?>
		        <option value="<?php echo $sessionsAvailable['session_name']; ?>"><?php echo $sessionsAvailable['session_name']; ?></option>
		        <?php
		        }
		    ?>
  		</select>

		<span> Update Session Date: </span>
    	<select name='session_target_date'>
    		<option value = '0' selected = 'selected'>Switch to date</option>
		    <?php
		    	$session_date_sql = "Select DISTINCT session_date from Sessions ORDER BY session_date";
		    	$sessionsTargetDates = $pdo->prepare($session_date_sql);
		    	$sessionsTargetDates->execute();
		    	foreach($sessionsTargetDates as $sessionsTargetDate){
		    	?>
		        <option value="<?php echo $sessionsTargetDate['session_date']; ?>"><?php echo $sessionsTargetDate['session_date']; ?></option>
		        <?php
		        }
		    ?>
  		</select>

    	<span> Update Session Start Time: </span>
  		<select name='session_target_time'>
    		<option value = "0" selected = 'selected'>Switch to start time</option>
		    <?php
		    	$session_time_sql = "Select DISTINCT session_start_time from Sessions ORDER BY session_start_time";
		    	$sessionsTargetTimes = $pdo->prepare($session_time_sql);
		    	$sessionsTargetTimes->execute();
		    	foreach($sessionsTargetTimes as $sessionsTargetTime){
		    	?>
		        <option value="<?php echo $sessionsTargetTime['session_start_time']; ?>"><?php echo $sessionsTargetTime['session_start_time']; ?></option>
		        <?php
		        }
		    ?>
  		</select>

    	<span> Update Session Location: </span>
  		<select name='session_target_location'>
    		<option value = "0" selected = 'selected'>Switch to room</option>
		    <?php
		    	$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
		    	$session_loc_sql = "Select DISTINCT room from Sessions ORDER BY room";
		    	$sessionsTargetLocations = $pdo->prepare($session_loc_sql);
		    	$sessionsTargetLocations->execute();
		    	foreach($sessionsTargetLocations as $sessionsTargetLocation){
		    	?>
		        <option value="<?php echo $sessionsTargetLocation['room']; ?>">Room <?php echo $sessionsTargetLocation['room']; ?></option>
		        <?php
		        }
		    ?>
  		</select>

  		<input class="btn" type="submit" name="switch" value="Update">
  		</form>
  		
<?php
    if (isset($_POST['switch'])){
    	include('updateSession.php');
    	$new_location = "http://localhost:8080/real_project/session.php";
    	function page_refresh($location){
   		echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$location.'">';
   		exit; 
 		  }
 		  page_refresh($new_location);
	  }
?>



<span>View the schedule for: </span>
<form action='particularSession.php' method='post' id="dateform">
  <select name='session_date' form='dateform'>
    <option value = '0' selected = 'selected'>Select the date</option>
    <?php
    	$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
    	$session_sql = "Select DISTINCT session_date from Sessions";
    	$sessionsDates = $pdo->prepare($session_sql);
    	$sessionsDates->execute();
    	foreach($sessionsDates as $sessionDate){
    	?>
        <option value="<?php echo strtolower($sessionDate['session_date']); ?>"><?php echo $sessionDate['session_date']; ?></option>
        <?php
        }
    ?>
  </select>
  <input class="btn" type="submit" value="View">
</form>
	</div>
</body>
</html> 

