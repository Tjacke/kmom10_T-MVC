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
       $title = empty($title) ? NULL : $title;
       $ingress = '&nbsp;';
       $content = '&nbsp;';
    }
    $drop = empty($drop) ? NULL : $drop;
   
   // Make space in top of main page
   echo '<div class="headline"></div>';
    ?>
    

    <? // LEFT /////////////////////////////////////////////////////////////// ?>

    <div class="grid_4"><h3>innehåll!</h3> <!-- Start left -->
   
    </div>




    <? // MIDDLE /////////////////////////////////////////////////////////////// ?>     

    <div class="grid_8">
     
        <? 
        echo '<h1>'.$title.'</h1>'; 
        echo '<p><strong>'.$ingress.'</strong></p>'; 
        echo '<p>'.nl2br($content).'</p>'; 
        ?>
        <? 
        // TEMPORARY
        echo '<p>'.nl2br($drop).'</p>'; 
        ?>
 
    <!-- <p><a href="<? //echo base_url()?>info" class="read-more">Läs mer</a></p> -->
        
    </div> <!--  End Middle -->
    
    
    
    
    
    <? // RIGHT /////////////////////////////////////////////////////////////// ?>
    
    <!--  Start right -->
    <div class="grid_4"> 
    
        <?
       
    // Show developement controller - remove when done    
    foreach ($controller as $key => $value) {
        $key1 = $key;
        echo '<h3>' . $key1 . ':</h3>';

        foreach ($value as $key => $value) {
            $lnk = $key1 . '/' . $value;
            echo '<a href ="' . base_url() . $lnk . '">' . $lnk . '</a><br />';
        }
        echo '<hr />';
    } // End fore each - controller
    ?>
        
</div> <!-- End Right -->


<? ///////////////////////////////////////////////////////////////// ?>


</div> <!-- Content -->
<div class="clear"></div>