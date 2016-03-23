<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sucursales_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function listado_sucursal($rutempresa){
			
		$this->db->select('RutEmpresa, NombreSucursal, DireccionSucursal, TelefonoSucursal, NombreComuna, NombreCiudad');
		$this->db->from('sucursal');
		$this->db->join('comuna','sucursal.IdComuna=comuna.IdComuna');
		$this->db->join('ciudad','ciudad.IdCiudad=comuna.IdCiudad');
		$this->db->where('RutEmpresa',$rutempresa);
		$result=$this->db->get();

		if($result->num_rows()){
			return $result->result_array();

		}else{
			return false;
		}
		
	}
}