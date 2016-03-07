<?php
require '../model/dborm_connect.php';
include("../model/product.php");

$product= new Product();

$from=1; $catno=""; $q="";
if(isset($_GET['from']))
   $from=$_GET['from'];
if(isset($_GET['catno']))
   $catno=$_GET['catno'];
if(isset($_GET['q']))
   $q=$_GET['q'];

  include("../views/header.php");
  ?>
<div class="" style="width:80%; margin-left:10%; margin-top:-100px;">
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

    <?php include("../views/footer.php"); ?>
  
 


