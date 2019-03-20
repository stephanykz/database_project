<?php
	$theatres = userConnection()->query("select theatreNum, maxSeats, screenSize from theatre where complexAddress='".$_SESSION["complex"][1]."'");
?>
<h1>Theatres</h1>
<?php
	foreach($theatres as $theatre){
?>
	<br>
    	<form action="admin.php" class="form-inline" method="post">
		<?php
			echo "Theatre Number: ";
			echo $theatre[0];
		?>
			<span>   -   </span><input type="text" name="theatreNum"><p></p>
		<?php
			echo "Max Seats: ";
			echo $theatre[1];
		?>
			<span>   -   </span><input type="text" name="maxSeats"><p></p>
		<?php
			echo "Screen Size: ";
			echo $theatre[2];
		?>
			<span>   -   </span><input type="text" name="screenSize"><p></p>
			<button name="updateTheatre" class="btn btn btn-info" value="<?php echo base64_encode(serialize($theatre)); ?>">Update Theatre</button>
		</form>
	<br>
<?php
	}
?>