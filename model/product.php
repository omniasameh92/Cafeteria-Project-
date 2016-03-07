<?php

 
class Product
{

  
function searchProduct(){
    $query="select * from products where product_name='$this->name'";
     return previewResultInTable($query,true,"proedit.php");    
   }
   
  function displayProdWithImgs($from=1,$catno="",$q="")
   {/*
     global $obj;
     $tbl="<table>";
	 if($q!=""){
     $result=$obj->dbselect('products',array('*'),"where product_name like '%$q%'");
	  }else{
	   $result=$obj->dbselect('products',array('*'),"");
	 }
	 $rowNow =1; $complete=0;
	 $tbl.="<tr valign='top'>";
	 foreach($result as $row)
     {
        if($rowNow>=$from && $complete<4)
		{
		  $complete++;
		  $tbl.="<td>".$this->displayRowInTable($row)."</td>";
          		  
		}
		$rowNow++;
     }$tbl.="</tr>";
     return $tbl."</table>".$this->displayPager($obj->get_effected_number(),$catno,$q);;	 
   */
     $con=0;
             global $obj;
             if($q!=""){
    
                $res=$obj->dbselect("products",array('*'),"where  product_exist = 1 and product_name like '%$q%'");          
	         }else{
	              $res=$obj->dbselect('products',array('*')," where product_exist = 1 ");
	         }
	         if(count($res)==0){

	         	//echo " no products yet ";
	         	return;
	         }
             
              foreach($res as $p){
                 
                  if($p['product_state']!=0){
                     
                     echo "<div style='display:inline;margin:10;float:left;'class='product'><img id='".$p['product_id'].",".$p['product_name'].",".$p['product_price']."' width='60px' height='60px'src='/uploads/".$p['product_pic']."'><span style='display:block'>".$p['product_name']."</span><span>price:".$p['product_price']."</span></div>";
                     
                     }

                }   
        
   
             }

   
   function displayRowInTable($row){
   // echo "<div style='display:inline;margin:10;float:left;'class='product'><img id='".$p['product_id'].",".$p['product_name'].",".$p['product_price']."' width='60px' height='60px'src='/project/uploads/".$p['product_pic']."'>
   	//<span style='display:block'>".$p['product_name']."</span><span>price:".$p['product_price']."</span></div>";
     $tbl="<table class='table'>
	 <tr><td>
	 <img src='images/foot.png' height='100' width='100'>
	 </td></tr>
	 <tr><td><b>&nbsp;$row[product_name]</td></tr>
	 <tr><td>$row[product_price]</td></tr></table>";
     return $tbl;
   }
   
   
   
    function displayPager($numRow,$catno,$q){
	  $links="<div><";
	  $p=1;
	  for($x=1;$x<=$numRow;$x+=4)
	     {
		    $links.="|<a href='clienthome.php?from=$x&catno=$catno&q=$q'>$p</a>";
			$p++;
		 }
		 return $links."|></div>";
	}
   
}

?>

