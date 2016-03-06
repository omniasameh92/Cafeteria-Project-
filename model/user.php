<?php

class Customer
{
  var $id;
  var $user_name;
  var $pass;
  var $email;
  var $phone;
  var $gender;
  var $msg;
  var $img;
  
 function getCustomerId()
 { 
    global $obj;
    $res=$obj->dbselect('users',array('user_id'),"order by user_id DESC LIMIT 1");
    $this->id=$res['user_id'];
    return $this->id; 
 } 
 
function addCustomer()
{
             global $obj;
               $arr=array('name'=>$this->user_name,'password'=>$this->pass,'email'=>$this->email,'phone_number'=>$this->phone,'gender'=>$this->gender);
              $res=$obj->dbRowInsert('users',$arr);
              $this->id=$obj->get_last_inserted_id(); 	  
               if($res==1){
                   header('location:searchMembers.php');   
               }
 
}//end of register
/**********************************************/



function validateCustomer($rememberMe=false)
{
  global $obj;
$loginrow =$obj->dbselect("users",array('*'),"WHERE email = '" .$this->email."' AND password = '" . $this->pass."'");
//print_r($loginrow);
if(count($loginrow)==1)
{
//echo $loginrow[0]['name'];
if($rememberMe==true)
 {
 setcookie("user_name",$loginrow[0]['name'],time()+60*60*24);
 setcookie("user_id",$loginrow[0]['user_id'],time()+60*60*24);
 }
 else 
 {
 $_SESSION['user_name'] = $loginrow[0]['name'];
 $_SESSION['user_id'] = $loginrow[0]['user_id'];
 }
 if($loginrow[0]['user_id']==1)
 header("Location:/controller/adminhome.php");
 else
 header("Location:/controller/clienthome.php");
}
else
header("Location:index.php?error=1");
}//end of logIn
/***********************************************/
function updateCustomerData(){
 global $obj;
 $arr=array('name'=>$this->user_name,'phone_number'=>$this->phone,'gender'=>$this->gender);
 $res=$obj->dbRowUpdate("users",$arr,"where user_id=".$this->id);
 if($res==1)
  {  
		if(isset($_SESSION['user_name']))
           {
		   $_SESSION['user_name']=$this->user_name;
		header("location:myaccount.php?session=yes");
	}
     	else
		{
		   setcookie("user_name",$this->user_name,time()+60*60*24); 
	header("location:myaccount.php?cookie=yes");

	}
   }

}// end of altering customer data
/***************************************/

//change email/password
function validateLogInDetails($newPass)
{
$sql="select password from users where user_id='$this->id';";
  $result=mysql_query($sql);
  $row=mysql_fetch_assoc($result);
  if($this->pass==$row['password'])
  if(!empty($newPass))
  {
  $update= "update users set password=$newPass, email='$this->email' where user_id='$this->id'; ";
  mysql_query($update);
  header("location:loginDetail.php");
  }
  else
  $this->msg="Incorrect password";

}


function changePassword($newPass)
{
  global $obj;
  $loginrow =$obj->dbselect("users",array('password'),"where user_id='$this->id';");
  //print_r($loginrow);
  if($this->pass==$loginrow[0]['password'])
  {
  $arr=array('password'=>$newPass);
  $res=$obj->dbRowUpdate("users",$arr,"where user_id='$this->id';");
  if($res==1)
   $this->msg="Password has been changed successfully";
  else
   $this->msg="Passwords are not the same";
  }else
  $this->msg="Incorrect password";
 
}


function changeEmail()
{
  global $obj;
  $arr=array('email'=>$this->email);
  $obj->dbRowUpdate('users',$arr,'where user_id='.$this->id);
//  $update= "update users set email='$this->email' where user_id='$_COOKIE[UserID]'"; 
  header("location:loginDetail.php");

}


function editClientData(){

  global $obj;
  $arr=array('name'=>$this->user_name,'phone_number'=>$this->phone,'gender'=>$this->gender,'email'=>$this->email);
  $obj->dbRowUpdate('users',$arr,'where user_id='.$this->id);
  header("location:searchMembers.php");

}




   function displayUsers($from=1,$field="",$value="")
   {
     global $obj;
     
     $tbl="<table  class='table' width='100%'>";
	   //$query="select * from users where user_id>1";
     if($value!=""){
     $result=$obj->dbselect('users',array('*'),"where user_id>1 and $field like '%$value%'");
	  }else{
	   $result=$obj->dbselect('users',array('*'),"where user_id>1");
	 }
	 $rowNow =1; $complete=0;
	 
	 if(count($result)>0){
	 $tbl.="<tr width='80%'><th>Name</th><th>Email</th><th>Phone No</th><th>Gender</th><th>Edit</th><th>Delete</th></tr>";
     }
	 else $tbl.="No matched records please try again";
     foreach($result as $row)
     {
        if($rowNow>=$from && $complete<4)
		{
		  $complete++;
		  $tbl.="".$this->displayRowInTable($row, $field, $value);
         /* if($srow= mysql_fetch_assoc($result))
          {
            $complete++;
		       	$tbl.=$this->displayRowInTable($srow,$field,$value);
          }
          */	  
		    }
		$rowNow++;
		
     }
     $tbl.="</table>";
     $tbl.=$this->displayPager($obj->get_effected_number(),$field,$value);
     return $tbl;	 
   }

   
   function displayRowInTable($row,$field,$value){
   
     $tbl="
	 <tr><td><b>&nbsp;$row[name]</td>
	 <td>$row[email]</td>
	 <td>$row[phone_number]</td>
	 <td>";
	 if($row['gender']=='f') $tbl.="Female"; 
	 else $tbl.="Male";
	 $tbl.="</td><td><a href='editUser.php?id=$row[user_id]&Field=$field&fvalue=$value' style='color:#FF8DB4;'>Edit</a></td>
	 <td><a href='deleteUser.php?id=$row[user_id]&Field=$field&fvalue=$value' style='color:#FF8DB4;'>Delete</a></td></tr>";
     return $tbl;
   }
   
   
   
    function displayPager($numRow,$field,$value){
	  $links="<div>";
	  $p=1;
	  for($x=1;$x<=$numRow;$x+=4)
	     {
		    $links.="|<a href='searchMemebers.php?from=$x&field=$field&value=$value'>$p</a>";
			$p++;
		 }
		 return $links."</div>";
	}


function delete($userid){
   global $obj;
    $obj->dbRowDelete('users',"WHERE user_id=$userid");
}



function getCustomerDetails(){

//$query="select * from users where user_id='$_COOKIE[UserID]'";
   global $obj;
   $row = $obj->dbselect("users",array('*')," where user_id=".$this->id);
   $this->user_name=$row[0]['name'];
   $this->phone = $row[0]['phone_number'];
   $this->gender= $row[0]['gender'];   
   $this->email= $row[0]['email'];   
   $this->id=$row[0]['user_id']; 
}


 function uploadFile($file,$folderFileName)
 {
 if(strpos($file['type'],"image")===false)
 return "File type is not supported or no file chosen";
 if($file['tmp_name']=="none")
  return "The file is too large";
  else
  {
  move_uploaded_file($file['tmp_name'],"$_SERVER[DOCUMENT_ROOT]/$folderFileName");
  return "File uploaded successfully";
  }
 return "error: File is not uploaded".mysql_error();
 }

}

?>

