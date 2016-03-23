<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendedor_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        
    }
    public function very_user($usuario, $password){
        $this->db->select("v.idCliente, v.NombreCliente, v.ApellidoCliente");
        $this->db->from("cliente v");
        $this->db->where("v.CorreoCliente",$usuario);
        $this->db->where("v.ClaveCliente",md5($password));
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
    public function menu($idUsuario){

        $this->db->select("NombreMenu,RutaMenu");
        $this->db->from("menu");
        $this->db->join("submenu","submenu.IdMenu=menu.IdMenu");
        $this->db->join("usuariosubmenu","usuariosubmenu.IdSubmenu=submenu.IdSubmenu");
        $this->db->where("usuariosubmenu.IdUsuario",$idUsuario);
        $result=$this->db->get();

        if($result->num_rows()){
                return $result->row_array();

        }else{
                return false;
        }
    }
    public function listado_usuarios($id_maestra,$filtro=""){

        $this->db->select('*');
        $this->db->from('usuarios u');
        $this->db->join('tipousuario tu','tu.IdTipousuario=u.idTipousuario');
        $this->db->join('estadousuario eu','eu.IdEstadousuario=u.idEstadousuario');
        //$this->db->join('tipoempresa','tipoempresa.IdTipoempresa=empresa.IdTipoempresa');
        //$this->db->where('IdMaestra',$id_maestra);
        if($filtro!=""){
            $this->db->or_like("NombreEstadousuario",$filtro);
            $this->db->or_like("NombreTipousuario",$filtro);
            $this->db->or_like("NombreUsuario",$filtro);
            $this->db->or_like("ApellidoUsuario",$filtro);
            $this->db->or_like("UsuarioUsuario",$filtro);
        }
        $result=$this->db->get();

        if($result->num_rows()){


            return $result->result_array();

        }else{
                return false;
        }
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
      public function modificar($id_vendedor,$campos){
        $this->db->set($campos);
        $this->db->where("idCliente",$id_vendedor);
        $this->db->update("cliente");
       
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
    public function get_vendedores($campos="*", $filtro=array()){
        $this->db->select($campos);
        $this->db->from("cliente v");
        $this->db->join("estadocliente e","v.idEstadocliente=e.idEstadocliente");
        if(is_array($filtro)){
            $this->db->where($filtro);
        }
        $result=$this->db->get();
     
        if($result->num_rows()){
            return $result->result_array();
        }
        return false;
    }
    
}

