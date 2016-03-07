<?php
class Order
{  
   
   function check_orders($user)
   {
	global $obj;
	$result=array();
	if($user==false){
	$result=$obj->dbselect('users, orders',array('users.*','SUM( total_amount ) as total'),'WHERE users.user_id >1
	AND users.user_id = orders.user_id
	GROUP BY users.user_id');
     if(count($result)==0){

      	echo "no orders for that customer";
      	return;
      }
    }else{
	$result=$obj->dbselect('users, orders',array('users.*','SUM( total_amount ) as total'),'WHERE users.user_id ='.$user.'
	AND users.user_id = orders.user_id
	GROUP BY users.user_id');
     if(count($result)==0){

      	echo "there is no any order ";
      	return;
      }
       
       }
	$tbl="<table class='table table-hover'><th colspan='2'>Name</th><th>Total</th>";
	
	foreach($result as $row) {
		$tbl.="<tr><td><a id='show' style='color:pink;decoration:none;' class='glyphicon glyphicon-plus'href='#tr".$row['user_id']."' data-toggle='collapse'></a></td><td>". $row['name'] . "</td><td>". $row['total'] . " EGP</td></tr>";

		$entriesres = $obj->dbselect('orders',array('*'),"WHERE user_id = " . $row['user_id'].
		
		" ORDER BY order_date DESC");

		$tbl.= "<tr class='collapse' id=tr".$row['user_id']." ><td colspan='3'><div id=".$row['user_id']." ><ul>";
		foreach($entriesres  as $entriesrow  ) {
			$tbl.= "<li style='width:50%; list-style:none;'>
			<a id='desc' style='color:pink;decoration:none;' class='glyphicon glyphicon-plus' href='#tr".$entriesrow['order_id']."' data-toggle='collapse' aria-expanded='true'></a>
			". date('D jS F Y g.iA', strtotime($entriesrow['order_date']))."<span style='float:right;'>".$entriesrow['total_amount'] ." EGP </span></li>";

			$itemsres =$obj->dbselect('products, prod_order, orders',array('product_name', 'product_price', 'prod_quantity'),

		    " WHERE orders.order_id =".$entriesrow['order_id']."
			AND products.product_id = prod_order.product_id
			AND orders.order_id = prod_order.order_id");

			$tbl.= "<div><ul class='collapse' id=tr".$entriesrow['order_id'].">";
			foreach($itemsres as $itemsrow) {
			$tbl.= "<li style='decoration:none'>". $itemsrow['product_name']."&nbsp;&nbsp;&nbsp;".$itemsrow['product_price'] ." EGP &nbsp;&nbsp;".$itemsrow['prod_quantity']."</li>";

			}$tbl.= "</ul></div>";
		}$tbl.= "</ul></div></td></tr>";
	}
	echo $tbl."</table>".$this->displayPager($obj->get_effected_number());	 
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


   function check_orders_date($user,$from,$to)
   {
	global $obj;
	//echo $from.".............";
	//echo $to;
	if($user==false){
	$result=$obj->dbselect('users, orders',array('users.*','orders.*','SUM( total_amount ) as total'),"WHERE users.user_id >1
	AND users.user_id = orders.user_id
	GROUP BY users.user_id having date(order_date) between '$from' and '$to' order by order_date desc");
     if(count($result)==0){

      	echo " no orders match that date ";
      }
   
   }else{
	$result=$obj->dbselect('users, orders',array('users.*','orders.*','SUM( total_amount ) as total'),"WHERE users.user_id ='.$user.'
	AND users.user_id = orders.user_id
	having date(order_date) between '$from' and '$to' order by order_date desc");
      if(count($result)==0){

      	echo "no orders for that customer match that date";
      }
  }
	$tbl="<table class='table table-hover'><th colspan='2'>Name</th><th>Total</th>";
	
	foreach($result as $row) {
		$tbl.="<tr><td><a id='show' style='color:pink;decoration:none;' class='glyphicon glyphicon-plus'href='#tr".$row['user_id']."' data-toggle='collapse'></a></td><td>". $row['name'] . "</td><td>". $row['total'] . " EGP</td></tr>";

		$entriesres = $obj->dbselect('orders',array('*'),"WHERE user_id = " . $row['user_id'].
		
		" ORDER BY order_date DESC");

		$tbl.= "<tr class='collapse' id=tr".$row['user_id']." ><td colspan='3'><div id=".$row['user_id']." ><ul>";
		foreach($entriesres  as $entriesrow  ) {
			$tbl.= "<li style='width:50%; list-style:none;'>
			<a id='desc' style='color:pink;decoration:none;' class='glyphicon glyphicon-plus' href='#tr".$entriesrow['order_id']."' data-toggle='collapse' aria-expanded='true'></a>
			". date('D jS F Y g.iA', strtotime($entriesrow['order_date']))."<span style='float:right;'>".$entriesrow['total_amount'] ." EGP </span></li>";

			$itemsres =$obj->dbselect('products, prod_order, orders',array('product_name', 'product_price', 'prod_quantity'),

		    " WHERE orders.order_id =".$entriesrow['order_id']."
			AND products.product_id = prod_order.product_id
			AND orders.order_id = prod_order.order_id");

			$tbl.= "<div><ul class='collapse' id=tr".$entriesrow['order_id'].">";
			foreach($itemsres as $itemsrow){
			$tbl.= "<li style='decoration:none'>". $itemsrow['product_name']."&nbsp;&nbsp;&nbsp;".$itemsrow['product_price'] ." EGP &nbsp;&nbsp;".$itemsrow['prod_quantity']."</li>";

			}$tbl.= "</ul></div>";
		}$tbl.= "</ul></div></td></tr>";
	}
	echo $tbl."</table>".$this->displayPager($obj->get_effected_number());	 
   }

   

	
	function getAllUsers()
	{
		global $obj;
	    $result=$obj->dbselect('users',array('users.*'),'WHERE users.user_id >1');
		foreach($result as $row)
	    echo "<option value='".$row['user_id']."'>".$row['name']."</option>";
	}
	
	
}


?>






