<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['who'] != 'o')
  header("location: ownerLogin.php");
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
  <link rel="stylesheet" href="css/owner_manage.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  
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
            <a class="nav-link" href="ownerHome.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tenantRegister.php">Register Tenant</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="myTenants.php">My Tenants</a>
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

  <section class="section-content-block">
    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-6" id="descriptive">
          <div class="contents d-flex flex-column justify-content-around">
            <h5 class="mb-3" style="font-family: 'Montserrat', sans-serif; color: #281436;">Not able to remember details of your tenant?</h5>
            <h2 class="mb-3" style="font-family: 'Montserrat', sans-serif; color: black;">
              HomeRiver is the right place for it!
              </h1>
              <h5 class="mb-3 mt-1" style="font-family: 'Montserrat', sans-serif; color: #281436;">
                This is a place where you can register your apartment, to whom did you sold the apartment as well as the details of your tenants so that whenever you want - you can have access to those information!
                <br><br> All the information regarding the apartments you own and have given for rents are here!
              </h5>
              <div class="mt-1">
                <a type="button" class="btn mb-2 btn-primary" href="myTenants.php">See Tenant Details</a>
                <a type="button" class="btn mb-2 btn-primary but-2" href="tenantRegister.php">New Tenant</a>
              </div>
          </div>
        </div>
        <div class="col-lg-5 mt-3 mt-lg-0" id="illustration">
          <div class="row justify-content-center align-items-center">
            <img class="img-fluid" src="assets/i1.svg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="content inside_form">
    <div class="overlay">
      <?php
      $owner = $_SESSION['oid'];
      ?>
      <h3>
        Number of Apartments:
        <?php
        $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
          or die('error connect to server');
        $sql = "SELECT * FROM ownership WHERE ownerid= $owner";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        echo $count;
        ?>
      </h3>
      <h3>
        Number of Tenants:
        <?php
        $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
          or die('error connect to server');

        $sql = "SELECT * FROM ownership WHERE ownerid= $owner";
        $result = mysqli_query($db, $sql);
        $count = 0;
        while ($row = mysqli_fetch_array($result)) {
          $sql1 = "SELECT * FROM tenant WHERE  aid= " . $row['aid'];
          $result1 = mysqli_query($db, $sql1);
          $r = mysqli_fetch_array($result1);
          $count += mysqli_num_rows($result1);
        }
        echo $count;
        ?>
      </h3>
    </div>
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
        <a class="link-1" href="ownerHome.php">Home</a>
        <a href="tenantRegister.php">Register Tenant</a>
        <a href="myTenants.php">My Tenants</a>
      </p>
      <p>Copyright © 2021 HomeRiver Group - Apartment Management System.</p>
    </div>

  </footer>

  <!--overlay form -->
  <script src="/js/signup.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

  <!-- bootstrap jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/ reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>