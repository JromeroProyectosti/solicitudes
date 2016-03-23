<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function get_comuna($id_ciudad=0,$id_comuna=0){

            $this->db->order_by("NombreComuna","Asc");

            if($id_comuna>0){
                $this->db->where('IdComuna',$id_comuna);
            }
            if($id_ciudad>0){
                $this->db->where('IdCiudad',$id_ciudad);
            }
            $result=$this->db->get('comuna');
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

            $this->db->order_by("OrdenEstadocliente","Asc");
            if($id_estado>0){
                $this->db->where('IdEstadocliente',$id_estado);
            }
            $result=$this->db->get('estadocliente');
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
        public function get_estado_cuenta($id_estado=0){

            $this->db->order_by("OrdenEstadocuenta","Asc");
            if($id_estado>0){
                $this->db->where('idEstadocuenta',$id_estado);
            }
            $result=$this->db->get('estadocuenta');
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
        public function get_categorias(){
            $this->db->order_by("OrdenCategoria","Asc");
            $result=$this->db->get('categoria');
            return $result->result_array();
        }
        public function get_neto($venta){
            $neto=(int)($venta)/1.19;
            return $neto;
        }
        public function get_iva($venta){
            $iva=(int)($venta)-$this->get_neto($venta);
            return $iva;
        }
        public function recalcular_reservas($producto){
            $this->db->select_sum("CantidadDetallesolicitud");
           
            $this->db->from("solicitudes s");
            $this->db->join("detallesolicitud d"," s.idSolicitud = d.idSolicitud");
            $filtro=array(
                "idEstadosolicitud"=>2,
                "idproductos"=>$producto
            );
            $this->db->where($filtro);
            
           
            $query=$this->db->get();
            foreach($query->result() as $row){
                $this->db->set("ReservaProducto",$row->CantidadDetallesolicitud);
                $this->db->where("idproductos",$producto);
                $this->db->update("productos");
                
            }
        }
}