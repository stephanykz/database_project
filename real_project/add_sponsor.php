<?php
$company_name = $_POST["company_name"];
$grade = $_POST["level"];
switch ($grade) {
    case "Platinum":
        $email_allowance = '5';
        $rate = 10000;
        break;
    case "Gold":
        $email_allowance = '4';
        $rate = 5000;
        break;
    case "Silver":
        $email_allowance = '3';  
        $rate = 3000;
        break;
    default:
        $email_allowance = '0';
        $rate = 1000;

}
$email_sent = 0;

try {
    $pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
    $stmt = $pdo->prepare("Insert into Sponsor_company values(:company_name, :grade, :rate, :email_allowance,:email_sent)");
      if ($stmt->execute(array(':company_name' => $company_name, ':grade' => $grade, ':rate' => $rate, ':email_allowance'=> $email_allowance,':email_sent'=>$email_sent))) {
            echo "Added";
            } else {
            echo 'Failed';
            }
} catch (PDOException $e) {
    echo "Error";
}
?>