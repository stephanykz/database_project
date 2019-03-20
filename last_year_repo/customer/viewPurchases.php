<?php
	$reservations = userConnection()->query("select * from reserved where accountNum='".$_SESSION["accountNum"]."'");
?>
<?php
	echo "<h4>Here are your reserved tickets</h4>";
	
	if(empty($reservations)) {
		echo "<h5>You have no movies reserved :(<h5>";
	}

	else {
		foreach($reservations as $reserved){
			$movie = userConnection()->query("select * from movie where title='$reserved[2]'")->fetch(PDO::FETCH_ASSOC);
			$today = date("Y-m-d H:i:s");
			$date = $movie['endDate'];
			//query in movie for end data
			//if end date has passed display, else do nothing
			if ($date > $today) {
				echo "<br>";
	?>

	    		<form action="user.php" class="form-inline" method="post">
	<?php
					echo "<h4>";
					echo "$reserved[6] tickets for $reserved[2] | Start Time: $reserved[1] | Address: $reserved[5]";
				
	?>
					<br>	
					<button name="cancelPurchase" class="btn btn-sm btn-info" value="<?php echo base64_encode(serialize($reserved)); ?>">Cancel Purchase</button>
				</form>
	<?php
					echo "</h4>";
					echo "<br>";
			}	//echo $_SESSION['numTix'];
		}
	}
?>