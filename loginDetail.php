<?php
include("model/user.php");


if(!isset($_COOKIE['UserID']))
header("location:index.php");
$customer=new Customer();
$customer->getCustomerDetails();

if(isset($_POST['changeEmail'])){
$customer->email=$_POST['email']; 
$customer->changeEmail();
}


if(isset($_POST['submit']))
if($_POST['pass1']==$_POST['pass2'])
{
$customer->pass=$_POST['password'];
$customer->changePassword($_POST['pass1']);
}
else
$customer->msg="Passwords are not the same";



include("header.php");
?>


	<div class="content">
	<div class="container">
	
		<div class="login-page">
			   <div class="account_grid">
			   <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
			    
			  	 <h3>Change Email</h3>
				 	<div class="login-right">
					<form action="loginDetail.php" method="post">
					<span>Email Address<label>*</label></span><p>
					<input type="text" name="email" required="required" value="<?php echo $customer->email; ?>"> </p>
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
</div>
</div>
	<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="footer-top">
				<div class="col-md-3 location">
					<h4>location</h4>
					<p>#04 Dist.City,State,PK</p>
					<h4>hours</h4>
					<p>Weekdays 7 a.m.-7 p.m.</p>
					<p>Weekends 8 a.m.-7 p.m.</p>
					<p>Call for Holidays Hours.</p>
				</div>
				<div class="col-md-3 customer">
					<h4>customer service</h4>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod. </p>
					<h4>phone</h4>
					<h6>1(234)567-8910</h6>
					<h4>contact us</h4>
					<h6>contact us page.</h6>
				</div>
				<div class="col-md-3 social">
					<h4>get social</h4>
					<div class="face-b">
						<img src="images/foot.png" title="name"/>
						<a href="#"><i class="fb"> </i></a>
					</div>
					<div class="twet">		
						<img src="images/foot.png" title="name"/>
							<a href="#"><i class="twt"> </i></a>
					</div>	
				</div>
				<div class="col-md-3 sign">
					<h4>sign up for news later</h4>	
						<form>
							<input type="text" class="text" value="YOUR EMAIL" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'YOUR EMAIL ';}">
						</form>
				</div>
					<div class="clearfix"> </div>
			</div>
			<div class="footer-bottom">
				<p>Template by <a href="http://w3layouts.com" target="_blank"> w3layouts</a></p>
			</div>
		</div>
	</div>
	<!-- /footer -->
	</body>
</html>

