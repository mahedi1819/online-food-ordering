<?php
//echo" Delete food";

   include '../config/constant.php';

   //echo "delete page";
 if(isset($_GET['id']) AND isset($_GET['image_name']))
 {
   //echo "Get Value and Delete";

 	$id=$_GET['id'];
   	$image_name=$_GET['image_name'];

   	if ($image_name !="") 
   	 {
   	 	
   	 	$path="../images/food/".$image_name;

   	 	//remove the image
   	 	$remove =unlink($path);

   	 	
   	 		if ($remove==false) 

   	 	{
   	 		
   	 		//set the session messege
   	 		$_SESSION['upload'] ="<div class='error'>Failed to remove  image. </div>";


   	 		//redirect to manage category page

   	 		header('location:'.SITEURL.'admin/manage-food.php');

   	 		//stop the process
   	 		die();
   	 	}



      }

       //delete data from database
   	 //sql query to delete data from database
   	 $sql ="DELETE FROM tbl_food WHERE id=$id";

   	 //execut query
   	 $res = mysqli_query($conn,$sql);
   	 //check weather the data is deleted from database
   	 if($res==true)
   	 {
         $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
         
          header('location:'.SITEURL.'admin/manage-food.php');

   	 }
   	 else
   	 {

   	 	$_SESSION['delete'] = "<div class='success'>Failed to Deleted Food.</div>";
         
          header('location:'.SITEURL.'admin/manage-food.php');


   	 }

 	 

 }

 else
 {
  
       $_SESSION['unauthorize'] =" <div class='error'> Failed To Deleted Food.</div>";

   	 
   	 	    
         header('location:'.SITEURL.'admin/manage-food.php');

 }



?>