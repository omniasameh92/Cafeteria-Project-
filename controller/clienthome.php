<?php
     session_start();

$from=1; $catno=""; $q="";
if(isset($_GET['from']))
   $from=$_GET['from'];
if(isset($_GET['catno']))
   $catno=$_GET['catno'];
if(isset($_GET['q']))
   $q=$_GET['q'];


$user_id;

              if(isset($_COOKIE['user_name'])&& isset($_COOKIE['user_id'])){
          
                              $user_name=$_COOKIE['user_name'];
                              $user_id=$_COOKIE['user_id'];
                              $login=true;
              }elseif(isset($_SESSION['user_id']))
                   {
                  
                               $user_name=$_SESSION['user_name'];
                               $user_id=$_SESSION['user_id'];
                               //echo $user_id;
                               $login=true;
                   }else{

                    header('location:../index.php');
                   }
                     if($user_id==1){

                    header('location:../index.php');
                  }


    require '../model/dborm_connect.php';
      include("../model/product.php");

$product= new Product();

?>
         <?php include("../views/header.php"); ?>
 <div class="" style="width:80%; margin-left:10%;">

  <div class="slider-caption-left text-center" style="background-color:lavender; margin-top:50px;" >
       <div id="order_me"></div>
 <div id="request_order">
 <div id="order" class="text-primary"style="width:200px;height:200px">Request An order </div>
 <label  class="text-primary" >Notes:</label>
 <textarea cols="30" rows="5" class="form-control" id="order_notes"></textarea>
 <label  class="text-primary" >room:</label>

 <?php
    $res=$obj->dbselect('ext_room',array('room_number','room_id'));
    echo '<select class="form-control"  id="ext_room" name="ext_room">';
       foreach ($res as  $room){
            echo '<option value="'.$room[room_id].'">'.$room[room_number].'</option>';
        } 
       
      echo '</select>';  

 ?>
 <div id="total"></div>
  <div  class="text-success"  id="order_submit">Order Submitted</div>
  <div>
  <button class="btn btn-primary" id="order_btn">request order</button>
   </div>
</div>
<div  class="text-danger" id="errors"></div>

</div>
 <div class="slider-caption-right">
   <div class="row">

    <div class="panel panel-info">
      <div  class="panel-heading">  <a id="regbtn" data-toggle='collapse' href='#reg_order'>Regular Order </a> </div>
      <div  id='reg_order' class="panel-body collapse out order"> </div>
    </div>



    </div>
    <div class="row">
    <div class="form-group">
    <label for="prod_cat"  class="text-primary" >Select category:</label>
  <?php
       $res=$obj->dbselect('categories',array('cat_name','cat_id'));
       echo '<select class="form-control  text-primary" id="prod_cat" name="prod_cat">';
       foreach ($res as  $cat) {
            echo '<option value='.$cat['cat_id'].'>'.$cat['cat_name'].'</option>';
            
          } 
       echo '</select>';  
      ?>
    </div>
    <div id="txt"class="order">
      <?php 
    if(isset($_GET['q']))
    echo'<div id="txt"class="order">'.
           $product->displayProdWithImgs($from,$catno,$q)
            .'</div>';
  ?>
    
    </div>
   </div>
</div>

<script src="../js/clienthome.js">  
  </script>
<?php include("../views/footer.php"); ?>



