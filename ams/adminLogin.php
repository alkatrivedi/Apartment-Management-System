<?php
$db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
  or die('error connect to server');
session_start();
if (isset($_SESSION['user'])) {
  header("location: addBuilding.php");
  exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form 

  $myusername = mysqli_real_escape_string($db, $_POST['email']);
  $mypassword = mysqli_real_escape_string($db, $_POST['pass']);

  $sql = "SELECT id FROM adminlogin WHERE email = '$myusername' and password = '$mypassword'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);


  $count = mysqli_num_rows($result);


  // If result matched $myusername and $mypassword, table row must be 1 row

  if ($count == 1) {
    $who = 'a';
    $_SESSION['user'] = $myusername;
    $_SESSION['loggedin'] = true;
    $_SESSION['who'] = $who;
    header("location: addBuilding.php");
  } else {
    $error = "Your Login Name or Password is invalid";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" class="tab-icon" href="assets/ttt.png">
  <title>HomeRiver Group</title>
  <link rel="stylesheet" href="css/adminlogin.css">

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
            <a class="nav-link" href="">Admin Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ownerLogin.php">Owner Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tenantLogin.php">Tenant Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- <div class="container" style="text-align:center;" id="admin">
    <br> <br>
    <p>Admin Login</p>
    <form action="" method="post" style="margin: 0 auto; width:600px;">
      <div class="row mb-3">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="pass" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="pass" name="pass" required>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
  </div> -->

  <div class="content inside_form" id="admin">
    <div class="overlay">
      <form action="" name="myForm" method="post">
        <div>
          <h2>ADMIN LOGIN</h2>
        </div>
        <div class="mb-3">
          <label class="form-label" for="email">EMAIL</label>
          <input class="form-control" type="email" id="email" placeholder="email" name="email" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="pass">PASSWORD</label>
          <input class="form-control" type="password" id="pass" placeholder="password" name="pass" required>
        </div>
        <div class="mb-3">
          <input id="check" type="checkbox" class="check" checked>
          <label for="check"><span class="icon"></span> Keep me Signed in</label>
        </div>
        <div>
          <input type="submit" class="button" value="Sign In">
        </div>
      </form>
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
        <a class="link-1" href="adminLogin.php">Admin Login</a>
        <a href="ownerLogin.php">Owner Login</a>
        <a href="tenantLogin.php">Tenant Login</a>
      </p>
      <p>Copyright © 2021 HomeRiver Group - Apartment Management System.</p>
    </div>

  </footer>


  <!-- login form -->
  <script src="/js/signup.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

  <!-- bootstrap jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C     +OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.  min.js" integrity="sha384-9/ reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>