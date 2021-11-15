
<?php include '../config/constant.php'; ?>

<html>
<head>
	
	<title>Login-Food order System</title>
	<link rel="stylesheet" href="../css/admin.css">
	
	

</head>
<body class="log">

	<div class="login">
		<h1 class="text-center">Login Form</h1>
		
		
		<?php 
    
         if(isset($_SESSION["login"]))
         {
         	echo $_SESSION['login'];
         	unset($_SESSION['login']);
         }
         if(isset($_SESSION["no-login-message"]))
         {
          echo $_SESSION['no-login-message'];
          unset($_SESSION['no-login-message']);
         }
         

         ?>
         <br> <br>

		<!--login start-->
		<form action="" method="POST" >
			<p>User Name:</p>
			<input  type="text" name="username" placeholder="Enter Username">
			<br><br>
			<p>Password:</p>
			<input  type="password" name="password" placeholder="Enter Password">
			<br><br>

			<!--<input type="Submit" name="Submit" value="Login" class="btn-primary">-->
      <button type="Submit" name="Submit">Login</button>
     					
			
		</form>
		<br>


		<p class="text-center">Created By-<a href="">Mahedi</a></p>
		
	</div>

</body>
</html>
<?php 
    //check weather the submit button is clicked or not 
  if(isset($_POST["Submit"]))
  {
  	//process for login
  	//get the data from login form
  	 //$username =$_POST['username'];
     ///$password =md5($_POST['password']);

     $username =mysqli_real_escape_string($conn,$_POST['username']);
     $password =md5($_POST['password']);


  	 //sql to check username and password exist or not

  	 $sql ="SELECT *FROM tbl_admin WHERE username ='$username' AND password ='$password'";
  	 //execute query
  	 $res =mysqli_query($conn,$sql);
  	 //count rows weather the user exist or not
  	 $count = mysqli_num_rows($res);
  	 if ($count==1) {
  	 	
  	 	$_SESSION['login'] = "<div class='success'>Login Successful.</div>";

        $_SESSION['user'] =$username;


  	 	 header("location:".SITEURL.'admin/');
  	 	
  	 }
  	 else{
  	 	$_SESSION['login'] = "<div class='error text-center'>username or password did not match.</div>";
  	 	 header("location:".SITEURL.'admin/login.php');

  	 }
  }


?>