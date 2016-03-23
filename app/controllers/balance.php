<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cli_cliente
 *
 * @author John
 */
class Balance extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
 
    
    public function generar_balance(){
        
        
        $this->load->view("template/header", $this->data);
        $this->load->view("vendedores/modificar",$detalle);
        $this->load->view("template/footer", $this->data);
    }
    
}