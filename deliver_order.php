<?php
      session_start();
    //get session variables 
   
      require '../model/dborm_connect.php';
      require '../model/ordermodel.php';

      $ordcon->update_order();

    ?>

    