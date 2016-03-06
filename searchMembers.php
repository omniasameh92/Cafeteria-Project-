<?php


require __DIR__.'/model/user.php';

require __DIR__.'/model/dborm_connect.php';
$customer= new Customer();
$tbl="";
$from=1; $field="name"; $value="";
if(isset($_GET['from']))
   $from=$_GET['from'];
if(isset($_GET['Field']))
   $field=$_GET['Field'];
if(isset($_GET['fvalue']))
   $value=$_GET['fvalue'];

 include("header.php");
?>

 <div class="img-slider">
					
					    <div  id="top" class="callbacks_container">
					      <ul class="rslides" id="slider4">
					        <li>
					          <img src="images/Picture1.jpg" class="img-responsive" alt="">
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
											   <?php
                                   echo $customer->displayUsers($from,$field,$value);
                                      ?>
										   <div class="clearfix"> </div>
					          	  </div>
					          	  <div class="clearfix"> </div>
					          </div>
					          <div class="share-on">
					          	<div class="share-on-grid">
					          		<div class="share-on-grid-left">
					          			<h3>Share On</h3>
					          		</div>
					          		<div class="share-on-grid-right">
					          			<a href="#"><span class="facebook"> </span></a>
					          			<a href="#"><span class="twitter"> </span></a>
					          			<div class="clearfix"> </div>
					          		</div>
					          		<div class="clearfix"> </div>
					          	</div>
					          	<div class="clearfix"> </div>
					          </div>
					        </li>

					      </ul>
					    </div>
					    <div class="clearfix"> </div>
					</div>
<?php
  include("footer.php");
