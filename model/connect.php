<?php

class dbconnect{
/*
private $servername = "localhost";
private $username = "root";
private $password = "iti";
private $db_name ="cafeteriadb";
*/

private $servername = "127.3.152.130";
private $username = "adminmvzsASc";
private $password = "sDGxwqJBW9qU";
private $db_name ="cafeteriadb";

static $conn =null;
         
        private  function __construct(){
                  
                  self::$conn=mysqli_connect($this->servername,$this->username,$this->password,$this->db_name)or die('Can not Connect To DB');         
               }

static function connect_db(){
      
  // Create connection
    if(self::$conn==null){
           
           new dbconnect();
     }
        return self::$conn;
              
     }
 
}


 
?> 
