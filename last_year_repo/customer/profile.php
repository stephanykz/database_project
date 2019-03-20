<?php
	$user = userConnection()->query("select * from customer where accountNum = '".$_SESSION['accountNum']."'")->fetch(PDO::FETCH_ASSOC);
	echo "<h1>User Profile</h1>";
	echo "</h4><p></p><h4>";
	echo "Your current address is: ";
	echo $user['address'];
	echo "</h4><p></p><h4>";
	echo "Your current email is: ";
	echo $user['email'];
	echo "</h4><p></p><h4>";
	echo "Your current credit card number is: ";
	echo $user['creditCard'];
	echo "</h4><p></p><h4>";
	echo "Your current credit card expiry date is: ";
	echo $user['cardExpiry'];
	echo"<h3>Alter your current information below</h3>";
	echo "<br>";
?>
		<form action="user.php" class="form" method="post">
			<span><h4>Update Address: </h4></span><input type="text" name="address">			
			<span><h4>Update Email: </h4></span><input type="text" name="email">
			<span><h4>Update Card Number: </h4></span><input type="text" name="cardNumber">
			<span><h4>Update Card Expiry: </h4></span><input type="text" name="cardExpiry">	<span> Enter in the format YYYY-MM-DD</span>
			<p></p>	
			<button name="alterProfile" class="btn btn btn-info" value="<?php echo base64_encode(serialize($user)); ?>">Update Profile!</button>
		</form>