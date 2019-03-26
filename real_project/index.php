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
    <h1>Conference Organization</h1>
    <div class="main-menu">
      <h3>Choose from the following options</h3>
      <ul>
        <li><a href="committees.php">Committees</a></li>
        <li><a href="sponsors.php">Sponsors</a></li>
        <li><a href="attendees.php">Attendees</a></li>
        <li><a href="rooms.php">Hotel Rooms<a></li>
        <li><a href="session.php">Schedule<a></li>
      </ul>
    </div>

    <div class="breakdown">
      <h3>Intake Breakdown</h3>
      <ul>
        <li>Total Intake: $<?php echo $total?></li>
        <li>Sponsor Intake: $<?php echo $sponsor_rate?></li>
      </ul>
    </div>
  </body>
</html>
