<?php
session_start();

              if(isset($_COOKIE['user_name'])&& isset($_COOKIE['user_id'])){
                           if($_COOKIE['user_id']==1){

                             header('location:/controller/adminhome.php');
                         }else{

                         	 header('location:/controller/clienthome.php');
                         }
              }elseif(isset($_SESSION['user_id']))
                   {
                           if($_SESSION['user_id']==1){

                             header('location:/controller/adminhome.php');
                         }else{

                         	 header('location:/controller/clienthome.php');
                         }     
                   }

require  __DIR__."/model/user.php";
 require __DIR__.'/model/dborm_connect.php';
$customer= new Customer();

if(isset($_POST['submit']))
{
$customer->email= $_POST['email'];
$customer->pass = $_POST['pass'];
if(isset($_POST['remember']))
$customer->validateCustomer(true);
else
$customer->validateCustomer();

}
require __DIR__."/header.php";
?>
					          	 <div class="slider-caption-left text-center">
					          	 	<h1>&nbsp;&nbsp;ARE YOU LOOKING FOR &nbsp;&nbsp;&nbsp; HOT, COLD&nbsp; AND DELECIOUS FRESH DRINKS?</h1>
					          	 	<p>DON'T WORRY, WE CAN HELP YOU! <br/>CHECK OUR BEST DRINKS.</p>
					          	 	<a class="buy-btn">Join Us</a>
					          	 </div>
								 
					          	  <div class="slider-caption-right">
								 
                                           <h1>&nbsp;</h1>
										   <div class="login-right wow fadeInRight" data-wow-delay="0.4s">
											<h3>REGISTERED CUSTOMERS</h3>
											<p>If you have an account with us, please log in.</p>
											<form action="index.php" method="post"> 
											  <div>
												<span>Email Address<label>*</label></span>
												<input type="text" name="email" required="required" type="email"> 
											  </div>
											  <div>
												<span>Password<label>*</label></span>
												<input name="pass" required="required" type="password" > 
											  </div>
											  <?php if(isset($_GET['error'])) echo "<div style='color:red'>invalid login please try again!</div>"; ?>
											  <p><input type='checkbox' id="remember" name='remember' />
					                             <label for="remember">Remember me</label>
						                      </p>
											  <a class="forgot" href="/controller/mail.php">Forgot Your Password?</a>
											  <input type="submit" name="submit" value="Login">
											</form>
										   </div>	


										   <div class="clearfix"> </div>
					          	  </div>
					          	  <div class="clearfix"> </div>
					          
							  
					       