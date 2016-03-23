<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sec_empresa
 *
 * @author John
 */
class Sec_empresa extends My_Controller {
    //put your code here
    public function __construct(){
        parent::__construct(TRUE);
        
     
    }
    public function addempresa(){
        /*$this->data['titulo']="Empresa - Agregar";
        $detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
        $detalle['ciudad']=$this->common_model->get_ciudad();
        $detalle['comuna']=$this->common_model->get_comuna();
        $detalle['region']=$this->common_model->get_region();
        $this->load->view("template/header",$this->data);
        $this->load->view("mantenedores/empresa/agregar",$detalle);
        $this->load->view("template/footer",$this->data);*/
        $detalle['dato']="";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtRutEmpresa','Rut Empresa','required|callback_valida_rut');
        $this->form_validation->set_rules('txtNombreEmpresa','Nombre Empresa','required');
        //$this->form_validation->set_rules('txtRazonSocial','Razon Social','required|max_length[250]');
        /*$this->form_validation->set_rules('txtTelefono','Telefono','max_length[50]');
        $this->form_validation->set_rules('txtDireccion','Razon Social','max_length[250]');
        //$this->form_validation->set_rules('cboTipoEmpresa','Tipo Empresa','required');*/
        if($this->form_validation->run()===FALSE){
                $this->data['titulo']="Empresa - Agregar";
                //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
               /*$detalle['ciudad']=$this->common_model->get_ciudad();
                $detalle['comuna']=$this->common_model->get_comuna();
                $detalle['region']=$this->common_model->get_region();*/
                $this->load->view("template/header",$this->data);
                $this->load->view("mantenedores/empresa/agregar",$detalle);
                $this->load->view("template/footer",$this->data);
        }else{
                $this->empresas_model->add_empresa();
                redirect('listado_empresas');
        }
    }
    public function modificar_empresa($rutempresa){
        $this->load->library('form_validation');
        /*$empresa=$this->empresas_model->get_empresa($rutempresa);
        $comuna_array=$this->common_model->get_comuna(0,$empresa['IdComuna']);
        
        $ciudad_array=$this->common_model->get_ciudad(0,$comuna_array[0]['IdCiudad']);
        $detalle['region']=$this->common_model->get_region($ciudad_array[0]['IdRegion']);
        $detalle['ciudad']=$ciudad_array;
        $detalle['comuna']=$comuna_array;
        $detalle['IdRegion']=$ciudad_array[0]['IdRegion'];*/
        
        $this->form_validation->set_rules('txtNombreEmpresa','Nombre Empresa','required');
        $this->form_validation->set_rules('txtRazonSocial','Razon Social','required|max_length[250]');
          //$this->form_validation->set_rules('cboTipoEmpresa','Tipo Empresa','required');
        if($this->form_validation->run()===FALSE){
            
                $this->data['titulo']="Proveedor - Modificar";
                $detalle['detalle']=$this->empresas_model->get_empresa($rutempresa);
                //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
                $this->load->view("template/header",$this->data);
                $this->load->view("mantenedores/empresa/modificar",$detalle);
                $this->load->view("template/footer",$this->data);
        }else{
                $this->empresas_model->modificar_empresa();
                redirect('listado_empresas');
        }

    }
    public function listado_empresas(){
        $this->data['titulo']="Empresas - Listado";
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#table-proveedor').DataTable({
                responsive: true
        });
    });
</script>";
        $detalle['listado']=$this->empresas_model->listado_empresas($this->session->userdata('idMaestra'));
        $this->load->view("template/header",$this->data);
        $this->load->view("mantenedores/empresa/listado",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function detalle_empresa($rutempresa){
        $empresa=$this->empresas_model->get_empresa($rutempresa);
        $comuna_array=$this->common_model->get_comuna(0,$empresa['IdComuna']);
       
        $ciudad_array=$this->common_model->get_ciudad(0,$comuna_array[0]['IdCiudad']);
        $detalle['region']=$this->common_model->get_region($ciudad_array[0]['IdRegion']);
        $detalle['ciudad']=$ciudad_array;
        $detalle['comuna']=$comuna_array;
        $detalle['IdRegion']=$ciudad_array[0]['IdRegion'];
 
        $this->data['titulo']="Empresas - Modificar";
        $detalle['detalle']=$this->empresas_model->get_empresa($rutempresa);
        //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
        $this->load->view("template/header",$this->data);
        $this->load->view("mantenedores/empresa/detalle",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function valida_rut($rut){
        echo $this->empresas_model->get_empresa($rut);
        if($this->empresas_model->get_empresa($rut)!=FALSE){
            
            
            $this->form_validation->set_message('valida_rut','El Rut ya existe en el sistema');
            
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
