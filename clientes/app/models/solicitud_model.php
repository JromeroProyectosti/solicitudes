<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Solicitud_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    public function get_listado($campos="*",$filtro=null, $orden="s.FechaingresoSolicitud Asc"){
        $this->db->set($campos);
        $this->db->from("solicitudes s");
        $this->db->join("cliente v","v.idCliente=s.idCliente");
        $this->db->join("estadosolicitud e","e.idEstadosolicitud=s.idEstadosolicitud");
        $this->db->join("formaenvio f","f.idFormaenvio=s.idFormaenvio");
        if($filtro!=null){
            $this->db->where($filtro);
        }
        $this->db->order_by($orden);
        $result=$this->db->get();
        
        if($result->num_rows()){
            return $result->result_array();
        }
        return false;
    }
    public function get_solicitudes($id_vendedor,$campos="*", $filtro=null){
        $this->db->select($campos);
        $this->db->from("solicitudes s");
        $this->db->join("estadosolicitud e","e.idEstadosolicitud=s.idEstadosolicitud");
        $this->db->where("idCliente",$id_vendedor);
      
        if($filtro!=null){
            $this->db->where($filtro);
        }
        $result=$this->db->get();
        if($result->num_rows()){
            return $result->result_array();
        }
       // echo $this->db->last_query();
        return false;
    }
   public function get_solicitud($id_solicitud,$campos="*",$filtro=null){
        $this->db->set($campos);
        $this->db->from("solicitudes s");
        $this->db->join("cliente v","v.idCliente=s.idCliente");
        $this->db->join("estadosolicitud e","e.idEstadosolicitud=s.idEstadosolicitud");
        $this->db->join("estadocliente ev","ev.idEstadocliente=v.idEstadocliente");
   
        $this->db->where("idSolicitud",$id_solicitud);
        if($filtro!=null){
            $this->db->where($filtro);
        }
        $result=$this->db->get();
        if($result->num_rows()){
            return $result->row_array();
        }
        return false;
    }
    public function crear_solicitud($campos){
        
        $this->db->set($campos);
        
        $this->db->insert("solicitudes");

        return $this->db->insert_id();
    }
    public function ingresar_detalle($id_solicitud,$campos){
        $this->db->set($campos);
        $this->db->set("idSolicitud",$id_solicitud);
        $this->db->insert("detallesolicitud");
    }
     public function get_detalle_solicitud($id_solicitud,$campos="*",$filtro=null){
        $this->db->set($campos);
        $this->db->from("detallesolicitud d");
        $this->db->join("productos p","p.idproductos=d.idproductos");
        $this->db->where("idSolicitud",$id_solicitud);
        if($filtro!=false){
            $this->db->where($filtro);
        }
         $result=$this->db->get();
        if($result->num_rows()){
            
            return $result->result_array();
        }
        return false;
    }
    public function modificar_solicitud($id_solicitud,$campos,$filtro=null){
        $this->db->set($campos);
        $this->db->where("idSolicitud",$id_solicitud);
        if($filtro!=null){
            $this->db->where($filtro);
        }
        $this->db->update("solicitudes");
    }
}