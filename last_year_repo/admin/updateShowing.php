<?php
	$showing = $_SESSION["showing"];
	echo "<h1>";
	echo $showing[4];
	echo "</h1>";
	echo "<h2>Showing at: ";
	echo $showing[0];
	echo " PM</h2>";
	echo "<h3>Seats Available: ";
	echo $showing[1];
	echo "</h3>";
	echo "<h3>Complex Address: ";
	echo $showing[2];
	echo "</h3>";
	echo "<h4>Theatre Number: ";
	echo $showing[3];
	echo "</h4>";
	echo "<p>================================================</p>";
	echo "<p>================================================</p>";
	echo "You have to be sure to update the following information to conform to the constraints of the DB";
?>
<form action="admin.php" class="form" method="post">
		<span><h4>Update Title: </h4></span><input type="text" name="movieTitle">			
		<span><h4>Update Time: </h4></span><input type="text" name="startTime">
		<span><h4>Update Seats Available: </h4></span><input type="text" name="seatsAvailable">
		<span><h4>Update Theatre Number: </h4></span><input type="text" name="theatreNumber">
		<p></p>	
		<button name="alterShowing" class="btn btn btn-info" value="<?php echo base64_encode(serialize($showing)); ?>">Update Showing!</button>
	</form>