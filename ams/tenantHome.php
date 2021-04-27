<?php
   session_start();
   if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['who']!='t')
     header("location: tenantLogin.php");
    

     $tid=$_SESSION['tid'];
     if($_SERVER["REQUEST_METHOD"] == "POST") {
      echo $tid; 
      $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')  or die('error connect to server');
      date_default_timezone_set('Asia/Kolkata');
      $td = date("Y-m-d", time()); 
     
      $ww = "INSERT into payment (tenantid, paid_date) VALUES( $tid, '$td')";
      mysqli_query($db, $ww) or die('error444 querring database.');
      
      header("location: payments.php");
      exit;
     
   }
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
            <h3> My details </h3>

             <br>
              <br>
              <table class="table">
              <tbody>
             
                  <?php   
                    
                    $tid=$_SESSION['tid'];
                    $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')  or die('error connect to server');
                $sql="SELECT * FROM tenant WHERE id= $tid";
                mysqli_query($db, $sql) or die('error2 querring database.');
                $r1=mysqli_query($db, $sql);
                $row1=mysqli_fetch_array($r1);
                
                
                $sql2="SELECT * FROM apartment WHERE id=".$row1['aid'];
                mysqli_query($db, $sql2) or die('error3 querring database.');
                $r2=mysqli_query($db, $sql2);
                $row2=mysqli_fetch_array($r2);

                $sql3="SELECT * FROM building WHERE id=".$row2['bid'];
                mysqli_query($db, $sql3) or die('error4 querring database.');
                $r3=mysqli_query($db, $sql3);
                $row3=mysqli_fetch_array($r3);
                
                $sql4="SELECT * FROM ownership WHERE aid=".$row1['aid'];
                mysqli_query($db, $sql4) or die('error5 querring database.');
                $r4=mysqli_query($db, $sql4);
                $row4=mysqli_fetch_array($r4);
                
                $sql5="SELECT * FROM owner_details WHERE id=".$row4['ownerid'];
                mysqli_query($db, $sql5) or die('error6 querring database.');
                $r5=mysqli_query($db, $sql5);
                $row5=mysqli_fetch_array($r5);


                 echo  '<tr><th scope="row">Name</th><td>'.$row1['name'].'</td> </tr>
                     <tr><th scope="row">Email </th><td>'.$row1['email'].'</td></tr>
                   <tr><th scope="row">Phone </th><td>'.$row1['phone'].'</td></tr>
                   <tr><th scope="row">Building Name </th><td>'.$row3['name'].','.$row3['address'].'</td></tr>
                   <tr><th scope="row">Apartment Number </th><td>'.$row2['apart_num'].'</td></tr>
                   <tr><th scope="row">Owner Name </th><td>'.$row5['name'].'</td></tr>
                   <tr><th scope="row">Owner Email </th><td>'.$row5['email'].'</td></tr>
                   <tr><th scope="row">Owner Phone </th><td>'.$row5['phone'].'</td></tr>
                   <tr><th scope="row">Rent </th><td>'.$row1['rent'].'</td></tr>';
             
                
             ?> 
              </tbody>     
              </table>
              <form action="" method="post">
        <button type="submit" class="btn btn-primary">Pay Rent</button>
     </form>
     </div>
    
       

</body>
</html>