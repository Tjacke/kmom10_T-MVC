<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bloggar extends CI_Controller {

    public $message;

    public function index() {
        $this->home();
    }

    public function home() {
        $main = 'view_blogs'; // Uniqu for every controller and view
        $data['blogs'] = null;
        $data['uri_5'] = $this->uri->segment(5);
        $data['area'] = $this->uri->segment(3);
        
        
        // Start Head image data
        $data['headImg'] = $this->model_pages->getHead();
        // End Head image data
        
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data

        
        // If blog exist, show blog navigation
        if ($this->db->table_exists('blogs')) {

        // Fix uri for blog navigation
            $areas = $this->model_blogs->fixUri($this->uri->segment(3));
            $data['areas'] = $areas;
        // End fix uri
            
            $data['rows'] = $this->db->count_all('blogs');
            $data['blogs'] = $this->model_blogs->getBlogs();
            $data["blogArea"] = $this->model_blogs->getBlogArea($areas);
        }
       
        // Get blog content
        if($this->uri->segment(4)) { $page = $this->uri->segment(4); }
        else if(isset($rows)){ $page = $rows; }else { $page = 'bloggar'; }

        // Development controller
        // Remove when done developing
            $array = $this->controllerlist->getControllers();
            $data['controller'] = $array;
        // End development controller

        // uri_4 will be the 'id' from blog table
        // If no id found, blog page info will be shown
        if($this->uri->segment(4)){
        $data["blogs_results"] = $this->model_blogs->getData($page);
        } else {
        $data["pagedata_results"] = $this->model_pages->getData($page);
        }
        
       // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/footer', $data);
    }
    
    public function blog() {

        // Get blog content
        $blog_nr = $this->uri->segment(4);
        $page = !empty($blog_nr) ? $blog_nr : 1;

        $this->home();
    }

       
    
    public function edit() {
        $main = 'view_EDITblogs';
        $data["blogs"] = null;
        $id = $this->uri->segment(4);
        $area = $this->uri->segment(3);
        $areas = !empty($area) ? $area : $this->input->post('area');
        
         // Start Head image data
        $data['headImg'] = $this->model_pages->getHead();
        // End Head image data
        
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data
  
        
        
        // Fix uri for blog navigation
            $areas = $this->model_blogs->fixUri($areas);
            $data['areas'] = $areas;
        // End fix uri
        
        $data['rows'] = $this->db->count_all('blogs');
        $data["blogs"] = $this->model_blogs->getBlogs();
        $data["blogArea"] = $this->model_blogs->getBlogArea($areas);
        $data["blogs_results"] = $this->model_blogs->getData($id);

        
        if($this->session->userdata('is_logged_in')) {
            
        // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/footer', $data);
        
        } else {
            redirect(base_url());
        }
        
    } // END func edit blob
    
    
        public function edit_validation() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Bloggnamn', 'required|trim|xss');
        $this->form_validation->set_rules('content', 'Innehåll', 'required|trim|xss');
        
        // If the updated fields are ok, update db
        if ($this->form_validation->run()) {
            $this->load->model('model_blogs');
            
            $data['id'] = $this->input->post('id');            
            
            $this->model_blogs->update_blog($data);
            
            $blog_entity = $this->input->post('id');
            redirect(base_url().'bloggar/blog/'.$this->input->post('area') .'/'. $blog_entity);
           
        }
        $data["edit_blog_id"] = $this->input->post('id');
        $this->editblog();
    } // End func Edit
    
      
    public function delete_validation(){
        $id = $this->uri->segment(4);
        $data['area'] = $this->uri->segment(3);
        
        if($this->session->userdata('is_logged_in')) {
        $this->model_blogs->delete_blog($id);
        } else {
           redirect(base_url().'bloggar');
        }
        $this->home();
    } // END func delete validation

     

}

// End class Blogs



