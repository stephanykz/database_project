<?php

  $showing = $_SESSION["showing"];
  echo "<h3>How many tickets would you like for $showing[4] at $showing[0]pm?";
  echo "<h3>Address: $showing[2]</h3>";
?>

    <form action="user.php" class="form-inline" method="post">
    	<div class="form-group">
	  		<label for="numTix">Number of Tickets</label>
	  		<select class="form-control" name="numTix">
	    		<option>1</option>
	    		<option>2</option>
	    		<option>3</option>
	    		<option>4</option>
	    		<option>5</option>
	  		</select>
	   	</div>
		<button name="purchases" class="btn btn-sm btn-info" value="<?php echo base64_encode(serialize($showing)); ?>">Purchase Tickets</button>
	</form>
