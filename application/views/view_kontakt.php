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
   // Make space in top of main page
   echo '<div class="headline"></div>';
   
   
   ///////////////////////////////////////////////////////////////// 
   

   
    echo '<div class="grid_4">';        // Start left
   
    // Headline for Kontakt page
    echo '<div>' . heading($title, 1) . '</div>';
    echo '<p>' . $ingress .'</p>';    // Rubrik till text eller brödtext
    echo '<p>'.nl2br($content).'</p>';     // Textmassa
    echo '<h3>' . $message . '</h3>';
    echo '</div>';                      // End left
    
    
    
   /////////////////////////////////////////////////////////////////  
    
    
    
    echo '<div class="grid_8">';            // Start Middle
    

    // Kontakt Form Settings
    $data['fullName'] = array(
        "name" => "fullName",
        "id" => "fullName",
        "value" => set_value('fullName')
    );

    $data['email'] = array(
        "name" => "email",
        "id" => "email",
        "value" => set_value('email')
    );
    $data['message'] = array(
        "name" => "message",
        "id" => "message",
        "value" => set_value('message')
    );
    
       
    // Start of Form
    echo '<div id="form">';
    echo form_open("kontakt/skicka_epost");

    // fullName Field
    echo form_label("Namn:", "fullName");
    echo form_input($data['fullName']);

    // E-Mail Field
    echo form_label("Din E-Post:", "email");
    echo form_input($data['email']);

    // Message textfield
    echo form_label("Meddelande:", "message");
    echo form_textarea($data['message']);

    // Submit button
    echo form_submit("skicka_epost", "Skicka!");
   
    // Form Validation
    echo '<p>' . validation_errors() . '</p>';
    echo '</div>';          
    
    // Close Form
    echo form_close();
    
    // Close middle <<<<<
    echo '</div>';          
    
    
    
    
    /////////////////////////////////////////////////////////////////
    
    
    
    
    
    ?>
    <!-- Start Right -->
    <div class="grid_4">    &nbsp;
    </div> <!-- End Right -->



<? ///////////////////////////////////////////////////////////////// ?>


<div class="clear"></div>
</div><!-- Close Content -->
<div class="clear"></div>