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
  <title>Building</title>
  <link rel="stylesheet" href="css/admin_manage.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="">HomeRiver Group</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
  <div class="container" style="text-align:center;">
    <!--nav bar-->
    <br> <br>


    <p style="font-size: 20px; font-weight: 500; color: darkblue;"> Add buiding </p>
    <br>
    <form method="post" style="margin: 0 auto; width:600px;">
      <div class="row mb-3">
        <label for="bname" class="col-sm-2 col-form-label">Building name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="bname" name="bname" required>

        </div>
      </div>
      <div class="row mb-3">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="address" name="address" required>

        </div>
      </div>


      <button type="submit" class="btn btn-primary mt-3">Submit</button>
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
</body>

</html>