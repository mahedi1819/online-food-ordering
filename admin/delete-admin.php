<?php 
 //Include constants.php file here
   include '../config/constant.php';
//1.get the ID of Admin to be deleted
 $id = $_GET['id'];
//2.Create SQL Query to Delete Admin
 $sql = "DELETE FROM tbl_admin WHERE id=$id";
 //Execute the Query 
 $res = mysqli_query($conn, $sql);

 //Check whether  the query executed successfully or not
  if($res==TRUE)
 {
    //Query Exectued successully and Admin Deleted
   // echo "Admin Deleted";
    //Create SEssionn variable to display Message 
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Sucessfully. </div>";

    header("location:".SITEURL.'admin/manage-admin.php');
 }
 else
 {
    //Failed to Delete Admin
    // echo "Failed to Delete Admin ";
   $_SESSION['delete'] =  "<div class='error'>Failed to delete Admin.</div>";
    header("location:".SITEURL.'admin/manage-admin.php');
 }
    

?>