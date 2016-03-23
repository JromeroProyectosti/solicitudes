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
class Cli_cliente extends MY_Controller{
    //put your code here
    public function __construct() {
        parent::__construct(true);
    }
    public function registro(){
        $this->load->view("template/header");
        $this->load->view("clientes/registro");
        $this->load->view("template/footer");
    }
    public function listar_todos(){
        $this->load->model("vendedor_model");
        $this->data['scripts']="<script type='text/javascript' class='init'>
    $(document).ready(function() {
        $('#table-listado').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ],
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
        
    });
     
</script>";
        switch($this->session->userdata('rol')){
            case "Vendedor":
                $detalle['listado']=$this->vendedor_model->get_vendedores("*",array(
                    "idVendedor"=>$this->session->userdata('id_usuario'),
                    "v.idEstadocliente"=>2
                    )
                );
                break;
            default:
                $detalle['listado']=$this->vendedor_model->get_vendedores("*",array(
                    "v.idEstadocliente"=>2
                    ));
                break;
        }
        
        $this->data['titulo']="Clientes - Listado";
        
        $this->load->view("template/header", $this->data);
        $this->load->view("clientes/listado",$detalle);
        $this->load->view("template/footer", $this->data);
    }
    public function listar_por_validar(){
        $this->load->model("vendedor_model");
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#table-listado').DataTable({
                responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
    });
</script>";
        $detalle['listado']=$this->vendedor_model->get_vendedores("*",array("v.idEstadocliente"=>3));
        $this->data['titulo']="clientes - Listado";
        
        $this->load->view("template/header", $this->data);
        $this->load->view("clientes/listado",$detalle);
        $this->load->view("template/footer", $this->data);
    }
    public function modificar($id_vendedor){
      
        $this->load->model("vendedor_model");
        $this->load->model("usuarios_model");
        $detalle['estado']=$this->common_model->get_estado_vendedor();
        $this->data['titulo']="Clientes - Modificar";
        $detalle['ciudad']=$this->common_model->get_ciudad();
        $detalle['comuna']=$this->common_model->get_comuna();
        $detalle['region']=$this->common_model->get_region();
        $detalle['vendedores']=$this->usuarios_model->listado_usuarios_tipo(0,3);
        
        $this->load->library('form_validation');
  
        $this->form_validation->set_rules('txtNombreCliente','Nombre','required');
        //$this->form_validation->set_rules('txtApellidoCliente','Apellido','required');
        //$this->form_validation->set_rules('txtRutCliente','Rut','required');
        $this->form_validation->set_rules('txtCorreo','Correo','required|valid_email');
        $this->form_validation->set_rules('txtTelefono','Telefono','required');
        $this->form_validation->set_rules('txtDireccion','Direccion','required');
        //$this->form_validation->set_rules('cboEstado','Estado','required');
        
        if($this->form_validation->run()===FALSE){
            
            $detalle['vendedor']=$this->vendedor_model->get_vendedor($id_vendedor);

            $this->load->view("template/header", $this->data);
            $this->load->view("clientes/modificar",$detalle);
            $this->load->view("template/footer", $this->data);
            
        }else{
            $campos=array(
               
                "NombreCliente"=>$this->input->post("txtNombreCliente"),
                "ApellidoCliente"=>$this->input->post("txtApellidoCliente"),
                "CorreoCliente"=>$this->input->post("txtCorreo"),
                "CorreoconfirmacionCliente"=>$this->input->post("txtCorreo"),
                "TelefonoCliente"=>$this->input->post("txtTelefono"),
                "ComunaCliente_text"=>$this->input->post("txtComuna"),
                "DireccionCliente"=>  nl2br($this->input->post("txtDireccion")),
                "IdVendedor"=>$this->input->post("cboVendedor"),
                "IdComuna"=>$this->input->post("cboComuna"),
                "IdCiudad"=>$this->input->post("cboCiudad"),
                "IdRegion"=>$this->input->post("cboRegion"),
                "ObservacionesCliente"=>$this->input->post("txtObservacion")
            );
            $this->vendedor_model->modificar($id_vendedor,$campos);
            /*$detalle['vendedor']=$this->vendedor_model->get_vendedor($id_vendedor);
            $this->vendedor_model->modificar($id_vendedor,array("FechasolicitudValidacion"=>date("Y-m-d H:m:s"),
                "idEstadocliente"=>$this->input->post("cboEstado1")));
            
            if($this->input->post("cboEstado1")==2){
                if($this->input->post("cboEstado1")!=$detalle['vendedor']['idEstadocliente']){
                    

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
                    $mensaje="<html><head></head><body>"
                            . "<font size='4' face='verendana' color='green'>Para poder utilizar su sistema, debe generar su password <strong><a href='".$base_url."validacion/$id_vendedor'>AQUI</a></strong></font><br>"
                            . "<img src='".$base_url."img/bienvenido.jpg' /><br>"
                            . "</body></html>";
                    $mensaje2="Para poder utilizar su sistema, debe generar su password <a href='".$base_url."validacion/$id_vendedor'>AQUI</a>";
                      
                    $this->email->message($mensaje);
                    $this->email->set_alt_message($mensaje2);
                    if($this->email->send()){
                     $detalle['estado_mail']="Correo enviado Satisfactoriamente";
                    }else{
                        $detalle['estado_mail']="Hubo un error en el envio, verifique el correo sea valido";
                    }


                }
               
                //redirect("listado_vendedores");
            } */
            $detalle['vendedor']=$this->vendedor_model->get_vendedor($id_vendedor);
            $this->load->view("template/header", $this->data);
            $this->load->view("clientes/modificar",$detalle);
            $this->load->view("template/footer", $this->data);
        }
    }
    public function crear(){
      
        $this->load->model("vendedor_model");
        $this->load->model("usuarios_model");
        
        //$detalle['estado']=$this->common_model->get_estado_vendedor();
        $this->data['titulo']="Clientes - Modificar";
        $detalle['ciudad']=$this->common_model->get_ciudad();
        $detalle['comuna']=$this->common_model->get_comuna();
        $detalle['region']=$this->common_model->get_region();
        $detalle['vendedores']=$this->usuarios_model->listado_usuarios_tipo(0,3);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtRutCliente','Rut','required|callback_valida_rut');
        $this->form_validation->set_rules('txtNombreCliente','Nombre','required');
        $this->form_validation->set_rules('txtApellidoCliente','Apellido','required');
        $this->form_validation->set_rules('txtCorreo','Correo','required|valid_email');
        $this->form_validation->set_rules('txtTelefono','Telefono','required');
        $this->form_validation->set_rules('cboRegion','Region','callback_valida_combo');
        $this->form_validation->set_rules('cboCiudad','Ciudad','callback_valida_combo');
        $this->form_validation->set_rules('cboComuna','Comuna','callback_valida_combo');
        $this->form_validation->set_rules('cboVendedor','Vendedor','callback_valida_combo');
        $this->form_validation->set_rules('txtDireccion','Direccion','required');
        
        $this->form_validation->set_message('valida_combo','Campo Requerido');
        
        if($this->form_validation->run()===FALSE){
            
            $this->load->view("template/header", $this->data);
            $this->load->view("clientes/agregar",$detalle);
            $this->load->view("template/footer", $this->data);
            
        }else{

            $campos=array(
            "IdEstadocliente"=>2,
            "IdVendedor"=>$this->input->post("cboVendedor"),
            "RutCliente"=>$this->input->post("txtRutCliente"),
            "NombreCliente"=>$this->input->post("txtNombreCliente"),
            "ApellidoCliente"=>$this->input->post("txtApellidoCliente"),
            "CorreoCliente"=>$this->input->post("txtCorreo"),
            "CorreoconfirmacionCliente"=>$this->input->post("txtCorreo"),
            "DireccionCliente"=>$this->input->post("txtDireccion"),
            "IdComuna"=>$this->input->post("cboComuna"),
            "IdCiudad"=>$this->input->post("cboCiudad"),
            "IdRegion"=>$this->input->post("cboRegion"),
            "TelefonoCliente"=>$this->input->post("txtTelefono"),
            "FecharegistroCliente"=>date("Y-m-d h:m:s"),
            "FechasolicitudValidacion"=>date("Y-m-d h:m:s"),
            "ObservacionesCliente"=>$this->input->post("txtObservacion")
            );
            $vendedor=$this->vendedor_model->ingresar_registro($campos);
           
            redirect(base_url()."modificar_cliente/".$vendedor);
        }
    }
    public function eliminar($id_vendedor){
        
        $this->load->model("vendedor_model");
        
        $this->vendedor_model->modificar($id_vendedor,array('idEstadocliente'=>3));
        
        redirect("listado_clientes");
    }
    public function valida_rut($rut){

        $this->load->model('vendedor_model');
        if($this->vendedor_model->get_vendedor($rut)!=FALSE){
            $this->form_validation->set_message('valida_rut','El Rut ya existe en el sistema');
            return FALSE;
        }else{
            $this->load->library("comun");
            if($this->comun->valida_rut($rut)){
                return TRUE;
            }else{
                $this->form_validation->set_message('valida_rut','El Rut Tiene un formato erroneo');
                return FALSE;
            }
        }
    }
    public function valida_combo($value){
        return $value=='0'?FALSE:TRUE;
    }
}
