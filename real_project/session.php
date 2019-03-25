<!DOCTYPE html>
<html>
<head>
<link href="styles.css" type="text/css" rel="stylesheet" >
</head>
<body>
<h2>Conference Schedule</h2>
<ul>
<?php

echo "<p>Here is the complete conference schedule!</p>";

echo "<table><tr><th>Session Date</th><th>Session Name</th><th>Session Start Time</th><th>Session End Time</th><th>Room</th><th>Conference Name</th><th>Speaker First Name</th><th>Speaker Last Name</th></tr>";

$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$session_sql = "Select * from Sessions";
$sessions = $pdo->prepare($session_sql);
$sessions->execute(); 

foreach($sessions as $session){
        echo "<tr><td>".$session["session_date"]."</td><td>".$session["session_name"]."</td><td>".$session["session_start_time"]."</td><td>".$session["session_end_time"]."</td><td>".$session["room"]."</td><td>".$session["conference_name"]."</td><td>".$session["speaker_first_name"]."</td><td>".$session["speaker_last_name"]."</td></tr>";
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
  <input type="submit">
</form>

</body>
</html> 
