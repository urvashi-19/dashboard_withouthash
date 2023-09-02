
<?php
     $showError = false;
     $showAlert = false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
     require 'partial/dbconnect.php';

     $username = $_POST["username"];
     $password = $_POST["password"];
     $cpassword = $_POST["cpassword"];


     $existSql = "SELECT * FROM `dashboard` WHERE username = '$username'";
     $result = mysqli_query($conn , $existSql);
     $numrow = mysqli_num_rows($result);

     if($numrow>0){
        $showError = "User already exsist!";
     }

     else{
        if(($password == $cpassword)){

            
            //$hash = password_hash($password , PASSWORD_DEFAULT);
           $hash = $password;
         
            $sql = "INSERT INTO `dashboard` ( `username`, `password`, `dt`) VALUES
             ('$username', '$hash', current_timestamp()); ";
      
            $result = mysqli_query($conn , $sql);   // to make query run;
          if($result){
            
            $showAlert = true;
   }

        }

        else{
            $showError = "Password do not match";
        }
     }

    }


?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signin  page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
   
    <?php require 'partial/nav.php'?>
    <?php 
    if($showAlert){
       
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success !</strong> You account is now created.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

    }

    ?>

<?php
    if($showError){
       
         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
   <strong>Error !</strong>' .$showError.'
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>';

     }
     ?>




    <div class="container">
        <h1 class="text-center">Welcome to Signin Page</h1>
        <form action = "/login1/signin.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
  </div>
  <button type="submit" class="btn btn-primary">Signin</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
  </body>
</html>