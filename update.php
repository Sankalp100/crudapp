<?php include "config/config.php"; ?>
<?php
    if(isset($_GET['upd'])){
        $id = $_GET['upd'];
        $query = "SELECT * FROM users WHERE id = $id";
        $fire = mysqli_query($con,$query) or die("can not fetch the data.".mysqli_error($con));
        $user = mysqli_fetch_assoc($fire);
    }
?>
<!--Update Data-->
<?php 
   if(isset($_POST['update'])){
       $first_name = $_POST['first_name'];
       $last_name = $_POST['last_name'];
       $email = $_POST['email'];

       $query = "UPDATE users SET first_name ='$first_name',last_name = '$last_name',email='$email' WHERE id=$id";  

       $fire = mysqli_query($con,$query) or die("cannot update data into database". mysqli_error($con));

       if($fire) header("Location:index.php");
   }
   ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="col-lg-6 col-lg-offset-3">
                    <h3>Update Data</h3>
                    <hr>
                    <form name="signup" id="signup" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input value="<?php echo $user['first_name']?>" name="first_name" id="firstname" type="text" class="form-control" placeholder="firstname">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input value="<?php echo $user['last_name']?>" name="last_name" id="username" type="text" class="form-control" placeholder="lastname">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input value="<?php echo $user['email']?>" name="email" id="email" type="email" class="form-control" placeholder="email">
                        </div>
                        
                        
                        <div class="form-group">
                            <button name="update" id="update" class="btn btn-warning btn-block">Update</button>
                        </div>
                    </form>
                </div>
                
            </div>
            
        </div>
        
    </div>
</body>
</html>