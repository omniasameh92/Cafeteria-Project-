<?php
session_start();

//print_r($_POST['product_id']);
if(isset($_POST['arr'])){

 echo "good";

}

function get_user(){

if(isset($_SESSION['user_id'])){
    
//     echo  $_SESSION['user_id'];

}elseif($_COOKIE['user_id']){
  
  // echo  $_COOKIE['user_id'];
}

//echo "omnia";
}

get_user();


?>