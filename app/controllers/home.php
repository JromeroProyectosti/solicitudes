<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
               
		if(!$this->session->userdata('username')){
                    
			redirect(base_url()."login");
		}
                
		$this->data['nombre_completo']=$this->session->userdata('nombre_completo');
		$this->data['usuario']=$this->session->userdata('username');
                $this->data['tipousuario']=$this->session->userdata("rol");
	}
	public function index(){
		$this->data['titulo']=ucfirst("index");
		$this->load->view("template/header",$this->data);
		$this->load->view("index",$this->data);
		$this->load->view("template/footer",$this->data);
	}
	public function view($page="index"){
		if ( ! file_exists('app/views/'.$page.'.php'))
		{
			// Oh, oh... no tenemos una pagina para esto!
			show_404();
		}
		$this->data['titulo']=ucfirst($page);
		$this->load->view("template/header",$this->data);
		$this->load->view($page,$this->data);
		$this->load->view("template/footer",$this->data);
	}
}