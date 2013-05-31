<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info extends CI_Controller {

	public function index()	{
        $this->home();
	}

    public function home() {
         $main = 'view_info'; // Uniqu for every controller and view
        
        // Start Head image data
        $data['headImg'] = $this->model_pages->getHead();
        // End Head image data
        
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data
        
        // Get hem content from db
        // Parameter in getData('hem')is from 'page' field in 'pagedata' table
        $data["result"] = $this->model_pages->getData('info'); 
  
        
        // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/footer', $data);
    }

} // End class Info





