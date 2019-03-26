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

    foreach($rooms as $room){
    ?>
    <li>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <button name="room_id" value="<?php echo $room[0]; ?>"><?php echo $room[0]; ?></button>
        </form> 
    </li>
    
<?php
    }
    if(isset($_POST["room_id"])){
        include("room.php");
    }
?>
</ul>
</body>
</html>