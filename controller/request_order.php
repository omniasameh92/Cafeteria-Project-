<?php

session_start();
require '../model/dborm_connect.php';
require "../model/ordermodel.php";

echo $ordcon->request_order();

?>