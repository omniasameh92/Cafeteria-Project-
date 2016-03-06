<?php
require '../model/dborm_connect.php';


$updated=false;
while(!$updated){
    $last_update=$obj->dbselect('products',array('last_update'),"where cat_id=".$_POST['catid']);
    $len=count($last_update);
    if($last_update[$len-1]['last_update']!=date('y-m-d h:i:s')){
    	$updated=true;
    }
    return 1;
}

?>