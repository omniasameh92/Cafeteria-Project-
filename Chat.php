<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {


   protected $clients;
   protected $obj;

   public function __construct() {
       //require('user.php'); 
      $this->clients = new \SplObjectStorage;
      
     }


    public function onOpen(ConnectionInterface $conn){
    //store the new connection
    $this->clients->attach($conn);

   // echo "\n someone connected\n";
     }

    public function onMessage(ConnectionInterface $from, $msg) {
    //send the message to all the other clients except the one who sent.
         //echo $msg;
       $msg1=json_decode($msg,true);
     // print_r($msg1);
      
       
      foreach ($this->clients as $client){

           $client->send($msg);

      }
    
/*

      global $obj;

     
     $msg1=json_decode($msg,true);
     $len=count($msg1);
     //print_r($msg1);
      if(isset($msg1['type'])){

     if($msg1['type']=='getproducts'){   

        foreach ($this->clients as $client){ 

             $res=$obj->dbselect('products',array('cat_id','product_name','product_id','product_price','product_pic','product_state'),'where cat_id='.$msg1["catid"].'');  
                
             if(count($res)>0){
             $res=json_encode($res);
             }else{
              $res='no product';
             }
             $client->send($res);
        }


     }

     if($msg1['type']=='addproduct'){       
        foreach ($this->clients as $client){
           if($from != $client){
          $res=$obj->dbselect('products',array('cat_id','product_name','product_id','product_price','product_pic','product_state'),'where cat_id='.$msg1["catid"].'');  
             if(count($res)>0){
             $res=json_encode($res);
             }else{
              $res='no product';
             }
             $client->send($res);
         
              }
  }
}

 if($msg1['type']=='order'){ 
       foreach ($this->clients as $client){
            $client->send("order");      
       }

   }

 }

*/
  }

   public function onClose(ConnectionInterface $conn) {
    $this->clients->detach($conn);
    //echo "\nsomeone has disconnected\n";
   }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    echo "\n An error has occurred: {$e->getMessage()}\n";
    $conn->close();
   }
}




?>