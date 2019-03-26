<?php
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$type = $_POST["type"];
$room = $_POST["room"];

$pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
$max_id = $pdo->prepare("SELECT MAX(attendee_id) FROM Attendee");
$max_id->execute();
$res = $max_id->fetch();
$id = $res[0] +1;


switch ($type) {
    case "professional":
        $rate = '$100';
        break;
    case "student":
        $rate = '$50';
        break;
    default:
        $rate = 'FREE';
}

if ($type != "student" and $room > 0){
    echo "Only students can stay in a hotel room!";
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
        $sql = "Insert into Attendee (attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, phone, phone)
        values(:attendee_id, :attendee_first_name, :attendee_last_name, :attendee_type, :rate, :phone, :phone)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute(array(':attendee_id' => $id, ':attendee_first_name' => $firstname, ':attendee_last_name' => $lastname, ':attendee_type' => $type, ':rate' => $rate, ':email' => $email, ':phone' => $phone))) {
		    header('Location: '.$_SERVER['REQUEST_URI']);        
        } else {
            echo 'Failed';
        }
    } catch (PDOException $e) {
        echo "Error";
    }
}
else {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
        
        if ($room > 0){
            $sql = "Insert into Attendee (attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, phone, live_in)
            values(:attendee_id, :attendee_first_name, :attendee_last_name, :attendee_type, :rate, :email, :phone, :live_in)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array(':attendee_id' => $id, ':attendee_first_name' => $firstname, ':attendee_last_name' => $lastname, ':attendee_type' => $type, ':rate' => $rate, ':email' => $email, ':phone' => $phone, ':live_in' => $room))) {
                header('Location: '.$_SERVER['REQUEST_URI']);                    
            } else {
                print_r($stmt->errorInfo());
            }
        }

        else {
            $sql = "Insert into Attendee (attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, phone)
            values(:attendee_id, :attendee_first_name, :attendee_last_name, :attendee_type, :rate, :email, :phone)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array(':attendee_id' => $id, ':attendee_first_name' => $firstname, ':attendee_last_name' => $lastname, ':attendee_type' => $type, ':rate' => $rate, ':email' => $email, ':phone' => $phone))) {
                header('Location: '.$_SERVER['REQUEST_URI']);                    
            } else {
                print_r($stmt->errorInfo());
            }
        }
    } catch (PDOException $e) {
        echo "Error";
    }
}
?>