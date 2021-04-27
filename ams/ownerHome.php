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
     <h3>
         Number of Apartments:
          <?php
              $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
              or die('error connect to server');
              $sql="SELECT * FROM ownership WHERE ownerid= $owner";
              $result = mysqli_query($db,$sql);
              $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
              $count = mysqli_num_rows($result); 
              echo $count;
          ?>
     </h3>
     <h3>
       Number of Tenants:
       <?php
              $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
              or die('error connect to server');
             
              $sql="SELECT * FROM ownership WHERE ownerid= $owner";
              $result = mysqli_query($db,$sql);
              $count=0;
              while($row=mysqli_fetch_array($result))
              {
                $sql1="SELECT * FROM tenant WHERE  aid= ". $row['aid'];
                $result1 = mysqli_query($db,$sql1);
                 $r=mysqli_fetch_array($result1);
                $count+= mysqli_num_rows($result1); 
               }
               echo $count;
          ?>
     </h3>
     </div>
     


</body>
</html>