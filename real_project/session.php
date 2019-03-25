<!DOCTYPE html>
<html>
<head>
<link href="styles.css" type="text/css" rel="stylesheet" >
</head>
<body>
<h2>Complete Schedule</h2>
<ul>
<?php

echo "<p>Here is the complete conference schedule!</p>";

echo "<table><tr><th>Session Name</th><th>Session Start Time</th><th>Session End Time</th><th>Room</th><th>Conference Name</th><th>Speaker First Name</th><th>Speaker Last Name</th></tr>";

$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$session_sql = "Select * from Sessions";
$sessions = $pdo->prepare($session_sql);
$sessions->execute(); 

while ($session = $sessions->fetch()) {
        echo "<tr><td>".$session["session_name"]."</td><td>".$session["session_start_time"]."</td><td>".$session["session_end_time"]."</td><td>".$session["room"]."</td><td>".$session["conference_name"]."</td><td>".$session["speaker_first_name"]."</td><td>".$session["speaker_last_name"]."</td></tr>";
    }

echo "<p>Or you can choose to view the schedule for a particular date!</p>";

?>


<select name='session_date' form='dateform'>
	<option value = '0' selected = 'selected'>Select the date</option>
	<option value = '2019-03-01'>March 1st</option>
	<option value = '2019-03-02'>March 2nd</option>
</select>

<form action='particularSession.php' method='post' id="dateform">
  <input type="submit">
</form>


</ul>
</body>
</html> 
