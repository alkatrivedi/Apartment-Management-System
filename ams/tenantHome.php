<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['who'] != 't')
  header("location: tenantLogin.php");


$tid = $_SESSION['tid'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo $tid;
  $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')  or die('error connect to server');
  date_default_timezone_set('Asia/Kolkata');
  $td = date("Y-m-d", time());

  $ww = "INSERT into payment (tenantid, paid_date) VALUES( $tid, '$td')";
  mysqli_query($db, $ww) or die('error444 querring database.');

  header("location: payments.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" class="tab-icon" href="assets/ttt.png">
  <!-- <title>Owner HomePage</title> -->
  <title>HomeRiver Group</title>
  <link rel="stylesheet" href="css/tenant_manage.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">

  <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="">
        <span>
          <img src="assets/tt.png" width="55" height="45" class="logo" alt="">
        </span>
        HomeRiver Group
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="tenantHome.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="payments.php">Payments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Welcome <?php echo $_SESSION['user']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <br><br><br>
  <div class="content container mt-4 mb-5" style="text-align:center;">

    <br>
    <h3> My details </h3>
    <br>
    <br>

    <table class="table" id="table-details">
      <tbody>

        <?php

        $tid = $_SESSION['tid'];
        $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')  or die('error connect to server');
        $sql = "SELECT * FROM tenant WHERE id= $tid";
        mysqli_query($db, $sql) or die('error2 querring database.');
        $r1 = mysqli_query($db, $sql);
        $row1 = mysqli_fetch_array($r1);

        $sql2 = "SELECT * FROM apartment WHERE id=" . $row1['aid'];
        mysqli_query($db, $sql2) or die('error3 querring database.');
        $r2 = mysqli_query($db, $sql2);
        $row2 = mysqli_fetch_array($r2);

        $sql3 = "SELECT * FROM building WHERE id=" . $row2['bid'];
        mysqli_query($db, $sql3) or die('error4 querring database.');
        $r3 = mysqli_query($db, $sql3);
        $row3 = mysqli_fetch_array($r3);

        $sql4 = "SELECT * FROM ownership WHERE aid=" . $row1['aid'];
        mysqli_query($db, $sql4) or die('error5 querring database.');
        $r4 = mysqli_query($db, $sql4);
        $row4 = mysqli_fetch_array($r4);

        $sql5 = "SELECT * FROM owner_details WHERE id=" . $row4['ownerid'];
        mysqli_query($db, $sql5) or die('error6 querring database.');
        $r5 = mysqli_query($db, $sql5);
        $row5 = mysqli_fetch_array($r5);
        echo  '<tr><th scope="row">Name</th><td>' . $row1['name'] . '</td> </tr>
                     <tr><th scope="row">Email </th><td>' . $row1['email'] . '</td></tr>
                   <tr><th scope="row">Phone </th><td>' . $row1['phone'] . '</td></tr>
                   <tr><th scope="row">Building Name </th><td>' . $row3['name'] . ',' . $row3['address'] . '</td></tr>
                   <tr><th scope="row">Apartment Number </th><td>' . $row2['apart_num'] . '</td></tr>
                   <tr><th scope="row">Owner Name </th><td>' . $row5['name'] . '</td></tr>
                   <tr><th scope="row">Owner Email </th><td>' . $row5['email'] . '</td></tr>
                   <tr><th scope="row">Owner Phone </th><td>' . $row5['phone'] . '</td></tr>
                   <tr><th scope="row">Rent </th><td>' . $row1['rent'] . '</td></tr>';
        ?>
      </tbody>
    </table>

    <form action="" method="post">
      <button type="submit" class="btn btn-primary mt-5" style="margin-top:10px;">Pay Rent</button>
    </form>
  </div>

  <footer class="footer footer-distributed sticky-bottom">

    <div class="footer-right">
      <p style="color: white; font-size: 16px; font-weight: bold;">About the Website</p>
      <p style="color: #8f9296; font-size: 14px; margin-bottom: 2rem;">
        Keep all the information related to your building apartments, tenants and rentals at one place.
      </p>
      <a href="mailto:contact@yourwebsite.com"><i class="fas fa-envelope"></i></a>
      <a href="#"><i class="fab fa-linkedin-in"></i></a>
      <a href="526894587"><i class="fa fa-phone"></i></a>
      <a href="https://github.com/alkatrivedi/Apartment-Management-System"><i class="fab fa-github"></i></a>

    </div>

    <div class="footer-left">
      <img class="footlogo" src="assets/tt.png">
      <p class="footer-links">
        <a class="link-1" href="tenantHome.php">Tenant Home</a>
        <a href="payments.php">Payments</a>
        <!-- <a href="tenantLogin.php">Tenant Login</a> -->
      </p>
      <p>Copyright © 2021 HomeRiver Group - Apartment Management System.</p>
    </div>

  </footer>

  <!-- bootstrap jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/ reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>