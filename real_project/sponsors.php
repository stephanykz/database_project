<?php
include("nav.php");
?>
<h2>Sponsors</h2>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<table>
    <tr>
        <th>Company Name</th>
        <th>Level of Sponsorship</th>
    </tr>
    
<?php
	$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
	$sponsors_sql = "Select company_name, grade from Sponsor_company";
	$sponsors = $pdo->prepare($sponsors_sql);
	$sponsors->execute(); 
    foreach($sponsors as $sponsor){
 ?>
    <tr>
        <td><?php echo $sponsor["company_name"]; ?></td>
		<td><?php echo $sponsor["grade"]; ?></td>
		<td><button type="submit" name="delete" value="<?php echo $sponsor["company_name"]; ?>">Delete</td>
		<td><button type="submit" name="show_jobs" value="<?php echo $sponsor["company_name"]; ?>">Show Jobs</td>
    </tr>
 <?php
    }
?>
</table>
<div>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<input type="submit" name="show_all" value="Show All Job Postings">
	</form>
<div>
<div>
	<h3> Add a Sponsor </h3>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<label>Company Name:</label>
		<input type="text" name="company_name">
		<select name='level'>
			<option value = 'Platinum' selected = 'selected'>Platinum</option>
			<option value = 'Gold'>Gold</option>
			<option value = 'Silver'>Silver</option>
			<option value = 'Bronze'>Bronze</option>
		</select>
		<input type="submit" name="submit" value="Add">
	</form> 
</div>


<?php
    if(isset($_POST["delete"])){
		$company_name = $_POST["delete"];
		echo $company_name;
		try {
			$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
			$sponsors_sql = "Delete from Sponsor_company where company_name = '".$company_name."'";
			$sponsors = $pdo->prepare($sponsors_sql);
			$sponsors->execute(); 
			echo "Deleted";
			// TODO: Update the table after delete
		} catch (PDOException $e) {
			echo "Error";
		}
	}
	if(isset($_POST["submit"])){
		include("add_sponsor.php");
	}
	if(!empty($_POST["show_all"])){
		$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
		$sql = "Select job_title, location_city, location_province, pay_rate from Ads ";
		$jobs = $pdo->prepare($sql);  
		$jobs->execute();
?>
<div>
	<h3>All Jobs Postings</h3>
	<table>
		<tr>
			<th>Job Title</th>
			<th>City</th>
			<th>Province</th>
			<th>Salary</th>
		</tr>
	<?php
			foreach($jobs as $job){
	?>
			<tr>
			<td><?php echo $job["job_title"]; ?></td>
			<td><?php echo $job["location_city"]; ?></td>
			<td><?php echo $job["location_province"]; ?></td>
			<td><?php echo $job["pay_rate"]; ?></td>
		</tr>
	<?php
		}
	}
	?>
	</table>
</div>

<?php
	if(isset($_POST["show_jobs"])){
		$sponsor = $_POST["show_jobs"];
		$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
		$sql = "Select job_title, location_city, location_province, pay_rate from Ads where company_name = ?";
		$jobs = $pdo->prepare($sql);  
		$jobs->execute([$sponsor]);
?>
<div>
	<h3>Jobs Postings of <?php echo $sponsor; ?></h3>
	<table>
		<tr>
			<th>Job Title</th>
			<th>City</th>
			<th>Province</th>
			<th>Salary</th>
		</tr>
	<?php
			foreach($jobs as $job){
	?>
			<tr>
			<td><?php echo $job["job_title"]; ?></td>
			<td><?php echo $job["location_city"]; ?></td>
			<td><?php echo $job["location_province"]; ?></td>
			<td><?php echo $job["pay_rate"]; ?></td>
		</tr>
	<?php
		}
	}
	?>
	</table>
</div>
</body>
</form>
</html>