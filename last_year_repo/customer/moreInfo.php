<?php
	$movie = $_SESSION['movie'];
	$reviews = userConnection()->query("select * from review where movieTitle = '$movie[0]'");
	echo "<h1>";
	echo $movie[0];
	echo "</h1>";
	echo "<h2>Directed by: ";
	echo $movie[1];
	echo "</h2>";
	echo "<h3>Plot Synopsis: ";
	echo $movie[4];
	echo "</h3>";
	echo "<h3>Cast: ";
	echo $movie[5];
	echo "</h3>";
	echo "<h4>Rating: ";
	echo $movie[3];
	echo "</h4>";
	echo "<h4>Running Time: ";
	echo $movie[2];
	echo "</h4>";
	echo "<h4>Production Company: ";
	echo $movie[6];
	echo "</h4>";
	echo "<h4>In theatres from: ";
	echo $movie[7];
	echo " until: ";
	echo $movie[8];
	echo "</h4>";
	echo "<h4>Supplier: ";
	echo $movie[9];
	echo "</h4>";
	echo "<br>";

	foreach($reviews as $review){
		echo "<h4>Review id: ";
		echo $review[0];
		echo " | ";
		echo $review[3];
		echo "</h4>";
	}

	echo"<h3>Add a review below!</h3>";
	generateUniqueReview();
?>
<form action="user.php" class="form" method="post">
	<textarea rows="6" cols="60" name="review"></textarea>
	<p></p>	
	<button name="submitReview" class="btn btn btn-info" value="<?php echo base64_encode(serialize($movie)); ?>">Submit Review!</button>
</form>


<!-- Need to display all information for a movie,
		Also have option for review at the bottom, text area and submit? -->

<?php 
	function generateUniqueReview(){
	    $reviewID = rand(0,100);
	    
	    $reviewExists = rootConnection()->query("select id from review where id='$reviewID'");

	    // echo $reviewID;

	    while(empty($reviewExists)){
	      echo "regenerating review number";
	      $reviewID = rand(0,100);
	      $reviewExists = rootConnection()->query("select id from review where id='$reviewID'");
	    }

	    $_SESSION["reviewId"] = $reviewID;
  }
?>