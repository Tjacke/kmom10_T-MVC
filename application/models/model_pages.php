<?php

class Model_pages extends CI_Model {
    
    
    function getData($page){
        // Sort db 
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("pagedata", array("page" => $page));
        
        if($query->num_rows()){
          return $query->result();  
        } else {
          return NULL;
        }
        
    } // END getData
    
    function getUsers(){
        // Sort db 
        $query = $this->db->query("SELECT * FROM users");
        return $query->result();
        }
    function getTempUsers(){
        // Sort db 
        $query = $this->db->query("SELECT * FROM temp_users");
        return $query->result();
        
    } // END getData
    
    function dropTbl($tbl){
        //echo 'inne i motort - ' . $tbl;
       // exit;
        //$this->dbforge->drop_table('pagedata');
        $sql = 'DROP TABLE IF EXISTS ' . $tbl;
        $query = $this->db->query($sql); 
        
        if($tbl == 'users'){
            $sql = 'DROP TABLE IF EXISTS ' . 'temp_users';
            $query = $this->db->query($sql); 
        }
        return TRUE; 
// gives DROP TABLE IF EXISTS table_name
      //  $query = $this->db->get_where("pagedata", array("id" => $id));
      //  return $query->result();
    }
            
    
    
    
    function getPageId($id){
        $query = $this->db->get_where("pagedata", array("id" => $id));
        return $query->result();
    }
    
     function getPage(){
        $query = $this->db->query("SELECT DISTINCT page FROM pagedata");
        return $query->result();
    }
    
    function getEdit(){       
        $query = $this->db->query("SELECT id, title, page, content FROM pagedata");
        return $query->result();
    }
    
    function getHead() {

        if (!$this->db->table_exists('pagedata')) {

            // If no pagedata table exist send dummy img
            return 'none.png';
        }

        $this->db->select('content');
        $this->db->from('pagedata');
        $this->db->where('title', '1');
        $this->db->where('page', 'logga');
        $query = $this->db->get();

        $query->result();

        if ($query->num_rows()) {

            // Extract the image name from db
            $headImg = $query->result_object;
            foreach ($headImg as $value) {
                $img = $value->content;
            }   // Get image name from db
            return $img;
        } else {
            // If no image is selected in db use dummy image
            return 'none.png';
        }
    }

// End func getHead
    
    
    function getFootData(){    
        $this->db->select('content');
        $this->db->from('pagedata');
        $this->db->where('page', 'sidfot');
        $query = $this->db->get();
        
       $query->result();
            
        if($query->num_rows()){
            // Extract the data fron an object
            $footData = $query->result_object;
            foreach ($footData as $value) { $footRes = $value->content;}   // Get image name from db
            return $footRes;
            
            
        } else {
            
            // If no data is found in db
           return 'Skapa en sidfot i admin menyn.';
        }
    }
    
    function setHead($id){  
       
        $query = $this->db->query("SELECT id FROM pagedata WHERE title='1' AND page='logga'");
        $zero = $query->result();
        
        // Get the post with title value 1 from an object
        // $zero will be a var containing the id where title is 1
        if($query->num_rows()){
            foreach($zero as $value){ $zero = $value; }
            $zero = $zero->id;

            // The post with title = 1 will be set as title = 0    
            $this->db->where('id', $zero);
            $this->db->update('pagedata', array('title'  => '0')); 
        }
        
        // The selectet image-title will be set to title = 1   
        $this->db->where('id', $id);
        $this->db->update('pagedata', array('title'  => '1')); 
       
        redirect(base_url().'admin/logga');
    }
    
    
    function deleteHead($id){  
        $this->load->helper('file');
        
        $this->db->select('content');
        $this->db->from('pagedata');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
       $query->result();
            
        if($query->num_rows()){
            
            // Extract the image name from db
            $headImg = $query->result_object;
            foreach ($headImg as $value) { $img = $value->content;}   // Get image name from db
                       
        } else {
            // If no row exist
           return FALSE;
        }
        
        $this->db->delete("pagedata", array('id' => $id));
        
        // Path to image that will be deleted
        $img_path = realpath(APPPATH . '../images/logo/'.$img);
      
        unlink($img_path);
        
        redirect(base_url().'admin/logga');
    }
    
    
    
    function getFot(){
        $query = $this->db->get_where("pagedata", array("page" => 'Sidfot'));
        return $query->result();
    }
    function delete_page($id){
        $this->db->delete("pagedata", array('id' => $id));
    } 
    
     public function update_page($id){
        
        $this->db->where('id', $id);
     
              
        $update = array(
            'title'     => $this->input->post('title'),
            'page'      => $this->input->post('page'),
            'ingress'   => $this->input->post('ingress'),
            'content'   => $this->input->post('content'),
        
        );
               
        $this->db->update("pagedata", $update);
    }
    
    public function add_page(){
        
        $data = array(
            'title'     => $this->input->post('title'),
            'page'      => $this->input->post('page'),
            'ingress'     => $this->input->post('ingress'),
            'content'     => $this->input->post('content'),
        
        );
        
        $query = $this->db->insert('pagedata', $data);
        if($query){
            return true;
        } else {
            return false;
        }
    } // End add pages 
    
     public function upload_img($size) {
      
      $insert = array(
            'title'         => '0',
            'page'          => $this->input->post('page'),
            'ingress'       => $size[0] .' X ' . $size[1],
            'content'       => $this->upload->file_name,
        );
            

        $query = $this->db->insert('pagedata', $insert);
        
        if($query){
            return true;
        } else {
            return false;
        }
    } // END func upload_img
    
    
    function do_page_table(){
        $this->load->dbforge();
        $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ),
                'page' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ),
                'ingress' => array(
                    'type' => 'TEXT',
                ),
                'content' => array(
                    'type' => 'TEXT',
                ),
                 
            );
         
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('pagedata');        
        
         // Create a user "doe" with admin rights
        $data = array(
   array(
      'title' => 'Välkommen till sidan!' ,
      'page' => 'hem' ,
      'ingress' => 'Logga in och testa sidan.',
      'content' => 'Ändra innehållet, ladda upp ny logga skapa bloggar mm.',
   ),
   array(
      'title' => 'Information!' ,
      'page' => 'info' ,
      'ingress' => 'Här kan man fylla i vad sidan handlar om. Allt sköts från adminsidan.',
      'content' => 'Vill man skriva om sidan eller en produkt eller ett företag, det är upp till användaren.',
   ),
   array(
      'title' => 'Kontakta oss!' ,
      'page' => 'kontakt' ,
      'ingress' => 'Här kan man kontakta sidans ägare eller företag.',
      'content' => 'Funktionen på adminsidan för att ställa in E-post är inte skapad än, men man ska kunna välja vart mailen ska skickas.',
   ),
   array(
      'title' => 'Välkommen!' ,
      'page' => 'medlem' ,
      'ingress' => 'Du är inloggad med administrativa rättigheter.',
      'content' => 'För att skapa sidor och bloggar klicka på admin. Man kan inte ändra på användarens profil än, men man kan registrera sig som ny användare.',
   ),
   array(
      'title' => 'Admin!' ,
      'page' => 'admin' ,
      'ingress' => 'Som admin kan du ändra allt på sidan.',
      'content' => 'Alla funktioner är inte skapade än.',
   ),
   array(
      'title' => 'Logga in!' ,
      'page' => 'loggain' ,
      'ingress' => 'E-post: doe@doe.com<br />Lösen: doe',
      'content' => '&nbsp;',
   ),
   array(
      'title' => 'Bloggar!' ,
      'page' => 'bloggar' ,
      'ingress' => 'Du kan nu skapa bloggar fritt via admin och bloggar. Ingen gruppfunktion är skapade, men man ska i framtiden kunna tilldela grupptillhörighet för användarna.',
      'content' => 'För att editera eller ta bort en blogg så navigerar du dig fram till den blogg du vill editera. Du måste vara inloggad först.',
   )
);
        
        // Insert user "doe"
        $query = $this->db->insert_batch('pagedata', $data);
        
        
    } // END do pagedata table
    
    function do_blog_table(){
        $this->load->dbforge();
        $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ),
                'ingress' => array(
                    'type' => 'TEXT',
                ),
                'content' => array(
                    'type' => 'TEXT',
                ),
                 'area' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ),
            );
         
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('blogs');       
        
    } // END do blog table
    
    
    function do_user_table(){
        $this->load->dbforge();
        $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ),
                'password' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '32',
                ),
            );
         
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('users'); 
        
        
        // Create a user "doe" with admin rights
        $data = array(
            'email'     => 'doe@doe.com',
            'password'      => md5('doe'),
        
        );
        
        // Insert user "doe"
        $query = $this->db->insert('users', $data);
        
        // Create temp_user table for email validation
        $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ),
                'password' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '32',
                ),
                'key' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '32',
                ),
            );
         
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('temp_users');
        
        
    } // END do users & temp_users table
   
    
  } // End Class Model_pages
  