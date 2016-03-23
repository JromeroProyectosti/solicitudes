<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permisos_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function lista_permisos($id_usuario=0, $constructor=""){
        $this->db->select("pa.NombrePermisoaccion, MetodoPermisoaccion");
        $this->db->from("permisosacciones pa");
        $this->db->join("permisos p", "p.idPermiso=pa.IdPermiso");
        if($id_usuario>0){
            $this->db->join("usuarios_permisosacciones upa","upa.IdPermisoaccion=pa.IdPermisoaccion");
            $this->db->where("upa.IdUsuario",$id_usuario);
        }
        if($constructor!=""){
            $this->db->where("p.ConstructorPermiso",$constructor);
        }
        $result=$this->db->get();
        $resultado_permisos=array();
        if($result->num_rows())
        {
            foreach($result->result() as $item){
                $resultado_permisos[]=$item->MetodoPermisoaccion;
            }
            return $resultado_permisos;
        }else{
            return false;
        }
    }
    
}