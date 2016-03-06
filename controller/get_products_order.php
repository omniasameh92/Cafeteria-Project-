<?php
require '../model/dborm_connect.php';

require "../model/productmodel.php";

if(isset($_POST['cat'])){
echo $pdcon->display_product_client($_POST['cat']);
}else{
 echo "Sorry No products";
}

?>