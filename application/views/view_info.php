<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
echo '<div id="content">';

   // Get data from db - table pagedata
    if($result){
        foreach($result as $row){
           $title = $row->title;
           $ingress = $row->ingress;
           $content = $row->content;
       } 
    } else {
       $title = '&nbsp;';
       $ingress = '&nbsp;';
       $content = '&nbsp;';
    } 
   
   
    // Make space in top of main page
    echo '<div class="headline"></div>';
    ?>

    <? ///////////////////////////////////////////////////////////////// ?>


    <div class="grid_4">&nbsp;</div>
    
    
    
    <? ///////////////////////////////////////////////////////////////// ?>
   
    
    
    <div class="grid_8"> <!-- Start middle -->
    <?
    // Headline for Kontakt page
    echo '<div>' . heading($title, 1) . '</div>';
    ?>
        
    <p><? echo $ingress; ?></p>
    <p><? echo $content; ?></p>
    </div> <!-- End middle -->
    
    
    <? ///////////////////////////////////////////////////////////////// ?>



    <div class="grid_4"> <!--  Start right -->
        &nbsp;
    </div> <!-- End Right -->



    <? ///////////////////////////////////////////////////////////////// ?>



    <div class="clear"></div>
</div><!-- Close Content -->
<div class="clear"></div>
