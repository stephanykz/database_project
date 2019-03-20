<?php
	$members = userConnection()->query("select accountNum, name, address, email, phone from customer");
?>
<h1>Members</h1>
<?php
	echo "<h4>Here are all customers in the database</h4>";
	foreach($members as $member){
?>
    	<form action="admin.php" class="form-inline" method="post">
<?php
			echo "<h4>";
			echo "$member[0] | $member[1] | $member[3] | $member[2] | $member[4]";
?>
			<br>	
			<button name="deleteMember" class="btn btn-sm btn-info" value="<?php echo base64_encode(serialize($member)); ?>">Delete Member</button>
			<button name="tickets" class="btn btn-sm btn-info" value="<?php echo base64_encode(serialize($member)); ?>">Show Rental History</button>
		</form>
<?php
		echo "</h4>";
		echo "<br>";
	}
?>