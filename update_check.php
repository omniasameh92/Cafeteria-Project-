<?php
require '../model/dborm_connect.php';


$updated=false;
while(!$updated){
    $last_update=$obj->dbselect('products',array('last_update'),"where product_id=".$_POST['prodid']);
    if($last_update[0]['last_update']!=$_POST['last_update']){
    	$updated=true;
    }
    return 1;
}

?>