<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontakt extends CI_Controller {

	public  $message;
    
	public function index()	{
        $this->home();
	}

    public function home() {
        $main = 'view_kontakt'; // Uniqu for every controller and view
        
        // Start Head image data
        $data['headImg'] = $this->model_pages->getHead();
        // End Head image data
        
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data
        
        // Get hem content from db
        // Parameter in getData('hem')is from 'page' field in 'pagedata' table
        $data["result"] = $this->model_pages->getData('kontakt'); 
        
        
        $data['message'] = $this->message;
               
               
        // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/footer', $data);
    }

    
    public function skicka_epost() {
        $this->load->helper("form");
        $this->load->library('form_validation');
        $this->form_validation->set_rules("fullName", "Namn:", "required|xss_clean");
        $this->form_validation->set_rules("email", "E-Post:", "required|valid_email|xss_clean");
        $this->form_validation->set_rules("message", "Medelande:", "required|xss_clean");

        if ($this->form_validation->run() == FALSE) {
            $this->home();
        } else {
            $this->message = 'Tack för att du kontaktade oss!';

            $this->load->library('email');

            $this->email->from(set_value('email'), set_value('fullName'));
            $this->email->to('tjacke@hotmail.com');
            $this->email->subject('Medelande från Vision Njurunda!');
            $this->email->message(set_value('message'));

            $this->email->send();

            //echo $this->email->print_debugger();

            $this->home();
        }
    }

    
} // End class Kontakt

