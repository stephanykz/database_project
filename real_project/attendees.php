<?php
include("nav.php");
?>
<div class="wrapper">
<h2>Attendees</h2>
<?php
        $pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
        $students_sql = "Select * from Attendee where attendee_type='student' ";
        $students = $pdo->prepare($students_sql);
        $students->execute(); 

        $professionals_sql = "Select * from Attendee where attendee_type='professional' ";
        $professionals = $pdo->prepare($professionals_sql);
        $professionals->execute(); 

        $sponsors_sql = "Select * from Attendee where attendee_type='sponsor' ";
        $sponsors = $pdo->prepare($sponsors_sql);
        $sponsors->execute(); 

        $sponsors_sql = "Select * from Attendee where attendee_type='sponsor' ";
        $sponsors = $pdo->prepare($sponsors_sql);
        $sponsors->execute(); 

        // $rooms_sql = "Select * from Rooms";
        $rooms_sql = "SELECT COUNT(Attendee.attendee_id) as c, Rooms.room_id, Rooms.bed_count FROM Rooms\n"

            . "LEFT JOIN Attendee\n"

            . "ON Attendee.live_in = Rooms.room_id\n"

            . "GROUP BY Rooms.room_id";
        $rooms = $pdo->prepare($rooms_sql);
        $rooms->execute(); 
        $filterd_rooms = array();
        foreach($rooms as $room){
            if ($room[0] < $room[2]){
                array_push($filterd_rooms, $room);
            }
        }   
        ?>

<div>
    <ul>
        <li><h3>Students</h3></li>
        <?php
        foreach($students as $student){
            echo "<li><h5>$student[0]   | $student[1]    $student[2]     | lives in: ".$student["live_in"]."<h5></li>";
        }            
        ?>
        <li><h3>Professionals</h3></li>
        <?php
        foreach($professionals as $professional){
            echo "<li><h5>$professional[0]   | $professional[1]    $professional[2] <h5></li>";
        }            
        ?>
        <li><h3>Sponsors</h3></li>
        <?php
        foreach($sponsors as $sponsor){
            echo "<li><h5>$sponsor[0]   | $sponsor[1]    $sponsor[2]  <h5></li>";
        }            
        ?>
    </ul>
</div>
<div>
<h3> Add an Attendee </h3>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<label>First Name:</label>
        <input type="text" name="firstname">
        <label>Last Name:</label>
        <input type="text" name="lastname">
        <label>Email:</label>
        <input type="text" name="email">
        <label>Phone:</label>
        <input type="text" name="phone">
        <label>Type:</label>
		<select name='type'>
			<option value = 'student' selected = 'selected'>Student</option>
			<option value = 'professional'>Professional</option>
			<option value = 'sponsor'>Sponsor</option>
        </select>
        <label>Select a hotel room for students:</label>
        <select name='room'>
			<option value = '-1' selected = 'selected'>Select a room</option>
            <?php 
            foreach($filterd_rooms as $open_room){
                echo "<option value = '".$open_room[1]."'>".$open_room[1]."</option>";
            }
            ?>
        </select>

		<input class="btn" type="submit" name="submit" value="Add">
	</form> 
</div>
<?php
if(isset($_POST["submit"])){
		include("add_attendee.php");
    }
?>
</div>
</body>
</html>