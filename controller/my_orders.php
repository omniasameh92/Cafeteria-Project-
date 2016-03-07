<html>
<?php
  session_start();
  $user_id=0;
  $user_name="";
    if(isset($_COOKIE['user_name'])&& isset($_COOKIE['user_id'])){
          
                              $user_name=$_COOKIE['user_name'];
                              $user_id=$_COOKIE['user_id'];
                              $login=true;
              }elseif(isset($_SESSION['user_id'])&& isset($_SESSION['user_name']))
                   {
                                          
                               $user_name=$_SESSION['user_name'];
                               $user_id=$_SESSION['user_id'];
                               $login=true;
                   }else{

                    header('location:../index.php');
                   }

                  if($user_id==1){

                   header('location:../index.php');
                  }
?>
    <?php include("../views/header.php"); ?>
  
  
  <div class="" style="width:80%; margin-left:10%; margin-top:50px;">
  <?php
  require '../views/search_by_date.php';
?>
<div style="">
<div id="my_orders" style="position:relative;">

<?php

require '../model/dborm_connect.php';

require "../model/ordermodel.php";

echo $ordcon->my_orders(false,$user_id);


?>
</div>
</div>
 

  <script src="../js/myorder.js"></script>
        <script src="../js/jquery-1.9.1.min.js"></script>
        <script src="../js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#from').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
        </script>        
    <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#to').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
        </script>

  <?php include("../views/footer.php"); ?>

