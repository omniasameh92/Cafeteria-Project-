<?php

session_start();
require '../model/dborm_connect.php';

//$res=$obj->dbselect('users',array('user_id')," where user_id=".$_POST['user_id']);


if($_POST['user_id']==$_SESSION['user_id']){

	echo 1; 
}

?>