<?php
	$movies = userConnection()->query("select * from reserved");
	$popular = 0;
	$theatreTitle = "";
	foreach($movies as $movie){
		$sumTickets = userConnection()->query("select numTix from reserved where complexAddress = '$movie[5]'");
		$sum = 0;
		foreach ($sumTickets as $sumTicket) {
			$sum += $sumTicket[0];
		}
		if ($sum > $popular){
			$popular = $sum;
			$theatreTitle = $movie[5];
		}
	}
	echo "<h2>The most tickets have been sold by the complex at $theatreTitle</h2>";
	echo "<h2>It has sold $popular tickets total</h2>";
?>