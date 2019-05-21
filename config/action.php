<?php require "config.php" ?>

<?php 
   if(isset($_POST['submit'])){
       $msg = "";
       $first_name = mysqli_real_escape_string($con,trim($_POST['first_name']));
       $last_name = mysqli_real_escape_string($con,trim($_POST['last_name']));
       $email = mysqli_real_escape_string($con,trim($_POST['email']));
       
       $first_name_valid = $last_name_valid =$email_valid = false;
       //Cheak First_Name
       if(!empty($first_name)){
           if(strlen($first_name) > 2 && strlen($first_name) <= 30){
               if(!preg_match('/[^a-zA-Z]/',$first_name)){
                // ALL Test Passed !!
                $first_name_valid = true;
                
               }else{ $msg .= "Firstname can contain only alphabets<br>";}
           }else{ $msg .= "Firstname must be in between 2 to 30 chars long. <br>";}
       }else{ $msg .= "Firstname can not be blank!! <br>";}
       
       //Check Last_Name
       if(!empty($last_name)){
            if(strlen($last_name) > 2 && strlen($last_name) <= 30){
                if(!preg_match('/[^a-zA-Z]/',$last_name)){
                    // ALL Test Passed !!
                    $last_name_valid = true;
                    
                }else{ $msg .= "Lastname can contain only alphabets<br>";}
            }else{ $msg .= "Lastname must be in between 2 to 30 chars long. <br>";}
        }else{ $msg .= "Lastname can not be blank!! <br>";}

       //Check Email
       if(!empty($email)){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                
                
                $query="SELECT email FROM employee WHERE email = '$email'";
                $fire= mysqli_query($con,$query) or die ("can not fire query to select email".mysqli_error($con));
                if(mysqli_num_rows($fire)>0) {
                    $msg .= "email is used !! <br>"; 
                }else{
                    // ALL Test Passed !!
                    $email_valid = true;
                }

            }else{$msg .= $email."is an invalid email address. <br>";}
       }else{ $msg .= "email can not be blank !! <br>";}

       if($first_name_valid && $last_name_valid && $email_valid){
        $query = "INSERT INTO employee(first_name,last_name,email) VALUES('$first_name','$last_name','$email')";  

        $fire = mysqli_query($con,$query) or die("cannot insert data into database". mysqli_error($con));
 
        if($fire){ 
            $msg = "Data submitted to database.";
            header("Location: ../index.php?msg=".$msg);
            }
       }else{
            header("Location: ../index.php?msg=".$msg);
       }
   }
   ?> 