
<?php
session_start();
?>
<?php
require '../views/header.php';
require '../model/dborm_connect.php';
$error=false;
if(strtolower($_SERVER['REQUEST_METHOD'])=="post"){
    
  echo '<script type="text/javascript"> window.onload=function(){';
  if(empty($_POST['prod_name'])){
     
     echo '$("#p_name").attr("class","form-group has-error has-feedback");'; 
     echo'$("#p_name").append("<span class=' ;
       $c="'glyphicon glyphicon-plus form-control-feedback'";
    echo $c.'></span>");';
    echo 'document.getElementById("name_error").innerHTML="Please Enter Product Name";';      
    
     $error=true;

   }else{

    if(!preg_match("/^[a-zA-Z0-9]{3,15}$/",$_POST['prod_name'])){
         $error=true;
          echo '$("#p_name").attr("class","form-group has-error has-feedback");'; 
          echo'$("#p_name").append("<span class=' ;
          $c="'glyphicon glyphicon-plus form-control-feedback'";
          echo $c.'></span>");';
          echo 'document.getElementById("name_error").innerHTML="Only Character are avaliable from 3-15 characters unique name ";';    
    
            }
           $res=$obj->dbselect('products',array('product_name')," where product_name ='".$_POST['prod_name']."'");
            if(count($res)!=0){
                        $error=true;
          echo '$("#p_name").attr("class","form-group has-error has-feedback");'; 
          echo'$("#p_name").append("<span class=' ;
          $c="'glyphicon glyphicon-plus form-control-feedback'";
          echo $c.'></span>");';
          echo 'document.getElementById("name_error").innerHTML=" Sorry there is a product with same name ";';    

            }
               
       
   }

   if(empty($_POST['prod_price'])){

     echo '$("#p_price").attr("class","form-group has-error has-feedback");'; 
     echo'$("#p_price").append("<span class=' ;
       $c="'glyphicon glyphicon-plus form-control-feedback'";
    echo $c.'></span>");';
     echo 'document.getElementById("price_error").innerHTML="Please Enter Product Price" ;';      
     $error=true;
   }
  echo'} </script>';

  if(!$error){
    
    include  '../model/categoriesmodel.php';
    $catobj->addcategory();

  }

}


?>

<div >
<?php

 include  '../views/addcategory1.php';
?>
</div>
<script src="../js/addcategory.js"type="text/javascript"></script>
<?php
require '../views/footer.php';

?>




