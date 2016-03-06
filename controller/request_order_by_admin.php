<?php
session_start();
require '../model/dborm_connect.php';

 require "../model/ordermodel.php";
 
 $ordcon->request_order_admin();
?>