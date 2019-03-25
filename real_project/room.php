<!DOCTYPE html>
<html>
<head>
<link href="styles.css" type="text/css" rel="stylesheet" >
</head>
<body>
<h3> <?php echo $_POST["room_id"]; ?> </h3>


<?php
    $room_id = $_POST["room_id"];
    $pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
    $students_sql = "Select attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, phone, live_in from Attendee where attendee_type = 'student' and live_in = ?";
    $students = $pdo->prepare($students_sql);
    $students->execute([$room_id]); 
?>
<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
    </tr>
    
<?php
    foreach($students as $student){
 ?>
    <tr>
        <td><?php echo $student["attendee_first_name"]; ?></td>
        <td><?php echo $student["attendee_last_name"]; ?></td>
        <td><?php echo $student["email"]; ?></td>
    </tr>
 <?php
    }
?>
</table>
</body>
</html> 