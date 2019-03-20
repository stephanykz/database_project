<?php
	$movies = userConnection()->query("select * from reserved");
	$popular = 0;
	$movieTitle = "";
	foreach($movies as $movie){
		$sumTickets = userConnection()->query("select numTix from reserved where movieTitle = '$movie[2]'");
		$sum = 0;
		foreach ($sumTickets as $sumTicket) {
			$sum += $sumTicket[0];
		}
		if ($sum > $popular){
			$popular = $sum;
			$movieTitle = $movie[2];
		}
	}
	echo "<h2>The most tickets have been sold by $movieTitle</h2>";
	echo "<h2>It has sold $popular tickets total</h2>";
?>