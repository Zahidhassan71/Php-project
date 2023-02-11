<?php
session_start();

$conn = new mysqli('localhost','root','','user_database');
if(!$conn){
}

 $empty_email = $empty_password = '';
if(isset($_POST['Submit'])){
    $user_email= $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    $md5_user_password = md5($user_password);

    if(empty($user_email)){
        $empty_email = "Enter your Email";
    }
    if(empty($user_password)){
        $empty_password = "Enter your Password";
    }
    if(!empty($user_email) && !empty($user_password)){
       $sql = "SELECT * FROM user_db WHERE user_email= '$user_email' AND user_password= '$md5_user_password' ";
       $query = $conn->query($sql);
       if($query->num_rows > 0){
          $_SESSION['login'] = 'login success';
          header('location:dashbord.php');
      }else{
        echo 'Not found';
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
    <title>Login page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="col-4"></div>
          
     <div class="container col-4">
        <div class="row">    
            <form action="login.php" method="POST">
            <?php  
             if(isset($_GET['usercreated'])){
               echo 'User create successfully.';
             }
          ?>
              <div>
                <h5 class="dotted">Login Form</h5>
              </div>               
              <div>
              <input type="email"  name="user_email" value="<?php if(isset($_POST['Submit'])){ echo $user_email;}?>" placeholder="Enter your Email.."><br>
                <?Php if(isset($_POST['Submit'])){ echo "<span class='text-danger'>" . $empty_email."</span>";} ?>
              </div>
               <div>
               <input type="password" name="user_password" value="<?php if(isset($_POST['Submit'])){echo $md5_user_password;}?>" placeholder="Enter your Password.."><br>
                <?Php if(isset($_POST['Submit'])){ echo "<span class='text-danger'>" . $empty_password."</span>";} ?>
               </div>
               <div>
                <button class="btn btn-success" name="Submit">Submit</button>
                <h5>Create an Account? <a href="index.php">Register</a></h4>
              </div>
            </form>     
        </div>
     </div>
     <div class="col-4"></div>
</body>
</html>