<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
echo '<div id="content">';
    

$blogg = null;
    
    
    if (isset($blogs_results)) {
   
        // Get data from db - table blogs
    foreach ($blogs_results as $row) {
        $title = $row->title;
        $ingress = $row->ingress;
        $content = $row->content;
        $area = $row->area;
        $id = $row->id;

        // LINK edit/delete
        $edit = '<a href="' . base_url() . 'bloggar/edit/' . $area . '/' . $id . '">Edit</a>';
        $delete = '<a href="' . base_url() . 'bloggar/blog/' . $area . '/' . $id . '/delete">Ta bort</a>';

        // If delete, show delet confirm link
        if ($uri_5 == 'delete') {
            $delete .= ' | <a href="' . base_url() . 'bloggar/delete_validation/' . $area . '/' . $id . '">Klicka här för att ta bort bloggen!</a></p>';
        }

        // If delete confirm activated. blog post will be deleted
        if ($uri_5 == 'deleteblog') {
            
            
            $this->model_pages->delete_page($id);
            redirect(base_url() . 'admin/sidor');
        }
    }

    
   
   
   } else {
       $blogs_results = null;
   } // End if blogs_results
   
   if(isset($pagedata_results)){
   // Get data from db - table pagedata
    foreach($pagedata_results as $row){
       $title = $row->title;
       $ingress = $row->ingress;
       $content = $row->content;
       $id = $row->id;
   } 
   } else {
       $pagedata_results = null;
   }// End if pagedata_results
  
   
    
   // Create blog navigation
    if($blogs) {
    foreach($blogs as $row){
        if($row->area){
        $blogg .= '<a href="'.base_url().'bloggar/blog/'.$row->area.'">'.$row->area.'</a><br />';
                
            if($blogArea && $row->area == $areas){
                foreach($blogArea as $rows){
                $blogg .= '<a href="'.base_url().'bloggar/blog/'.$row->area.'/'.$rows->id.'" class="blogg_link">'.$rows->title.'</a><br />'; 
            }
                
                }
         }
         } 
         
   }   else {
             $blogg .= 'Inga Bloggar!';
         }
    // Headline for Kontakt page
    //echo '<div class="headline">' . heading($title, 1) . '</div>';
    echo '<div class="headline"></div>';
    // End Blog navigation
   
    ?>
    
<div class="grid_4"><h3>Bloggar:</h3> <!-- Start left -->
   <? echo $blogg; ?>
  
</div> <!-- End left -->

<div class="grid_8"> <!-- Start Middle -->
    
    <? 
    if($blogs_results) {
        echo '<h1>'.$title.'</h1>'; 
        echo '<p><strong>'.$ingress.'</strong></p>'; 
        echo '<p>'.$content.'</p>'; 
        if($this->session->userdata('is_logged_in')){
        echo '<p>'.$edit. ' | ' . $delete . '</p>'; 
        }
    }
    
    if($pagedata_results){
        
        echo '<h1>'.$title.'</h1>'; 
        echo '<p><strong>'.$ingress.'</strong></p>'; 
        echo '<p>'.nl2br($content).'</p>'; 
    }
    
    
     ?>
 &nbsp;
    </div> <!-- End Middle -->
    <div class="grid_4"> <!--  Start right -->
    
        <?
        //
        // a Controller
        //
    
  //  $array = $this->controllerlist->getControllers();
    foreach ($controller as $key => $value) {
        $key1 = $key;
        echo '<h3>' . $key1 . ':</h3>';

        foreach ($value as $key => $value) {
            $lnk = $key1 . '/' . $value;
            echo '<a href ="' . base_url() . $lnk . '">' . $lnk . '</a><br />';
        }
        echo '<hr />';
    }
    ?>
</div> <!-- End Right -->

</div> <!-- End Content -->
<div class="clear"></div>