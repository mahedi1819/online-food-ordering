<?php

        
include("partials/menu.php");
?>

<div class="main-contant">
   <div class="wrapper">
        <h1>Add Category</h1>
        

         <br><br>

         
<?php
         if(isset($_SESSION ['add']))
            {
               echo $_SESSION['add'];
               unset($_SESSION['add']);

            }

            if(isset($_SESSION ['upload']))
            {
               echo $_SESSION['upload'];
               unset($_SESSION['upload']);

            }
            ?>
            <br /><br />
        

          <!--Add Category Form Starts -->
         <form action="" method="POST" enctype="multipart/form-data">
         


           <table class="tb1-30">
              <tr>
                  <td>Title: </td>

                   <td>
                   <input type="text"name="title"Placeholder="Category Title">
                 </td>

             </tr>

             <tr>
                 <td>Select image: </td>

                 <td> 
                     <input type="file" name="image">
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
                    <input type="submit"name="submit"Value ="Add Category" class="btn-secondary">
                </td>
                    </tr>
                    </table>  
                </form>

                 <?php



           //CHeck whether the submit Button is clicked or not 
           if(isset($_POST['submit']))
           {
              //echo "Clicked";
           //1. Get the Value from CATegory Form
            $title = $_POST['title'];

             if(isset($_POST['featured']))
            {
                //Get the Value from
                 $featured =$_POST['featured'];
            }
            else
            {
                //SET the Default VAlue
                $featured =  "No";  

           }

            if(isset($_POST['active']))
           {
             $active =$_POST['active'];
           }
           else
           {
               $active = "No";
           }

           //check whether the image or not and set the value for image name accordingly
         
           if(isset($_FILES['image']['name']))
           { 
              //upload the image 
              //To upload image we need image name,source path and destination path 
            $image_name = $_FILES['image']['name'];

            //upload image if image is selected
            if ($image_name !="") 
            {
              # code...
            


            //Get the Extension of our image (jpg,png,gif,etc)e.g."specialfood1.Jpg"

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
                  
                header("location:".SITEURL.'admin/add-category.php');
               //Stop the Process
               die();


            }
          }
              

            
           }
           else
           {
              //
              $image_name ="";
           }





           //2. Create SQL Query  to Insert CATegory into Database 
           $sql= "INSERT INTO tbl_category SET
                    title='$title',
                    image_name ='$image_name',

                    featured='$featured',
                    active='$active'

          ";
          //3. Execute the Query and Save in Database
          $res = mysqli_query($conn,$sql);

          //4. Chcek whether the query executed or not and data added or not 
         if($res==true)
         {
            //Query Executed and Category Added
            $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
            //Redirect to Manage category page 
           
          header("location:".SITEURL.'admin/manage-category.php');
         }

          else 
         {
            //Failed to Add Category 
            $_SESSION['add'] =" <div class='error'>Failed to Add Category.</div>";
            //Redirect to Manage category page 
            
          header("location:".SITEURL.'admin/add-category.php');
         }


            

           }

     ?>






  </div>
  </div>



<?php
include("partials/footer.php");
?>
