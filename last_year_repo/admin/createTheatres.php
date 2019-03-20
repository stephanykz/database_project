<h2>Update Existing Complexes</h2>
	<br>
    	<form action="admin.php" class="form-inline" method="post">
    	<?php
			for($x=1; $x<=$_SESSION["numTheatres"]; $x++){
			echo "Theater Number: ";
			echo $x;
		?>
			<p></p>
		<?php
			echo "Max Seats: ";
		?>
			<span>   -   </span><input type="text" name="maxSeats[]"><p></p>
		<?php
			echo "Screen Size: ";
		?>
			<span>   -   </span><input type="text" name="screenSize[]"><p></p>
		<?php
		}
		?>
			<button name="addTheatre" class="btn btn btn-info" value="addTheatre">Add Theatres</button>
		</form>
	<br>
