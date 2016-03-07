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
                  
  require '../views/header.php';   
?>
<div class="" style="width:80%; margin-left:10%;">
 <a  class='btn btn-default' href='addproduct.php'>Add Product</a>
 <div id="txt">
<?php

  

  require '../model/dborm_connect.php';
  
  require '../model/productmodel.php';
 
  $pdcon->get_all_products();

?>
</div>

  <script src="../js/product.js"></script>
<?php
  require '../views/footer.php';   
?>