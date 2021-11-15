<?php
include("partials/menu.php");
?>


<div class="main-contant">
     	<div class="wrapper">
     	<h1>Add Admin</h1>
     	<br> <br> <br> <br><br>
          
          <?php
          if(isset($_SESSION['add']))
          {
               echo $_SESSION['add'];
               unset($_SESSION['add']);

          }

          ?>


     	<form action="" method="POST">
     		<table class="tbl-30">
     			<tr>
     				<td>Full Name</td>
     				<td><input type="text" name="full_name" placeholder="Enter your Name"></td>
     				
     			</tr>
     			<tr>
     				<td>Username</td>
     				<td>
     					<input type="text" name="username" placeholder="Your Name">
     				</td>
     			</tr>
     			<tr>
     				<td>Password</td>
     				<td>
     					<input type="password" name="password" placeholder="Your Password">
     				</td>
     			</tr>
     			<tr>
     				<td colspan="2">
     					<input type="Submit" name="Submit" value="Add Admin" class="btn-secondary">
     					
     				</td>
     			</tr>
     		</table>
     		
     	</form>



</div>
     	
     </div>







<?php
include("partials/footer.php");
?>


<?php
//process the value from form and save it in database
//check weather the submit button is clicked or not
if(isset($_POST["Submit"]))
{
	$full_name = $_POST["full_name"];
	$username =  $_POST["username"];
	$password = md5($_POST["password"]);

	//database connection
	$sql ="INSERT INTO tbl_admin SET

     full_name ='$full_name',
     username ='$username',
     password ='$password'
     ";
     $conn = mysqli_connect('localhost','root') or die(mysqli_error());
     $db_select =mysqli_select_db($conn, 'food_order') or die(mysqli_error());
	$res = mysqli_query($conn, $sql) or die(mysqli_error());

     if($res==TRUE)
     {
          //echo "Data Inserted";
          $_SESSION['add'] = "<div class='success'>Admin Added Sucessfully. </div>";

          header("location:".SITEURL.'admin/manage-admin.php');

     }
     else{
          //echo "Failed to inset Data";
          $_SESSION['add'] = " <div class='error'>Failed to Add Admin.</div>";

          header("location:".SITEURL.'admin/add-admin.php');

     }

}

?>


