<?php
require '../model/dborm_connect.php';
require '../model/user.php';
 //if(!isset($_COOKIE['UserID']))
 //header("location:../index.php");
 $customer= new Customer();   
 if(isset($_GET['id']))
 $customer->id=$_GET['id'];
 $customer->getCustomerDetails();

if(isset($_POST['submit']))
 {
  $customer->user_name=$_POST['username'];
  $customer->gender=$_POST['gender'];
  $customer->phone=$_POST['phone'];
  $customer->email=$_POST['email'];
  $customer->id=$_POST['id'];

  $customer->editClientData();  
 }
 
include("../views/header.php");
?>
					           <div class="slider-caption" style="width:100%">
					          	 <div class="slider-caption-left text-center" style="width:50%">						
									  
								<form action="searchMembers.php" method="get">
					          	 	<h1> &nbsp;&nbsp; Search FOR Members</h1>
										<div style="margin-top:60px;  margin-bottom:30px; color:#8d7662;"><span style="color:#8cc0d3; font-weight:100; font-size:1.2em;">Search by </span>
										<label>
										<input type="radio" name="Field" value="name" checked="checked"/>Username 
										</label>
										
										<label><input type="radio" name="Field" value="email"/>Email</label>
										<label><input type="radio" name="Field" value="phone_number" />Phone No</label>
											</div>
										<div style="margin-top:30px;"><span style="color:#8cc0d3; font-weight:100; font-size:1.2em;"> Value to search</span>
										 <input name="fvalue" type="text" /></div><div style="margin-top:30px;">
                                         <input name="submit" type="submit" style="padding: 0.4em 3em; color: #FFF;font-size: 1.2em;text-transform: uppercase;text-decoration: none;background: radial-gradient(ellipse at center,#FF8DB4 0%,#FF8DB4 50%,#FF8DB4 100%);"value="Search" /></div>
                                         <?php //echo $tbl; ?>									  
									  </form>
					          	 </div>
					          	  <div class="slider-caption-right" style="width:50%">
                                  <h1>&nbsp;</h1>
										   <div class="login-right wow fadeInRight" data-wow-delay="0.4s">
											<h3>Edit Client Information</h3>
											<form action="editUser.php" method="post"> 
										<input type="hidden" name="id" value="<?php echo $customer->id; ?>" />
											  <div>
												<span>Email <label></label></span>
												<input type="text" name="email" required="required" type="text" value="<?php echo $customer->email; ?>"> 
											  </div> <div>
												<span>Username<label></label></span>
												<input type="text" name="username" required="required" value="<?php echo $customer->user_name; ?>"> 
											  </div> <div>
												<span>Phone Number</span>
												<input name="phone" required="required"  maxlength="11" type="text" value="<?php echo $customer->phone; ?>"> 
											  </div>
											  <div>
												<span>Gender<label></label></span>
												<input type="radio" name="gender" value="m" <?php if($customer->gender=="m") print "checked"; ?> />&nbsp;Male&nbsp;&nbsp;
								<input type="radio" name="gender" value="f" <?php if($customer->gender=="f") print "checked"; ?> />&nbsp;Female
											  </div>
							 <p style="margin-left:400px;">
								<input type="submit" name="submit" value="Save changes">
							</p>
											</form>
											</div>
										   <div class="clearfix"> </div>
</div>
<?php
  include("../views/footer.php");