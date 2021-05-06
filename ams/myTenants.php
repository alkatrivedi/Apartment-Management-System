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
  <title>Owner HomePage</title>
  <link rel="stylesheet" href="css/owner_manage.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
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


  <div class="container mt-5" style="text-align:center;">
    <?php
    $owner = $_SESSION['oid'];
    ?>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Tenant id</th>
          <th scope="col">Tenant name</th>
          <th scope="col">Tenant email</th>
          <th scope="col">Building</th>
          <th scope="col">Apartment Number</th>
          <th scope="col">Rent</th>

        </tr>
      </thead>
      <tbody>
        <?php
        function component($id, $name, $phn, $buid, $apart, $rent)
        {
          $element = '<tr>
               <th scope="row">' . $id . '</th>
              <td>' . $name . '</td>
              <td>' . $phn . '</td>
              <td>' . $buid . '</td>
              <td>' . $apart . '</td>
              <td>' . $rent . '</td>
              
               </tr>';

          echo $element;
        }
        $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
          or die('error connect to server');
        $query = "SELECT * FROM ownership WHERE ownerid=$owner";
        mysqli_query($db, $query) or die('error1 querring database.');
        $result = mysqli_query($db, $query);
        while ($row = mysqli_fetch_array($result)) {
          //echo $row['aid'];
          $sql = "SELECT * FROM tenant WHERE aid= " . $row['aid'];
          mysqli_query($db, $sql) or die('error2 querring database.');
          $r1 = mysqli_query($db, $sql);
          $row1 = mysqli_fetch_array($r1);
          $count = mysqli_num_rows($r1);

          if ($count == 1) {
            $sql2 = "SELECT * FROM apartment WHERE id=" . $row['aid'];
            mysqli_query($db, $sql2) or die('error3 querring database.');
            $r2 = mysqli_query($db, $sql2);
            $row2 = mysqli_fetch_array($r2);

            $sql3 = "SELECT * FROM building WHERE id=" . $row2['bid'];
            mysqli_query($db, $sql3) or die('error4 querring database.');
            $r3 = mysqli_query($db, $sql3);
            $row3 = mysqli_fetch_array($r3);


            component($row1['id'], $row1['name'], $row1['phone'], $row3['name'], $row2['apart_num'], $row1['rent']);
          }
        }
        mysqli_close($db);
        ?>
  </div>

  <!-- bootstrap jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/ reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>