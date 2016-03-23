<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        define("DBEXT","");
    }

    public function very_user($usuario, $password){
        //$result=$this->db->get_where('usuario', array('Usuario'=>$usuario,'Clave'=>$password));
        
        $this->db->select("u.IdUsuario, u.NombreUsuario, u.ApellidoUsuario, u.IdTipousuario");
        $this->db->from("usuarios u");
        $this->db->where("u.UsuarioUsuario",$usuario);
        $this->db->where("u.ClaveUsuario",md5($password));
        $this->db->where("u.IdEstadousuario",1);
        $result=$this->db->get();

        if($result->num_rows()>0){
                $usuario=$result->row_array();
                $this->db->set("FechaultimoingresoUsuario",date("Y-m-d h:m:s"));
                $this->db->where("IdUsuario",$usuario['IdUsuario']);
                $this->db->update("usuarios");
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
    public function add_usuario(){
        try{
        $this->db->set("idTipousuario",$this->input->post("cboTipo1"));
        $this->db->set("idEstadousuario",$this->input->post("cboEstado1"));
        $this->db->set("RutUsuario",$this->input->post("txtRutUsuario"));
        $this->db->set("NombreUsuario",$this->input->post("txtNombreUsuario"));
        $this->db->set("ApellidoUsuario",$this->input->post("txtApellidoUsuario"));
        $this->db->set("CorreoUsuario",$this->input->post("txtCorreo"));
        $this->db->set("UsuarioUsuario",$this->input->post("txtUsuario"));
        $this->db->set("claveUsuario",md5($this->input->post("txtPassword")));
        $this->db->set("FecharegistroUsuario", date("Y-m-d"));
        $this->db->insert('usuarios');
        }
        catch (Exception $e){
            return FASLSE;
        }
        
    }
    public function mod_usuario($rut){
        try{
           
        $this->db->set("idTipousuario",$this->input->post("cboTipo1"));
        $this->db->set("idEstadousuario",$this->input->post("cboEstado1"));
        $this->db->set("NombreUsuario",$this->input->post("txtNombreUsuario"));
        $this->db->set("ApellidoUsuario",$this->input->post("txtApellidoUsuario"));
        $this->db->set("CorreoUsuario",$this->input->post("txtCorreo"));
        $this->db->set("UsuarioUsuario",$this->input->post("txtUsuario"));
        if($this->input->post("txtPassword")){
            $this->db->set("claveUsuario",md5($this->input->post("txtPassword")));
        }
        $this->db->where("RutUsuario",$rut);
        $this->db->update('usuarios');
        }
        catch (Exception $e){
            return FASLSE;
        }
        
    }
    public function get_usuario($rut){
        $this->db->select("*");
        $this->db->from("usuarios u");
        //$this->db->where("IdEstadousuario","1");
        $this->db->where("RutUsuario",$rut);
        $result=$this->db->get();

        if($result->num_rows()){
            return $result->row_array();
        }else{
            return FALSE;
        }
        
        
        
    }
    public function get_permisos($rut){
        $this->db->select("p.idPermiso,p.NombrePermiso");
        $this->db->from("permisos p");
        $this->db->join("tipousuariopermisos tup","tup.idPermiso=p.idPermiso");
        $this->db->join("tipousuario tu","tu.idTipousuario=tup.idTipousuario");
        $this->db->join("usuarios u", "tu.idTipousuario=u.idTipousuario");
        $this->db->where("u.RutUsuario",$rut);
        $result=$this->db->get();
        if($result->num_rows()){
            return $result->result_array();
        }else{
            return FALSE;
        }
        
    }
    public function get_acciones($id_permiso, $rut=''){
        $this->db->select("pa.idPermisoaccion,pa.NombrePermisoaccion");
        $this->db->from("permisosacciones pa");
       
        $this->db->where("pa.idPermiso",$id_permiso); 
        
        if($rut!=''){
            $this->db->join("usuarios_permisosacciones upa","upa.idPermisoaccion=pa.idPermisoaccion");
            $this->db->join("usuarios u","u.idUsuario=upa.idUsuario");
            $this->db->where("u.RutUsuario",$rut);
        }
        $result=$this->db->get();
        $resultado_permisos=array();
        if($result->num_rows()){
            if($rut!=''){
                
        
                foreach($result->result() as $item){
                    $resultado_permisos[]=$item->NombrePermisoaccion;
                }
                return $resultado_permisos;
            }else{
                return $result->result_array();
            }
        }else{
            return FALSE;
        } 
    }
    public function del_permisos($rut){
        
        
        $array_usuario=$this->get_usuario($rut);
    
        $this->db->where("idUsuario",$array_usuario['idUsuario']);
        $this->db->delete('usuarios_permisosacciones');
    }
    public function set_permisos($rut){
        $array_permisos=$this->input->post('checkpermisos');

        $array_usuario=$this->get_usuario($rut);
        
        if(is_array($array_permisos)){
            foreach($array_permisos as $row){
                $this->db->set("idPermisoaccion",$row);
                $this->db->set("idUsuario",$array_usuario['idUsuario']);
                $this->db->insert("usuarios_permisosacciones");
            }
            
            
            
        }
    }
    
    
}

