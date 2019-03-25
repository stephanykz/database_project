<!DOCTYPE html>
<html>
<head>
<link href="styles.css" type="text/css" rel="stylesheet" >
</head>
<body>
<h2>Hotel Rooms</h2>
<div>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <select name="room_id" >
            <option selected="selected">Choose a room</option>
            <?php
            $pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
            $rooms_sql = "Select * from Rooms ";
            $rooms = $pdo->prepare($rooms_sql);
            $rooms->execute(); 

            foreach($rooms as $room){
            ?>
            <option value="<?php echo strtolower($room[0]); ?>"><?php echo $room[0]; ?></option>
            <?php
            }
            ?>
        </select>
        <input type="submit" name="submit" value="Show students" />
    </form> 
    </div>
<?php
    if(isset($_POST["submit"])){
        include("room.php");
    }
?>
</body>
</html>