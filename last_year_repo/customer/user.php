<?php
  session_start();
  include("../partials/customer_header.php");  // customer_header
  include("../config.php");
?>
  <div class="container">
    <div class="row">
      <h1>Hi <?php echo $_SESSION['name']?>!</h1>
      <div class="col-xs-9">
        <div> 
          <?php

///////////////////// Confirm, View & Cancel Purchases //////////////////////          

            if(!empty($_POST["confirmPurchase"])){
              $_SESSION["showing"] = unserialize(base64_decode($_POST["confirmPurchase"]));
              include("confirmPurchase.php");
            }

            if(!empty($_POST["purchase"])){
              include("purchase.php"); //Show Viewings Button
            } // More info button

            if(!empty($_POST["purchases"])){
              if(!empty($_POST["numTix"])){
                $_SESSION["numTix"] = $_POST["numTix"];

                $currentTicksAvailable = userConnection()->query("select seatsAvailable from showing where startTime = '".$_SESSION['showing'][0]."' and complexAddress = '".$_SESSION['showing'][2]."' and theatreNum = '".$_SESSION['showing'][3]."' and movieTitle = '".$_SESSION['showing'][4]."' and movieDirector = '".$_SESSION['showing'][5]."'");

                if($currentTicksAvailable >= $_SESSION['numTix']){
                  userConnection()->query("update showing set seatsAvailable = seatsAvailable - '".$_SESSION['numTix']."'");

                  userConnection()->query("insert into reserved values ('".$_SESSION['accountNum']."','".$_SESSION['showing'][0]."','".$_SESSION['showing'][4]."', '".$_SESSION['showing'][5]."', '".$_SESSION['showing'][3]."', '".$_SESSION['showing'][2]."','".$_SESSION['numTix']."')");
                }

                else{
                  
                }
              }
              include("viewPurchases.php");
            } // Review here also, these are current purchases uses reserved table

            if(!empty($_POST["cancelPurchase"])){
              $_SESSION["deleteReserved"] = unserialize(base64_decode($_POST["cancelPurchase"]));                            
              userConnection()->query("delete from reserved where movieTitle = '".$_SESSION['deleteReserved'][2]."' and numTix = '".$_SESSION['deleteReserved'][6]."' and accountNum = '".$_SESSION['accountNum']."'");
              include("viewPurchases.php");
            }

///////////////////// Browse Movie, Showings & Reviews //////////////////////          

            if(!empty($_POST["browse"])){
              include("browse.php");
            }

            if(!empty($_POST["moreInfo"])){
              $_SESSION["movie"] = unserialize(base64_decode($_POST["moreInfo"]));              
              include("moreInfo.php");
            } // Need Review in here as well and more info

            if(!empty($_POST["submitReview"])){
              $review = $_POST['review'];
              userConnection()->query("insert into review values ('".$_SESSION['reviewId']."','".$_SESSION['accountNum']."','".$_SESSION['movie'][0]."','$review')");
              include("moreInfo.php");
            }

///////////////////// View & Alter Profile //////////////////////          

            if(!empty($_POST["profile"])){
              include("profile.php");
            }

            if(!empty($_POST["alterProfile"])){
              if (!empty($_POST["address"])){
                userConnection()->query("update customer set address = '".$_POST['address']."' where accountNum = '".$_SESSION['accountNum']."'");
              }
              if (!empty($_POST["email"])){
                userConnection()->query("update customer set email = '".$_POST['email']."' where accountNum = '".$_SESSION['accountNum']."'");
              }
              if (!empty($_POST["cardNumber"])){
                userConnection()->query("update customer set creditCard = '".$_POST['cardNumber']."' where accountNum = '".$_SESSION['accountNum']."'");
              }
              if (!empty($_POST["cardExpiry"])){
                userConnection()->query("update customer set cardExpiry = '".$_POST['cardExpiry']."' where accountNum = '".$_SESSION['accountNum']."'");
              }
              include("profile.php");
            }

///////////////////// Browse Past Rentals //////////////////////          

            if(!empty($_POST["rentals"])){
              include("rental.php");
            } // Need Review feature in here, past purchases

///////////////////// Home Page Navigation //////////////////////          

          ?>
        </div>
      </div>
      <div class="col-xs-3">
        <div>
          <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <p><input type="submit" name="purchase" class="btn btn-info btn-lg btn-block" value="Browse Showings"></button></p>
            <p><input type="submit" name="purchases" class="btn btn-info btn-lg btn-block" value="View/Cancel Purchases"></button></p>
            <p><input type="submit" name="profile" class="btn btn-info btn-lg btn-block" value="Profile"></button></p>
            <p><input type="submit" name="rentals" class="btn btn-info btn-lg btn-block" value="Rental History"></button></p>
            <p><input type="submit" name="browse" class="btn btn-info btn-lg btn-block" value="Browse Movies"></button></p>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
  include("../partials/footer.php");
?>
