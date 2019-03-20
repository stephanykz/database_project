<?php
	$complexes = userConnection()->query("select name, address, phoneNumber from theatrecomplex");
?>
<h1>Complexes</h1>
	<h2>Add a New Complex</h2>
	<br>
    	<form action="admin.php" class="form-inline" method="post">
		<?php
			echo "Name: ";
		?>
		<input type="text" name="name"><p></p>
		<?php
			echo "Address: ";
		?>
		<input type="text" name="address"><p></p>
		<?php
			echo "Phone Number: ";
		?>
		<input type="text" name="phoneNumber"><p></p>
		<?php
			echo "Number of Theatres: ";
		?>
		<input type="text" name="numTheatres"><p></p>
		<button name="addComplex" class="btn btn btn-info" value="<?php echo base64_encode(serialize($complex)); ?>">Add Complex</button>
		</form>
	<br>
	<h2>Update Existing Complexes</h2>
<?php
	foreach($complexes as $complex){
?>
	<br>
    	<form action="admin.php" class="form-inline" method="post">
		<?php
			echo "Name: ";
			echo $complex[0];
		?>
		<span>   -   </span><input type="text" name="name"><p></p>
		<?php
			echo "Address: ";
			echo $complex[1];
		?>
		<span>   -   </span><input type="text" name="address"><p></p>
		<?php
			echo "Phone Number: ";
			echo $complex[2];
		?>
		<span>   -   </span><input type="text" name="phoneNumber"><p></p>
		<button name="updateComplex" class="btn btn btn-info" value="<?php echo base64_encode(serialize($complex)); ?>">Update Complex</button>
		<button name="editTheatres" class="btn btn btn-info" value="<?php echo base64_encode(serialize($complex)); ?>">Update Theaters</button>
		</form>
	<br>
<?php
	}
?>
