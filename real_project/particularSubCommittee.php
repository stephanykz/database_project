<?php
$subcommitteeName = $_POST["sub_committee_name"];                      

echo "<p>Here is a list of all the members at $subcommitteeName!</p>";

echo "<table><tr><th>Member ID</th><th>First Name</th><th>Last Name</th><th>Is Chair of</th></tr>";

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$sql = "Select * from Member M, Sub_committee_members S where M.member_id = S.member_id and S.sub_committee_name = ?";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute([$subcommitteeName]); 

#stmt contains the result of the program execution
#use fetch to get results row by row.
while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["member_id"]."</td><td>".$row["member_first_name"]."</td><td>".$row["member_last_name"]."</td><td>".$row["chair_of"]."</td></tr>";
}

?>