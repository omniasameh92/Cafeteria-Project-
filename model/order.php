<?php
class Order
{  
   function check_orders($value,$from=1)
   {
	global $obj;
	
	$result=$obj->dbselect('users, orders',array('users.*','SUM( total_amount ) as total'),'WHERE users.user_id >1
	AND users.user_id = orders.user_id
	GROUP BY users.user_id');

	$tbl=$this->displayPager($obj->get_effected_number());
	$tbl.="<table class='table table-hover'><th colspan='2'>Name</th><th>Total</th>";
	
	foreach($result as $row) {
		$tbl.="<tr><td><a id='show' style='color:pink;decoration:none;' class='glyphicon glyphicon-plus'href='#tr".$row['user_id']."' data-toggle='collapse'></a></td><td>". $row['name'] . "</td><td>". $row['total'] . " EGP</td></tr>";

		$entriesres = $obj->dbselect('orders',array('*'),"WHERE user_id = " . $row['user_id'].
		
		" ORDER BY order_date DESC");

		$tbl.= "<tr class='collapse' id=tr".$row['user_id']." ><td colspan='3'><div id=".$row['user_id']." ><ul class='list-group'>";
		foreach($entriesres  as $entriesrow  ) {
			$tbl.= "<li class='list-group-item'>". date('D jS F Y g.iA', strtotime($entriesrow['order_date']))."&nbsp;&nbsp;".$entriesrow['total_amount'] ." EGP </li>";

			$itemsres =$obj->dbselect('products, prod_order, orders',array('product_name', 'product_price', 'prod_quantity'),

		    " WHERE orders.order_id =".$entriesrow['order_id']."
			AND products.product_id = prod_order.product_id
			AND orders.order_id = prod_order.order_id");

			$tbl.= "<ul>";
			foreach($itemsres as $itemsrow) {
			$tbl.= "<li>". $itemsrow['product_name']."&nbsp;&nbsp;&nbsp;".$itemsrow['product_price'] ." EGP &nbsp;&nbsp;".$itemsrow['prod_quantity']."</li>";

			}$tbl.= "</ul>";
		}$tbl.= "</ul></div></td></tr>";
	}
	echo $tbl."</table>";	 
   }

   
    function displayPager($numRow){
	  $links="<div><";
	  $p=1;
	  for($x=1;$x<=$numRow;$x+=4)
	     {
		    $links.="|<a href='checks.php?from=$x'>$p</a>";
			$p++;
		 }
		 return $links."|></div>";
	}   
}


?>






