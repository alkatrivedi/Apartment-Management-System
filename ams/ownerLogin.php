<?php
    $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
    or die('error connect to server');
   session_start();
   if(isset($_SESSION['user']) && $_SESSION['who']='o')
   header("location: ownerHome.php");
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['pass']); 
      
      $sql = "SELECT * FROM owner_details WHERE email = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
      
      $count = mysqli_num_rows($result);
    
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $who='o';
        $_SESSION['user'] = $row['name'];
        $_SESSION['loggedin']=true;
        $_SESSION['who']= $who; 
         $_SESSION['oid']= $row['id'];
         header("location: ownerHome.php");
      }else {
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
    <title>Owner Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
     <div class="container">
        <!--nav bar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Navbar</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="adminLogin.php">Admin Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Owner Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="tenantLogin.php">Tenant Login</a>
                  </li>
                
                </ul>
              </div>
            </div>
          </nav>
          <br> <br>
        <p>Owner Login</p>
        <form action="" method="post">
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


     </div>
</body>
</html>