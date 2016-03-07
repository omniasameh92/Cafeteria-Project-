<?php
session_start();
require '../model/dborm_connect.php';
require '../model/user.php';
    $user_id=0;
    $user_name;
              if(isset($_COOKIE['user_name'])&& isset($_COOKIE['user_id'])){
          
                              $user_name=$_COOKIE['user_name'];
                              $user_id=$_COOKIE['user_id'];
                              $login=true;
              }elseif(isset($_SESSION['user_id']))
                   {
                  
                             $user_name=$_SESSION['user_name'];
                               $user_id=$_SESSION['user_id'];
                              // echo $user_id;
                               $login=true;
                   }else{

                    header('location:../index.php');
                   }

                   if($user_id!=1){

                 	header('location:../index.php');
                  }
$customer=new Customer();
$customer->gender='m';
$email="";
$username="";
$phone="";


function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if(isset($_POST['submit']))
{
$emailvalid = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
     if(preg_match('/^[a-zA-Z]{5,}$/', $_POST['username'])) 
	     $customer->user_name=test_input($_POST['username']);
     else
	     $username=" should be alphanumeric & > or = 5 chars";
     if (!filter_var($emailvalid, FILTER_VALIDATE_EMAIL) === false) 
         $customer->email=test_input($_POST['email']);
	 else 
         $email=" Not a valid email address";
     if(preg_match("/^[0-9]{3}[0-9]{4}[0-9]{4}$/", $_POST['phone'])) 
         $customer->phone=test_input($_POST['phone']);
     else 
	     $phone=" Phone number format is invalid";
$customer->gender=test_input($_POST['gender']);
$customer->pass=test_input($_POST['password']);
if($_POST['password']==$_POST['pass2'])
{
if(!empty($customer->user_name) && !empty($customer->phone) && !empty($customer->pass)&& !empty($customer->email))
{
$password=test_input($_POST['password']);
$password=md5($password);
$customer->pass=$password;
$customer->addCustomer();
}
}else
$customer->msg="Passwords are not the same";
}
include("../views/header.php");
?>
<div class="" style="width:80%; margin-left:10%;">
		  <div class="register" style="margin-top:-100px;">
		  	  <form action="register.php" method="post"> 
				 <div class="register-top-grid">
				 <?php  echo $customer->msg; ?>
					<h3>PERSONAL INFORMATION</h3>
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
						<span>Username<label><?php if(isset($_POST['submit']) && $customer->user_name=="") echo "<font color='red'> * </font> $username"; ?></label></span>
						<input name="username" type="text"  value="<?=$customer->user_name?>"> 
					 </div>
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						<span>Mobile Number<label><?php if(isset($_POST['submit']) && $customer->phone=="") echo "<font color='red'> * </font> $phone"; ?></label></span>
						<input name="phone" type="text" maxlength="11" value="<?=$customer->phone?>"> 
					 </div>
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
						 <span>Email Address<label><?php if(isset($_POST['submit']) && $customer->email=="") echo "<font color='red'> * </font> $email"; ?></label></span>
						 <input type="text" name="email" value="<?php echo $customer->email; ?>"> 
					 </div>
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <p><span>Gender</span></p>
						<input id="input" type="radio" name="gender"  value="m"<?php if($customer->gender=="m") print "checked";?>/>&nbsp;&nbsp;Male
						 <input id="input1" type="radio" name="gender" value="f" <?php if($customer->gender=="f") print "checked";?>/>&nbsp;&nbsp;Female 
					 </div>
					   <a class="news-letter">
					   </a>
					 </div>
				     <div class="register-bottom-grid">
							<h3>LOGIN INFORMATION</h3>
							<div class="wow fadeInLeft" data-wow-delay="0.4s">
								<span>Password<label><?php if(isset($_POST['submit']) && $customer->pass=="") echo "<font color='red'> *</font>"; ?></label></span>
								<input type="password" name="password" >
							 </div>
							 <div class="wow fadeInRight" data-wow-delay="0.4s">
								<span>Confirm Password<label><?php if(isset($_POST['submit']) && $customer->pass=="") echo "<font color='red'> *</font>"; ?></label></span>
								<input type="password" name="pass2" >
							 </div>
					 </div>
				   <div >
					   <input  class="btn btn-primary"type="submit" name="submit" value="submit">
					   &nbsp;&nbsp;
                       <input class="btn btn-primary" type="reset"/>
					   <div class="clearfix"> </div>
				</div>
				</form>
				<div class="clearfix"> </div>

		   </div>
	<?php include("../views/footer.php"); ?>

