<?php

echo "<p>Here are all the sponsors (company name) and their level of sponsorship!</p>";

echo "<table><tr><th>Company Name</th><th>Level of Sponsorship</th></tr>";

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");

$sql = "Select company_name, grade from Sponsor_company";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute(); 

#stmt contains the result of the program execution
#use fetch to get results row by row.
while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["company_name"]."</td><td>".$row["grade"]."</td></tr>";
}
?> 