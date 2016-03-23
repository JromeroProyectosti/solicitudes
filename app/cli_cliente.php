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
class Cli_cliente extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function registro(){
        $this->load->view("template/header");
        $this->load->view("clientes/registro");
        $this->load->view("template/footer");
    }
    public function listar_todos(){
        $this->load->model("vendedor_model");
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#table-listado').DataTable({
                responsive: true
        });
        $('#excel').click(function(e) {
            window.open('data:application/vnd.ms-excel,' + $('#div-1a').html());
            e.preventDefault();
        });
    });
     
</script>";
        $detalle['listado']=$this->vendedor_model->get_vendedores("*");
        $this->data['titulo']="Vendedores - Listado";
        
        $this->load->view("template/header", $this->data);
        $this->load->view("vendedores/listado",$detalle);
        $this->load->view("template/footer", $this->data);
    }
    public function listar_por_validar(){
        $this->load->model("vendedor_model");
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#table-listado').DataTable({
                responsive: true
        });
    });
</script>";
        $detalle['listado']=$this->vendedor_model->get_vendedores("*",array("v.idEstadovendedor"=>1));
        $this->data['titulo']="Vendedores - Listado";
        
        $this->load->view("template/header", $this->data);
        $this->load->view("vendedores/listado",$detalle);
        $this->load->view("template/footer", $this->data);
    }
    public function modificar($id_vendedor){
      
        $this->load->model("vendedor_model");
        
        $detalle['estado']=$this->common_model->get_estado_vendedor();
        $this->data['titulo']="Vendedores - Modificar";
      
        $this->load->library('form_validation');
  
        $this->form_validation->set_rules('txtNombreVendedor','Nombre','required');
        //$this->form_validation->set_rules('txtApellidoVendedor','Apellido','required');
        //$this->form_validation->set_rules('txtRutVendedor','Rut','required');
        $this->form_validation->set_rules('txtCorreo','Correo','required|valid_email');
        $this->form_validation->set_rules('txtTelefono','Telefono','required');
        $this->form_validation->set_rules('txtDireccion','Direccion','required');
        //$this->form_validation->set_rules('cboEstado','Estado','required');
        
        if($this->form_validation->run()===FALSE){
            
            $detalle['vendedor']=$this->vendedor_model->get_vendedor($id_vendedor);

            $this->load->view("template/header", $this->data);
            $this->load->view("vendedores/modificar",$detalle);
            $this->load->view("template/footer", $this->data);
            
        }else{
            $campos=array(
               
                "NombreVendedor"=>$this->input->post("txtNombreVendedor"),
                "ApellidoVendedor"=>$this->input->post("txtApellidoVendedor"),
                "CorreoVendedor"=>$this->input->post("txtCorreo"),
                "CorreoconfirmacionVendedor"=>$this->input->post("txtCorreo"),
                "TelefonoVendedor"=>$this->input->post("txtTelefono"),
                "ComunaVendedor_text"=>$this->input->post("txtComuna"),
                "DireccionVendedor"=>$this->input->post("txtDireccion"),
                "idEstadovendedor"=>$this->input->post("cboEstado1"),
            );
            $this->vendedor_model->modificar($id_vendedor,$campos);
            $detalle['vendedor']=$this->vendedor_model->get_vendedor($id_vendedor);
            if($this->input->post("cboEstado1")==2){
                $this->vendedor_model->modificar($id_vendedor,array("FechasolicitudValidacion"=>date("Y-m-d H:m:s")));
                $this->load->library("email");
                $config['protocol'] = 'sendmail';
                    $config['mailpath'] = '/usr/sbin/sendmail';
                    $config['charset'] = 'iso-8859-1';
                    $config['wordwrap'] = TRUE;
                    $config['mailtype']='html';

                    $this->email->initialize($config);
                $this->email->from("info@nutramarket.cl","informaciones");
                $this->email->to($this->input->post("txtCorreo"));
                $this->email->subject('Confirmacion de Registro');
                $base_url=str_replace("admin/","",base_url());
                $mensaje="<html><head></head<body>"
                        . "para poder ingresar al sistio, debe ir a esta direccion <a href='".$base_url."validacion/$id_vendedor'>AQUI</a>"
                        . "</body></html>";
                $this->email->message($mensaje);	
                $this->email->send();
                $detalle['estado_mail']=$this->email->print_debugger();
                
            }
            $this->load->view("template/header", $this->data);
            $this->load->view("vendedores/modificar",$detalle);
            $this->load->view("template/footer", $this->data);
            //redirect("listado_vendedores");
        }
    }
    
}
