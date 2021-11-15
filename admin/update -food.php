
<?php
include("partials/menu.php");
?>



 <div class="main-contant">
   <div class="wrapper">
        <h1>Update Food</h1>

        <br><br><br><br>




 <?php
         if (isset($_GET['id'])) 
        {
            $id =$_GET['id'];

            //sql query
            $sql2 ="SELECT *FROM tbl_food WHERE id=$id";

            //execute the query
            $res2 =mysqli_query($conn,$sql2);
            $row2 =mysqli_fetch_assoc($res2);

            //count the rows to check the id i valid or not
           
            $title = $row2['title'];
            $description  = $row2['description'];
            $price = $row2['price'];
            $current_image  = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured  =$row2['featured'];
            $active  = $row2['active'];

         }

         else
         {

            header('location:'.SITEURL.'admin/manage-food.php');

         }

         ?>


        <form action="" method="POST" enctype="multipart/form-data">
         
        <table class="tb1-30">

        	 <tr>
                  <td>Title: </td>

                   <td>
                   <input type="text"name="title"value="<?php echo $title;?>" >
                 </td>

             </tr>

             <tr>
                    <td>Description: </td>
                    <td> 
                       <textarea name="description" cols="30" rows="5" ><?php echo $description;?></textarea>     
                     </td>
                </tr>

                 <tr>
                    <td>price: </td>
                     <td>
                         <input type="number" name="price"value="<?php echo $price;?>">
                     </td>
                 </tr>
                 

                  <tr>
                   <td>Current Image: </td>
                     <td>
                   <?php 
                    if ($current_image =="") 
                    {
                        echo " <div class='error'> Image Not Added.</div>";
                    }
                    else
                    {
                        
                         ?>

                        <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="100px">

                        <?php

                    }

                    ?>
                     </td>
                 </tr>

                 <tr>
                   <td>Select New Image: </td>
                     <td>
                         <input type="file" name="image">
                     </td>
                 </tr>

                 <tr>
                   <td>Category: </td>
                     <td>
                         <select name="category">
                         	<?php
                         		$sql ="SELECT *FROM tbl_category WHERE active ='Yes'";

        	                   //execute the query
        	                 $res =mysqli_query($conn,$sql);

        	                //count the rows to check the id i valid or not
        	                  $count =mysqli_num_rows($res);

        	                  if ($count>0)
        	                   {

        	                   	while($row=mysqli_fetch_assoc($res))
                                 { 
                                   //get the details of categories
                                    
                                   $category_title = $row['title'];
                                   $category_id = $row['id'];

                                   

                                   ?>

                                   <option <?php if($current_category==$category_id){echo "selected";} ?> Value="<?php echo $category_id; ?>"><?php echo $category_title; ?></options>
                                    <?php

                                 }

        	                  	
        	                  }

        	                  else 
        	                  {
        	                   echo "<option  Value='0'> Category Not Available .</option>";

        	                  }


                         	?>
                         	

                         	
                         </select>
                     </td>
                 </tr>
                  <tr>
                    <td>Featured: </td>
                 
                 <td>
                    <input <?php if($featured=="Yes"){echo "checked  ";} ?> type="radio" name="featured" Value="Yes">Yes
                
                    <input <?php if($featured=="No"){echo "checked  ";} ?>  type="radio" name="featured" Value="No">NO
                </td>
            </tr>

            <tr>
                 <td>Active: </td>
                 <td>
                    <input <?php if($active=="Yes"){echo "checked  ";} ?>type="radio" name="active" Value="Yes">Yes
                
                    <input <?php if($active=="No"){echo "checked  ";} ?>  type="radio" name="active" Value="No">NO
                </td>
             </tr>

             <tr>
                <td Colspan="2";>

                    <input type="hidden" name="id" value="<?php echo  $id;?>">
                    <input type="hidden" name="current_image" value="<?php echo  $current_image;?>">
                    <input type="submit"name="submit"Value ="Update Food" class="btn-secondary">
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
                        $description=$_POST['description'];
                        $price=$_POST['price'];
                        $current_image=$_POST['current_image'];
                        $category=$_POST['category'];
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
                                $image_name = "Food_Name_".rand(000,999).'.'.$ext;//e.g. Food_Category_834.jpg

                                $source_path =$_FILES['image']['tmp_name'];


                                 $destination_path = "../images/food/".$image_name;


                                 //Finally Upload the Image
                                 $upload = move_uploaded_file($source_path ,$destination_path );

                                  if($upload==false)

                                  {
                                     //SET message 
                                   $_SESSION['upload'] = "<div class='error'>Failed to upload image. </div>";

                                    //Redirect to Add CATEgory page

                                    header("location:".SITEURL.'admin/manage-food.php');
                  
                                    //Stop the Process

                                    die();
                               }

                                //remove our current image
                             if ($current_image !="") 
                             {

                                 $remove_path="../images/food/".$current_image;

                                  $remove= unlink($remove_path);

                                   //check weather the image removed or not
                                 if($remove==false)
                                {
                                 $_SESSION['remove-failed'] = "<div class='error'>Failed To Remove Current Image. </div>";

                                    header("location:".SITEURL.'admin/update -food.php');

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

                         $sql3="UPDATE tbl_food SET
                         title='$title',
                         description='$description',
                         price=$price,
                         image_name='$image_name',
                         category_id='$category',
                         featured='$featured',
                         active ='$active'
                         WHERE  id=$id

                         ";

                          $res3=mysqli_query($conn,$sql3);
                         if ($res3==true) 
                         {
                           
                           $_SESSION['update'] ="<div class='success'>Food Updated  Successfully.</div>";

                           header("location:".SITEURL.'admin/manage-food.php'); 
                         }

                         else
                         {
                            $_SESSION['update'] ="<div class='error'>Failed To Updated Food  .</div>";

                           header("location:".SITEURL.'admin/manage-food.php');

                           

                         }
                        


                         }


             ?>




         </div>
       </div>





<?php
include("partials/footer.php");
?>
