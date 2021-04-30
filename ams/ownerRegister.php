<?php
   $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
   or die('error connect to server');
   session_start();
   if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['who']!='a')
      header("location: adminLogin.php");
 
      if($_SERVER["REQUEST_METHOD"] == "POST") {
     $mail4=$_POST['email'];
     $password4=$_POST['pass'];
     $name4=$_POST['name'];
     $phn4=$_POST['phn'];
     $aid4=$_POST['getap'];
     $sql="SELECT * FROM ownership WHERE aid=$aid4";
     $result = mysqli_query($db,$sql);
     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     $count = mysqli_num_rows($result);
     if($count==0)
     {
       
       $sql1="SELECT * FROM owner_details WHERE email='$mail4'";
       $result= mysqli_query($db,$sql1);
       $row= mysqli_fetch_array($result, MYSQLI_ASSOC);
       $count2 = mysqli_num_rows($result);
       if($count2==0)
       {
       $sql="INSERT into owner_details ( email, password, name, phone ) VALUES ( '$mail4', '$password4', '$name4', '$phn4')";
       $result = mysqli_query($db,$sql);
       $sql="SELECT * from owner_details WHERE email='$mail4'";
       $result=mysqli_query($db, $sql);
       $row=mysqli_fetch_array($result);
       $oid=$row['id'];
       
       $sql="INSERT into ownership( aid, ownerid) VALUES ( $aid4, $oid)";
       $result=mysqli_query($db, $sql);
       header("location: addBuilding.php ");
       }
       else
       {
           if($row['password']==$password4)
           {
            $oid=$row['id'];
            $sql="INSERT into ownership( aid, ownerid) VALUES ( $aid4, $oid)";
            $result=mysqli_query($db, $sql);
            header("location: addBuilding.php");
           }
           else
           {
            header("location:ownerRegister.php");
           }
       }
     
     }
     else
     {
         header("location:ownerRegister.php");
     }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    
    <SCRIPT language=JavaScript><!--
       function reload(form)
        {
       var val1=form.getbn.options[form.getbn.options.selectedIndex].value;
       var val2=document.getElementById("name").value;
       var val3=document.getElementById("email").value;
       var val4=document.getElementById("pass").value;
       var val5=document.getElementById("phn").value;

       self.location='ownerRegister.php?getbn='+val1+'&name='+val2+'&email='+val3+'&pass='+val4+'&phn='+val5 ;

     }
//-->

</script>

    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="">Apartment Management</a>
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
                    <a class="nav-link" href="">Welcome <?php echo $_SESSION['user']; ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
      <?php
    @$getbn=$_GET['getbn'];
    @$name=$_GET['name'];
    @$email=$_GET['email'];
    @$pass=$_GET['pass'];
    @$phn=$_GET['phn'];
    ?>
     <div class="container" style="text-align:center;">
        <!--nav bar-->
          <br> <br>
        <!--login-->
        <form action="" method="post" style="margin: 0 auto; width:600px;">
             <div class="row mb-3">
              <label for="name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name"
                 <?php
                   if(isset($name) and strlen($name)>0)
                   echo 'value ='.$name. ' ';
                   else echo 'value="" ';
                 ?>
                required>
               
              </div>
            </div>
            <div class="row mb-3">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email"
                <?php
                   if(isset($email) and strlen($email)>0)
                   echo 'value ='.$email. ' ';
                   else echo 'value="" ';
                 ?>
                required>
               
              </div>
            </div>
            <div class="row mb-3">
              <label for="pass" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="pass" name="pass" 
                <?php
                   if(isset($pass) and strlen($pass)>0)
                   echo 'value ='.$pass. ' ';
                   else echo 'value="" ';
                 ?>
                required>
               
              </div>
            </div>
            
            <div class="row mb-3">
              <label for="phn" class="col-sm-2 col-form-label">Phone Number</label>
              <div class="col-sm-10">
                <input type="tel" class="form-control" id="phn" name="phn"
                <?php
                   if(isset($phn) and strlen($phn)>0)
                   echo 'value ='.$phn. ' ';
                   else echo 'value="" ';
                 ?>
                required>
                
              </div>
            </div>

            <div  class="row mb-3">
           <label for="getbn" class="col-sm-2 col-form-label">Select Building</label>
             <div  class="col-sm-10">
              <select class="form-select" id="getbn" name="getbn" required onchange="reload(this.form)">
                  <option value="">  </option>
                 <?php
                     
                     
                     $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
                     or die('error connect to server');
                     $query1="SELECT * FROM building";
                     mysqli_query($db, $query1) or die('error querring database.');
                     $result=mysqli_query($db, $query1);
                     while($row=mysqli_fetch_array($result))
                     {  if($row['id']==@$getbn)
                        echo '<option selected value='.$row['id'].'>'.$row['name'].' </option>';
                        else
                        echo '<option  value='.$row['id'].'>'.$row['name'].','.$row['address'] .'</option>';
                  
                      }
                  ?>

         </select>
             
          </div>
                    </div>
          
          <div  class="row mb-3">
           <label for="getap" class="col-sm-2 col-form-label">Select Apartment</label>
             <div  class="col-sm-10">
              <select class="form-select" id="getap" name="getap" required >
                  <option value="">  </option>
              <?php
                
                
                  function  apfunc($id, $name)
                   {   $element= ' <option value='. $id .'>'. $name.'</option>';
                      echo $element;
                    }
                    if(isset($getbn) and strlen($getbn)>0)
                    {
                    
                     $db = mysqli_connect('localhost', 'root', '', 'apartmentdb')
                     or die('error connect to server');
                     $p=(int)$getbn;
                     $query2="SELECT * FROM apartment WHERE bid= $p";
                     mysqli_query($db, $query2) or die('error querring database.');
                     $result=mysqli_query($db, $query2);
                     while($row=mysqli_fetch_array($result))
                     {
                        apfunc($row['id'],$row['apart_num']);
                  
                      }
                    }
              ?>
               
         </select>
          </div>
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>


     </div>
</body>
</html>