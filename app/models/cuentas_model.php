<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cuentas_model
 *
 * @author jonathan
 */
class cuentas_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function crear_cuenta($campos){
        
        $this->db->flush_cache();
        $this->db->set($campos);
        
        //echo $this->db->last_query();
        if($this->db->insert("cuenta")){
            
            return $this->db->insert_id();
        }
        return false;
    }
    
    public function crear_detalle($id_cuenta,$id_solicitudes=null){
        
        if(is_array($id_solicitudes)){
            
            foreach($id_solicitudes as $ides){
            
                $this->db->set("idSolicitud",$ides);
                $this->db->set("idCuenta",$id_cuenta);
                $this->db->insert("detallecuenta");
           
                
                $this->db->set("InformadoSolicitud",1);
                $this->db->where("idSolicitud",$ides);
                $this->db->update("solicitudes");
                
                
            }
            
        }
        
    }
    
    public function get_cuentas($campos="*",$filtro=array()){
        if(is_array($filtro)){
            $this->db->select($campos);
            $this->db->from("cuenta c");
            $this->db->join("cliente v","v.idCliente=c.idCliente");
            $this->db->join("estadocuenta e","e.idEstadocuenta=c.idEstadocuenta");
            $this->db->where($filtro);
            $result=$this->db->get();
           
            if($result->num_rows()){
                
                //echo $this->db->last_query();
                return $result->result_array();
            }
        }
        
        
        return false;
    }
    public function get_cuenta($id_cuenta,$campos="*"){
        $this->db->select($campos);
            $this->db->from("cuenta c");
            $this->db->join("cliente v","v.idCliente=c.idCliente");
            $this->db->join("estadocuenta e","e.idEstadocuenta=c.idEstadocuenta");
            
            $this->db->where("idCuenta",$id_cuenta);
            $result=$this->db->get();
            if($result->num_rows()){
                return $result->row_array();
            }
            
            return false;
    }
    public function get_detalle_cuenta($id_cuenta,$campos="*"){
        $detalle="";
        $this->db->select($campos);
        $this->db->from("detallecuenta d");
        $this->db->join("solicitudes s","s.idSolicitud=d.idSolicitud");
        $this->db->where("idCuenta",$id_cuenta);
        $result=$this->db->get();
        
        if($result->num_rows()){
            return $result->result_array();
        }
        return false;
    }
    
    public function modificar($id_cuenta,$campos=array()){
        $this->db->set($campos);
        $this->db->where("idCuenta",$id_cuenta);
        $this->db->update("cuenta");
       // echo $this->db->last_query();
    }
    public function eliminar($id_cuenta){
        $this->db->delete("detallecuenta",array("idCuenta"=>$id_cuenta));
        $this->db->delete("cuenta",array("idCuenta"=>$id_cuenta));
    }
    public function get_informe_ventas($campos="*",$filtro=null){
        $this->db->select($campos);
       
        $this->db->from("cuenta c");
        $this->db->join("estadocuenta ec","ec.idEstadocuenta=c.idEstadocuenta");
        $this->db->join("cliente cl","cl.idCliente=c.idCliente");
        if($filtro!=null){
            $this->db->where($filtro);
        }
        $query=$this->db->get();
        
        return $query->result_array();
    }
    public function get_informe_ventas_productos($campos="*",$filtro=null){
        $this->db->select($campos);
        $this->db->from("detallecuenta d");
        
        $this->db->join("solicitudes s","s.idSolicitud=d.idSolicitud");
        $this->db->join("detallesolicitud ds","ds.idSolicitud=s.idSolicitud");
        $this->db->join("productos p","p.idproductos=ds.idproductos");
        $this->db->join("cuenta c","c.idCuenta=d.idCuenta");
        $this->db->join("estadocuenta ec","ec.idEstadocuenta=c.idEstadocuenta");
        $this->db->join("cliente cl","cl.idCliente=c.idCliente");
        if($filtro!=null){
            $this->db->where($filtro);
        }
        $query=$this->db->get();
        
        return $query->result_array();
    }
    
}
