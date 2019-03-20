<?php
   session_start();
   include("../config.php");
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = $_POST["email"];
      $password = $_POST["password"];
      $server = $_SERVER['SERVER_NAME'];

      //$trimmedEmail = preg_replace("/[^A-Za-z0-9 ]/", '', $email);
      // echo "<p>Username: $username 
      //          Password: $password </p>";
      // echo $_SERVER['SERVER_NAME'];

      try {
          $user = rootConnection()->query("select accountNum, name from customer where email='$email' and password='$password'")->fetch(PDO::FETCH_ASSOC);
          $admin = rootConnection()->query("select accountNum, name from admin where email='$email' and password='$password'")->fetch(PDO::FETCH_ASSOC);

          if(empty($user) && empty($admin)){
            echo "Could not find user!";
            header('location: /332_omts');
          }

          else if(!empty($user) && empty($admin)){
            $_SESSION["accountNum"] = $user["accountNum"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["password"] = $password;
            echo "Found user!";
            header('location: ../customer/user.php');
          }

          else if(empty($user) && !empty($admin)){
            $_SESSION["accountNum"] = $admin["accountNum"];
            $_SESSION["name"] = $admin["name"];
            $_SESSION["password"] = $password;
            echo "Found user!";
            header('location: ../admin/admin.php');
          }

          else {
            echo "Could not find user!";
            header('location: /332_omts');
          }
      } catch(PDOException $e) {
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
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
                <!-- <span class="help-block"><?php echo $username_err; ?></span> -->  
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <!-- <span class="help-block"><?php echo $password_err; ?></span> -->
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="login/register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>