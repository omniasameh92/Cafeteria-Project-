<?php
include("model/user.php");
$customer=new Customer();

if(isset($_POST['submit']))
if($_POST['password']==$_POST['pass2'])
{
$customer->user_name=$_POST['username'];
$customer->email=$_POST['email'];
$customer->gender=$_POST['gender'];
$customer->phone=$_POST['phone'];
$customer->pass=$_POST['password'];
$customer->addCustomer();

}else
$customer->msg="Passwords are not the same";

include("header.php");
?>
	<div class="content">
	<div class="main">
	   <div class="container">
		  <div class="register">
		  	  <form action="register.php" method="post"> 
				 <div class="register-top-grid">
					<h3>PERSONAL INFORMATION</h3>
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
						<span>Username<label>*</label></span>
						<input name="username" type="text" required="required" value="<?=$customer->user_name?>"> 
					 </div>
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						<span>Mobile Number<label>*</label></span>
						<input name="phone" type="text" maxlength="11"  value="<?=$customer->phone?>"> 
					 </div>
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
						 <span>Email Address<label>*</label></span>
						 <input type="text" name="email" required="required" value="<?php echo $customer->email; ?>"> 
					 </div>
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <p><span>Gender</span></p>
						<input id="input" type="radio" name="gender" required="required" value="m"<?php if($customer->gender=="m") print "checked";?>/>&nbsp;&nbsp;Male
						 <input id="input1" type="radio" name="gender" value="f" <?php if($customer->gender=="f") print "checked";?>/>&nbsp;&nbsp;Female 
					 </div>
					   <a class="news-letter">
					   </a>
					 </div>
				     <div class="register-bottom-grid">
							<h3>LOGIN INFORMATION</h3>
							<div class="wow fadeInLeft" data-wow-delay="0.4s">
								<span>Password<label>*</label></span>
								<input type="text" name="password" required="required">
							 </div>
							 <div class="wow fadeInRight" data-wow-delay="0.4s">
								<span>Confirm Password<label>*</label></span>
								<input type="text" name="pass2" required="required">
							 </div>
					 </div>
				   <div class="register-but">
					   <input type="submit" name="submit" value="submit">
					   <div class="clearfix"> </div>
				</div>
				</form>
				<div class="clearfix"> </div>

		   </div>
	     </div>
	    </div>
		</div>
	<?php include("footer.php"); ?>
	</body>
</html>

