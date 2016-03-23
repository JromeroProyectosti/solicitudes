<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function get_comuna($id_ciudad=0,$id_comuna=0,$id_region=0){
            $this->db->select(" c.* ");
            $this->db->from("comuna c");
            $this->db->order_by("NombreComuna","Asc");

            if($id_comuna>0){
                $this->db->where('c.IdComuna',$id_comuna);
            }
            if($id_ciudad>0){
                $this->db->where('c.IdCiudad',$id_ciudad);
            }
            if($id_region>0){
                $this->db->join("ciudad ci", "ci.IdCiudad=c.IdCiudad");
                $this->db->where("ci.IdRegion",$id_region);
            }
            $result=$this->db->get();
            return $result->result_array();
		
	}
	public function get_ciudad($id_region=0, $id_ciudad=0){
           
            $this->db->order_by("NombreCiudad","Asc");
            if($id_region>0){
                $this->db->where('IdRegion',$id_region);
            }
            if($id_ciudad>0){
                $this->db->where('IdCiudad',$id_ciudad);
            }
            
            $result=$this->db->get('ciudad');
            return $result->result_array();
           
	}
	public function get_region($id_region=0){

            $this->db->order_by("DescripcionRegion","Asc");
            if($id_region>0){
                $this->db->where('IdRegion',$id_region);
            }
            $result=$this->db->get('region');
            return $result->result_array();
	}
        public function get_estado_usuario($id_estado=0){

            $this->db->order_by("OrdenEstadousuario","Asc");
            if($id_estado>0){
                $this->db->where('IdEstadousuario',$id_estado);
            }
            $result=$this->db->get('estadousuario');
            return $result->result_array();
	}
        public function get_estado_vendedor($id_estado=0){

            $this->db->order_by("OrdenEstadovendedor","Asc");
            if($id_estado>0){
                $this->db->where('IdEstadovendedor',$id_estado);
            }
            $result=$this->db->get('estadovendedor');
            return $result->result_array();
	}
         public function get_estado_solicitud($id_estado=0){

            $this->db->order_by("OrdenEstadosolicitud","Asc");
            if($id_estado>0){
                $this->db->where('idEstadosolicitud',$id_estado);
            }
            $result=$this->db->get('estadosolicitud');
            return $result->result_array();
	}
         public function get_tipo_usuario($id_perfil=0){

            $this->db->order_by("NombreTipousuario","Asc");
            if($id_perfil>0){
                $this->db->where('IdTipousuario',$id_perfil);
            }
            $result=$this->db->get('tipousuario');
            return $result->result_array();
	}
        public function get_forma_envio(){
            $this->db->order_by("OrdenFormaenvio","Asc");
            $result=$this->db->get('formaenvio');
            return $result->result_array();
	}
}