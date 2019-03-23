///////////////////// Show All Members For a Subcommittee //////////////////////
/// TO-DO: allow the user to choose the sub-committee from a drop down menu

            
<?php
$subcommitteeName = $_POST["sub_committee_name"];                      

echo "<p>Here is a list of all the members at $subcommitteeName!</p>";

echo "<table><tr><th>Member ID</th><th>First Name</th><th>Last Name</th><th>Attend</th><th>Is Chair of</th></tr>";

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$sql = "Select * from Member M, Sub_committee_members S where M.member_id = S.member_id and S.sub_committee_name = ?";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute([$subcommitteeName]); 

#stmt contains the result of the program execution
#use fetch to get results row by row.
while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["member_id"]."</td><td>".$row["member_first_name"]."</td><td>".$row["member_last_name"]."</td><td>".$row["conference_name"]."</td><td>".$row["chair_of"]."</td></tr>";
}

?>

///////////////////// For a particular hotel room, list all of the students housed in this room. //////////////////////


<?php
$roomId = $_POST["room_id"];                      

echo "<p>Here is a list of all the students at $roomId!</p>";

echo "<table><tr><th>Student ID</th><th>First Name</th><th>Last Name</th><th>Attendee Type</th><th>Rate</th><th>Email</th><th>Phone</th><th>Room</th></tr>";

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$sql = "Select attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, phone, live_in from Attendee where attendee_type = 'student' and live_in = ?";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute([$roomId]); 

#stmt contains the result of the program execution
#use fetch to get results row by row.
while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["attendee_id"]."</td><td>".$row["attendee_first_name"]."</td><td>".$row["attendee_last_name"]."</td><td>".$row["attendee_type"]."</td><td>".$row["rate"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td><td>".$row["r=live_in"]."</td></tr>";
}
?>


///////////////////// Display the conference schedule for a particular day. //////////////////////


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

///////////////////// list the sponsors (company name) and their level of sponsorship //////////////////////


<?php

echo "<p>Here are all the sponsors (company name) and their level of sponsorship!</p>";

echo "<table><tr><th>Company Name</th><th>Level of Sponsorship</th></tr>";

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$sql = "Select company_name, grade from Sponsor_company";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute(); 

#stmt contains the result of the program execution
#use fetch to get results row by row.
while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["company_name"]."</td><td>".$row["grade"]."</td></tr>";
}
?>

///////////////////// for a particular company, list the jobs that they have available //////////////////////


<?php
$companyName = $_POST["company_name"];                      

echo "<p>Here the jobs available from $companyName!</p>";

echo "<table><tr><th>Job Title</th><th>Location City</th><th>Location Province</th><th>Pay Rate</th></tr>";

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$sql = "Select job_title, location_city, location_province, pay_rate from Ads where company_name = ?";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute([$companyName]); 

#stmt contains the result of the program execution
#use fetch to get results row by row.
while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["job_title"]."</td><td>".$row["location_city"]."</td><td>".$row["location_province"]."</td><td>".$row["pay_rate"]."</td></tr>";
}
?>

///////////////////// list all jobs available. //////////////////////


<?php
echo "<p>Here are all jobs available!</p>";

echo "<table><tr><th>Company Name<th><th>Job Title</th><th>Location City</th><th>Location Province</th><th>Pay Rate</th></tr>";

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$sql = "Select * from Ads ";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute(); 

#stmt contains the result of the program execution
#use fetch to get results row by row.
while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["company_name"]."</td><td>".$row["job_title"]."</td><td>".$row["location_city"]."</td><td>".$row["location_province"]."</td><td>".$row["pay_rate"]."</td></tr>";
}
?>




