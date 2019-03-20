<?php
	$tickets = userConnection()->query("select movieTitle, movieDirector, startTime, theatreNum, complexAddress, numTix from reserved where accountNum='".$_SESSION["member"][0]."'");
?>
<h1>Tickets</h1>
<?php
	echo "<h4>Here are all the tickets for ";
	echo $_SESSION["member"][1];
	echo "</h4>";
	foreach($tickets as $ticket){
?>
    	<form action="admin.php" class="form-inline" method="post">
<?php
			echo "<h4>";
			echo "$ticket[0] | Directed by: $ticket[1] | At: $ticket[2] PM| Theater Number: $ticket[3] | Location: $ticket[4] | Number of Tickets Purchased: $ticket[5]";
?>
			<br>	
		</form>
<?php
		echo "</h4>";
		echo "<br>";
	}
?>