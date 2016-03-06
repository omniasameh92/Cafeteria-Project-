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
 require "../model/user.php";
 require '../model/dborm_connect.php';
 $customer= new Customer();

 if(!isset($_GET['id'])){
    header("Location:../index.php");
   
}
$customer->delete($_GET['id']);
header("Location:searchMembers.php?Field=".$_GET['Field']."&fvalue=".$_GET['fvalue']);
die();

