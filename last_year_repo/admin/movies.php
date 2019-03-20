<h2>Add New Movie to the Database</h2>
<form action="admin.php" class="form" method="post">
	<span><h4>Title: </h4></span><input type="text" name="movieTitle">			
	<span><h4>Director: </h4></span><input type="text" name="director">
	<span><h4>Running Time: </h4></span><input type="text" name="runningTime">
	<span><h4>Rating: </h4></span><input type="text" name="rating">
	<span><h4>Plot Synopsis: </h4></span><textarea rows="3" cols="30" name="plotSynopsis"></textarea>
	<span><h4>Main Actors: </h4></span><input type="text" name="mainActors">
	<span><h4>Production Company: </h4></span><input type="text" name="prodCompany">
	<span><h4>Date to make available to customers: </h4></span><input type="text" name="dateStart"> <span> Enter in the format YYYY-MM-DD</span>
	<span><h4>Date to remove purchase ability: </h4></span><input type="text" name="endDate"> <span> Enter in the format YYYY-MM-DD</span>
	<!-- <span><h4>Supplier: </h4></span><input type="text" name="supplier">		 -->
	<p></p>	
	<button name="createMovie" class="btn btn btn-info" value="1">Add Movie!</button>
</form>