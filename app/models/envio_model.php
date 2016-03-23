<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Envio_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function agregar($nombre){
        $this->db->insert("formaenvio",array('NombreFormaenvio'=>$nombre));
        //echo $this->db->last_query();
        return $this->db->insert_id();
      
    }
    public function eliminar($id){
        $this->db->delete("formaenvio",array('idFormaenvio'=>$id));
    }
    
    public function get_envio($id){
        $this->db->select("*");
        $query=$this->db->get_where("formaenvio",array("idFormaenvio"=>$id));
        
        return $query->row_array();
    }
    public function get_envios(){
         $query=$this->db->get("formaenvio");
         
         return $query->result_array();
    }
    
}
