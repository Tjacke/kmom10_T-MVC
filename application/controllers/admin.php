<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// O.B.S - Autoload: model_user

class Admin extends CI_Controller {

	public  $message;
	public function index()
	{
        $this->home();
	}

    
    public function home() {
        $main = 'view_admin'; // Uniqu for every controller and view
        
        // Start Head image data
        $data['headImg'] = $this->model_pages->getHead();
        // End Head image data
        
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data
        
        // Get hem content from db
        // Parameter in getData('hem')is from 'page' field in 'pagedata' table
        $data["result"] = $this->model_pages->getData('admin'); 
        
        $data['uri_2'] = !empty($uri_2) ? $uri_2 : $this->uri->segment(2);
        
        // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/footer', $data);
    }

// End func home

    
    public function logga($img_error = 'Välj bild!') {
        $data['uri_2'] = 'logga'; // switch in view_admin
        $main = 'view_admin';
        $this->load->helper('file');

        $data['img_error'] = empty($img_error) ? NULL : $img_error;

        // Start Head data
        $data['page'] = $this->model_pages->getData('logga');
        $data['headImg'] = $this->model_pages->getHead();
        // End Head data
                
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data
        
        // Get hem content from db
        // Parameter in getData('hem')is from 'page' field in 'pagedata' table
        $data["result"] = $this->model_pages->getData('admin'); 
        
        
        
        $uri_3 = $this->uri->segment(3) ? $this->uri->segment(3) : null;
        $uri_4 = $this->uri->segment(4) ? $this->uri->segment(4) : null;

        // If you klick "använd" change logo
        if ($uri_4 == 'set') {
            $this->model_pages->setHead($uri_3);
            redirect(base_url().'admin/logga');
        }

        // If you klick "Ta bort" delete logo
        if ($uri_4 == 'delete') {
            $this->model_pages->deleteHead($uri_3);
        }


        $extensions = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
        $data['filenames'] = get_filenames_by_extension('images/logo/', $extensions);


        // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/footer', $data);
    }

// End func logga
    
 
    public function upload_image() {

        // Path to upload map for head images
        $img_path = realpath(APPPATH . '../images/logo');

        if ($_FILES['title']['error'] == 0) {
            //upload and update the file
            $config = array(
                'upload_path' => $img_path,
                'allowed_types' => 'gif|GIF|jpg|JPG|jpeg|JPEG|png|PNG',
                'overwrite' => false,
                'remove_spaces' => true,
                    //$config['max_size']   = '100';// in KB // if required, remove the comment and give the size
            );

            //codeigniter default function
            $this->load->library('upload', $config);


            // redirect page if the load fails.
            if (!$this->upload->do_upload('title')) {
                //show an error to select a picture before clicking the update pic button
                $img_error = base_url().'Ogiltig bild eller format! (jpg, jpeg, gif, png)';
                $this->logga($img_error);
            } else {
                //Image Resizing
                $config['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                $config['maintain_ratio'] = TRUE;
                // If image is larger then 960 px meake it smaller else keep original size 
                if ($this->upload->image_width > 960) {
                    $config['width'] = 960; // image re-size  properties
                    $config['height'] = 768; // image re-size  properties 
                }

                //codeigniter default function
                $this->load->library('image_lib', $config);

                // redirect  page if the resize fails.
                if (!$this->image_lib->resize()) {

                    //show an error if the resize fails.
                    $img_error = 'Det gick inte skala om bilden, försök igen!';
                    $this->logga($img_error);
                }

                /////////////////////////////////////////////////////////////////////////////////////////////////
                //get new width and height from resized image for db storage
                $size = getimagesize($this->upload->upload_path . $this->upload->file_name);

                $this->model_pages->upload_img($size);
                //show an message if img uploaded
                $img_error = 'Bilden laddades upp!';
                $this->logga($img_error);
            }
        } else {
            //show an error to select a picture before clicking the update pic button
            $img_error = 'Skicka med en bild!';
            $this->logga($img_error);
        }
    }

// End func upload_image
       
    
     public function sidor() {

        $data['uri_2'] = 'sidor'; // switch in view_admin
        $uri_3 = $this->uri->segment(3);
        $data['edit_post'] = empty($uri_3) ? null : $uri_3;
        $main = 'view_admin';

        $data['uri_4'] = $this->uri->segment(4);
        $data['validate'] = $this->load->library('form_validation');

        $this->load->helper('file');

        // Start Head data
        $data['headImg'] = $this->model_pages->getHead();
        // End Head data     
         
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data
        
        // Get hem content from db
        // Parameter in getData('hem')is from 'page' field in 'pagedata' table
        $data["result"] = $this->model_pages->getData('admin'); 
        
        // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/footer', $data);
        
    } // End func sidor
     
     
        public function page_validation() {
       
        $data['title'] = 'Validera ny Sida:';
        $this->load->library('form_validation');
                
        $this->form_validation->set_rules('title', 'Titel', 'required|trim');
        $this->form_validation->set_rules('page', 'Sida', 'required|trim');
        $this->form_validation->set_rules('content', 'Innehåll', 'required|trim');

        if ($this->form_validation->run()) {

            $this->model_pages->add_page();
          
            redirect(base_url().'/admin/sidor');
            
        }
        
        $this->sidor();
    }
    
    public function blog(){
       $main = 'view_admin';
       $data['uri_2'] = 'blog'; // switch in view_admin
         // Start Head data
        $data['headImg'] = $this->model_pages->getHead();
        // End Head data     
         
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data
        
        // Get hem content from db
        // Parameter in getData('hem')is from 'page' field in 'pagedata' table
        $data["result"] = $this->model_pages->getData('bloggar'); 
        
        
        // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/footer', $data);
    }
    
        public function blog_validation() {
       // $main = 'view_INCadmin';
        $data['title'] = 'Blogg registrering:';
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Bloggnamn', 'required|trim');
        $this->form_validation->set_rules('content', 'Innehåll', 'required|trim');

        if ($this->form_validation->run()) {

            $this->model_blogs->add_blog();
            $blog_entity = $this->db->insert_id();
            redirect(base_url() . 'bloggar/blog/' . $this->input->post('area') . '/' . $blog_entity);
        }
        
        $this->blog();
        
    } // End func blog_validation
    
     public function fot() {
        $main = 'view_admin';
        $uri_3 = $this->uri->segment(3);
        $data['edit_post'] = empty($uri_3) ? null : $uri_3;
        $data['uri_2'] = 'fot'; // switch in view_admin
          // Start Head data
        $data['headImg'] = $this->model_pages->getHead();
        // End Head data     
         
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data
        
        // Get hem content from db
        // Parameter in getData('hem')is from 'page' field in 'pagedata' table
        $data["result"] = $this->model_pages->getData('admin'); 
      
        
        
        // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/footer', $data);
        
    } // End func fot
    
         public function fot_validation() {

        $data['title'] = 'Validera Fotsida:';
        $this->load->library('form_validation');

        $this->form_validation->set_rules('content', 'Innehåll', 'required|trim');

        if ($this->form_validation->run()) {

            if ($this->input->post('submit_fot_update')) {
                $id = $this->input->post('id');

                $this->model_pages->update_page($id);
                redirect(base_url() . 'admin/fot');
            }
            if ($this->input->post('submit_fot')) {
                $this->model_pages->add_page();
                redirect(base_url() . 'admin/fot');
            }

            // Load View
            $this->fot();
        }
        // Load View
        $this->fot();
        
    } // END fot validation

    
     public function medlem() {

        $data['uri_2'] = 'medlem'; // switch in view_admin
        $uri_3 = $this->uri->segment(3);
        //$data['edit_post'] = empty($uri_3) ? null : $uri_3;
        $main = 'view_admin';
        
         
        $data['users'] = $this->model_pages->getUsers();
        $data['tempUsers'] = $this->model_pages->getTempUsers();
       // $data['uri_4'] = $this->uri->segment(4);
       // $data['validate'] = $this->load->library('form_validation');

      //  $this->load->helper('file');

        // Start Head data
        $data['headImg'] = $this->model_pages->getHead();
        // End Head data     
         
        // Start Foot data
        $data['footData'] = $this->model_pages->getFootData();
        // End Foot  data
        
        // Get hem content from db
        // Parameter in getData('hem')is from 'page' field in 'pagedata' table
        $data["result"] = $this->model_pages->getData('admin'); 
        
        // Load View
        $this->load->view('includes/header', $data);
        $this->load->view($main, $data);
        $this->load->view('includes/footer', $data);
        
    } // End func medlem

    
    
      // Create a page table if not exist
    public function skapa_sida() {
       // if ($this->session->userdata('is_logged_in')) {
            $this->model_pages->do_page_table();
            redirect(base_url());
     //   } else {
      //      echo 'Du måste ha administrativa rättigheter för att skapa websidan';
      //      echo '<p><a href ="' . base_url() . '">Hem</a></p>';
      //      exit;
       // }
            
    } // END func skapa sida
    
    
      // Create a blog table if not exist
    public function skapa_blog() {
       // if ($this->session->userdata('is_logged_in')) {
            $this->model_pages->do_blog_table();
            redirect(base_url());
     //   } else {
      //      echo 'Du måste ha administrativa rättigheter för att skapa websidan';
      //      echo '<p><a href ="' . base_url() . '">Hem</a></p>';
      //      exit;
       // }
            
    } // END func skapa blog
      // Create a blog table if not exist
    
    
    
    public function skapa_user() {
       // if ($this->session->userdata('is_logged_in')) {
            $this->model_pages->do_user_table();
            redirect(base_url());
     //   } else {
      //      echo 'Du måste ha administrativa rättigheter för att skapa websidan';
      //      echo '<p><a href ="' . base_url() . '">Hem</a></p>';
      //      exit;
       // }
            
    } // END func skapa blog


}

// End class Hem


