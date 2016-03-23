<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Denegado extends MY_Controller{
    public function __construct(){
		parent::__construct(FALSE);
    }
    
    public function index(){
        $data['titulo']="Denegado";
        $this->load->view("template/header",$data);
        $this->load->view('AccessDenied');
        $this->load->view("template/footer",$data);
    }
                
}