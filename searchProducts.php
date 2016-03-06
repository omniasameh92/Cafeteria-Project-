<?php
include("model/product.php");
 //require __DIR__.'/dborm_connect.php';
$product= new Product();

$from=1; $catno=""; $q="";
if(isset($_GET['from']))
   $from=$_GET['from'];
if(isset($_GET['catno']))
   $catno=$_GET['catno'];
if(isset($_GET['q']))
   $q=$_GET['q'];

  include("header.php");
  ?>
  
  <div class="img-slider">
					
					    <div  id="top" class="callbacks_container">
					      <ul class="rslides" id="slider4">
					        <li>
					          <img src="images/Picture1.jpg" class="img-responsive" alt="">
					           <div class="slider-caption">
					          	 <div class="slider-caption-left text-center">
					          	 	<h1>&nbsp;&nbsp;ARE YOU LOOKING FOR &nbsp;&nbsp;&nbsp; HOT, COLD&nbsp; AND DELECIOUS FRESH DRINKS?</h1>
					          	 	<p>DON'T WORRY, WE CAN HELP YOU! <br/>CHECK OUR BEST DRINKS.</p>
					          	 	<a class="buy-btn">Join Us</a>
					          	 </div>
					          	  <div class="slider-caption-right">
                                           <h1>&nbsp;</h1>
										   <div class="login-right wow fadeInRight" data-wow-delay="0.4s">
											 <?php
  echo $product->displayProdWithImgs($from,$catno,$q);
  ?>
										   </div>	
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

		</div>
    <?php include("footer.php"); ?>
  
 


