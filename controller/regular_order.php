<?php
session_start();
$user=0;

if(isset($_SESSION['user_id'])){
    
    $user=$_SESSION['user_id'];


  }elseif(isset($_COOKIE['user_id'])){
    $user=$_COOKIE['user_id'];

  }else{

  	echo "  ";
  }

require '../model/dborm_connect.php';

require "../model/ordermodel.php";

echo $ordcon->regular_order($user);

?>