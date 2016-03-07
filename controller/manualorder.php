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

?>

         <?php include("../views/header.php"); ?>
<div class="" style="width:80%; margin-left:10%;"> 
   <div  style="background-color:lavender;margin-top:-20px;" class="slider-caption-left text-center" >

 <div id="request_order">
 <div id="order" class="text-primary" style="width:200px;height:200px">Request An order </div>
 <label class="text-primary">Notes:</label>
 <textarea class="form-control" cols="30" rows="5" id="order_notes"></textarea>
 <label class="text-primary" >room:</label>

 <?php
    $res=$obj->dbselect('ext_room',array('room_number','room_id'));
    echo '<select class="text-primary form-control" id="ext_room" name="ext_room">';
       foreach ($res as  $room){
            echo '<option class="text-primary"  value="'.$room[room_id].'">'.$room[room_number].'</option>';
        } 
       
      echo '</select>';  

 ?>
 <div class="text-primary" id="total"></div>
  <div class="text-primary" id="order_submit">Order Submitted</div>
  <div>
  <button class="btn btn-primary" id="order_btn">request order</button>
   </div>
</div>
<div id="errors"></div>

</div>
 <div class="slider-caption-right" style="margin-top:-20px;">
   <div class="row">
        <label class="text-primary" for="user">Select User:</label><br>
               <?php
    
        $res=$obj->dbselect('users',array('name','user_id'),"where user_id <> 1");
       echo '<select  class="text-primary form-control" id="user" name="user">';
       foreach ($res as  $us){
            echo '<option class="text-primary" value="'.$us[user_id].'">'.$us[name].'</option>';
          } 
       echo '</select>';  
             ?>
             </div>
    <div class="row">
    <div class="form-group">
    <label class="text-primary" for="prod_cat">Select category:</label>
  <?php
       $res=$obj->dbselect('categories',array('cat_name','cat_id'));
       echo '<select class="form-control text-primary"  id="prod_cat" name="prod_cat">';
       foreach ($res as  $cat) {
            echo '<option class="text-primary" value='.$cat['cat_id'].'>'.$cat['cat_name'].'</option>';
            
          } 
       echo '</select>';  
      ?>
    </div>
    <div id="txt"class="order text-primary">
    
    </div>
   </div>
</div>

<script src="../js/adminrequestorder.js">  
  </script>
<?php include("../views/footer.php"); ?>



