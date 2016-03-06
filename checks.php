<html>
<head>

</head>
<?php
  session_start();

?>

<body>
<div>
	<form  action="get_orders_date.php" method="GET" class="form-inline" role="form">
	<label for="from">from:</label>
      <input  class="form-control" id="from" value="2016-01-01" min="2016-01-01" name="date_from" type="date">
      <label for="to"> to:</label>
      <input   class="form-control" id="to"  name="date_to" value="<?php echo date('Y-m-d');?>" type="date">
      <input class="btn btn-default" type="submit">
	</form>

<div id="my_orders">
<?php
require __DIR__.'/model/dborm_connect.php';
require __DIR__."/model/order.php";
$order=new Order();
$order->check_orders(false);
?>
</div>
</div>
 <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet"href="css/bootstrap.css">
  <link rel="stylesheet"href="css/my-bootstrap.css">
  
  <!-- jQuery library -->
  <script src="/project/js/jquery.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="js/bootstrap.min.js"></script>
             
  <script src="js/myorder.js"></script>
</body>