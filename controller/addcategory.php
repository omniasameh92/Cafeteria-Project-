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
require '../views/header.php';
require '../model/dborm_connect.php';

$error=false;
if(strtolower($_SERVER['REQUEST_METHOD'])=="post"){
    
  echo '<script type="text/javascript"> window.onload=function(){';
  if(empty($_POST['cat_name'])){
     
     echo '$("#c_name").attr("class","form-group has-error has-feedback");'; 
     echo'$("#c_name").append("<span class=' ;
       $c="'glyphicon glyphicon-plus form-control-feedback'";
    echo $c.'></span>");';
    echo 'document.getElementById("name_error").innerHTML="Please Enter category Name";';      
    
     $error=true;
   }else{

    if(!preg_match("/^[a-zA-Z0-9]{3,15}$/",$_POST['cat_name'])){
         $error=true;
          echo '$("#c_name").attr("class","form-group has-error has-feedback");'; 
          echo'$("#c_name").append("<span class=' ;
          $c="'glyphicon glyphicon-plus form-control-feedback'";
          echo $c.'></span>");';
          echo 'document.getElementById("name_error").innerHTML="Only Character are avaliable from 3-15 characters and numbers unique name ";';    
    
          }
           $res=$obj->dbselect('categories',array('cat_name')," where cat_name ='".$_POST['cat_name']."'");
            if(count($res)!=0){
                        $error=true;
          echo '$("#cat_name").attr("class","form-group has-error has-feedback");'; 
          echo'$("#cat_name").append("<span class=' ;
          $c="'glyphicon glyphicon-plus form-control-feedback'";
          echo $c.'></span>");';
          echo 'document.getElementById("name_error").innerHTML=" Sorry there is a category with same name ";';    

            }
               
       
   }

   
  echo'}</script>';
  if(!$error){  
       include  '../model/categoriesmodel.php';
       $catobj->addcategory();
    }
  }
?>
 <div class="slider-caption" style="width:90%; margin-left:5%;">   
   <div  class="slider-caption-left text-center" >
<?php
  include  '../views/addcategoryview.php';

?>
  </div >

  <script>

   
    $("#cat_name").change(function(e){
  //  alert('here');
     $("#c_name").attr('class','form-group');  
     $("#c_name span").remove();
     document.getElementById("name_error").innerHTML=" ";
        
   }); 
 

  </script>
  <?php
include('../views/footer.php');

?>

