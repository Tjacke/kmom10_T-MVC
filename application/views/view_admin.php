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
    
    
    // LEFT/////////////////////////////////////////////////////////////// 
    ?>

    <div class="grid_4">
        <div id="left_menu"><? $this->load->view('view_NAVleft'); ?></div>
    </div>


    <? // MIDDLE /////////////////////////////////////////////////////////////// 


       echo '<div class="grid_8">';

       // Thi menu can be done from a db later
       echo '<div class="Admin_menu"><a href="' . base_url() . 'admin/logga">logga</a></div>'; 
       echo '<div class="Admin_menu"><a href="' . base_url() . 'admin/fot">Fottext</a></div>';
       echo '<div class="Admin_menu"><a href="' . base_url() . 'admin/blog">Bloggar</a></div>';
       echo '<div class="Admin_menu"><a href="' . base_url() . 'admin/sidor">Sidor</a></div>';
       echo '<div class="Admin_menu"><a href="' . base_url() . 'admin/medlem">Medlemmar</a></div>';
       echo '<div class="clear"></div>';
       echo '<hr />';
       
switch ($uri_2) {
            
////////////////////////////////////////////////////////////////////////////////
/// logga
////////////////////////////////////////////////////////////////////////////////          
case 'logga':
                echo '<h3>Ladda, byt eller ta bort Logga:</h3><p>
Det kan uppstå problem då kmom05 till kmom10 delar på samma databas, men varje moment har en separat image/logo folder.
Meningen är att det bara ska finnas en sida per databas och vise versa. Nu är det inte så och problemet kan då uppstå.
</p>';
             
                       
                
      // Check if PAGEDATA Table exist in db
      if ($this->db->table_exists('pagedata')) {          
                          
        echo '<div id="form">';
        echo '<p>'.$img_error.'</p>';
        echo form_open_multipart('admin/upload_image');
        $Fdata = array('class' => 'file', 'name' => 'title'); // set your file and class for the image
        echo form_upload($Fdata); // upload the datas here the image that user has selected.
        echo form_hidden('page', 'logga');
        echo form_submit('upload_submit', 'Ladda logga!'); // your submit button fucntion
        
        echo form_close();
        echo '</div>';
        
       } else {
         // If no PAGEDATA table exist create one
          echo 'Skapa en tabbel för sidan?<br />';
          echo '<p><a href="' . base_url() . 'pages/skapawebsida">Klicka här!</a><p />';
       }        
            
       // Show existing logos in image/logo folder
       if(isset($page)){ 
       foreach ($page as $value) {
            
            echo '<div id="logo_pre">';
            echo '<h6>'. $value->ingress . ' | ' . $value->content .'</h6>';
            echo '<img src="' . base_url() . 'images/logo/' . $value->content . '" alt="logga" />';
            echo '<hr /><h6>
                <a href="'.base_url().'admin/logga/'.$value->id.'/set">Använd</a> | 
                <a href="'.base_url().'admin/logga/'.$value->id.'/delete">Ta bort</a></h6>';
            echo '</div>';
        }
        }
                
                break;
////////////////////////////////////////////////////////////////////////////////
/// fot
////////////////////////////////////////////////////////////////////////////////
case 'fot':
                echo '<h3>Ändra Fottext:</h3>';
    
               $edit_post = empty($edit_post) ? null : $edit_post;
               $id = NULL;
               $content = NULL;
               
               if($edit_post){
                    
                
                // Get data post from db - table pagedata
                $show = $this->model_pages->getPageId($edit_post);
                
                   
                // Fill Form with info if NOT validate or when EDIT
                if($this->input->post('submit_for')) {
                        $content = $this->input->post('content');
                        $id = $this->input->post('id');
               } else {
                   foreach($show as $row){
                        $content = $row->content;
                        $id = $row->id;
                        
                   }  
               }}      
    
                                
                // Check if PAGEDATA Table exist in db
                if ($this->db->table_exists('pagedata')) {

                    echo '<div id="form">';
                    echo form_open('admin/fot_validation');
                    echo form_hidden('page', 'sidfot');
                    echo form_hidden('id', $id);
                    echo 'Sidfot:';
                    echo form_textarea('content', $content);
                    echo '<br />';
                    
                    if($edit_post){
                         echo form_submit('submit_fot_update', 'Uppdatera sidfot!');
                    } else if($this->model_pages->getFot()) {
                        echo 'Bara en sidfot är tillåten!<br />Klicka på sidfot - 1 till höger.';
                    } else  {
                        echo form_submit('submit_fot', 'Lägg till sidfot!');
                      }
                    
                    echo '<p>' . validation_errors() . '</p>';
                    echo form_close();
                    echo '</div>';
                } else {
                    // If no PAGEDATA table exist create one
                    echo 'Skapa en tabbel för sidan?<br />';
                    echo '<p><a href="' . base_url() . 'pages/skapawebsida">Klicka här!</a><p />';
                }
                

                break;
////////////////////////////////////////////////////////////////////////////////
/// sidor
////////////////////////////////////////////////////////////////////////////////
case 'sidor':
       
    $edit_post = empty($edit_post) ? null : $edit_post;
                
    if($edit_post){
          
        
        // Get data post from db - table pagedata
        $show = $this->model_pages->getPageId($edit_post);
                
                   
                // Fill Form with info if NOT validate or when EDIT
                if($this->input->post('submit_page')) {
                   
                   $title = $this->input->post('title');
                   $page = $this->input->post('page');
                   $ingress = $this->input->post('ingress');
                   $content = $this->input->post('content');
                   $id = $this->input->post('id');
                    
               } else {
                   foreach($show as $row){
                        $title = $row->title;
                        $page = $row->page;
                        $ingress = $row->ingress;
                        $content = $row->content;
                        $id = $row->id;
                   }  
               }  
               
          // Do Edit/Delete Menu     
            echo '<p>
           <a href="' . base_url() . 'admin/sidor/' . $edit_post . '/edit">Editera </a> | 
           <a href="' . base_url() . 'admin/sidor/' . $edit_post . '/delete"> Ta bort sida</a>';

            // If delete, show delet confirm link
            if ($uri_4 == 'delete') {
                echo ' | <a href="' . base_url() . 'admin/sidor/' . $edit_post . '/deletepost">Klicka här för att ta bort sidan!</a></p>';
            }
            
            // If delete confirm activated. post will be deleted
            if ($uri_4 == 'deletepost') {
                $this->model_pages->delete_page($edit_post);
                redirect(base_url() . 'admin/sidor');
            }

            echo '<h1>'.$title.'</h1>';
            echo '<p><strong>'.$ingress.'</strong></p>';
            echo '<p>'.nl2br($content).'</p>';

        // If edit post, show edit form
        if($uri_4 == 'edit'){
                                              
                if($this->uri->segment(5)){        
                $this->form_validation->set_rules('title', 'Titel', 'required|trim');
                $this->form_validation->set_rules('page', 'Sida', 'required|trim');
                $this->form_validation->set_rules('content', 'Innehåll', 'required|trim');

                        if ($this->form_validation->run()) {
                            $this->model_pages->update_page($id);
                            redirect(base_url().'admin/sidor');
                        }
                }


             
                     $option = $page;
                    // Temp Do drop down menu for form
                    // Later make this to db-table
                    $page = array(
                    'hem' => 'Hem',
                    'info' => 'Info',
                    'kontakt' => 'Kontakt',
                    'medlem' => 'Medlem',
                    'loggain' => 'Logga in',
                    'admin' => 'Admin',
                    'bloggar' => 'Bloggar',
                );
                      
                    echo '<div id="form">';
                    echo form_open('admin/sidor/'.$edit_post.'/edit/page_validate');
                    echo 'Titel:';
                    echo form_hidden('id', $id);
                    echo form_input('title', $title);
                    echo 'Sida:';
                    echo form_dropdown('page', $page, $option, 'class="dropdown"');
                    echo 'Rubrik/ingress:';
                    echo form_textarea('ingress', $ingress);
                    echo 'Innehåll:';
                    echo form_textarea('content', $content);
                    echo '<br />';
                    echo form_submit('submit_page', 'Uppdatera sida!');
                    
                    // If not validatet show message
                    echo '<p>' . validation_errors() . '</p>';
                    echo form_close();
                    echo '</div>'; 
                   
               
                }
                                 
                
               
                 
////////////////////////////////////////////////////////////////////////////////
/// sidor -- Above EDIT part / under DEFAULT part
////////////////////////////////////////////////////////////////////////////////   
} else {
                    
        echo '<h3>Skapa ny Sida:</h3>';
                
                // Temp Do drop down menu for form
                // Later make this to db-table
                $pages = array(
                    'hem' => 'Hem',
                    'info' => 'Info',
                    'kontakt' => 'Kontakt',
                    'medlem' => 'Medlem',
                    'loggain' => 'Logga in',
                    'admin' => 'Admin',
                    'bloggar' => 'Bloggar',
                );
                
                
                // Check if PAGEDATA Table exist in db
                if ($this->db->table_exists('pagedata')) {

                    echo '<div id="form">';
                    echo form_open('admin/page_validation');
                    echo 'Titel:';
                    echo form_input('title', $this->input->post('title'));
                    echo 'Sida:';
                    echo form_dropdown('page', $pages, $this->input->post('page'), 'class="dropdown"');
                    echo 'Rubrik/ingress:';
                    echo form_textarea('ingress', $this->input->post('ingress'));
                    echo 'Innehåll:';
                    echo form_textarea('content');
                    echo '<br />';
                    echo form_submit('login_submit', 'Lägg till sida!');
                    
                    // If not validatet show message
                    echo '<p>' . validation_errors() . '</p>';
                    echo form_close();
                    echo '</div>';
                } else {
                    // If no PAGEDATA table in db create one
                    echo 'Skapa en tabbel för sidan?<br />';
                    echo '<p><a href="' . base_url() . 'pages/skapawebsida">Klicka här!</a><p />';
                }

                
                } // End else or if edit
                
                break;
////////////////////////////////////////////////////////////////////////////////
/// blog
////////////////////////////////////////////////////////////////////////////////
case 'blog':
                
                
    
    echo '<h3>Bloggar:</h3>';
                $areas = array(
                    'Nolby' => 'Nolby',
                    'Klockarberget' => 'Klockarberget',
                    'Forsa' => 'Forsa',
                    'Stångom' => 'Stångom',
                    'Negerbyn' => 'Negerbyn',
                    'Essvik' => 'Essvik',
                    'Juniskär' => 'Juniskär',
                    'Myre' => 'Myre',
                    'Hemmanet' => 'Hemmanet',
                    'Berga' => 'Berga',
                    'Bommen' => 'Bommen',
                    'Maj' => 'Maj',
                    'Skatan' => 'Skatan',
                    'Björkön' => 'Björkön',
                    'Kvissleby' => 'Kvissleby',
                    'Mjösund' => 'Mjösund',
                    'Nyland' => 'Nyland',
                    'Västanå' => 'Västanå',
                );

                // Check if BLOGS Table exist in db
                if ($this->db->table_exists('blogs')) {

                    echo '<div id="form">';
                    echo form_open('admin/blog_validation');
                    echo 'Bloggnamn:';
                    echo form_input('title', $this->input->post('title'));
                    echo 'Område:';
                    echo form_dropdown('area', $areas, $this->input->post('area'), 'class="dropdown"');
                    echo 'Rubrik/ingress:';
                    echo form_textarea('ingress', $this->input->post('ingress'));
                    echo 'Innehåll:';
                    echo form_textarea('content');
                    echo '<br />';

                    echo form_submit('login_submit', 'Skapa Blog!');
                    echo '<p>' . validation_errors() . '</p>';
                    echo form_close();
                    echo '</div>';
                } else {
                    // If no BLOGS table exist create one
                    echo 'Villd du skapa en blogg?<br />';
                    echo '<p><a href="' . base_url() . 'admin/skapa_blog">Klicka här!</a><p />';
                }
                break;
////////////////////////////////////////////////////////////////////////////////
/// medlem
////////////////////////////////////////////////////////////////////////////////
case 'medlem':
             $tRow = NULL;   
    foreach($users as $row){
           $tRow .= '<tr><td>' . $row->id . '</td>';
           $tRow .= '<td>' . $row->email . '</td>';
           $tRow .= '<td>' . $row->password . '</td>';
           $tRow .= '<td>' . 'edit' . '</td></tr>';
    }            
    
    echo '<h3>Medlemmar:</h3>';
    ?>
    <table border="1">
<tr>
<th>id:</th>
<th>E-Post:</th>
<th>Lösen:</th>
<th>Edit:</th>
</tr>
<?
echo $tRow;
?>
</table>
    <br />
 <?   
              $tRow = NULL;
         foreach ($tempUsers as $row) {
             $tRow .= '<tr><td>' . $row->id . '</td>';
             $tRow .= '<td>' . $row->email . '</td>';
             $tRow .= '<td>' . $row->key . '</td>';
             $tRow .= '<td>' . 'Radera' . '</td></tr>';
         }

         echo '<h3>Ansökningar:</h3>';
?>
    <table border="1">
<tr>
<th>id:</th>
<th>E-Post:</th>
<th>Key:</th>
<th>Radera:</th>
</tr>
<?
echo $tRow;
?>
</table>
    <br />
 <?   
            
                break;
////////////////////////////////////////////////////////////////////////////////
/// default
////////////////////////////////////////////////////////////////////////////////
            default:
           
            echo '<h1>'.$title.'</h1>';
            echo '<p><strong>'.$ingress.'</strong></p>';
            echo '<p>'.nl2br($content).'</p>';
               
         
         break;
        }

        if ($this->session->userdata('is_logged_in')) {
            
        } else {

            redirect('loggain');
        }

        ?>
         </div> <!-- End Middle -->
         
         
         
         
         
         
         <div class="grid_4"> <!-- Start right -->

             <?
             //$this->load->model('model_pages');
             $edit = $this->model_pages->getEdit();
             $page = $this->model_pages->getPage();
             $nr = null;
             // Do array for each key and Do links for show content
             foreach ($edit as $value) {

                 $page1 = $value->page;

                 @$res1[$page1] .= '<a href ="' . base_url() . 'admin/sidor/' . $value->id . '">' . $value->title . '</a><br />';
                 if ($page1 == 'sidfot') {
                     $nr += 1;
                     @$res2[$page1] .= '<a href ="' . base_url() . 'admin/fot/' . $value->id . '">' . $value->page . ' - ' . $nr . '</a><br />';
                 }
             }
             if ($uri_2 == 'sidor') {
                 foreach ($page as $value1) {
                     $page = $value1->page;
                     if ($page != 'logga' && $page != 'sidfot') {
                         echo '<h3>' . $page . '</h3>';
                         echo print_r($res1[$page], true) . '<hr />';
                     }
                 }
             }

             if ($uri_2 == 'fot') {
                 foreach ($page as $value1) {
                     $page = $value1->page;
                     if ($page == 'sidfot') {
                         echo '<h3>' . $page . '</h3>';
                         echo print_r($res2[$page], true) . '<hr />';
                     }
                 }
             }

             if ($uri_2 == 'blog') {

                 echo '<h1>' . $title . '</h1>';
                 echo '<p><strong>' . $ingress . '</strong></p>';
                 echo '<p>' . nl2br($content) . '</p>';
             }



// End if uri_2
        
?>
            
        
    </div><!-- End right -->
   

    
        

   <? ///////////////////////////////////////////////////////////////// ?>



<div class="clear"></div>
</div> <!-- end login -->
<div class="clear"></div>