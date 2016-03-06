<?php
session_start();
require '../model/dborm_connect.php';
include("../model/user.php");

 $customer= new Customer();   
 if(isset($_COOKIE['user_id']))
 $customer->id=$_COOKIE['user_id'];
 if(isset($_SESSION['user_id']))
 $customer->id=$_SESSION['user_id'];
 
 $customer->getCustomerDetails();


if(isset($_POST['submit'])||isset($_POST['upload']))
 {
  $customer->user_name=$_POST['username'];
  $customer->gender=$_POST['gender'];
  $customer->phone=$_POST['phone']; 
 }
 
 if(isset($_POST['submit']))
    $customer->updateCustomerData();
 if(isset($_POST['upload']))
  {
  if(empty($_FILES['userImg']['tmp_name']))
  $customer->updateCustomerData();
  $customer->msg=$customer->uploadFile($_FILES['userImg'],"userImgs/$customer->id.jpg");
  }
 
include("../views/header.php");
?>


<div class="slider-caption" style="width:80%; margin-left:10%; margin-top:70px;">


				<div class="col_1_of_account span_1_of_account">
					
					<h4 class="title">Change Picture</h4>
					 <h5 class="sub_title"></h5>
					 <p>
					  <?php 
      
						$file="http://localhost/cafeteria/userImgs/$customer->id.jpg";
						$file_headers = @get_headers($file);
						if($file_headers[0] == 'HTTP/1.1 404 Not Found')
						echo '<div style="height:200px; width:200px;"><img src="../images/profilePic.jpg" height="200" width="200"></div>'; 
						else
						echo '<div style="height:200px; width:200px;"><img src="../userImgs/'.$customer->id .'.jpg" height="200" width="200"></div>';	  
												  
					  ?>
					 
					</p>
					<form action="myaccount.php" method="post" enctype="multipart/form-data">
					<input id="file" type="file" name="userImg" MAX_FILE_SIZE="30000" value="upload your picture"/>
					   <input id="upload" type="submit" name="upload" value=" Upload " />
					 <div class="clear"></div>

				</div>
				<div class="col_1_of_account span_1_of_account">
				  <div class="account-title">
				   <div style="float:right; margin-top:-40px;"><a href="loginDetail.php">Change your password</a></div>
					<h4 class="title">Account Details</h4>
					
                    <div class="comments-area">
						
							<p>
								<label>Username</label>
								<span></span>
								<input type="text" name="username" required="required" value="<?php echo $customer->user_name; ?>" >
							</p>
							<p>
								<label>Mobile Number</label>
								<span></span>
								<input name="phone" required="required"  maxlength="11" type="text" value="<?php echo $customer->phone; ?>">
							</p>
							<p>
								<label>Gender</label>
								<span>&nbsp;&nbsp;&nbsp;</span>
								<input type="radio" name="gender" value="m" <?php if($customer->gender=="m") print "checked"; ?> />&nbsp;Male&nbsp;&nbsp;
								<input type="radio" name="gender" value="f" <?php if($customer->gender=="f") print "checked"; ?> />&nbsp;Female
							</p>
							 <p>
								<input type="submit" name="submit" value="Save changes">
							</p>
						</form>
					</div>					
					
					
					
			      </div>
				</div>
				<div class="clear"></div>
		<?php include("../views/footer.php"); ?>


