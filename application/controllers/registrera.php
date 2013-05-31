<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// O.B.S - Autoload: model_user

class Registrera extends CI_Controller {

    public $reg_message;

    public function index() {
        $this->home();
    }

    public function home() {
        $main = 'view_registrera'; // Uniqu for every controller and view
        
        // Start Head image data
        $data['headImg'] = $this->model_pages->getHead();
        // End Head image data
        
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data
        
        $data['mess'] = 'Registrera dig nu!';
        
        // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/footer', $data);
   
    }
      
    
    public function signup_validation() {
        $message = NULL;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-Post', 'required|trim|xss_clean|valid_email|is_unique[users.email]');

        $this->form_validation->set_rules('password', 'Lösen', 'required|trim|xss_clean|min_length[5]');
        $this->form_validation->set_rules('cpassword', 'Bekräfta Lösen', 'required|trim|xss_clean|matches[password]');

        $this->form_validation->set_message('is_unique', 'E-Postadressen används redan.');

        if ($this->form_validation->run()) {
           
            
            //generate a random key
            $key = md5(uniqid());
            $this->load->library('email', array('mailtype' => 'html'));
          
            $this->email->from('tjacke@hotmail.se', "Bekräftelse - tjacke@hotmail.com");
            $this->email->to($this->input->post('email'));
            $this->email->subject("Bekräfta ditt konto.");

            $message = "<p>Tack för att du registrerar dig!</p>";
            $message .= "<p><a href='" . base_url() . "registrera/register_user/$key'>Klicka här</a> för att slutföra registreringen</p>";

            //send and email to the user 
            $this->email->message($message);

            //add temp_user to db
            if ($this->model_users->add_temp_user($key)) {
                if ($this->email->send()) {
                    $data = array(
                        // If registration succeed
                        'error' => '<h2>Tack!</h2><p>En bekräftelse är skickad till din E-Post.<br />Logga in på din mail för att slutföra registreringen.</p>'
                    );
                    $this->reg_message = "<h1>Tack för din registrering!</h1> 
                        <p>Vänligen logga in på din mail och klicka på länken för att 
                        färdigställa din registrering.</p><p><strong>O.B.S. Ditt mail kan hamna i skräpposten.</strong></p>";
                    $this->session->set_userdata($data);
                    $this->session->set_userdata($data);
                    $this->home();
                } else {

                    // If E-mail fails    
                    $data = array(
                        'error' => '<h2>Något gick fel!</h2><p>Kunde inte skicka E-Posten, vänligen försök igen.</p>'
                    );
                    
                    $this->home();
                }
            } else {

                // If registration Failed
                $data = array(
                    'error' => '<h2>Något gick fel!</h2><p>Problem med databasen. Vänligen försök igen.</p>'
                );
                $this->session->set_userdata($data);
                $this->home();
            }

            // If field validation don´t meet requirements   
        } else {
            $this->home();
        }
    }
    
    // When new user answer by email the user will be moved to the main user table
    // if the user pass the controll
    public function register_user($key) {

        if ($this->model_users->is_key_valid($key)) {
            if ($newemail = $this->model_users->add_user($key)) {
                $data = array(
                    'email' => $newemail,
                    'is_logged_in' => 1,
                );
                $this->reg_message = '<h1>Registreringen klar!</h1><p>Du är nu inloggad och kan administrera sidan!</p>';

                $this->session->set_userdata($data);
                $this->home();
            } else {
                $data = array(
                    'error' => '<h2>Något gick fel!</h2><p>Registreringen misslyckades, vänligen försök igen!</p>'
                );
                $this->session->set_userdata($data);
                $this->home();
            }
        } else {
            $data = array(
                'error' => '<h2>Något gick fel!</h2><p>Ogiltigt konto eller E-Post, Du kanske redan är registrerar.<br />Prova logga in eller registrera dig igen och logga in på din mail!</p>'
            );
            $this->session->set_userdata($data);
            $this->home();
        }
    }


}

// End class Registrera

        /* End of file start.php */
/* Location: ./application/controllers/welcome.php */

