 <html>
<head>

  <meta charset='utf-8' />
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet"href="/project/css/bootstrap.css">
  <link rel="stylesheet"href="/project/css/my-bootstrap.css">
  <link rel="stylesheet"href="/project/css/style.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="/project/js/bootstrap.min.js"></script>

</head>
<body>
 <div  id="orders">
 <?php
 session_start();
 require('dborm_connect.php');
 require __DIR__."/controller/ordercontroller.php";                
 $ordcon->get_orders();                      
?>
</div>