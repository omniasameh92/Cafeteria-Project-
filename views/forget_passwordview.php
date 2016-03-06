
  <div id="errors">
</div>

     <form method="post"  role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
     	<div id="email_txt">
     	<label>Enter your Email :</label><input  class="form-control" id="email" type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"> <br>
     	</div>
     	<span style="color:red;"  id="email_error"></span><br>
        <input type="submit"class="btn btn-primary form-control" name="submit" value="Send Mail"/>
     </form>	

     <div class="text-primary"id="result"></div>
 