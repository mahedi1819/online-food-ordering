<?php
include("partials/menu.php");
?>

<div class="main-contant">
     	<div class="wrapper">
     	<h1>UpdateAdmin</h1>

     	<br>

     	<?php
     	                $id = $_GET['id'];
                     //Query to Get all Admin
                      $sql = "SELECT* FROM tbl_admin WHERE id=$id";
                     //Execute the Query
                      $res = mysqli_query($conn, $sql);
                      if($res==true)
                    {
                       //count Rows to Check whether we have data in database or not
                       $count = mysqli_num_rows($res);
                       if($count==1)
                       {
                       	echo "Admin Available";
                       	$rows= mysqli_fetch_assoc($res);

                       	$full_name=$rows['full_name'];
                        $username=$rows['username'];

                       }
                       else{
                       	 header("location:".SITEURL.'admin/manage-admin.php');
 
                       }

                   }

                      
                       
        ?>


     	<form action="" method="POST">
     		<table class="tbl-30">
     			<tr>
     				<td>Full Name</td>
     				<td><input type="text" name="full_name"value="<?php echo $full_name; ?>" ></td>
     				
     			</tr>
     			<tr>
     				<td>Username</td>
     				<td>
     					<input type="text" name="username"value="<?php echo $username; ?>">
     				</td>
     			</tr>
     			<tr>
     				<td colspan="2">
     					<input type="hidden" name="id" value="<?php echo $id; ?>">
     					<input type="Submit" name="Submit" value="Update Admin" class="btn-secondary">
     					
     				</td>
     			</tr>
     		</table>
     		
     	</form>



         </div>
     	 </div>
     	 <?php

     	 if(isset($_POST["Submit"]))
     	 {
     	 	//echo "Button clicked";
     	 	$id=$_POST['id'];
            $full_name=$_POST['full_name'];
            $username=$_POST['username'];


            $sql = "UPDATE tbl_admin SET
            full_name ='$full_name',
             username ='$username' 
            WHERE id=$id
            ";
            $res = mysqli_query($conn, $sql);


            if($res==true)
            {

            	 $_SESSION['update'] = "<div class='success'>Admin Update Sucessfully. </div>";
            	 header("location:".SITEURL.'admin/manage-admin.php');


            }
            else{

            	$_SESSION['update'] = " <div class='error'>Failed to Update Admin.</div>";
            	 header("location:".SITEURL.'admin/manage-admin.php');

            }


     	 }
     	 ?>




     	 
<?php
include("partials/footer.php");
?>