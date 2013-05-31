<?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); ?>
<div id="content">
   
    
    <?
    // Make space in top of main page
    echo '<div class="headline"></div>';
    ?>
    
    

    <? ///////////////////////////////////////////////////////////////// ?>

    
    
    
    <div class="grid_4">
            <? echo $this->reg_message ; ?>
             <!-- Start left -->
            &nbsp;
    </div> <!-- End left -->
        
        
        
  <? ///////////////////////////////////////////////////////////////// ?>     
        
        
        
        
    <div class="grid_8"> 
        
    <div><h1>Skapa ett användar konto!</h1></div>
        <div id="form">
        <?
        echo form_open('registrera/signup_validation');
        echo '<p>E-Post:';
        echo form_input('email', $this->input->post('email'));
        echo '</p>';
        
        echo '<p>Lösen:';
        echo form_password('password');
        echo '</p>';
        
        echo '<p>Bekräfta Lösen:';
        echo form_password('cpassword');
        echo '</p>';
        echo '<p>';
        echo form_submit('signup_submit','Registrera');
        echo '</p>';
        
       echo validation_errors();
        
        ?>
        </div> <!-- End Form -->
    
    </div> <!--  End Middle -->
    
    
    
    <? ///////////////////////////////////////////////////////////////// ?>
    
    
    
    <div class="grid_4"> 
        
    </div> <!-- End Right -->

  

<? ///////////////////////////////////////////////////////////////// ?>    
    
<div class="clear"></div>      
</div> <!-- End Content -->
<div class="clear"></div>