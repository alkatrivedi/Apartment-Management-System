<?php
      $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
    or die('error connect to server');
    session_start();
   if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['who']!='a')
      header("location: adminLogin.php");
      
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $bname=$_POST['getbn'];
      $num=$_POST['anum'];
      $des=$_POST['desc'];
      $sql="SELECT * FROM apartment WHERE apart_num = $num and bid = $bname";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      if($count==0)
      {
        $sql="INSERT into apartment ( bid, apart_num, description) VALUES ( $bname, $num, '$des')";
        $result = mysqli_query($db,$sql);
        header("location: addApart.php");
      }
   } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartments</title>
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
                    <a class="nav-link" href="addBuilding.php">Buildings</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="addApart.php">Apartments</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="ownerRegister.php">Ownership</a>
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
          <br> <br>
        <!--login-->

        <p> Add Apartment </p>
            <br>
        <form  method="post">
        <div  class="row mb-3">
        <label for="getbn" class="col-sm-2 col-form-label">Select Building</label>
          <div  class="col-sm-10">
              <select class="form-select" id="getbn" name="getbn" required >
                  <option value="">  </option>
                 <?php
                     
                     function  func($id, $name, $addrs)
                    {   $element= ' <option value='. $id .'>'. $name.','.$addrs.'</option>';
                         echo $element;
                     }
                    
                     $query="SELECT * FROM building";
                     mysqli_query($db, $query) or die('error querring database.');
                     $result=mysqli_query($db, $query);
                     while($row=mysqli_fetch_array($result))
                     {
                        func($row['id'],$row['name'],$row['address']);
                  
                      }
                  ?>

         </select>
          </div>
        </div>

            <div class="row mb-3">
              <label for="anum" class="col-sm-2 col-form-label">Apartment Number</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="anum" name="anum" required>
                
              </div>
            </div>
            
            <div class="row mb-3">
              <label for="desc" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="desc" name="desc" required>
                
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          <br> <br>
     <!--table-->
          <table class="table">
           <thead>
          <tr>
            <th scope="col">Apartment id</th>
            <th scope="col">Building id</th>
            <th scope="col">Building Name</th>
            <th scope="col">Apartment Number</th>
            <th scope="col">Description</th>          
         </tr>
         </thead>
         <tbody>
          <?php
            function component($id, $bid, $name, $adds, $num, $des)
            {
               $element='<tr>
               <th scope="row">'. $id.'</th>
              <td>'.$bid.'</td>
              <td>'.$name.','.$adds.'</td> 
              <td>'.$num.'</td>
              <td>'.$des.'</td>
               </tr>';
              
                  echo $element;
            }
            
            $query="SELECT * FROM apartment";
            mysqli_query($db, $query) or die('error querring database.');
            $result=mysqli_query($db, $query);
            while($row=mysqli_fetch_array($result))
            {   $t=$row['bid'];
                 $sql="SELECT * FROM building WHERE id = $t";
                mysqli_query($db, $sql) or die('error querring database.');
                $r=mysqli_query($db, $sql);  
                $p= mysqli_fetch_array($r);
               component($row['id'],$row['bid'], $p['name'], $p['address'], $row['apart_num'], $row['description']);
         
             }
      mysqli_close($db); 
         ?>
     </tbody>
    </table>
     </div>
</body>
</html>