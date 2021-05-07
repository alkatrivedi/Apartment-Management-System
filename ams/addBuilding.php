<?php
$db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
  or die('error connect to server');
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['who'] != 'a')
  header("location: adminLogin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $bname = $_POST['bname'];
  $baddress = $_POST['address'];
  $sql = "SELECT * FROM building WHERE name='$bname' and address='$baddress'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  if ($count == 0) {
    $sql = "INSERT into building (name, address) VALUES ( '$bname', '$baddress')";
    $result = mysqli_query($db, $sql);
    header("location: addBuilding.php");
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
  <!-- <title>Building</title> -->
  <title>HomeRiver Group</title>
  <link rel="stylesheet" href="css/admin_manage.css">

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
            <a class="nav-link" href="addBuilding.php">Buildings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addApart.php">Apartments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ownerRegister.php">Ownership</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              Welcome <?php echo $_SESSION['user']; ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <br><br><br>
  <div class="content container" style="text-align:center;">
    <!--nav bar-->
    <br> <br>
    <p style="font-size: 20px; font-weight: 500; color: darkblue;"> Add buiding </p>
    <br>

    <form method="post" class="form-add-building">
      <div class="row mb-3">
        <label for="bname" class="col-sm-3 col-form-label">Building name</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="bname" name="bname" required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="address" class="col-sm-3 col-form-label">Address</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="address" name="address" required>
        </div>
      </div>
      <button type="submit" class="btn btn-primary mt-3 mb-4">Submit</button>
    </form>

    <br> <br>

    <!--table-->
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Building id</th>
          <th scope="col">Building name</th>
          <th scope="col">Address</th>
        </tr>
      </thead>
      <tbody>
        <?php
        function component($id, $name, $address)
        {
          $element = '<tr>
               <th scope="row">' . $id . '</th>
              <td>' . $name . '</td>
              <td>' . $address . '</td>
               </tr>';

          echo $element;
        }

        $query = "SELECT * FROM building";
        mysqli_query($db, $query) or die('error querring database.');
        $result = mysqli_query($db, $query);
        while ($row = mysqli_fetch_array($result)) {
          component($row['id'], $row['name'], $row['address']);
        }
        mysqli_close($db);
        ?>
      </tbody>
    </table>
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
        <a class="link-1" href="addBuilding.php">Buildings</a>
        <a href="addApart.php">Apartments</a>
        <a href="ownerRegister.php">Ownership</a>
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