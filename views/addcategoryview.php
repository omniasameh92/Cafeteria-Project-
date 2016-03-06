
  <div id="errors">
</div>
     <form method="post" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
     	<div  id="c_name">
     	<label>Category Name :</label><input id="cat_name"class="form-control" type="text" name="cat_name" value="<?php echo isset($_POST['cat_name']) ? $_POST['cat_name'] : '' ?>"> 
     	<br>
     </div>
     	<span style="color:red;" name="name_error" id="name_error"></span><br><br>
        <input  class="btn btn-primary form-control" type="submit" name="submit" value="Add Category"/>
     </form>	
