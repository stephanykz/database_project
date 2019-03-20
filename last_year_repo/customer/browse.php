<?php
	$movies = userConnection()->query("select * from movie");
?>

	<div class="container">
		<div class="row">
			<form action="user.php" method="post">
					<div class="col-xs-6">
						<input class="form-control" name="search" type="text" placeholder="Browse Movie Titles">
					</div>
					<div class="col-xs-2">
						<input type="submit" name="browse" class="btn btn-primary" value="Search"></input>
					</div>
			</form>
		</div>
		<br>
			<div class="row">
				<div class="col-xs-6">
					<?php
						if(!empty($_POST["search"])){
			              $title = $_POST["search"];
			              $movies = userConnection()->query("select * from movie where title = '$title'");
			              echo"<p></p>";
			              if(!empty($movies)){
			              	echo "<h2>Search results for $title:</h2>";
			              	foreach($movies as $movie){
			        ?>
			              		<form action="user.php" class="form-inline" method="post">
			        <?php
						    	echo "<h4>";
						    	echo "$movie[0] | $movie[3]";
					?>
									<button name="moreInfo" class="btn btn-sm btn-info" value="<?php echo base64_encode(serialize($movie)); ?>">More Info / Review</button>
								</form>
					<?php
								echo "</h4>";
						  	}
			              }
			            }
			            else {
			            	echo "<h2>All Movies:</h2>";
				            echo "<p></p>";
							foreach($movies as $movie){
					?>
			              		<form action="user.php" class="form-inline" method="post">
			        <?php
						    	echo "<h4>";
						    	echo "$movie[0] | $movie[3]";
					?>
									<button name="moreInfo" class="btn btn-sm btn-info" value="<?php echo base64_encode(serialize($movie)); ?>">More Info / Review</button>
								</form>
					<?php
								echo "</h4>";
							}
			            }
					?>
				</div>
			</div>
	</div>