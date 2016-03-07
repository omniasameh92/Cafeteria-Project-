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
 <script>
  var date_from=" ";
  var date_to=" ";
 </script>
  <div class="" style="width:80%; margin-left:10%; margin-top:50px;">
<div id="my_orders" style="position:relative;">
<?php
//$option="no";
require '../model/dborm_connect.php';

require "../model/ordermodel.php";

if(isset($_GET['date_from']) && isset($_GET['date_to']))
   
{
  
   echo $ordcon->my_orders(true,$user_id);
   echo "<script>date_from='".$_GET['date_from']."'</script>"; 
   echo "<script>date_to='".$_GET['date_to']."'</script>";   
}else{

header('location:my_orders.php');

}

?>
</div>

   
<script src="../js/myorder_date.js"> 
</script>
    <?php include("../views/footer.php"); ?>