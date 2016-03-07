<?php
 session_start();
    $user_id=0;
    $user_name;
              if(isset($_COOKIE['user_name'])&& isset($_COOKIE['user_id'])){
          
                              $user_name=$_COOKIE['user_name'];
                              $user_id=$_COOKIE['user_id'];
                              $login=true;
              }elseif(isset($_SESSION['user_id']))
                   {
                  
                             $user_name=$_SESSION['user_name'];
                               $user_id=$_SESSION['user_id'];
                              // echo $user_id;
                               $login=true;
                   }else{

                 header('location:../index.php');
                   }


                   if($user_id!=1){

                    header('location:../index.php');
                  }

?>
<?php
 
require '../views/header.php';


?>
<script>
  
  var catid;
  var prodid;
  var last_update;
</script>
<?php
require '../model/dborm_connect.php';

if(strtolower($_SERVER['REQUEST_METHOD'])=="get"){
   	  if(isset($_GET['pid']) && isset($_GET['catid']) ){
        $_SESSION['pid']=$_GET['pid'];
        $_SESSION['catid']=$_GET['catid'];
        $pid=$_SESSION['pid'];
        $catid=$_SESSION['catid'];

        $last_update=$obj->dbselect("products",array('last_update')," where product_id=".$_SESSION['pid']);
        $last=$last_update[0]['last_update'];
  
          echo "<script>last_update='".$last."';</script>";
        echo '<script>prodid='.$pid.'; catid='.$catid.'; console.log(catid);</script>';

$arr=array('p.product_name','p.product_price','p.product_pic','c.cat_name');
$res=$obj->dbselect('products p,categories c',$arr,'where p.product_id='.$_GET['pid'].' and p.cat_id=c.cat_id');

if(count($res)>0){
$_GET['prod_name']=$res[0]['product_name'];
$_GET['prod_price']=$res[0]['product_price'];
$_SESSION['prod_pic']=$res[0]['product_pic'];
$_GET['cat_name']=$res[0]['cat_name'];

}

}else{

 header("location:productadminpanel.php"); 
}
}
?>
<div class="" style="width:80%; margin-left:10%;">   
   <div   class="slider-caption-left" >

<?php
include '../views/editproductview.php';
?>
</div>

 <script src="../js/editproduct.js"></script>             
<?php
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
    $res=$obj->dbselect('products',array('product_name')," where product_name ='".$_POST['prod_name']."' and product_id !=".$_SESSION['pid']);
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
      include  '../model/productmodel.php';
      if($_FILES['prod_pic']['error']==0){
      $result=$pdcon->edit_all_product_inf();
              }else{

      $result=$pdcon->editproduct();
     
      }
         if($result==1){
         
         echo "<script>window.location.href='/controller/productadminpanel.php'</script>";

      }

    }
 }

?>


<?php
 
require '../views/footer.php';


?>