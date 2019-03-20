<?php
  session_start();
  include("../partials/admin_header.php");
  include("../config.php");
?>
  <div class="container">
  <?php
  echo "<h3>Hi "; 
  echo $_SESSION["name"];
  echo "!</h3>"; // Put account Name here
  ?>
    <div class="row">
      <div class="col-xs-9">
        <div>
          <?php

////////////////////// View & Delete Members ///////////////////////////////////////////

            if(!empty($_POST["members"])){
              include("members.php");
            }

            if(!empty($_POST["deleteMember"])){
              $_SESSION["member"] = unserialize(base64_decode($_POST["deleteMember"]));
              $connection = userConnection();
              $connection->query("drop user '".$_SESSION["member"][0]."'@".DB_SERVER);
              $connection->query("delete from customer where accountNum='".$_SESSION["member"][0]."'");
              include("members.php");
            }

////////////////////// Add & Update Complexes ///////////////////////////////////////////

            if(!empty($_POST["complexes"])){
              include("complexes.php");              
            }

            if(!empty($_POST["updateComplex"])){
              $_SESSION['complex'] = unserialize(base64_decode($_POST["updateComplex"]));
              if (!empty($_POST["name"])){
                userConnection()->query("update theatrecomplex set name = '".$_POST['name']."' where address = '".$_SESSION['complex'][1]."'");
              }
              if (!empty($_POST["address"])){
                userConnection()->query("update theatrecomplex set address = '".$_POST['address']."' where address = '".$_SESSION['complex'][1]."'");
              }
              if (!empty($_POST["phoneNumber"])){
                userConnection()->query("update theatrecomplex set phoneNumber = '".$_POST['phoneNumber']."' where address = '".$_SESSION['complex'][1]."'");
              }
              include("complexes.php");              
            }

            if(!empty($_POST["addComplex"])){
              userConnection()->query("insert into theatrecomplex values ('".$_POST['address']."', '".$_POST['name']."', '".$_POST['phoneNumber']."', '".$_POST['numTheatres']."')");
              //userConnection()->query("insert into theatre (complexAddress) values ('".$_POST['address']."')");
              $_SESSION["numTheatres"] = $_POST['numTheatres'];
              $_SESSION["complexAddress"] = $_POST['address'];
              include("createTheatres.php");
            }

/////////////////// Add, Edit & Update Theatres //////////////////////////////////

            if(!empty($_POST["addTheatre"])){
              $seats = $_POST["maxSeats"];
              $screen= $_POST["screenSize"];
              for($x=1; $x<=$_SESSION["numTheatres"]; $x++){
                $index = $x - 1;
                userConnection()->query("insert into theatre values ('$x','".$_SESSION["complexAddress"]."', '$seats[$index]', '$screen[$index]')");
              }
              include("complexes.php");
            }

            if(!empty($_POST["editTheatres"])){
              $_SESSION['complex'] = unserialize(base64_decode($_POST["editTheatres"]));
              include("theatres.php");
            }

            if(!empty($_POST["updateTheatre"])){
              $_SESSION['theatre'] = unserialize(base64_decode($_POST["updateTheatre"]));
              if (!empty($_POST["theatreNum"])){
                userConnection()->query("update theatre set theatreNum = '".$_POST['theatreNum']."' where complexAddress = '".$_SESSION['complex'][1]."' and theatreNum = '".$_SESSION['theatre'][0]."'");
              }
              if (!empty($_POST['maxSeats'])){
                userConnection()->query("update theatre set maxSeats = '".$_POST['maxSeats']."' where complexAddress = '".$_SESSION['complex'][1]."' and theatreNum = '".$_SESSION['theatre'][0]."'");
              }
              if (!empty($_POST['screenSize'])){
                userConnection()->query("update theatre set screenSize = '".$_POST['screenSize']."' where complexAddress = '".$_SESSION['complex'][1]."' and theatreNum = '".$_SESSION['theatre'][0]."'");
              }
              include("complexes.php");
            }

/////////////////// Add Movies //////////////////////////////////

            if(!empty($_POST["movies"])){
              include("movies.php");
            }
            if(!empty($_POST["createMovie"])){
               if(!empty($_POST["movieTitle"]) && !empty($_POST["director"]) && !empty($_POST["runningTime"]) && !empty($_POST["rating"]) && !empty($_POST["plotSynopsis"]) && !empty($_POST["mainActors"]) && !empty($_POST["prodCompany"]) && !empty($_POST["dateStart"]) && !empty($_POST["endDate"]) && !empty($_POST["supplier"])){
                userConnection()->query("insert into movie values ('".$_POST['movieTitle']."', '".$_POST['director']."', '".$_POST['runningTime']."', '".$_POST['rating']."', '".$_POST['plotSynopsis']."', '".$_POST['mainActors']."', '".$_POST['prodCompany']."', '".$_POST['dateStart']."', '".$_POST['endDate']."', 'suppliers')");
              }
                include("movies.php");
            }

///////////////////// Show All Tickets For a Member //////////////////////

            if(!empty($_POST["tickets"])){
              $_SESSION["member"] = unserialize(base64_decode($_POST["tickets"]));
              include("tickets.php");
            }

///////////////////// Popular Tickets and Theatres //////////////////////

            if(!empty($_POST["popularTicket"])){
              include("popularTicket.php");
            }
            if(!empty($_POST["popularTheatre"])){
              include("popularTheatre.php");
            }

///////////////////// Showings //////////////////////

            if(!empty($_POST["showings"])){
              include("showings.php");
            }

            if(!empty($_POST["updateShowing"])){
              $_SESSION["showing"] = unserialize(base64_decode($_POST["updateShowing"]));
              include("updateShowing.php");
            }

            if(!empty($_POST["alterShowing"])){
              $_SESSION["showing"] = unserialize(base64_decode($_POST["alterShowing"]));
              if (!empty($_POST["startTime"])){
                userConnection()->query("update showing set startTime = '".$_POST['startTime']."' where movieTitle = '".$_SESSION['showing'][4]."' and movieDirector = '".$_SESSION['showing'][5]."'");
              }
              if (!empty($_POST["seatsAvailable"])){
                userConnection()->query("update showing set seatsAvailable = '".$_POST['seatsAvailable']."' where movieTitle = '".$_SESSION['showing'][4]."' and movieDirector = '".$_SESSION['showing'][5]."'");
              }
              if (!empty($_POST["complexAddress"])){
                userConnection()->query("update showing set complexAddress = '".$_POST['complexAddress']."' where movieTitle = '".$_SESSION['showing'][4]."' and movieDirector = '".$_SESSION['showing'][5]."'");
              }
              if (!empty($_POST["theatreNumber"])){
                userConnection()->query("update showing set theatreNum = '".$_POST['theatreNumber']."' where movieTitle = '".$_SESSION['showing'][4]."' and movieDirector = '".$_SESSION['showing'][5]."'");
              }
              if (!empty($_POST["movieTitle"])){
                userConnection()->query("update showing set movieTitle = '".$_POST['movieTitle']."' where movieTitle = '".$_SESSION['showing'][4]."' and movieDirector = '".$_SESSION['showing'][5]."'");
              }
              include("showings.php");
            }
            if(!empty($_POST["addShowing"])){
                if(!empty($_POST["startTime"]) && !empty($_POST["seatsAvailable"]) && !empty($_POST["complexAddress"]) && !empty($_POST["theatreNum"]) && !empty($_POST["movieTitle"]) && !empty($_POST["movieDirector"])){
                userConnection()->query("insert into showing values ('".$_POST['startTime']."', '".$_POST['seatsAvailable']."', '".$_POST['complexAddress']."', '".$_POST['theatreNum']."', '".$_POST['movieTitle']."', '".$_POST['movieDirector']."')");
                }
              include("showings.php");
            }

///////////////////// Navigation on Home Page //////////////////////

          ?>
        </div>
      </div>
      <div class="col-xs-3">
        <div>
          <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <p><input type="submit" name="members" class="btn btn-info btn-lg btn-block" value="View/Remove Members"></button></p>
            <p><input type="submit" name="complexes" class="btn btn-info btn-lg btn-block" value="Add/Update Theatre Complex"></button></p>
            <p><input type="submit" name="movies" class="btn btn-info btn-lg btn-block" value="Add Movies"></button></p>
            <p><input type="submit" name="popularTicket" class="btn btn-info btn-lg btn-block" value="Ticket Analytics"></button></p>
            <p><input type="submit" name="popularTheatre" class="btn btn-info btn-lg btn-block" value="Theatre Analytics"></button></p>
            <p><input type="submit" name="showings" class="btn btn-info btn-lg btn-block" value="Update Showings"></button></p>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php
  include("../partials/footer.php");
?>
<!-- 
list all the members
remove a member
add or update the information for a theatre complex/theatre
add movies to the database
update where/when movies are showing
for a particular customer, show their rental history (including current tickets held)
find the movie that is the most popular (ie. has sold the most tickets across all theatres).
find the theatre complex that is most popular (ie. has sold the most tickets across all movies) -->