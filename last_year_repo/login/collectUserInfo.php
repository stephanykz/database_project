<?php
   session_start();
   include("../config.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $address = $_POST["address"];
      $phone = $_POST["phone"];
      $card = $_POST["card"];
      $expiry = $_POST["expiry"];

      try{
        userConnection()->query("update customer set address='$address', phone='$phone', creditCard='$card', cardExpiry='$expiry' where accountNum='".$_SESSION['accountNum']."'");
        echo "succesfully updated customer information";
        header('location: ../customer/user.php');
      }
      catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>User Information</h2>
        <p>Please fill in your infromation to complete registration.</p>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control">
                <!-- <span class="help-block"><?php echo $username_err; ?></span> -->  
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" class="form-control">
                <!-- <span class="help-block"><?php echo $password_err; ?></span> -->
            </div>
            <div class="form-group">
                <label>Credit Card Number</label>
                <input type="text" name="card" class="form-control">
                <!-- <span class="help-block"><?php echo $password_err; ?></span> -->
            </div>
             <div class="form-group">
                <label>Credit Card Expiry</label>
                <input type="text" name="expiry" class="form-control">
                <!-- <span class="help-block"><?php echo $password_err; ?></span> -->
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>    
</body>
</html>