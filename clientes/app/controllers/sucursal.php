<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sucursal extends CI_Controller{
	
	public function __construct(){
		
		parent::__construct();
		if(!$this->session->userdata('username')){
			redirect(base_url()."login");
		}
		$this->data['nombre_completo']=$this->session->userdata('nombre_completo');
		$this->data['nombre_empresa']=$this->session->userdata('nombre_empresa');
		$this->data['sucursales']=$this->session->userdata('sucursales');
		$this->data['usuario']=$this->session->userdata('username');

	}

	public function listado_sucursal($rutempresa){
		
		$this->data['titulo']="Sucursal - Listado";
		$detalle['listado']=$this->sucursales_model->listado_sucursal($rutempresa);
		print_r($detalle);
		$this->load->view("template/header",$this->data);
		$this->load->view("mantenedores/sucursal/listado_sucursal",$detalle);
		$this->load->view("template/footer",$this->data);
	}
}