<!DOCTYPE html>
<html>
<head>
<link href="styles.css" type="text/css" rel="stylesheet" >
</head>
<body>
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
		<td><a href="delete_sponsor.php?id=<?php echo $sponsor["company_name"]; ?>">Delete</td>
		<td><button type="submit" name="show_jobs" value="<?php echo $sponsor["company_name"]; ?>">Show Jobs</td>
    </tr>
 <?php
    }
?>
</table>
<?php
    if(isset($_POST["delete"])){
		// delete
	}
	if(isset($_POST["show_jobs"])){
		$sponsor = $_POST["show_jobs"];
		$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
		$sql = "Select job_title, location_city, location_province, pay_rate from Ads where company_name = ?";
		$jobs = $pdo->prepare($sql);  
		$jobs->execute([$sponsor]);
?>
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
</body>
</form>
</html>