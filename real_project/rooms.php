<!DOCTYPE html>
<html>
<head>
<link href="styles.css" type="text/css" rel="stylesheet" >
</head>
<body>
<h2>Hotel Rooms</h2>
<ul>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$rooms_sql = "Select * from Rooms ";
$rooms = $pdo->prepare($rooms_sql);
$rooms->execute(); 

while ($room = $rooms->fetch()) {
    echo "<h3>".$room["room_id"]."</h3>";
    $students_sql = "Select attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, phone, live_in from Attendee where attendee_type = 'student' and live_in = ?";
    $students = $pdo->prepare($students_sql);
    $students->execute([$room["room_id"]]); 

    echo "<table><tr><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
    
    while ($student = $students->fetch()) {
        echo "<tr><td>".$student["attendee_first_name"]."</td><td>".$student["attendee_last_name"]."</td><td>".$student["email"]."</td></tr>";
    }

    echo "</table>";
}
?>
</ul>
</body>
</html> 
