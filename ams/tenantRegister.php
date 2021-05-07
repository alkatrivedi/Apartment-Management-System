<?php
$db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
  or die('error connect to server');
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['who'] != 'o')
  header("location: ownerLogin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $mail4 = $_POST['email'];
  $password4 = $_POST['pass'];
  $name4 = $_POST['name'];
  $phn4 = $_POST['phn'];
  $aid4 = $_POST['getap'];
  $rent4 = $_POST['rent'];


  $sql = "SELECT * FROM tenant WHERE email = '$mail4' OR aid= $aid4";
  mysqli_query($db, $sql) or die('error querring database.');
  $r3 = mysqli_query($db, $sql);
  $count = mysqli_num_rows($r3);


  if ($count == 0) {

    $sql = "INSERT into tenant ( email, password, name, phone, aid, rent) VALUES ( '$mail4', '$password4', '$name4', '$phn4', $aid4, $rent4)";
    $result = mysqli_query($db, $sql);
    header("location:myTenants.php");
  } else {
    header("location:ownerHome.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Owner Register</title> -->
  <title>HomeRiver Group</title>
  <link rel="icon" class="tab-icon" href="assets/ttt.png">
  <link rel="stylesheet" href="css/owner_manage.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">

  <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>

  <SCRIPT language=JavaScript>
    function reload(form) {
      var val1 = form.getbn.options[form.getbn.options.selectedIndex].value;
      var val2 = document.getElementById("name").value;
      var val3 = document.getElementById("email").value;
      var val4 = document.getElementById("pass").value;
      var val5 = document.getElementById("phn").value;
      var val6 = document.getElementById("rent").value;

      self.location = 'tenantRegister.php?&getbn=' + val1 + '&name=' + val2 + '&email=' + val3 + '&pass=' + val4 + '&phn=' + val5 + '&rent=' + val6;
    }
  </script>
</head>

<body>
  <?php
  @$getbn = $_GET['getbn'];
  @$name = $_GET['name'];
  @$email = $_GET['email'];
  @$pass = $_GET['pass'];
  @$phn = $_GET['phn'];
  @$rent = $_GET['rent'];


  ?>
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

  <br><br><br><br>

  <div class="content container" style="text-align:center;">

    <br> <br>

    <form action="" method="post" style="margin: 0 auto; width:600px;" class="form-add-tenant">
      <div class="row mb-3">
        <label for="name" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="name" name="name" <?php
                                                                        if (isset($name) and strlen($name) > 0)
                                                                          echo 'value =' . $name . ' ';
                                                                        else echo 'value="" ';
                                                                        ?> required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
          <input type="email" class="form-control" id="email" name="email" <?php
                                                                            if (isset($email) and strlen($email) > 0)
                                                                              echo 'value =' . $email . ' ';
                                                                            else echo 'value="" ';
                                                                            ?> required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="pass" class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" id="pass" name="pass" <?php
                                                                            if (isset($pass) and strlen($pass) > 0)
                                                                              echo 'value =' . $pass . ' ';
                                                                            else echo 'value="" ';
                                                                            ?> required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="phn" class="col-sm-3 col-form-label">Phone Number</label>
        <div class="col-sm-9">
          <input type="tel" class="form-control" id="phn" name="phn" <?php
                                                                      if (isset($phn) and strlen($phn) > 0)
                                                                        echo 'value =' . $phn . ' ';
                                                                      else echo 'value="" ';
                                                                      ?> required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="getbn" class="col-sm-3 col-form-label">Select Building</label>
        <div class="col-sm-9">
          <select class="form-select" id="getbn" name="getbn" required onchange="reload(this.form)">
            <option value=""> </option>
            <?php
            function  func($id, $name)
            {
              $element = ' <option value=' . $id . '>' . $name . '</option>';
              echo $element;
            }
            $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
              or die('error connect to server');
            $query1 = "SELECT * FROM building";
            mysqli_query($db, $query1) or die('error querring database.');
            $result = mysqli_query($db, $query1);
            $oid = $_SESSION['oid'];
            while ($row = mysqli_fetch_array($result)) {  // echo $row['id'];
              $q2 = "SELECT * FROM apartment WHERE bid= " . $row['id'];
              mysqli_query($db, $q2) or die('error querring database.');
              $r2 = mysqli_query($db, $q2);
              $count = 0;
              while ($row1 = mysqli_fetch_array($r2)) { // echo $oid; 

                $q3 = "SELECT * FROM ownership WHERE ownerid= $oid AND aid= " . $row1['id'];
                mysqli_query($db, $q3) or die('error querring database.');
                $r3 = mysqli_query($db, $q3);
                $count = $count + mysqli_num_rows($r3);
              }
              if ($row['id'] == @$getbn)
                echo '<option selected value=' . $row['id'] . '>' . $row['name'] . ',' . $row['address'] . ' </option>';
              else if ($count != 0)
                echo '<option  value=' . $row['id'] . '>' . $row['name'] . ',' . $row['address'] . ' </option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="getap" class="col-sm-3 col-form-label">Select Apartment</label>
        <div class="col-sm-9">
          <select class="form-select" id="getap" name="getap" required>
            <option value=""> </option>
            <?php
            function  apfunc($id, $name)
            {
              $element = ' <option value=' . $id . '>' . $name . '</option>';
              echo $element;
            }
            if (isset($getbn) and strlen($getbn) > 0) {

              $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
                or die('error connect to server');
              $p = (int)$getbn;
              $oid = $_SESSION['oid'];
              $query2 = "SELECT * FROM ownership WHERE ownerid= $oid";
              mysqli_query($db, $query2) or die('error querring database.');
              $result = mysqli_query($db, $query2);

              while ($row = mysqli_fetch_array($result)) {
                $query2 = "SELECT * FROM apartment WHERE id= " . $row['aid'] . " AND bid=$p";
                mysqli_query($db, $query2) or die('error querring database.');
                $r2 = mysqli_query($db, $query2);
                $row1 = mysqli_fetch_array($r2);

                apfunc($row1['id'], $row1['apart_num']);
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="rent" class="col-sm-3 col-form-label">Rent</label>
        <div class="col-sm-9">
          <input type="rent" class="form-control" id="rent" name="rent" <?php
                                                                        if (isset($rent) and strlen($rent) > 0)
                                                                          echo 'value =' . $rent . ' ';
                                                                        else echo 'value="" ';
                                                                        ?> required>
        </div>
      </div>
      <button type="submit" class="btn btn-primary mt-3">Submit</button>
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
        <a class="link-1" href="ownerHome.php">Home</a>
        <a href="tenantRegister.php">Register Tenant</a>
        <a href="myTenants.php">My Tenants</a>
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