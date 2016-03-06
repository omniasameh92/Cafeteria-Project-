
<?php

class order_control{

   function get_orders(){
    
    global $obj;
                 
     $res=$obj->dbselect("users u ,orders o , extension e , ext_room m",array('o.notes,o.order_date','o.total_amount','o.order_id','u.name' ,'e.ext_number','m.room_number')
     ,"where o.user_id=u.user_id
       and   o.room_id=m.room_id 
       and  m.ext_id= e.ext_id
       and o.order_state='processing' order by o.order_date");   
       if(count($res)==0){
             echo '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>There are  no orders yet wait for making orders please .</div>';
             return;

       } 
            echo "<table class='table table-hover'>";
           echo "<th colspan='2'>Order date</th><th>Username</th><th>Extension</th><th>Room</th><th>Actions</th>";
        foreach($res as $order){
                echo"<tr><td><a  id='show' style='color:pink;decoration:none;' class='glyphicon glyphicon-plus'href='#tr".$order['order_id']."' data-toggle='collapse'></a></td><td>".$order['order_date']."</td><td>".$order['name']."</td><td>".$order['ext_number']."</td><td>".$order['room_number']."</td><td><button id='".$order['order_id']."' class='deliver'>Deliver</button></td></tr>";         
                echo "<tr class='collapse' id='tr".$order['order_id']."'><td colspan='6'>";
                
                $res1=$obj->dbselect("prod_order pd , products p",array('p.product_name','p.product_price','p.product_pic','pd.prod_quantity'),
                 "where pd.order_id=".$order['order_id'].
                 " and pd.product_id=p.product_id");  
                foreach($res1 as $prod){
                     echo "<div  style='float:left;'class='product'>".
                     "<img width='60px' height='60px'". 
                     "src='/project/uploads/".$prod['product_pic']."'><span style='display:block;'>".$prod['product_name'].
                     "</span><span>price:".$prod['product_price']."</span>"
                     ."<br><span>quantity:".$prod['prod_quantity']."</span>
                     ";     
                    }
                echo "</div></td><tr>";
            
            }
             
         echo "</table>";



   }


     function regular_order($user){
             
             global $obj;
             
             $res=$obj->dbselect("orders o , prod_order pd",array('pd.product_id ','count(pd.product_id)'),"where o.order_id = pd.order_id 
               and o.user_id=".$user."  group by pd.product_id order by count(pd.product_id) desc limit 5;");
             if(count($res)==0){
                 return "There is no orders,make an order please.";
             }
           foreach($res as $prod){

            $pobj=$obj->dbselect("products",array('product_id','product_name','product_price','product_pic'),"where product_id=".$prod['product_id']." and product_exist = 1 and product_state=1");                    
              
               foreach($pobj as $p){

                echo "<div style='display:inline;margin:10;float:left;'class='product'><img id='".$p['product_id'].",".$p['product_name'].",".$p['product_price']."' width='60px' height='60px'src='/project/uploads/".$p['product_pic']."'><span style='display:block'>".$p['product_name']."</span><span>price:".$p['product_price']."</span></div>";

            //<div style='display:inline;' class='product'><img id='.$pobj['product_id'].','.$pobj['product_name'].','.$pobj['product_price'].' width='60px' height='60px'src='/project/uploads/'.$pobj['product_pic'].'><span>'.$pobj['product_name'].'</span><span>'.$pobj['product_price'].'</span></div>);</script>'";

             
                  }   
          

                    }
                 }
         function my_orders($order_date,$user){
                     global $obj;
                    
        //mysql> select o.order_date ,o.total_amount,o.order_id, m.room_number FROM orders o , ext_room m where o.room_id=m.room_id and o.user_id=2 order by o.order_date desc  ;
                  if($order_date==true){
                     $from= $_GET['date_from'];
                   //  echo $from;
                      $to= $_GET['date_to'];
                     //   echo $to;
                 $res=$obj->dbselect("orders o , ext_room m",array('o.order_date','o.total_amount','o.order_state','o.order_id','m.room_number')
                ,"where o.room_id=m.room_id and o.user_id=".$user." having date(o.order_date) between '".$from."' and '".$to."' order by o.order_date desc");

                  }else{

               $res=$obj->dbselect("orders o , ext_room m",array('o.order_date','o.total_amount','o.order_state','o.order_id','m.room_number')
               ,"where o.room_id=m.room_id and o.user_id=".$user." order by o.order_date desc");
                     
                }

           if(count($res)==0 && $order_date==false){

              echo  '<div class="alert alert-danger fade in">'.
              '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>There are  no orders yet make an order please.</div>';
                return;
             } 
           if(count($res)==0 && $order_date==true){
               echo  '<div class="alert alert-danger fade in">'.
              '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>There are  no orders match this date .</div>';
            return;
           }   
        echo "<table  class='table table-hover'>";
           echo "<th colspan='2'>Order date</th><th>Status</th><th>Room</th><th>Total amount</th><th>Actions</th>";
        foreach($res as $order){
             if($order['order_state']=='Processing'){
            echo"<tr><td><a  id='show' style='color:pink;decoration:none;' class='glyphicon glyphicon-plus'href='#".$order['order_id']."' data-toggle='collapse'></a></td><td>".$order['order_date']."</td><td>".$order['order_state']."</td><td>".$order['room_number']."</td><td>".$order['total_amount']."</td><td><button class='delete' id='cancel,".$order['order_id']."'>cancel</button></td></tr>";
                }else{

              echo"<tr><td><a  id='show' style='color:pink;decoration:none;' class='glyphicon glyphicon-plus'href='#".$order['order_id']."' data-toggle='collapse'></a></td><td>".$order['order_date']."</td><td>".$order['order_state']."</td><td>".$order['room_number']."</td><td>".$order['total_amount']."</td><td></td></tr>";       
                }
                echo "<tr id=tr".$order['order_id']." ><td colspan='6'><div id=".$order['order_id']." class='collapse'>";
                $res1=$obj->dbselect("prod_order pd , products p",array('p.product_name','p.product_price','p.product_pic','pd.prod_quantity'),
                 "where pd.order_id=".$order['order_id'].
                 " and pd.product_id=p.product_id");  
                foreach($res1 as $prod){
                     echo "<div class='product'>".
                     "<img width='60px' height='60px'". 
                     "src='/project/uploads/".$prod['product_pic']."'><p style='display:block;'>".$prod['product_name'].
                     "</p><p> Price:".$prod['product_price']."</p>"
                     ."<p>Nu. ordered :".$prod['prod_quantity']."</p>
                     </div>";     
                    }
                echo "</div></td><tr>";
                 

            }
             
         echo "</table>";



         }
          function delete_order(){

             global $obj;

          if(isset($_POST['order_id'])){


          $res=$obj->dbRowDelete('orders',"where order_id=".$_POST['order_id']);
           echo $res;
             }

          }
          function update_order(){
                 global $obj;
                 if(isset($_POST['order_id'])){
                          $arr=array('order_state' => 'Out for delivery');
                        $res=$obj->dbRowUpdate('orders',$arr,"where order_id=".$_POST['order_id']);
                        echo $res;

                 }
              

          }

          function request_order(){

              global $obj;
              $user=0;
             if(isset($_POST['arr'])&& isset($_POST['room_id']) && isset($_POST['order_total']) && isset($_POST['notes'])){

              if(isset($_SESSION['user_id'])){

                
                  $user=  $_SESSION['user_id'];
                    
              }elseif(isset($_COOKIE['user_id'])){
              
                  $user= $_COOKIE['user_id'];
              }

              
            //2016-02-26 23:24:43
              $arr=array("order_date"=>date('y-m-d h:m:i'),"room_id"=>$_POST['room_id'],
              "user_id"=>$user,"requested_by"=>$user,
              "total_amount"=>$_POST['order_total'],
              "order_state"=>"1",
              "notes"=>$_POST['notes']);
              $obj->dbRowInsert('orders',$arr);
              $order_id=$obj->get_last_inserted_id();   
              
              $products=$_POST['arr'];
              
              foreach($products as $prod){
                        $temp=$obj->dbselect('products',array('product_exist','product_state','product_price')," where product_id =".$prod['id']);                                                  
                        if($temp[0]['product_state']==0 || $temp[0]['product_exist']==0 || $temp[0]['product_price']!=$prod['price']){
                            $obj->dbRowDelete('orders', " where order_id = ".$order_id);
                            $obj->dbRowDelete('prod_order', " where order_id = ".$order_id);
                           
                             echo "-1";
                            return;
                          }
                 $prod_arr=array("order_id"=>$order_id,"product_id"=>$prod['id'],"prod_quantity"=>$prod['quan']);
                
                 $obj->dbRowInsert('prod_order',$prod_arr);
              }
             // $obj->dbRowInsert('orders',$arr);
              echo $user;
            }



          }
          function request_order_admin(){
                     global $obj;
                     $user=0;
            if(isset($_POST['arr'])&& isset($_POST['room_id']) && isset($_POST['order_total']) && isset($_POST['notes'])){

  if(isset($_SESSION['user_id'])){
       

     $user=  $_SESSION['user_id'];

  }elseif($_COOKIE['user_id']){
  
      $user= $_COOKIE['user_id'];
  }
//2016-02-26 23:24:43
  $arr=array("order_date"=>date('y-m-d h:m:i'),"room_id"=>$_POST['room_id'],
  "user_id"=>$_POST['foruser'],"requested_by"=>$user,
  "total_amount"=>$_POST['order_total'],
  "order_state"=>"1",
  "notes"=>$_POST['notes']);
  $obj->dbRowInsert('orders',$arr);
  $order_id=$obj->get_last_inserted_id();   
  
  echo $user;
  
  $products=$_POST['arr'];
  
  foreach($products as $prod){
     $prod_arr=array("order_id"=>$order_id,"product_id"=>$prod['id'],"prod_quantity"=>$prod['quan']);
     $obj->dbRowInsert('prod_order',$prod_arr);
      }
 // $obj->dbRowInsert('orders',$arr);

         }
          }

 }

$ordcon = new order_control();

?>