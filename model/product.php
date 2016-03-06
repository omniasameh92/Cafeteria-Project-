<?php
mysql_connect("localhost","root","");
mysql_select_db("cafeteriadb");
 mysql_query("SET CHARACTER SET utf8");
 
class Product
{

  
function searchProduct(){
    $query="select * from products where product_name='$this->name'";
     return previewResultInTable($query,true,"proedit.php");    
   }
   
   function displayProdWithImgs($from=1,$catno="",$q="")
   {
     $tbl="<table>";
	 $query="select * from products ";
	 if($q!="")
	   $query.="where product_name like '%$q%'";
	 $result=mysql_query($query);
	 $rowNow =1; $complete=0;
	 $tbl.=$this->displayPager(mysql_affected_rows(),$catno,$q);
     while($row=mysql_fetch_assoc($result))
     {
        if($rowNow>=$from && $complete<4)
		{
		  $complete++;
		  $tbl.="<tr valign='top'><td>".$this->displayRowInTable($row)."</td>";
          if($srow= mysql_fetch_assoc($result))
          {
            $complete++;
			$tbl.="<td>".$this->displayRowInTable($srow)."</td>";;
          }
          $tbl.="</tr>";		  
		}
		$rowNow++;
     }
     return $tbl."</table>";	 
   }

   
   function displayRowInTable($row){
   
     $tbl="<table class='table'>
	 <tr><td>
	 <a href=searchProducts.php?catno=>
	 <img src='images/foot.png' height='100' width='100'></a>
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
		    $links.="|<a href='searchProducts.php?from=$x&catno=$catno&q=$q'>$p</a>";
			$p++;
		 }
		 return $links."|></div>";
	}
   
}

?>

