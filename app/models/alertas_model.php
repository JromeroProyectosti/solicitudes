<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alertas_model extends CI_Model{
     public function __construct(){
        parent::__construct();
        
    }
    
    public function get_nuevos_vendedores($contar=false){
        $this->db->select("*");
        $this->db->where("IdEstadovendedor",1);
        $result=$this->db->get("vendedor");
        
        if($contar){
            return $result->num_rows();
        }else{
            if($result->num_rows()){
                return $result->result_array();
            }
        }
    }
    
}