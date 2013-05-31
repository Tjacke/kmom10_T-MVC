<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// O.B.S - Autoload: model_user

class Loggain extends CI_Controller {

	    
	public function index()
	{
        $this->home();
	}


    public function home() {
        $data['title'] = 'Logga in:';
        
        $main = 'view_loggain'; // Uniqu for every controller and view
        
        // Start Head image data
        $data['headImg'] = $this->model_pages->getHead();
        // End Head image data
        
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data
        
        // Get hem content from db
        // Parameter in getData('hem')is from 'page' field in 'pagedata' table
        $data["result"] = $this->model_pages->getData('loggain'); 
       
        // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/footer', $data);
       
        
        
   
        }
    
    public function login_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-Post', 'required|trim|xss_clean|callback_validate_credentials');
        $this->form_validation->set_rules('password', 'Lösen', 'required|md5|trim|xss_clean');

        if ($this->form_validation->run()) {
            $data = array(
                'email' => $this->input->post('email'),
                'is_logged_in' => 1
            );

            $this->session->set_userdata($data);
            redirect(base_url() . 'medlem');
        } else {
            // Load View
            $this->home();
        }
    }

// End login validation

    public function validate_credentials() {

        if ($this->model_users->can_login()) {
            return true;
        } else {
            $this->form_validation->set_message('validate_credentials', 'Felaktigt 
                lösenord/E-Post.');
            return false;
        }
    }

    // User logging out
    public function loggaut() {
        $this->session->sess_destroy();

        redirect(base_url() . 'loggain');
    }

}

// End class Hem


