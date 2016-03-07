<?php
  session_start();
  
   $user=0;
  if(isset($_SESSION['user_id'])){
    
    $user=$_SESSION['user_id'];


  }elseif(isset($_COOKIE['user_id'])){
    $user=$_COOKIE['user_id'];

  }

require '../model/dborm_connect.php';

require "../model/ordermodel.php";

echo $ordcon->my_orders(true,$user,$_POST['date_from'],$_POST['date_to']);

?>
   
