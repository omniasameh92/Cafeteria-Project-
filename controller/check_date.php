<html>
<head>

</head>
<?php
  session_start();
  require '../model/dborm_connect.php';
  require "../model/order.php";
  $order=new Order();
?>
<?php
   $user=0;
  if(isset($_SESSION['user_id'])){
    
    $user=$_SESSION['user_id'];


  }elseif(isset($_COOKIE['user_id'])){
    $user=$_COOKIE['user_id'];

  }else{

   header('location:../index.php');
  }
?>
    <?php include("../views/header.php"); ?>
<div class="" style="width:80%; margin-left:10%;">

<body>
<div>
<div id="my_orders">
<?php
if(isset($_GET['user'])&& isset($_GET['date_from']) && isset($_GET['date_to'])){
$order->check_orders_date($_GET['user'],$_GET['date_from'],$_GET['date_to']);}
elseif(isset($_GET['date_from']) && isset($_GET['date_to'])){
$order->check_orders_date(false,$_GET['date_from'],$_GET['date_to']);
}else{

   header('location:../index.php');
}
?>
</div>
</div>
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
