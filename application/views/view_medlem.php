<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
echo '<div id="content">';

if($result) {
    // Get data from db
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
   
    
    // LEFT /////////////////////////////////////////////////////////////// 
    
    
    // Make space in top of main page
    echo '<div class="headline"></div>';
    
    ?>

    <div class="grid_4">
        <div id="left_menu">
            <? $this->load->view('view_NAVleft'); ?>
        </div>
    </div>


    
    
    
    <? // MIDDLE /////////////////////////////////////////////////////////////// ?>

    
    <div class="grid_8">
       
        <div class="clear"></div>

        <?
        if ($this->session->userdata('is_logged_in')) {

            // Headline for Kontakt page
    echo '<div>' . heading($title, 1) . '</div>';
    echo '<p>' . $ingress .'</p>';    // Rubrik till text eller brödtext
    echo '<p>'.nl2br($content).'</p>';     // Textmassa
   
        } else {

            redirect('loggain');
        }
        ?>
</div> <!-- end right column -->

        


     <? ///////////////////////////////////////////////////////////////// ?>  

        


<div class="clear"></div>
</div> <!-- end login -->
<div class="clear"></div>