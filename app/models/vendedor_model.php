<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendedor_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        
    }
    public function very_user($id_vendedor){
        $this->db->select("v.idCliente, v.NombreCliente, v.ApellidoCliente,v.CorreoCliente");
        $this->db->from("cliente v");
        $this->db->where("v.idCliente",$id_vendedor);
        $this->db->where("v.IdEstadocliente",2);
        $result=$this->db->get();

        if($result->num_rows()>0){
            $vendedor=$result->row_array();
            $this->db->set("FechaultimoingresoCliente",date("Y-m-d h:m:s"));
            $this->db->where("idCliente",$vendedor['idCliente']);
            $this->db->update("cliente");
            return $result->result_array();
        }else{
            return false;
        }
    }
    public function get_vendedores($campos="*",$filtro=null){
        $this->db->select($campos);
        $this->db->from("cliente v");
        $this->db->join("estadocliente e","v.idEstadocliente=e.idEstadocliente");
        if($filtro!=null){
            $this->db->where($filtro);
        }
        $result=$this->db->get();
         
        if($result->num_rows()){
            return $result->result_array();
        }
    }
     public function get_vendedor($id_vendedor,$campos="*"){
        $this->db->select($campos);
        $this->db->from("cliente v");
        $this->db->join("estadocliente e","v.idEstadocliente=e.idEstadocliente");
        $this->db->where("idCliente",$id_vendedor);
        $result=$this->db->get();
     
        if($result->num_rows()){
            return $result->row_array();
        }
    }
    public function modificar($id_vendedor,$campos){
        $this->db->set($campos);
        $this->db->where("idCliente",$id_vendedor);
        $this->db->update("cliente");
       
    }
    public function ingresar_registro($array_vendedor){
        try{
            $this->db->set($array_vendedor);
            $this->db->insert('cliente');
            return $this->db->insert_id();
        }
        catch (Exception $e){
            return FALSE;
        }
    }
}

