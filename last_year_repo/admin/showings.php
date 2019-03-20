<?php
	$showings = userConnection()->query("select * from showing");
	$movies = userConnection()->query("select * from movie");
	$complexes = userConnection()->query("select * from theatrecomplex");
?>
	<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<?php
		            	echo "<h2>All Movies:</h2>";
			            echo "<p></p>";
						foreach($showings as $showing){
					?>
		              		<form action="admin.php" class="form-inline" method="post">
			        <?php
					    		echo "<h4>";
					    		echo "$showing[4] | $showing[0] PM | Theatre Number: $showing[3] | $showing[1] Seats Available | At $showing[2]";
					?>
								<button name="updateShowing" class="btn btn-sm btn-info" value="<?php echo base64_encode(serialize($showing)); ?>">Update Showing</button>
							</form>
					<?php
							echo "</h4>";
						}
					?>
						<form action="admin.php" class="form" method="post">
			            	<h2>Create a New Showing</h2>
				            <p></p>
							<h4>Movie Title: </h4><select class="form-control" name="movieTitle">
													<?php
														foreach($movies as $movie){
															echo "<option>";
															echo "$movie[0]";
															echo "</option>";
														}
													?>
												</select>	
							<h4>Start Time: </h4><input type="text" name="startTime"> <span> Enter in the format H:MM</span>
							<h4>Seats Available: </h4><input type="text" name="seatsAvailable">
							<h4>Complex Address: </h4><select class="form-control" name="complexAddress">
														<?php
															foreach($complexes as $complex){
																$theatres = userConnection()->query("select * from theatre where complexAddress = '$complex[0]'");
																echo "<option>";
																echo "$complex[0] | Available Theatres: | ";
																foreach ($theatres as $theatre) {
																	echo "$theatre[0] | ";
																}
																echo "</option>";
															}
														?>
													</select>
							<h4>Theatre Number: </h4><input type="text" name="theatreNum"> <span>Please choose one of the theatres in the above complex</span>
							<p></p>	
							<button name="addShowing" class="btn btn btn-info" value="1">Add Showing!</button>
						</form>
				</div>
			</div>
	</div>