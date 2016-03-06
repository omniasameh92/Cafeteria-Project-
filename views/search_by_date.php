<form  action="../controller/get_orders_date.php" method="GET" class="form-inline" role="form">
	<label for="from">from:</label>
      <input  class="form-control" id="from" value="2016-01-01" min="2016-01-01" name="date_from" type="date">
      <label for="to"> to:</label>
      <input   class="form-control" id="to"  name="date_to" value="<?php echo date('Y-m-d');?>" type="date">
      <input class="btn btn-default" type="submit">
	</form>