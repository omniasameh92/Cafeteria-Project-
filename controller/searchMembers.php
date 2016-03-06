<?php

session_start();
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
                  
require '../model/dborm_connect.php';
require '../model/user.php';
$customer= new Customer();
$tbl="";
$from=1; $field="name"; $value="";
if(isset($_GET['from']))
   $from=$_GET['from'];
if(isset($_GET['Field']))
   $field=$_GET['Field'];
if(isset($_GET['fvalue']))
   $value=$_GET['fvalue'];

 include("../views/header.php");
?>
<div class="slider-caption" style="width:80%; margin-left:10%;">
    <div style="float:right; margin-top:40px;"><a href="register.php">Add New User</a></div>

					          	 <div class="slider-caption-left text-center" style="width:100%; margin-top:58px;">						
									  
								<form action="searchMembers.php" method="get">
					          	 	
										<div style=" color:#8d7662;"><span style="color:#8cc0d3; font-weight:100; font-size:1.2em;">Search by </span>
										<label>
										<input type="radio" name="Field" value="name" checked="checked"/>Username 
										</label>
										<label><input type="radio" name="Field" value="email"/>Email</label>
										<label><input type="radio" name="Field" value="phone_number" />Phone No</label>
											</div>
										<div style="margin-top:15px;"><span style=" color:#8cc0d3; font-weight:100; font-size:1.2em;"> Value to search</span>
										 <input name="fvalue" type="text" />
                                         <input name="submit" type="submit" style="padding: 0.1em 1em; color: #FFF;font-size: 1.2em;text-transform: uppercase;text-decoration: none;background: radial-gradient(ellipse at center,#FF8DB4 0%,#FF8DB4 50%,#FF8DB4 100%);"value="Search" /></div>
                                         <?php //echo $tbl; ?>									  
									  </form>
									  	   <?php
                                   echo $customer->displayUsers($from,$field,$value);
                                      ?>
					          	 </div>
					          	  <div class="clearfix"> </div>
<?php
  include("../views/footer.php");
