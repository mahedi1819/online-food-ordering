<?php
include("partials/menu.php");
?>

<div class="main-contant">
     	<div class="wrapper">
     	<h1>Change Password</h1>

          <br> <br>
           <?php
          if(isset($_GET['id']))
          {
              $id = $_GET['id'];

          }

          ?>

     	<form action="" method="POST">
     		<table class="tbl-30">

     			<tr>
     				<td>Current Password:</td>
                         <td> 

                         <input type="Password" name="current_password" placeholder="Current Password"> 
                         </td>
     			</tr>

                    <tr>
                         
                         <td>New Password</td>

                         <td> <input type="Password" name="new_password" placeholder="New Password"> </td>
                    </tr>

                    <tr>
                         
                         <td>Confirm Password</td>
                         <td>
                         <input type="Password" name="confirm_password" placeholder="Confirm Password">
                         </td>
                         </tr>




                         <tr>
                         <td colspan="2">
                              <input type="hidden" name="id" value="<?php echo $id; ?>">
                              
                              <input type="Submit" name="Submit" value="Change Password"class="btn-secondary"
                              
                         </td>
                    </tr>
                    




     	</table>
     		
     	</form>



         </div>
     	 </div>

           <?php 
           //check weather the submit button clicked or not 
          if(isset($_POST["Submit"]))
          {
               $id= $_POST["id"];
               $current_password= md5($_POST["current_password"]);
               $new_password = md5($_POST["new_password"]);
               $confirm_password = md5($_POST["confirm_password"]);

               //check weather the user with current id and current password exists or not
               $sql="SELECT * FROM tbl_admin WHERE id =$id AND Password='$current_password'";
               //execute the query
               $res = mysqli_query($conn, $sql);
                if($res==true)
                {
                    //check data is availabe or not 
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //echo "User found";
                         
                         if ($new_password==$confirm_password) {
                                      


                          $sql = "UPDATE tbl_admin SET
                           Password ='$new_password'
                            WHERE id=$id
                           ";

                            $res = mysqli_query($conn, $sql);


                            if($res==true)
                        {

                         $_SESSION['change-pass'] = "<div class='success'> Password Change Successfully. </div>";
                         header("location:".SITEURL.'admin/manage-admin.php');


                         }
                         else{

                         $_SESSION['change-pass'] = " <div class='error'>Failed to Change Password.</div>";
                          header("location:".SITEURL.'admin/manage-admin.php');

                          }


                         }


                         else{

                    $_SESSION['pass-not-match'] = " <div class='error'>Password did not match.</div>";
                    header("location:".SITEURL.'admin/manage-admin.php');

                         }


                    }
                    else
                    {
                          
                    $_SESSION['user-not-found'] = " <div class='error'>user not found.</div>";
                    header("location:".SITEURL.'admin/manage-admin.php');

                    }

                
                }
           }




            ?>



<?php
include("partials/footer.php");
?>