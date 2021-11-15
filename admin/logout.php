<?php 
   include '../config/constant.php';

   SESSION_destroy();

   header("location:".SITEURL.'admin/login.php');



 ?>