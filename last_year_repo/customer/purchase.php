<?php
	$showings = userConnection()->query("select * from showing");
?>
<?php
	echo "<h2>All Movies:</h2>";

	if(empty($showings)){
		echo "<h5>There are no showings :(<h5>";
	}

	else{
		foreach($showings as $showing){
		$movie = userConnection()->query("select * from movie where title='$showing[4]'")->fetch(PDO::FETCH_ASSOC);
		$today = date("Y-m-d H:i:s");
		$date = $movie['endDate'];
			if ($date > $today) {
				echo "<br>";
	?>

	    		<form action="user.php" class="form-inline" method="post">
	<?php
					echo "<h4>";
					echo "$showing[4] | Playing at: $showing[0]pm | Address: $showing[2] | Seats Available: $showing[1] | Theatre Number:  $showing[3]";
	?>
					<br>	
					<button name="confirmPurchase" class="btn btn-sm btn-info" value="<?php echo base64_encode(serialize($showing)); ?>">Purchase Tickets</button>
				</form>
	<?php
				echo "</h4>";
				echo "<br>";
			}
		}
	}
?>