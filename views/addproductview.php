
<div id="errors">
</div>

<form enctype="multipart/form-data" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">	

 <div  id="p_name">
 <label>Product Name :</label><input id='prod_name' class="form-control" placeholder='Enter product name 'type="text" name="prod_name" value="<?php echo isset($_POST['prod_name']) ? $_POST['prod_name'] : '' ?>">
</div>
 <span Style="color:red" id="name_error"></span><br><br>
<div id="p_price">
 <label>price:</label><input type="number" id="prod_price" step="0.25" class="form-control" name="prod_price" min="1"value="<?php echo isset($_POST['prod_price']) ? $_POST['prod_price'] : '1' ?>"/><span>EGP</span>
 </div>
<span Style="color:red" id="price_error"></span>
<br/><br>
<label>category:</label>
<br/><br>
<?php
  $res=$obj->dbselect('categories',array('cat_name','cat_id'));
  echo '<select class="form-control" id="prod_cat" name="prod_cat">';

  foreach ($res as  $cat) {
           
        echo '<option value="'.$cat[cat_id].'">'.$cat[cat_name].'</option>';
          
      } 
   echo '</select>';      
?>
 &nbsp;&nbsp;<a href="../controller/addcategory.php">Add Category</a>
<br/><br>

   <label>Photo:</label><br>
   <span style="color:red" id="pic_error"> </span>
<br>
  <input type="file" class="form-control" name="prod_pic">
 <br/><br>
  
 <input class='btn btn-primary'type="submit" id="add_prod" name="submit" value="Add product"/>&nbsp;&nbsp;
 <input class='btn btn-primary'  type="reset"/>
</form>
