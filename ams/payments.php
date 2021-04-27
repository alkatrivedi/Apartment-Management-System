<?php
   session_start();
   if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['who']!='t')
     header("location: tenantLogin.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner HomePage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    
</head>
<body>
    <div class="container">
    <?php
     $tid=$_SESSION['tid'];
     $rnt=$_SESSION['rent'];
     ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Navbar</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link" href="#">Welcome <?php echo $_SESSION['user']; ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                  </li>
                
                </ul>
              </div>
            </div>
            </nav>
               
              <br>
             <h2>Previous Payments</h2>
              <table class="table">
              <tbody>
               <thead>  <tr>
                  <th scope="col">#</th>
                  <th scope="col">Date Paid</th>
                  <th scope="col">Rent</th>
              </tr>
              </thead>
           <?php
              $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')  or die('error connect to server');
                $sql="SELECT * FROM payment WHERE tenantid= $tid";
                mysqli_query($db, $sql) or die('error2 querring database.');
                $r1=mysqli_query($db, $sql);
               
               while( $row1=mysqli_fetch_array($r1))
               {
                 echo '<tr><th scope="row">'.$row1['id'].'</th><td>'.$row1['paid_date'].'</td> <td>'.$rnt.'</td></tr>';
                 
               }

              
               

             ?>
      </div>
     
       

</body>
</html>