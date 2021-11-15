<?php


   include '../config/constant.php';

   //echo "delete page";
 if(isset($_GET['id']) AND isset($_GET['image_name']))
   
   {
   	//echo "Get Value and Delete";
   	$id=$_GET['id'];
   	$image_name=$_GET['image_name'];
   	 if ($image_name !="") 
   	 {
   	 	
   	 	$path="../images/category/".$image_name;

   	 	//remove the image
   	 	$remove =unlink($path);

   	 	//if failed  to remove image then add an error masage and stop the person
   	 	if ($remove==false) 

   	 	{
   	 		
   	 		//set the session messege
   	 		$_SESSION['remove'] ="<div class='error'>Failed to remove category image. </div>";


   	 		//redirect to manage category page

   	 		header("location:".SITEURL.'admin/manage-category.php');

   	 		//stop the process
   	 		die();


   	 	}

   	 }

   	 //delete data from database
   	 //sql query to delete data from database
   	 $sql ="DELETE FROM tbl_category WHERE id=$id";

   	 //execut query
   	 $res = mysqli_query($conn,$sql);
   	 //check weather the data is deleted from database
   	 if($res==true)
         {
   	 	$_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";

   	 	header("location:".SITEURL.'admin/manage-category.php');


   	

   	 }

   	 else
   	 {

   	 		 $_SESSION['delete'] =" <div class='error'> Failed To Deleted Category.</div>";

   	 
   	 	    header("location:".SITEURL.'admin/manage-category.php');


   	 }

   	 //redirect to manage category page with message



   }


   else
   {

   	header("location:".SITEURL.'admin/manage-category.php');


   }
?>