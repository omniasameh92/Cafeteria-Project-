<?php
session_start();
require '../model/dborm_connect.php';
include("../model/user.php");

$customer=new Customer();
 if(isset($_COOKIE['user_id']))
 $customer->id=$_COOKIE['user_id'];
 if(isset($_SESSION['user_id']))
 $customer->id=$_SESSION['user_id'];
$customer->getCustomerDetails();

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
$email="";


if(isset($_POST['changeEmail'])){
$emailvalid = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
     if (!filter_var($emailvalid, FILTER_VALIDATE_EMAIL) === false) 
         $customer->email=test_input($_POST['email']);
	 else 
         $email=" Enter a valid email address or use the old one";
if($email=="")
$customer->changeEmail();
}


if(isset($_POST['submit']))
if($_POST['pass1']==$_POST['pass2'])
{
$password=test_input($_POST['password']);
$password=md5($password);
$customer->pass=$password;

$newpass=test_input($_POST['pass1']);
$newpass=md5($newpass);
$customer->changePassword($newpass);
}
else
$customer->msg="Passwords are not the same";



include("../views/header.php");
?>

<div class="" style="width:80%; margin-top:-100px; margin-left:10%;">

	<div style="float:right; margin-top:40px;"><a href="myaccount.php">Edit Account Information</a></div>
		<div class="login-page" >
			   <div class="account_grid">
			   <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
			    
			  	 <h3>Change Email</h3>
				 	<div class="login-right">
					<form action="loginDetail.php" method="post">
					<span>Email Address<label>*  <?php echo $email; ?></label></span><p>
					<input type="text" name="email" value="<?php echo $customer->email; ?>"> </p>
				  </div>
                  <input type="submit" class="acount-btn"name="changeEmail" value="Validate your email" />
					   <h3><?=$customer->msg;?></h3>
			   </div>
			    
			   <div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s">
			  	<h3>Change your password</h3>
				  <div>
					<span>Current Password</span>
					<input name="password" type="password" />
				  </div>
				  <div>
					<span>New Password</span>
					<input name="pass1" type="password" />
				  </div>				  
				  <div>
					<span>Confirm Password</span>
					<input name="pass2" type="password" />
				  </div>
				  <input type="submit" name="submit" value="Change">
				</form>
			   </div>	
			   <div class="clearfix"> </div>
			 </div>
		   </div>

		<?php include("../views/footer.php"); ?>



