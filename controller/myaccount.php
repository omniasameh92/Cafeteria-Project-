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

 function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
$username="";
$phone="";

if(isset($_POST['submit'])||isset($_POST['upload']))
 {
     if(preg_match('/^[a-zA-Z]{5,}$/', $_POST['username'])) 
	     $customer->user_name=test_input($_POST['username']);
     else
	     $username=" should be alphanumeric & > or = 5 chars";
     if(preg_match("/^[0-9]{3}[0-9]{4}[0-9]{4}$/", $_POST['phone'])) 
         $customer->phone=test_input($_POST['phone']);
     else 
	     $phone=" Phone number format is invalid";
  $customer->gender=$_POST['gender'];
 }
 
 if(isset($_POST['submit']))
 if(!empty($customer->username) && !empty($customer->phone))
    $customer->updateCustomerData();
 if(isset($_POST['upload']))
  {
  if(empty($_FILES['userImg']['tmp_name']))
  $customer->updateCustomerData();
  $customer->msg=$customer->uploadFile($_FILES['userImg'],"userImgs/$customer->id.jpg");
  }
 
include("../views/header.php");
?>


<div class="" style="width:80%; margin-left:10%;">


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
								<span><?php echo $username;?></span>
								<input type="text" name="username" value="<?php echo $customer->user_name; ?>" >
							</p>
							<p>
								<label>Mobile Number</label>
								<span><?php echo $phone;?></span>
								<input name="phone"  maxlength="11" type="text" value="<?php echo $customer->phone; echo $phone; ?>">
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
		<?php include("../views/footer.php"); ?>


