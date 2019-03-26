<!DOCTYPE html>
<html>
  <head>
    <link href="styles.css" type="text/css" rel="stylesheet" />
  </head>

  <body>
    <?php
      $pdo = new PDO('mysql:host=localhost;dbname=conference', "root", "");
      $rate = $pdo->prepare("SELECT SUM(rate) FROM Sponsor_company");
      $rate->execute();
      $res = $rate->fetch();
      $sponsor_rate = $res[0];

      $rate = $pdo->prepare("SELECT SUM(rate) FROM Attendee");
      $rate->execute();
      $res = $rate->fetch();
      $attendee_rate = $res[0];

      $total = $attendee_rate + $sponsor_rate;
    ?>
    <h1>Conference Organization Dashboard</h1>
    <div class="wrapper">
    <div class="main-menu">
      <h3>Choose from the following options</h3>
      <ul>
        <li><a href="committees.php"><h4>Committees</h4></a></li>
        <li><a href="sponsors.php"><h4>Sponsors</h4></a></li>
        <li><a href="attendees.php"><h4>Attendees</h4></a></li>
        <li><a href="rooms.php"><h4>Rooms</h4></a></li>
        <li><a href="session.php"><h4>Schedule</h4></a></li>
      </ul>
    </div>

    <div class="breakdown">
      <h2>Intake Breakdown</h3>
      <ul>
        <li><h4>Total Intake: $<?php echo $total?></h4></li>
        <li><h4>Sponsor Intake: $<?php echo $sponsor_rate?></h4></li>
      </ul>
    </div>
  </div>
  </body>
</html>
