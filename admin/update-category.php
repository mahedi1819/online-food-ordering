<?php
include("partials/menu.php");
?>


        


<div class="main-contant">
   <div class="wrapper">
        <h1>Update Category</h1>

        <br><br><br>



        <?php
        if (isset($_GET['id'])) 
        {
        	$id =$_GET['id'];

        	//sql query
        	$sql ="SELECT *FROM tbl_category WHERE id=$id";

        	//execute the query
        	$res =mysqli_query($conn,$sql);

        	//count the rows to check the id i valid or not
        	$count =mysqli_num_rows($res);

        	if ($count==1) 
        	{
        		$row =mysqli_fetch_assoc($res);
        		$title =$row['title'];
        		$current_image=$row['image_name'];
        		$featured=$row['featured'];
        		$active=$row['active'];
        	}

        	else
        	{
        		 $_SESSION['no-category-found'] =" <div class='error'>  Category Not Found.</div>";

   	 	            header("location:".SITEURL.'admin/manage-category.php');

        	}
        }

        else
           {


   	 	        header("location:".SITEURL.'admin/manage-category.php');
           }


        ?>


         <form action="" method="POST" enctype="multipart/form-data">
         
        <table class="tb1-30">
              <tr>
                  <td>Title: </td>

                   <td>
                   <input type="text"name="title" value="<?php echo $title;?>" >
                 </td>

             </tr>

             <tr>
             	 <td>Current image: </td>

                 <td> 
                    <?php 
                    if ($current_image !="") 
                    {
                    	
                    	?>

                    	<img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="100px">

                    	<?php
                    }
                    else
                    {
                    	echo " <div class='error'> Image Not Added.</div>";

                    }

                    ?>
                 </td>
             </tr>

             <tr>
             	 <td>New image: </td>

                 <td> 
                     <input type="file" name="image">
                 </td>
             </tr>
 

             <tr>
                 <td>Featured: </td>
                 <td>
                      <input <?php if($featured=="Yes"){echo "checked  ";} ?> type="radio" name="featured" Value="Yes">Yes
                     
                    <input <?php if($featured=="No"){echo "checked  ";} ?>   type="radio" name="featured" Value="No">NO
                </td>
                 </tr>

             <tr>
                 <td>Active: </td>
                 <td>
                    <input <?php if($active=="Yes"){echo "checked  ";} ?>  type="radio" name="active" Value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked  ";} ?>   type="radio" name="active" Value="No">NO
                </td>
             </tr>
             <tr>
                <td >
                       <input type="hidden" name="current_image" value="<?php echo  $current_image;?>"> 

                       <input type="hidden" name="id" value="<?php echo  $id;?>">


                	   <input type="submit"name="submit"Value ="Update Category" class="btn-secondary">
                </td>
                    </tr>
                    </table>
                    </form> 

                    <?php 

                    if (isset($_POST['submit'])) 
                    {
                      //echo "clicked ";
                        $id=$_POST['id'];
                        $title=$_POST['title'];
                        $current_image=$_POST['current_image'];
                         $featured=$_POST['featured'];
                         $active=$_POST['active'];

                         //updating new image

                         if (isset($_FILES['image']['name']))
                          {

                            $image_name=$_FILES['image']['name'];

                            if($image_name !="")

                            {

                                 $ext = end(explode('.', $image_name));
                        //Rename the Image
                          $image_name = "Food_Category_".rand(000,999).'.'.$ext;//e.g. Food_Category_834.jpg


                          $source_path =$_FILES['image']['tmp_name'];


                          $destination_path = "../images/category/".$image_name;


                          //Finally Upload the Image
                         $upload = move_uploaded_file($source_path ,$destination_path );

                        if($upload==false)

                        {
                           //SET message 
                           $_SESSION['upload'] = "<div class='error'>Failed to upload image. </div>";

                           //Redirect to Add CATEgory page

                           header("location:".SITEURL.'admin/manage-category.php');
                  
                                 //Stop the Process

                             die();
                           }

                             //remove our current image
                             if ($current_image !="") 
                             {

                                 $remove_path="../images/category/".$current_image;

                              $remove= unlink($remove_path);

                              //check weather the image removed or not
                              if($remove==false)
                              {
                                $_SESSION['failed-remove'] = "<div class='error'>Failed To Remove Current Image. </div>";

                                header("location:".SITEURL.'admin/manage-category.php');

                                die();

                              }



                             }


                             




                            }


                             else
                             {
                                $image_name=$current_image;


                              }

                          }
                          
                           else
                           {


                            $image_name=$current_image;

                           }                         

                         //update database

                         $sql2="UPDATE tbl_category SET
                         title='$title',
                         image_name='$image_name',
                         featured='$featured',
                         active ='$active'
                         WHERE  id=$id

                         ";
                         $res2=mysqli_query($conn,$sql2);
                         if ($res2==true) 
                         {
                           
                           $_SESSION['update'] ="<div class='success'>Category Updated  Successfully.</div>";

                           header("location:".SITEURL.'admin/manage-category.php'); 
                         }

                         else
                         {
                            $_SESSION['update'] ="<div class='error'>Failed To Updated Category  .</div>";

                           header("location:".SITEURL.'admin/manage-category.php');

                           

                         }
                        
                    

                 
                        
                    }

                    ?>
        

         <br><br>
</div>
</div>

<?php
include("partials/footer.php");
?>
