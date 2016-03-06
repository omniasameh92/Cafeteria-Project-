<html>
<?php
  session_start();
  $user_id;
      if(isset($_COOKIE['user_name'])&& isset($_COOKIE['user_id'])){
          
                              $user_name=$_COOKIE['user_name'];
                              $user_id=$_COOKIE['user_id'];
                              $login=true;
              }elseif(isset($_SESSION['user_id']))
                   {
                  
                               $user_name=$_SESSION['user_name'];
                               $user_id=$_SESSION['user_id'];
                               $login=true;
                   }else{

                    header('location:../index.php');
                   }
?>

   <?php include("../views/header.php");  ?>
 <div class="slider-caption" style="width:90%; margin-left:5%;"> 
<div class="slider-caption-left text-center">
<div id="my_orders">
<?php

require '../model/dborm_connect.php';

require "../model/ordermodel.php";

if(isset($_GET['date_from']) && isset($_GET['date_to']))

{echo $ordcon->my_orders(true,$user_id);}

else{

header('location:my_orders.php');

}

?>
</div>

  </div> 
<script src="../js/myorder.js"> 
</script>
    <?php include("../views/footer.php"); ?>