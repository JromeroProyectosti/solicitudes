<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sec_usuario
 *
 * @author John
 */
class sec_usuario extends My_Controller{
    //put your code here
    public function __construct(){
        parent::__construct(TRUE);
        $this->data['titulo']="";
    }
    public function listar($filtro=""){
        $this->data['titulo']="Usuarios - Listado";
        //$this->data['scripts']="";
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#dataTables-usuario').DataTable({
                responsive: true
        });
    });
</script>";
        $detalle['listado']=$this->usuarios_model->listado_usuarios($this->session->userdata('idMaestra'),$filtro);
        $this->load->view("template/header",$this->data);
        $this->load->view("mantenedores/usuario/listado",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function crear(){
        
        /*$this->data['titulo']="Empresa - Agregar";
        //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
        
        $detalle['comuna']=$this->common_model->get_comuna();
        $detalle['region']=$this->common_model->get_region();
        $this->load->view("template/header",$this->data);
        $this->load->view("mantenedores/empresa/agregar",$detalle);
        $this->load->view("template/footer",$this->data);*/
        $detalle['estado']=$this->common_model->get_estado_usuario();
        $detalle['tipo']=$this->common_model->get_tipo_usuario();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtRutUsuario','Rut','required|callback_valida_rut');
        $this->form_validation->set_rules('txtNombreUsuario','Nombre','required');
        $this->form_validation->set_rules('txtCorreo','Correo','required|valid_email');
        $this->form_validation->set_rules('txtUsuario','Usuario','required|max_length[250]');
        $this->form_validation->set_rules('txtPassword','Password','required');
        
        //$this->form_validation->set_rules('cboTipoEmpresa','Tipo Empresa','required');
        if($this->form_validation->run()===FALSE){
                $this->data['titulo']="Usuario - Agregar";
                //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
                
                $this->load->view("template/header",$this->data);
                $this->load->view("mantenedores/usuario/agregar",$detalle);
                $this->load->view("template/footer",$this->data);
        }else{
                $this->usuarios_model->add_usuario();
                redirect('permiso_usuario/'.$this->input->post("txtRutUsuario"));
        }
   
    }
   
    public function modificar($rut){
       $detalle['estado']=$this->common_model->get_estado_usuario();
        $detalle['tipo']=$this->common_model->get_tipo_usuario();
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('txtRutUsuario','Rut','required|callback_valida_rut');
        $this->form_validation->set_rules('txtNombreUsuario','Nombre','required');
        $this->form_validation->set_rules('txtCorreo','Correo','required|valid_email');
        $this->form_validation->set_rules('txtUsuario','Usuario','required|max_length[250]');

        
        //$this->form_validation->set_rules('cboTipoEmpresa','Tipo Empresa','required');
        if($this->form_validation->run()===FALSE){
                               
        }else{
            $this->usuarios_model->mod_usuario($rut);
            redirect('listado_usuarios');
        } 
        $detalle['estado']=$this->common_model->get_estado_usuario();
        $detalle['tipo']=$this->common_model->get_tipo_usuario();
        
        $detalle['usuario']=$this->usuarios_model->get_usuario($rut);
       
        $this->data['titulo']="Usuario - Modificar";
        $this->load->view("template/header",$this->data);
        $this->load->view("mantenedores/usuario/modificar",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    
    public function permiso($rut){
        
        if($this->input->post('checkpermisos')){
            $this->usuarios_model->del_permisos($rut);
            $this->usuarios_model->set_permisos($rut); 
        }
        $this->data['titulo']="Usuario - Permisos";
        $this->load->helper("permisos");
        $detalle['permisos']=$this->usuarios_model->get_permisos($rut);
        $detalle['rut']=$rut;
        $this->load->view("template/header",$this->data);
        $this->load->view("mantenedores/usuario/permisos",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    
    public function valida_rut($rut){
        //echo $this->usuarios_model->get_usuario($rut);
        if($this->usuarios_model->get_usuario($rut)!=FALSE){
            
            
            $this->form_validation->set_message('valida_rut','El Rut ya existe en el sistema, verifica si esta Deshabilitado');
            
            return FALSE;
        }
        else {
            $this->load->library("comun");
            if($this->comun->valida_rut($rut)){
                return TRUE;
            }else{
                $this->form_validation->set_message('valida_rut','El Rut Tiene un formato erroneo');
            
                return FALSE;
           
            }
        }
    }
    
}
