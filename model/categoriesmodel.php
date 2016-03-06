<?php
class categories{
	
  function addcategory(){
  	          global $obj;
                $arr=array('cat_name'=>$_POST['cat_name']);
         $res=$obj->dbRowInsert('categories',$arr);
         if($res==1){
              
              header('location:addproduct.php');

         }else{
             echo '<script type="text/javascript"> window.onload=function(){document.getElementById("errors").innerHTML="<p>can not add category</p>";}</script>';
          

         }


  }

}

$catobj= new categories();

?>