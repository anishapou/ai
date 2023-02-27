<?php
require 'config.php';
session_start();
$msg = "";
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["submit"]))
{
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = md5($_POST["password"]);
  $confirmpassword = md5($_POST["confirmpassword"]);
  $duplicate = mysqli_query($conn, "SELECT * FROM login WHERE name = '$username' OR email = '$email'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Username or Email Is Already Taken'); </script>";
  }
  else if($password !== $confirmpassword){
      echo
      "<script> alert('Password Does Not Match'); </script>";

    }
    else if ($_POST["captcha"] != $_SESSION["captcha_code"] OR $_SESSION["captcha_code"]=='')  {
    echo "<script>alert('Incorrect verification code');</script>" ;


  } 
    
  else{
  
      $query = "INSERT INTO login VALUES('','$username','$email','$password')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Registration Is Successful'); </script>";       
}
  }
    



?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
    <title>Login Form - Brave Coder</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
   
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />

</head>

<body>

    <section class="w3l-mockup-form">
        <div class="container">
           
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/image2.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Register Here</h2>
                        <p> Registration </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="text" class="username" name="username" placeholder="Enter Username" value="<?php if (isset($_POST['submit'])) { echo $username; } ?>" required>
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" required minlength=8 pattern= "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                            <input type="password" class="confirm-password" name="confirmpassword" placeholder="Confirm Password" required>
                            <div class="input-group">
				                    <input type="text" placeholder="Enter Captcha" name="captcha" required>
			                      </div>
			                      <div class="input-group">
				                    <img src="captcha.php"/>
                            <button name="submit" class="btn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account! <a href="index.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </section>


    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>











  <!-- <head>
    <meta charset="utf-8">
    <title>Registration</title>
  </head>
  <body>
    <h2>Registration</h2>
    <form class="" action="" method="post" autocomplete="off">
      <label for="name">Name : </label>
      <input type="text" name="name" id = "name" required value=""> <br>
      <label for="username">Username : </label>
      <input type="text" name="username" id = "username" required value=""> <br>
      <label for="email">Email : </label>
      <input type="email" name="email" id = "email" required value=""> <br>
      <label for="password">Password : </label>
      <input type="password" name="password" id = "password" required value=""> <br>
      <label for="confirmpassword">Confirm Password : </label>
      <input type="password" name="confirmpassword" id = "confirmpassword" required value=""> <br>
      <button type="submit" name="submit">Register</button>
    </form>
    <br>
    <a href="login.php">Login</a>
  </body> -->
</html>
