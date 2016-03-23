<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Empresa extends MY_Controller{
	
	public function __construct(){
		
		parent::__construct(FALSE);
                
		if(!$this->session->userdata('username')){
			redirect(base_url()."login");
		}
		$this->data['nombre_completo']=$this->session->userdata('nombre_completo');
		$this->data['nombre_empresa']=$this->session->userdata('nombre_empresa');
		$this->data['sucursales']=$this->session->userdata('sucursales');
		$this->data['usuario']=$this->session->userdata('username');

	}

	public function view($page='listado'){
		
		if ( ! file_exists('app/views/mantenedores/empresa/'.$page.'.php'))
		{
			// Oh, oh... no tenemos una pagina para esto!
			$this->load->view("template/header",$this->data);
			show_404();
			$this->load->view("template/footer",$this->data);
		}
		$this->data['titulo']="Empresa - ".ucfirst($page);

		$this->load->view("template/header",$this->data);
		$this->load->view("mantenedores/empresa/".$page,$this->data);
		$this->load->view("template/footer",$this->data);

	}
	
	public function guardarempresa(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtRutEmpresa','Rut Empresa','required|callback_valida_rut');
		$this->form_validation->set_rules('txtNombreEmpresa','Nombre Empresa','required');
		$this->form_validation->set_rules('txtRazonSocial','Razon Social','required|max_length[250]');
		$this->form_validation->set_rules('txtTelefono','Telefono','max_length[50]');
		$this->form_validation->set_rules('txtDireccion','Razon Social','max_length[250]');
		//$this->form_validation->set_rules('cboTipoEmpresa','Tipo Empresa','required');
		if($this->form_validation->run()===FALSE){
			$this->data['titulo']="Empresa - Agregar";
			//$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
			$detalle['ciudad']=$this->common_model->get_ciudad();
			$detalle['comuna']=$this->common_model->get_comuna();
			$detalle['region']=$this->common_model->get_region();
			$this->load->view("template/header",$this->data);
			$this->load->view("mantenedores/empresa/agregar",$detalle);
			$this->load->view("template/footer",$this->data);
		}else{
			$this->empresas_model->add_empresa();
			redirect('listado_empresas');
		}

	}
        /*
	public function modificarempresa(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtNombre','Nombre Empresa','required');
		$this->form_validation->set_rules('txtRazonSocial','Razon Social','required|max_length[250]');
		$this->form_validation->set_rules('txtTelefono','Telefono','max_length[50]');
		$this->form_validation->set_rules('txtDireccion','Razon Social','max_length[250]');
		$this->form_validation->set_rules('cboTipoEmpresa','Tipo Empresa','required');
		if($this->form_validation->run()===FALSE){
			$this->data['titulo']="Empresa - Agregar";
			$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
			$detalle['ciudad']=$this->common_model->get_ciudad();
			$detalle['comuna']=$this->common_model->get_comuna();
			$detalle['region']=$this->common_model->get_region();
			$this->load->view("template/header",$this->data);
			$this->load->view("mantenedores/empresa/agregar",$detalle);
			$this->load->view("template/footer",$this->data);
		}else{
			$this->empresas_model->add_empresa($this->session->userdata('idMaestra'));
			redirect('empresa/listado_empresas');
		}

	}*/
	public function generaoptionciudad(){
		$data=$this->common_model->get_ciudad();
		$option='<option value=0>--Selecciona una Ciudad--</option>';
		foreach ($data as $key => $value) {
			# code...
			$option.='<option value="'.$value['IdCiudad'].'">'.$value['NombreCiudad'].'</option>';
		}

		//return $option;
		$detalle['option']=$option;
		$this->load->view("mantenedores/empresa/option",$detalle);
	}
	public function valida_rut($rut){
		$rutempresa=$rut;
		/*$rutempresa=str_replace(".","",$rutempresa);
		$rutempresa=str_replace("-","",$rutempresa);*/
		if($this->empresas_model->valida_rut($rutempresa)){
			$this->form_validation->set_message('valida_rut',"El Rut ya existe");
			return FALSE;
		}else{
			return true;
		}
	}

	

	
}