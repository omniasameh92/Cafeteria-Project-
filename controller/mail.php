<?php
session_start();
?>
<?php
require '../views/header.php';
require '../model/dborm_connect.php';
$error=false;
if(strtolower($_SERVER['REQUEST_METHOD'])=="post"){
    
  echo '<script type="text/javascript"> window.onload=function(){';
  if(empty($_POST['email'])){
         
        //echo "console.log(document.getElementById('email_txt'));";
      echo '$("#email_txt").attr("class","form-group has-error has-feedback");'; 
      echo'$("#email_txt").append("<span class=' ;
       $c="'glyphicon glyphicon-plus form-control-feedback'";
      echo $c.'></span>");';
      echo 'document.getElementById("email_error").innerHTML="Please Enter Your Email Name";';
    
     $error=true;
   }

   else{
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
          $error=true;
          echo '$("#email_txt").attr("class","form-group has-error has-feedback");'; 
          echo'$("#email_txt").append("<span class=' ;
          $c="'glyphicon glyphicon-plus form-control-feedback'";
          echo $c.'></span>");';
          echo 'document.getElementById("email_error").innerHTML="Invalid email try again ";';
    
    }

}
    echo'}</script>';

  if(!$error){
       require '../model/user.php';
       $user = new Customer();
      // echo $_POST['email'];
       $res=$user->forget_password($_POST['email']);
       echo "<script>$('#result').html('".$res."');</script>";
    }
  }

 include  '../views/forget_passwordview.php';

 
?>
<script>   
   $("#email").change(function(e){
  //  alert('here');
     $("#email_txt").attr('class','form-group');  
     $("#email_txt span").remove();
     document.getElementById("email_error").innerHTML=" ";
        
   }); 

</script>
 <?php
include('../views/footer.php');
?>

