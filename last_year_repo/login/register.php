<?php
  session_start();
  include("../config.php");

  function generateUniqueAccount(){
    $accountNumber = rand(0,9999);

    if(!empty($_POST["adminCheck"])) $user = "admin";
    else $user = "customer";
    
    $accountExists = rootConnection()->query("select accountNum from $user where accountNum='$accountNumber'");

    echo $accountNumber;

    while(empty($accountExists)){
      echo "regenerating account number";
      $accountNumber = rand(0,9999);
      $accountExists = rootConnection()->query("select accountNum from $user where accountNum='$accountNumber'");
    }

    $_SESSION["accountNum"] = $accountNumber;
  }
   

  if($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $_SESSION["password"] = $password;
      $server = $_SERVER["SERVER_NAME"];
      // $trimmedEmail = preg_replace("/[^A-Za-z0-9 ]/", '', $email);
      // echo $trimmedEmail;

      generateUniqueAccount();
      // $accountNum = $_SESSION["accountNum"];

      $rootConnection = rootConnection();
      try{
        // $rootConnection->query("create user $accountNum'@".DB_SERVER." identified by '$password'");
        $rootConnection->query("create user '".$_SESSION["accountNum"]."'@".DB_SERVER." identified by '".$_SESSION["password"]."'");
        echo "succesfully created user ".$_SESSION["accountNum"];
        // rootConnection()->query("create user '".$_SESSION["accountNum"]."'@".DB_SERVER." indentified by '".$_SESSION["password"]."'");
      }
      catch(PDOException $e) {
        echo "Failed to create new user account" . $e->getMessage();
      }
      

      if(!empty($_POST["adminCheck"])){
        try{
          echo "Trying to create admin connection";

          $rootConnection->query("grant all privileges on ".DB_DATABASE.".* to '".$_SESSION["accountNum"]."'@".DB_SERVER);
          $rootConnection->query("grant create user on *.* to '".$_SESSION["accountNum"]."'@".DB_SERVER);

          // $userConnection = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, $_SESSION["accountNum"], $password);
          // // set the PDO error mode to exception
          // $userConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          userConnection()->query("insert into admin (accountNum, name, password, email) values ('".$_SESSION["accountNum"]."','$name','".$_SESSION["password"]."','$email')");

          echo "Successfully create admin connection"; 

          header('location: ../admin/admin.php');  
        } 
        catch(PDOException $e) {
          echo "Failed to create admin connection" . $e->getMessage();
        }
      }

      else {
        try{
          echo "Trying to create user connection";

          $rootConnection->query("grant all privileges on ".DB_DATABASE.".* to '".$_SESSION["accountNum"]."'@".DB_SERVER);

          // $userConnection = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, $trimmedEmail, $password);
          // // set the PDO error mode to exception
          // $userConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          userConnection()->query("insert into customer (accountNum, password, name, email) values ('".$_SESSION["accountNum"]."', '".$_SESSION["password"]."', '$name', '$email')");

          echo "Successfully create user connection"; 

          header('location: collectUserInfo.php');  
        } 
        catch(PDOException $e) {
          echo "Failed to create user connection" . $e->getMessage();
        } 
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
        <h2>Register</h2>
        <p>Please fill in your credentials to register.</p>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control">
                <!-- <span class="help-block"><?php echo $username_err; ?></span> -->  
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
                <!-- <span class="help-block"><?php echo $password_err; ?></span> -->
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <!-- <span class="help-block"><?php echo $password_err; ?></span> -->
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Register">
            </div>
            <p>Already have an account? <a href="/332_omts">Login now</a>.</p>
            <p>Register as an Admin <input type="checkbox" name="adminCheck"></p> 
        </form>
    </div>    
</body>
</html>