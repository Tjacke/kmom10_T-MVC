<?php

class Model_blogs extends CI_Model{
    
    
    function getData($page){
        $query = $this->db->get_where("blogs", array("id" => $page));
        return $query->result();
    }
    
    function getBlogs(){
        $query = $this->db->query("SELECT DISTINCT area FROM blogs");
        return $query->result();
    }
    
    function fixUri($fix){
        $replace1 = array('%C3%A5','%C3%A4','%C3%B6','%C3%85','%C3%84','%C3%96');
        $replace2 = array('å','ä','ö','Å','Ä','Ö');
        $areas = str_replace($replace1,$replace2,$fix);
        return $areas;
    }
    
    
    function getBlogArea($area){
        $query = $this->db->query("SELECT title, id FROM blogs WHERE area='$area'");
        return $query->result();
    }
          
    public function add_blog(){
        
        $data = array(
            'title'     => $this->input->post('title'),
            'area'      => $this->input->post('area'),
            'ingress'   => $this->input->post('ingress'),
            'content'   => $this->input->post('content'),
        
        );
        
        $query = $this->db->insert('blogs', $data);
        if($query){
            return true;
        } else {
            return false;
        }
    }
    
    public function update_blog($id){
        
        $update = array(
            'title'     => $this->input->post('title'),
            'area'      => $this->input->post('area'),
            'ingress'   => $this->input->post('ingress'),
            'content'   => $this->input->post('content'),
        
        );
               
        $this->db->update("blogs", $update, $id);
    }
    
    function delete_blog($id){
        $this->db->delete("blogs", array('id' => $id));
    }
    
                
    
} // End class Model_blogs