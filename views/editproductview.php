
<div id="errors">
</div>
<form enctype="multipart/form-data" role="form"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div  id="p_name">
 <label>Product Name :</label><input id='prod_name' class="form-control" type="text" name="prod_name" value="<?php echo isset($_POST['prod_name']) ? $_POST['prod_name'] : $_GET['prod_name'] ?>">
  </div>
  <span Style="color:red" id="name_error"></span><br>
  <div id="p_price">
 <label>price:</label><input id="prod_price" class="form-control" step="0.25" type="number" name="prod_price" min="0"value="<?php echo isset($_POST['prod_price']) ? $_POST['prod_price'] : $_GET['prod_price'] ?>"/><span>EGP</span>
</div>
<span Style="color:red" id="price_error"></span><br><br>


<label>category:</label>
<br/>
<?php
  
  
  $res=$obj->dbselect('categories',array('cat_name','cat_id'));
  echo '<select class="form-control" name="prod_cat">';
 // print_r($res);
  foreach ($res as  $cat){
           
        echo '<option value="'.$cat['cat_id'].'"';
          if(isset($_GET['cat_name'])&&$_GET['cat_name']==$cat['cat_name'])echo'selected';
        echo '>'.$cat['cat_name'].'</option>';
          
      } 
   echo '</select>';      
?>
<br/>
  <img style="width:90px;!important height 90px;!important "src='<?php if(isset($_SESSION['prod_pic'])){echo "../uploads/".$_SESSION['prod_pic']; } 

   ?>'/>
  <br><label>Choose another Photo:</label><br>
  <span style="color:red" id="pic_error"></span>
<br>
  <input class="form-control" type="file" name="prod_pic">
 <br/>
  <input  class="hidden" type="hidden" >
 <input id="submit_product" class=' form-control btn btn-primary'type="submit" name="submit" value="Edit product"/>
</form>