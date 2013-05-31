<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
echo '<div id="content">';

    $message = empty($message) ? NULL : $message;
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
    
    
    // LEFT/////////////////////////////////////////////////////////////// 
    
  
    
    echo '<div class="grid_4">';        // Start left
   
    // Headline for Kontakt page
    echo '<div>' . heading($title, 1) . '</div>';
    echo '<p>' . $ingress .'</p>';    // Rubrik till text eller brödtext
    echo '<p>'.nl2br($content).'</p>';     // Textmassa
    echo '<h3>' . $message . '</h3>';
    echo '</div>';                      // End left

    
    
     ///////////////////////////////////////////////////////////////// ?>
    
        
    <div class="grid_8"> <!-- Start middle -->
  

   <?  
    // Kontakt Form Settings
    $data['email'] = array(
        "name" => "email",
        "id" => "email",
        "value" => $this->input->post('email')
    );

    $data['password'] = array(
        "name" => "password",
        "id" => "password",
    );
  
   
   
   
        // Start of Form
        echo '<div id="form">';
        echo form_open('loggain/login_validation');
        
        // E-post field
        echo form_label("E-Post:", "email");
        echo form_input($data['email']);
        
        // Password field
        echo form_label("Lösen:", "password");
        echo form_password($data['password']);
    
        echo form_submit('login_submit', 'Logga in');
        echo '<a href="'.base_url().'registrera">Ny medlem!</a>';
        echo '<p>'.validation_errors().'</p>';
        echo form_close();
        echo '</div>';
        //  $this->load->view('view_signup');
    
    ?>
    </div> <!-- End middle -->
 
 
    <? ///////////////////////////////////////////////////////////////// ?>
 
    

    <div class="grid_4"> <!--  Start right -->
    </div> <!-- end right column -->



    <? ///////////////////////////////////////////////////////////////// ?>




<div class="clear"></div>
</div> <!-- end login -->
<div class="clear"></div>

