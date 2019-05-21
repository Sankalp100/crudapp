<?php include "config/config.php"; ?>

   <!--Delete Data-->
   <?php
        if(isset($_GET['del'])){
            $id = $_GET['del'];
            $query= "DELETE FROM employee WHERE id = $id ";
            $fire = mysqli_query($con,$query) or die("can not delete the data").mysqli_error($con);
            //if($fire) echo "Data deleted from database";
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
                    <h3>Add Employees</h3>
                    <hr>
                    <?php
                    if(isset($_GET['msg'])) echo $_GET['msg']; 
                    ?>
                    <form name="signup" id="signup" action="config/action.php" method="POST">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input name="first_name" id="firstname" type="text" class="form-control" placeholder="firstname" required>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input name="last_name" id="username" type="text" class="form-control" placeholder="lastname" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" id="email" type="email" class="form-control" placeholder="email" required>
                        </div>
                        
                        
                        <div class="form-group">
                            <button name="submit" class="btn btn-primary btn-block">ADD</button>
                        </div>
                    </form>
                </div>
                
            </div>
            
        </div>
        <div>
            <h3>USER DATA</h3>
            <hr>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query= "SELECT * FROM employee";
                    $fire= mysqli_query($con,$query) or die("".mysqli_error($con));

                    if(mysqli_num_rows($fire)>0){ 

                        while($user= mysqli_fetch_assoc($fire)){?>
                            
                        <tr>
                            <td><?php echo $user['first_name']?></td>
                            <td><?php echo $user['last_name']?></td>
                            <td><?php echo $user['email']?></td>

                            <td>
                                <a href="<?php $_SERVER['PHP_SELF'] ?> ? del=<?php echo $user['id']?> "
                                class="btn btn-sm btn-danger" >Delete</a>
                            </td>

                            <td>
                                <a href="update.php ? upd=<?php echo $user['id']?> "
                                    class="btn btn-sm btn-warning">Update</a>
                            </td>

                        </tr>
                        <?php
                        }
                    } else { ?>
                        <tr>
                            <td colspan="3" class="text-center">
                                <h2 class="text-muted">There is No Data to Show !!</h2>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>


                </tbody>
            </table>

        </div>
    </div>
</body>
</html>