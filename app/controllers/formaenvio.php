<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cli_solicitud
 *
 * @author John
 */
class Formaenvio extends MY_Controller{
    //put your code here
    public function __construct() {
        parent::__construct(true);
        $this->data['nombre_completo']=$this->session->userdata('nombre_completo');
        $this->data['nombre_empresa']=$this->session->userdata('nombre_empresa');
        $this->data['sucursales']=$this->session->userdata('sucursales');
        $this->data['usuario']=$this->session->userdata('username');
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-solicitudes').DataTable({
                responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
    });
    $(function() {
      var availableTags = [
        'ActionScript',
        'AppleScript',
      ];
      $( '#tags' ).autocomplete({
        source: availableTags
      });
    });
</script>";
    }
    
    public function listado(){
        $this->load->model("envio_model");
        
        $this->data['detalle']=$this->envio_model->get_envios();
        $this->load->view("template/header",$this->data);
        $this->load->view("mantenedores/formaenvio/listado",$this->data);
        $this->load->view("template/footer",$this->data);
        
    }
    public function agregar(){
        
    }
    
    
}