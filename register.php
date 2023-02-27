<?php
require 'config.php';
session_start();
error_reporting(0);
$msg = "";
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["submit"]))
{
  $name = $_POST["name"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = md5($_POST["password"]);
  $confirmpassword = md5($_POST["cpassword"]);
  $duplicate = mysqli_query($conn, "SELECT * FROM login WHERE name = '$username' OR email = '$email'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Username or Email Has Already Taken'); </script>";
  }
  else if($password !== $confirmpassword){
      echo
      "<script> alert('Password Does Not Match'); </script>";

    }
    else if ($_POST["captcha"] != $_SESSION["captcha_code"] OR $_SESSION["captcha_code"]=='')  {
    echo "<script>alert('Incorrect verification code');</script>" ;


  } 
    
  else{
  
      $query = "INSERT INTO login VALUES('$name','$username','$email','$password')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Registration is Successful'); </script>";       
}
  }
    



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
	#message {
  		display:none;
  		color:	 #000;
  		position: relative;
 		padding: 20px;
  		margin-top: 10px;
	}
	#message p {
  		padding: 10px 35px;
  		font-size: 18px;
	}
	.valid {
  		color: green;
	}
	.invalid {
  		color: red;
	}
</style>
	<title>Cafe Register Form</title>
  <head>

  <body>
<div class="container">
<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
<div class="input-group">
<input type="text" placeholder="Username" autocomplete="off" name="username" value="<?php echo $username; ?>" required>
</div>
<div class=input-group>  
    <input type="email" id="email" name="email" autocomplete="off" placeholder=Email value="<?php echo $email; ?>" required>
   </div>
   <div class=input-group>
    <input type="password" placeholder=Password id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php echo $_POST['password']; ?>" required>
    </div>
    <div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
<div class=input-group>
    <input type="password" onfocusout="myFunction()" placeholder=Password id="cpassword" name="cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php echo $_POST['cpassword']; ?>" required>
    </div>
    <div id="message">
       <p id="notmatch" class=invalid>Password doesnot match</p>
</div>
<div class="input-group">
<input type="text" placeholder="Enter Captcha" name="captcha" required>
</div>
<div class="input-group">
<img src="captcha.php"/>
</div>
<div class="input-group">
<button name="submit" class="btn">Register</button>
</div>
<p class="login-register-text">Already have an account? <a href="index.php">Login Here</a>.</p>
</form>
</div>
<script>  
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var cpass=document.getElementById("cpassword");
var capt=document.getElementById("captcha");
var capt1="<?php echo"$captcha_code"?>"
// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
 
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
 
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
 
}
</script>

</body>
</html>

</body>
</html>

