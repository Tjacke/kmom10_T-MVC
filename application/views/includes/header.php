<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Hem</title>
        <!-- Load CSS Style Sheet -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>styles/general.css" media="screen"> 

        <!-- Load Javascript -->
        <!-- <script src="<? //echo base_url(); ?>scripts/test.js"></script> -->

        <!-- display image as favicon -->
        <link rel="shortcut icon" href="<? echo base_url(); ?>favicon.png">
    </head>
    
    <body>
       
      <? 
      $size = getimagesize(base_url().'images/logo/'.$headImg);     // Get image data like image-height
      ?>
        
        
    <div class="container_16">
       
        <!-- Show header logo -->
        <div style="height:<? echo $size[1] ?>px;">
            <? echo '<img src="'.base_url().'images/logo/'.$headImg.'" alt="logo"/>' ; ?>  
        </div>
       
        <!-- Show horizontal navigation -->
        <div id="nav">

            <a href="<? echo base_url() ?>">Hem</a>
            <a href="<? echo base_url() ?>info">Info</a>
            <a href="<? echo base_url() ?>kontakt">Kontakta oss</a>
            <a href="<? echo base_url() ?>medlem">Medlem</a>
            <a href="<? echo base_url() ?>bloggar">Bloggar</a>

        </div> <!-- End Nav -->