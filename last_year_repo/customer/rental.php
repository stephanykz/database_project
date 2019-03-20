<?php
	$today = date("Y-m-d H:i:s");
	$reservations = userConnection()->query("select * from reserved where accountNum='".$_SESSION["accountNum"]."'")->fetch(PDO::FETCH_ASSOC);

	foreach($reservations as $reserved => $value){
		$movie = userConnection()->query("select * from movie where title='$reserved[2]'")->fetch(PDO::FETCH_ASSOC);
		$date = $movie['endDate'];
		if ($date < $today) {
			unset($reservations[$reserved]);
		}
	}

?>
<?php
	echo "<h4>Here are your past purchases for movies no longer showing:</h4>";

	if(empty($reservations)){
		echo "<h5>You have no expired purchases!<h5>";
	}

	else{
		//query in movie for end data, if end date has passed display, else do nothing
		foreach($reservations as $reserved){
			$movie = userConnection()->query("select * from movie where title='$reserved[2]'")->fetch(PDO::FETCH_ASSOC);
			echo "<h4>";
			echo $movie['title'];
			echo "</h4>";
			echo "<br>";
		}
	}
?>