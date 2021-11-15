<?php
include("partials-front/menu.php");
?>




    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php
              //display all the categories that are active
              $sql=" SELECT *FROM tbl_category WHERE active='Yes'";
              //execute the query
                $res =mysqli_query($conn,$sql);
                //count rows to check weather the category is available or not

                $count =mysqli_num_rows($res);

                if ($count>0) 

                {

                    while ($row=mysqli_fetch_assoc($res)) 
                    {
                         //get the value
                      $id=$row['id'];
                     $title=$row['title'];
                     $image_name=$row['image_name'];

                     ?>

                     <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id?>">
                     <div class="box-3 float-container">

                        <?php

                        if ($image_name=="")
                         {

                          //display image

                            echo "<div class='error'>Image not Available.</div>"; 


                         }

                         else
                         {
                            ?>

                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve"width="200">

                            <?php

                         }

                        ?>
                        

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                       </div>
                        </a>

                     <?php
                 }


                }

                else 
                {

                    echo "<div class='error'>category not found.</div"; 

                }

            ?>

            

            
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php
include("partials-front/footer.php");
?>

