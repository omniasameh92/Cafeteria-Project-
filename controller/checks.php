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
	<form  action="check_date.php" method="GET" class="form-inline" role="form">
	<label for="from">from:</label>
      <input  class="form-control" id="from" value="2016-01-01" min="2016-01-01" name="date_from" type="date">
      <label for="to"> to:</label>
      <input  class="form-control" id="to"  name="date_to" value="<?php echo date('Y-m-d');?>" type="date">
      <input class="btn btn-default" type="submit">
	</form action="checks.php" method="GET" class="form-inline">
	
	<form method="get" action="checks.php">
	<label for="user">Select User:</label>
    <select  id="user" name="user" class="btn btn-default" >
		<?php $order->getAllUsers(); ?>
	</select>
	<input class="btn btn-default" type="submit">
	</form>
	

<div id="my_orders">
<?php
if(isset($_GET['user']))
$order->check_orders($_GET['user']);
else
$order->check_orders(false);
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
