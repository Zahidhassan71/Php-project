<?php

$conn = new mysqli('localhost','root','','user_database');
if(!$conn){
    echo 'Not connect';
}

 $empmsg_firstName =  $empmsg_lastName =  $empmsg_email = $empmsg_password = $empmsg_password_again = '';
if(isset($_POST['Submit'])){
    $user_firstName = $_POST['user_firstName'];
    $user_lastName = $_POST['user_lastName'];
    $user_email= $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password_again = $_POST['user_password_again'];
    
     $md5_user_password = md5($user_password);

if(empty($user_firstName)){
    $empmsg_firstName  = 'Enter your first name.';
}
if(empty($user_lastName)){
    $empmsg_lastName  = 'Enter your last name.';
}
if(empty($user_email)){
    $empmsg_email = 'Enter your Email.';
}
if(empty($user_password)){
    $empmsg_password = 'Enter your Password.';
}
if(empty($user_password_again)){
    $empmsg_password_again = 'Enter your Password again.';
}

if(!empty($user_firstName) && !empty($user_lastName) && !empty($user_email) && !empty($user_password) && !empty($user_password_again)){
  if($user_password === $user_password_again){
    
     $sql = "INSERT INTO user_db (user_firstName,user_lastName,user_email,user_password) values ('$user_firstName', '$user_lastName','$user_email','$md5_user_password')";
    
     if($conn->query($sql) == TRUE){
        header('location:login.php?usercreated');
     }else{
        echo 'password not match';
    }
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="col-4"></div>
     <div class="container col-4">
        <div class="row">
            <form action="index.php" method="POST">
                <div>
                    <h5 class="dotted">Registration Form</h5>
                </div>
                <div>
                   <input type="text"  name="user_firstName" value="<?php if(isset($_POST['Submit'])){echo $user_firstName; } ?>" placeholder="Enter first name"><br>
                   <?Php if(isset($_POST['Submit'])){ echo "<span class='text-danger'>" . $empmsg_firstName."</span>";} ?>
                </div>
                <div>
                   <input type="text"  name="user_lastName" value="<?php if(isset($_POST['Submit'])){echo $user_firstName; } ?>"  placeholder="Enter last name"><br>
                   <?Php if(isset($_POST['Submit'])){ echo "<span class='text-danger'>" . $empmsg_lastName."</span>";} ?>
                </div>
                <div>
                   <input type="email"  name="user_email" value="<?php if(isset($_POST['Submit'])){echo $user_email; } ?>"  placeholder="Enter Email"><br>
                   <?Php if(isset($_POST['Submit'])){ echo "<span class='text-danger'>" . $empmsg_email."</span>";} ?>
                </div>
                <div>
                   <input type="password" name="user_password" value="<?php if(isset($_POST['Submit'])){echo $user_password; } ?>" placeholder="Enter password"><br>
                   <?Php if(isset($_POST['Submit'])){ echo "<span class='text-danger'>" . $empmsg_password."</span>";} ?>
                </div>
                <div>
                   <input type="password"  name="user_password_again" value="<?php if(isset($_POST['Submit'])){echo $user_password_again; } ?>" placeholder="Enter repassword"><br>
                   <?Php if(isset($_POST['Submit'])){ echo "<span class='text-danger'>" . $empmsg_password_again."</span>";} ?>
                </div>
                <div>
                   <button class="btn btn-success" name="Submit">Submit</button>
                   <h5>Have an account? <a href="Login.php">Login</a></h4>
                </div>
            </form>     
        </div>
     </div>
     <div class="col-4"></div>   
</body>

</html>