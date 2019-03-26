<?php
include("nav.php");
?>
<h2>Commitees</h2>
<ul>
<?php

echo "<p>Here is the information for all sub-committees!</p>";

echo "<table><tr><th>Sub-committee</th><th>Member ID</th><th>First Name</th><th>Last Name</th><th>Is Chair of</th></tr>";


$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$sql = "Select * from Member M, Sub_committee_members S where M.member_id = S.member_id ORDER BY S.sub_committee_name;";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute(); 

#stmt contains the result of the program execution
#use fetch to get results row by row.
foreach ($stmt as $row) {
	echo "<tr><td>".$row["sub_committee_name"]."</td><td>".$row["member_id"]."</td><td>".$row["member_first_name"]."</td><td>".$row["member_last_name"]."</td><td>".$row["chair_of"]."</td></tr>";
}
?>

<span>View the members for a specific sub-committee: </span>
<form action='particularSubCommittee.php' method='post' id="memberform">
  <select name='sub_committee_name' form='memberform'>
    <option value = '0' selected = 'selected'>A specific sub-committee</option>
    <?php
    	$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
    	$sub_committee_names_sql = "Select DISTINCT sub_committee_name from Sub_committee_members";
    	$sub_committee_names = $pdo->prepare($sub_committee_names_sql);
    	$sub_committee_names->execute();
    	foreach($sub_committee_names as $sub_committee_name){
    	?>
        <option value="<?php echo strtolower($sub_committee_name['sub_committee_name']); ?>"><?php echo $sub_committee_name['sub_committee_name']; ?></option>
        <?php
        }
    ?>
  </select>
  <input type="submit">
</form>
</body>
</html> 
