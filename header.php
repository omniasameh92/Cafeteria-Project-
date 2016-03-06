<html>
<head>
    <title>Cafeteria</title>
            <meta charset='utf-8' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet"href="css/bootstrap.css">
        <link rel="stylesheet"href="css/my-bootstrap.css">

        <!-- jQuery library -->
        <script src="js/jquery.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="js/bootstrap.min.js"></script>
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    </script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700,800,400,600' rel='stylesheet' type='text/css'>
  </head>
  <body>
  			<div class="top-header">
			<div class="container">
			<?php
               $user_name;
               $user_id;
               $login=false;
          
						  
                      if($login){
/*
                       	if($user_id==1){
                       		header('location:/controller/adminhome.php');

                       	}else{

                       		header('location:/cafe_backup/controller/clienthome.php');
                       	}*/
						  echo "
				<div class='top-header-left'>
					<ul>
						";
						
						
						if($user_id=='1')
                			echo"<li> </div></ul>
				</div><div class='top-header-center'>
					<p><span> </span></p>
				</div>";
						else
						    echo"
						<div class='clearfix'> </div>
					</ul>
				</div>
				<div class='top-header-center'>
                      
				</div>";

				echo"<div class='top-header-right'>
					<ul>
						   <li>";
	                        $file="http://localhost/cafeteria/userImgs/".$user_id.".jpg";
							$file_headers = @get_headers($file);
                            if($file_headers[0] == 'HTTP/1.1 404 Not Found')
                               $menuBar= '<img src="images/profilePic.png" height="25" width="25">'; 
                            else
                               $menuBar= '<img src="userImgs/'.$user_id.'.jpg" height="25" width="25">';
                            $menuBar.=" &nbsp;&nbsp;".$user_name."&nbsp;&nbsp;&nbsp;</a></li>
						    <li><a href='logOut.php'>Logout</a></li>							<li><form method='get' action='searchProducts.php'>
								<input type='text' name='q'>
								<input type='submit' name= 'submit' value='s' />
							</form></li>";
							echo $menuBar;
						  }
						else 
						echo "
						<div class='top-header-left'>
					<ul>
						
						<div class='clearfix'> </div>
					</ul>
				</div>
				<div class='top-header-center'>
				
					<p><span class='cart'> </span>Welcome To Smart Cafe<label></label></p>
				</div>
				<div class='top-header-right' style='left:100px;'>
					<ul>
						<li>
							
						</li>";
						
						?>
						
						
                </ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="main-menu">
			<div class="container">
			<div class="head-nav">
			
				<span class="menu"> </span>
				
				<?php /*if($login)
						  {
                             if($user_id=='1'){
						  	header('location:/cafe_backup/controller/adminhome.php');
						  	 }else{

                              header('location:/cafe_backup/controller/clienthome.php');
						  	 }
						  
						  	/*
						  echo '
				    <ul>';
					
					if($user_id=='1')
					echo'
					<li class="active"><a href="controller/clienthome.php">Home</a></li>
					<li><a href="#">products</a></li>
					     <li><a href="searchMembers.php">Users</a></li>
					     <li><a href="#">Checks</a></li>';
					else
					echo'<li class="active"><a href="controller/clienthome.php">Home</a></li>
					<li><a>about</a></li>
					<div class="clearfix"> </div>
				</ul>'; }else 
				echo'<div style="height:50px; width:100%;"></div>'; 
				*/
			//}
				?>
			</div>	
					<script>
						$( "span.menu" ).click(function() {
						  $( ".head-nav ul" ).slideToggle(300, function() {
						  });
						});
					</script>

				<div class="logo">
					<img src="images/logo3.png" height="199" width="290" title="Smart Cafe" />
				</div>
			</div>
		</div>
<div class="container">
					<div class="img-slider">
					