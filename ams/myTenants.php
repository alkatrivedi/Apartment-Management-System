<?php
   session_start();
   if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['who']!='o')
     header("location: ownerLogin.php");
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
     $owner=$_SESSION['oid'];
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
                    <a class="nav-link" href="tenantRegister.php">Register Tenant</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="myTenants.php">My Tenants</a>
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
               $element='<tr>
               <th scope="row">'. $id.'</th>
              <td>'.$name.'</td>
              <td>'.$phn.'</td>
              <td>'.$buid.'</td>
              <td>'.$apart.'</td>
              <td>'.$rent.'</td>
              
               </tr>';
              
                  echo $element;
            }
            $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
            or die('error connect to server');
            $query="SELECT * FROM ownership WHERE ownerid=$owner";
            mysqli_query($db, $query) or die('error1 querring database.');
            $result=mysqli_query($db, $query);
            while($row=mysqli_fetch_array($result))
            {
                 //echo $row['aid'];
                 $sql="SELECT * FROM tenant WHERE aid= ".$row['aid'];
                 mysqli_query($db, $sql) or die('error2 querring database.');
                 $r1=mysqli_query($db, $sql);
                 $row1=mysqli_fetch_array($r1);
                 $count= mysqli_num_rows($r1); 
                
                 if($count==1)
                 {
                 $sql2="SELECT * FROM apartment WHERE id=".$row['aid'];
                 mysqli_query($db, $sql2) or die('error3 querring database.');
                 $r2=mysqli_query($db, $sql2);
                 $row2=mysqli_fetch_array($r2);

                 $sql3="SELECT * FROM building WHERE id=".$row2['bid'];
                 mysqli_query($db, $sql3) or die('error4 querring database.');
                 $r3=mysqli_query($db, $sql3);
                 $row3=mysqli_fetch_array($r3);
                 
                 
                 component($row1['id'], $row1['name'], $row1['phone'] , $row3['name'], $row2['apart_num'], $row1['rent']);
                 }

                 
             }
      mysqli_close($db); 
       ?>
     </div>
     


</body>
</html>