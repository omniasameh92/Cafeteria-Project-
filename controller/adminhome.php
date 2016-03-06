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

?>
    

<?php
require '../views/header.php'; 
?>
       <div class="slider-caption" style="width:90%; margin-left:5%;"> 
       <div id="admin_orders"></div>  
     <div id="orders" class="slider-caption-left text-center">
         
<?php    
  
     require "adminorders.php";                
   
?>

   </div>

<script  src="../js/adminorder.js" type="text/javascript"></script>

<?php
require '../views/footer.php'; 
?>