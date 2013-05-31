<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
echo '<div id="content">';
    $blogg = null;
    $area = null;
    $title = null;
    
  
  // Get data from db - table blogs
  if(isset($blogs_results[0])) {
    foreach($blogs_results as $row){
       $title = $row->title;
       $ingress = $row->ingress;
       $content = $row->content;
       $area = $row->area;
       $id = $row->id;
   }} else {
       // When edit blog and not validated
       $title = $this->input->post('title');
       $ingress = $this->input->post('ingress');
       $content = $this->input->post('content');
       $id = $this->input->post('id');
      
   }
   
    if($area){ $option = $area; } else { $option = $this->input->post('area'); }
 
   // Create blog navigation
    if($blogs) {
    foreach($blogs as $row){
        if($row->area){
        $blogg .= '<a href="'.base_url().'bloggar/blog/'.$row->area.'">'.$row->area.'</a><br />';
                
            if($blogArea && $row->area == $areas){
                foreach($blogArea as $rows){
                $blogg .= '<a href="'.base_url().'bloggar/blog/'.$row->area.'/'.$rows->id.'" class="blogg_link">'.$rows->title.'</a><br />'; }
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
    


<? ///////////////////////////////////////////////////////////////// ?>




<div class="grid_4"><h3>Bloggar:</h3> <!-- Start left -->
   <? echo $blogg; ?>
  
</div> <!-- End left -->



<? ///////////////////////////////////////////////////////////////// ?>



<div class="grid_8"> <!-- Start Middle -->

    <?
    echo '<h1>Edit blog:</h1>';
    
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
                
               
   // $this->input->post('area')
                    echo '<div id="form">';
                    echo form_open('bloggar/edit_validation');
                    echo 'Bloggnamn:';
                    echo form_hidden('id', $id);
                    echo form_input('title', $title);
                    echo 'Område:';
                    echo form_dropdown('area', $areas, $option, 'class="dropdown"');
                    echo 'Rubrik/ingress:';
                    echo form_textarea('ingress', $ingress);
                    echo 'Innehåll:';
                    echo form_textarea('content', $content);
                    echo '<br />';

                    echo form_submit('login_submit', 'Uppdatera Blog!');
                    echo '<p>' . validation_errors() . '</p>';
                    echo form_close();
                    echo '</div>';
                    ?>

</div> <!-- End Middle -->



<? ///////////////////////////////////////////////////////////////// ?>



<div class="grid_4"> <!--  Start right -->
</div> <!-- End Right -->



<? ///////////////////////////////////////////////////////////////// ?>



</div> <!-- End Content -->
<div class="clear"></div>