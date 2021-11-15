<?php
include("partials/menu.php");

?>



<div class="main-contant">
   <div class="wrapper">
        <h1>Add Food </h1>
        <br><br>

        <?php
        if(isset($_SESSION ['upload']))
            {
               echo $_SESSION['upload'];
               unset($_SESSION['upload']);

            }



         ?>
        

         <br><br>

          <form action="" method="POST" enctype="multipart/form-data">
         


           <table class="tb1-30">


           	<tr>
                  <td>Title: </td>

                   <td>
                   <input type="text"name="title"Placeholder="Food Title">
                 </td>

             </tr>

             <tr>
                    <td>Description: </td>
                    <td> 
                       <textarea name="description" cols="30" rows="5" Placeholder="Description of the Food."></textarea>     
                     </td>
                </tr>

                <tr>
                    <td>price: </td>
                     <td>
                         <input type="number" name="price">
                     </td>
                 </tr>

                  <tr>
                   <td>Select Image: </td>
                     <td>
                         <input type="file" name="image">
                     </td>
                 </tr>

                 <tr>
                    <td>Category: </td>
                     <td>
                        <Select name="category">

                        	<?php
                              //create PHP Code to display  Categories from Database
                              //1.CReate SQL to get all active Categories from database
                              $sql = "SELECT* FROM tbl_category WHERE active='Yes'";

                              //2. Display on Drpopdown

                              //Exciting query
                               $res = mysqli_query($conn,$sql);

                              //count Rows to check whether  we have categories or not
                              $count = mysqli_num_rows($res);

                          

                            //IF count is greather than zero,we have categories else we donot have categories
                              if($count>0)
                              {
                                 //WE have categories
                                while($row=mysqli_fetch_assoc($res))
                                 { 
                                   //get the details of categories
                                    $id = $row['id'];
                                   $title = $row['title'];
                                    ?>

                                   <option Value="<?php echo $id; ?>"><?php echo $title; ?></options>
                                   	<?php

                                  
                                     }

                                 }
                              else
                              {
                                //WE do not have categories
                                ?>
                                <option  Value="0">No Category Found</option>
                                <?php
                              }
                              ?>



                          
                        </Select>

                    </td>
                 </tr>

                 <tr>
                    <td>Featured: </td>
                 
                 <td>
                    <input type="radio" name="featured" Value="Yes">Yes
                
                    <input type="radio" name="featured" Value="No">NO
                </td>
            </tr>
            <tr>
                 <td>Active: </td>
                 <td>
                    <input type="radio" name="active" Value="Yes">Yes
                
                    <input type="radio" name="active" Value="No">NO
                </td>
             </tr>

             <tr>
                <td Colspan="2";>
                    <input type="submit"name="submit"Value ="Add Food" class="btn-secondary">
                </td>
                    </tr>



           </table>
       </form>

       <?php

        if(isset($_POST['submit']))
       {
           

           //1. Get the Data from form
      $title = $_POST['title'];
      $description  = $_POST['description'];
      $price = $_POST['price'];
      $category = $_POST['category'];

      //check whether redion button for featured and actives are active  are checked or not
       if(isset($_POST['featured']))
       {
          $featured =$_POST['featured'];
       }
       else
       {
           $featured ="No";//SEtting the Default Value 
       }

        if(isset($_POST['active']))
       {
           $active = $_POST['active'];

       }
       else
       {
            $active ="No";//SEtting the Default Value
       }


   //2.upload the Image if Selected
   //check whether the select image is clicked or not and upload the  image only if the image is selected 


         if(isset($_FILES['image']['name']))
         {
       //Get the details of the selected  image

        $image_name = $_FILES['image']['name'];
             
       //check whether the image is selected or not upload image only if selected
         if($image_name !="")
       {  
         //image is SElected
         //A.RENamge the image 
        //Get the extension of Selected image (jpg,png,gif,etc.)"
         $ext = end(explode('.', $image_name));


       //Create New Name for Image 
        $image_name = "Food_Name".rand(0000,9999).".".$ext;//New Image Name May Be "Food_Name_657.jpg"

        //B. Upload the image
      //Get the src path and DEstination path



        //Source path is the current location  of the Image
      $src = $_FILES['image']['tmp_name'];



   //Destination path   for the Image to be upload
    $dst = "../images/food/".$image_name;

    

    //finally upload the food image
   $upload = move_uploaded_file($src,$dst);
    //check whether image upload of not
   if($upload==false)
   {
      //Failed to Upload the image 
      //REdircet to Add Food page with Error Message

      $_SESSION['upload'] = "<div class='error'>Failed to upload image. </div>";
       header('location:'.SITEURL.'admin/add-food.php');
       //Stop the Process
       die();

    }
}




   
    }
    else
    {
       $image_name = "";//SEtting the Default Value as blank
    }


      //create a SQL Query to save or Add food 
   //For Numerical we do not need to pass value inside quotes "But for setting value it is compulsary to add quotes"

   $sql2 = "INSERT INTO tbl_food SET
    title = '$title',
    description = '$description',
    price = $price,
    image_name = '$image_name',
    category_id = $category,
    featured   = '$featured',
    active =  '$active'
   
  ";


  //Execute the query 
   $res2 = mysqli_query($conn,$sql2);


    //CHeck whether data inserted or not 
  //4. Redirect with MEssage to Manage  Food Page
   if($res2 == true)  
   {
       //Data inserted Sucessfully 
        $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";

         header('location:'.SITEURL.'admin/manage-food.php');

            
             

    }
    else 
    {
            //Failed to Add Category 
            $_SESSION['add '] = "<div class='error'>Failed to Add Food.</div>";
            


             header('location:'.SITEURL.'admin/manage-food.php');


    }   
       }

       ?>
</div>
</div>


<?php
include("partials/footer.php");
?>
