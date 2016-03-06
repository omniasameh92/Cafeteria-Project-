<?php
class products{
	

  function addproduct(){
          global $obj;
        if($_FILES['prod_pic']['error']==0){
        if(preg_match('/^image/',$_FILES['prod_pic']['type'])){
             $target_dir = "../uploads/";
             $file_name=date("h:i:sa").$_FILES["prod_pic"]["name"];
             $target_file = $target_dir .$file_name;
        if(move_uploaded_file($_FILES["prod_pic"]["tmp_name"],$target_file)){
              $date=date("y-m-d h:i:s");
              $arr=array('product_name'=>$_POST['prod_name'],'product_price'=>$_POST['prod_price'],'product_pic'=>$file_name,'product_state'=>1,'cat_id'=>$_POST['prod_cat'],'last_update'=>$date);
              
              $res=$obj->dbRowInsert('products',$arr);
              $last_id=$obj->get_last_inserted_id();  
              $cat_id=$_POST['prod_cat'];
               if($res==1){
                     
                      header('location:../controller/productadminpanel.php');
               }

        }

      }else{  
         echo '<script type="text/javascript">window.onload=function(){document.getElementById("pic_error").innerHTML="<p>Selected file was not a photo , choose one please </p>";}</script>';
  }

   }else{
         echo '<script type="text/javascript"> window.onload=function(){document.getElementById("pic_error").innerHTML="<p>Choose photo to your product</p>";}</script>';
  }


  }
    function deleteproduct(){
               global $obj;

          if(isset($_POST['pid'])){

              $arr = array('product_exist' => '0');
          $res=$obj->dbRowUpdate('products',$arr,"where product_id=".$_POST['pid']);
             }
          }
    function get_all_products(){

            global $obj;
          $res=$obj->dbselect('products',array('*'));
           $res1=$obj->dbselect('products',array('*'),"where product_exist = 1");
       //
      if(count($res1)>0){
      echo '<table class="table table-hover table-striped table-bordered"><th>Name</th><th>Price</th><th>Picture</th><th>Actions</th>';
      foreach ($res1 as  $prod){
            $imgpath="../uploads/".$prod['product_pic'];
            
            if($prod['product_state']==1 ){   
                echo "<tr><td>".$prod['product_name']."</td><td>".$prod['product_price']."</td><td>".'<img src="'.$imgpath.'" width="50px" height="50px"/></td><td><button  id="'.$prod['product_id'].','.$prod['cat_id'].',0" class="aval btn btn-default">avaliable</button><a id="'.$prod['product_id'].','.$prod['cat_id'].'" href="editproduct.php?pid='.$prod['product_id'].'&catid='.$prod['cat_id'].'" class="edit btn btn-default">edit</a><button  id="'.$prod['product_id'].','.$prod['cat_id'].'" class="delete btn btn-default">delete</button></td></tr>';
             }else{
                         
                echo "<tr><td>".$prod['product_name']."</td><td>".$prod['product_price']."</td><td>".'<img src="'.$imgpath.'"width="50px" height="50px"/></td><td><button  id="'.$prod['product_id'].','.$prod['cat_id'].',1" class="unaval btn btn-default" >unavaliable</button><a  id="'.$prod['product_id'].','.$prod['cat_id'].'" href="editproduct.php?pid='.$prod['product_id'].'&catid='.$prod['cat_id'].'" class="edit btn btn-default">edit</a><button id="'.$prod['product_id'].','.$prod['cat_id'].'" class="delete btn btn-default">delete</button></td></tr>';
             }
      

            } 

      echo'</table>';

      }else{

        echo "There is no products Yet";

      }

    }
    
    function change_product_avaliability(){

                global $obj;  
            if(isset($_POST['pid'])&&isset($_POST['ava'])){

            $arr=array('product_state'=>$_POST['ava']);

            $res=$obj->dbRowUpdate('products',$arr,"where product_id=".$_POST['pid']);          
            
            }


 
    }


    function edit_all_product_inf(){
           global $obj;
       
        if(preg_match('/^image/',$_FILES['prod_pic']['type'])){
             $target_dir = "../uploads/";
             $file_name=date("h:i:sa").$_FILES["prod_pic"]["name"];
             $target_file = $target_dir .$file_name;
        if(move_uploaded_file($_FILES["prod_pic"]["tmp_name"],$target_file)){
              $arr=array('product_name'=>$_POST['prod_name'],'product_price'=>$_POST['prod_price'],'product_pic'=>$file_name,'cat_id'=>$_POST['prod_cat']);
              $res=$obj->dbRowUpdate('products',$arr,"where product_id=".$_SESSION['pid']);
              if($res==1){
                      return 1;
                
              }
                }

       }else{  
          echo '<script type="text/javascript"> window.onload=function(){document.getElementById("pic_error").innerHTML="<p>Selected file was not a photo , choose one please </p>";}</script>';
       }


    }
    function editproduct(){
                global $obj; 
             $arr=array('product_name'=>$_POST['prod_name'],'product_price'=>$_POST['prod_price'],'cat_id'=>$_POST['prod_cat']);
              $res=$obj->dbRowUpdate('products',$arr,"where product_id=".$_SESSION['pid']);
              if($res==1){

                 return 1;
                    
              }

          }
          function display_product_client($catid){
             $con=0;
             global $obj;
             $res=$obj->dbselect("products",array('*'),"where cat_id=".$catid." and  product_exist = 1");          
              if(count($res)==0){

                 echo "sorry there are no products yet in that category<br>";
              }
              foreach($res as $p){
                 
                 if($p['product_state']!=0){
                     
                     echo "<div style='display:inline;margin:10;float:left;'class='product'><img id='".$p['product_id'].",".$p['product_name'].",".$p['product_price']."' width='60px' height='60px'src='/project/uploads/".$p['product_pic']."'><span style='display:block'>".$p['product_name']."</span><span>price:".$p['product_price']."</span></div>";
                     
                     }else{
                        $con++;

                     }

                }   
        
                if($con==count($res) && count($res)!=0){
                  echo "all products are unavaliable now select another category";
                }
          }

}
$pdcon=new products();

?>