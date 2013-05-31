<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hem extends CI_Controller {

	public  $message;
    
	public function index()
	{
        $this->home();
	}

    public function home() {
        $main = 'view_home'; // Uniqu for every controller and view
        // Start Head image data
        $data['headImg'] = $this->model_pages->getHead();
        // End Head image data
        
         // If no db table is missing create
        if (    !$this->db->table_exists('pagedata')    || 
                !$this->db->table_exists('blogs')       || 
                !$this->db->table_exists('users')     
                )
            { 
                
            
              $page_tbl = !$this->db->table_exists('pagedata') ? 'Tabell för "sida" saknas, <a href="' . base_url() . 'admin/skapa_sida"> Skapa tabell</a>' : 'Tabell för sida - OK!';
              $blog_tbl = !$this->db->table_exists('blogs') ? 'Tabell för "blog" saknas, <a href="' . base_url() . 'admin/skapa_blog"> Skapa tabell</a>' : 'Tabell för blog - OK!';
              $user_tbl = !$this->db->table_exists('users') ? 'Tabell för "medlem" saknas, <a href="' . base_url() . 'admin/skapa_user"> Skapa tabell</a>' : 'Tabell för medlem - OK!';
              
              $title = '<h2>Du måste skapa alla tabeller!</h2><hr />';
              $title .=  '<p>'. $page_tbl .'</p>';
              $title .= '<p>'. $blog_tbl .'</p>';
              $title .= '<p>'. $user_tbl .'</p>';
              
              $data['title'] = $title;
                         
              $data['footData'] = NULL;
              $data["result"]   = NULL;
              
        } else {
                
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data
        
        // Get hem content from db
        // Parameter in getData('hem')is from 'page' field in 'pagedata' table
        $data["result"] = $this->model_pages->getData('hem'); 
        
       }
        
       // TEMPORARY
        $drop = '<hr /><p>För uppgiften skapade jag den här delen så att man kan ta bort tabeller och börja om på nytt!</p>';
        $drop .= '<a href="' . base_url() . 'hem/drop/pagedata"> Ta bort tabell för "sida"</a><br />'; 
        $drop .= '<a href="' . base_url() . 'hem/drop/blogs"> Ta bort tabell för "blog"</a><br />'; 
        $drop .= '<a href="' . base_url() . 'hem/drop/users"> Ta bort tabell för "medlem"</a>'; 
        
        $data["drop"] = $drop; 
        
        // END TEMP
        
        
        // Development controller - 
        // Just temporary, When done developing remove this
            $array = $this->controllerlist->getControllers();
            $data['controller'] = $array;
        // End development controller
        
        // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/dev_footer');
        $this->load->view('includes/footer', $data);
        
               
         
        
        } // End func home
        
      public function drop(){
             // This is just during the projekt so you can start over and drop
        // or remove all tables
        //$data['drop_all'] = $this->model_pages->dropAll();
           $tbl = $this->uri->segment(3); 
           
       $this->model_pages->dropTbl($tbl);
        
        redirect(base_url());
        
        }
        
} // End class Hem


