<?php
$company_name = $_POST[$sponsor["company_name"]];
echo $company_name;
try {
    $pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
    $sponsors_sql = "Delete from from Sponsor_company where company_name = '".$company_name."'";
    $sponsors = $pdo->prepare($sponsors_sql);
    $sponsors->execute(); 
    echo "Deleted";
} catch (PDOException $e) {
    echo "Error";
}

// header('Location: sponsors.php');
?>