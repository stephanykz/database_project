
<?php
$sessionDate = $_POST["session_date"];                      

echo "<p>Here is the conference schedule on $sessionDate!</p>";

echo "<table><tr><th>Session Name</th><th>Session Start Time</th><th>Session End Time</th><th>Room</th><th>Conference Name</th><th>Speaker First Name</th><th>Speaker Last Name</th></tr>";

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$sql = "Select session_name, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name from Sessions where session_date = ?";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute([$sessionDate]); 

#stmt contains the result of the program execution
#use fetch to get results row by row.
while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["session_name"]."</td><td>".$row["session_start_time"]."</td><td>".$row["session_end_time"]."</td><td>".$row["room"]."</td><td>".$row["conference_name"]."</td><td>".$row["speaker_first_name"]."</td><td>".$row["speaker_last_name"]."</td></tr>";
}
?>