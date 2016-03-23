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
    

    public function get_cuentas($campos="*",$filtro=array()){
        if(is_array($filtro)){
            $this->db->select($campos);
            $this->db->from("cuenta c");
            $this->db->join("cliente v","v.idCliente=c.idCliente");
            $this->db->join("estadocuenta e","e.idEstadocuenta=c.idEstadocuenta");
            $this->db->where($filtro);
            $result=$this->db->get();
            if($result->num_rows()){
                return $result->result_array();
            }
        }
        return false;
    }
    public function get_cuenta($id_cuenta,$campos="*"){
        $this->db->set($campos);
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
        $this->db->where("idcuenta",$id_cuenta);
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
    }
    
    
}
