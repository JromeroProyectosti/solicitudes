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
class Cuentas extends CI_Controller{
    public function __construct() {
        parent::__construct();
         $this->data['scripts']="<script>
                $(document).ready(function() {
                    $('#datatable-cuentas').DataTable({
                            responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
                    });
                });
            </script>";
    }
    
    public function listar_todos($estado=0){
        $this->data['titulo']="Estado de Cuentas";
        
        
        $this->load->model("cuentas_model");
        if($estado>0){
        $filtro=array(
            "c.idVendedor"=>$this->session->userdata("id_vendedor"),
            "c.idEstadocuenta"=>$estado
        );
        }else{
          $filtro=array(
            "c.idVendedor"=>$this->session->userdata("id_vendedor")
           
        );  
        }
        
        $detalle['listado']=$this->cuentas_model->get_cuentas("*",$filtro);
        $this->load->view("template/header",$this->data);
        $this->load->view("cuentas/listado",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function detalle($id_cuenta){
        $this->data['titulo']="Estado de Cuentas";
        
        $this->load->model("cuentas_model");
        $detalle['cuenta']=$this->cuentas_model->get_cuenta($id_cuenta);
        
        $detalle['detalle']=$this->cuentas_model->get_detalle_cuenta($id_cuenta);
        $this->load->view("template/header",$this->data);
        $this->load->view("cuentas/detalle",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    
}