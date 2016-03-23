<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of productos
 *
 * @author John
 */
class sec_productos extends My_Controller{
    //put your code here

    public function __construct() {
        parent::__construct(TRUE);
        $this->data['titulo']="";
        
    }
    public function listar(){
        $this->load->model("productos_model");
        
        $this->data['titulo']="Productos - Listado";
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-productos').DataTable({
                responsive: true
        });
    });
</script>";
        $detalle['listado']=$this->productos_model->get_listado_productos("*",NULL,array("EstadoProducto"=>1));
        $this->load->view("template/header",$this->data);
        $this->load->view("mantenedores/productos/listado",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function crear(){

        $this->load->library('form_validation');
 
        $this->form_validation->set_rules('txtCodigo','C&oacute;digo','required');
        $this->form_validation->set_rules('txtCodigoCatalogo','C&oacute;digo Catalogo','required');
        $this->form_validation->set_rules('txtDescripcion','Descripci&oacute;n','required');
        $this->form_validation->set_rules('txtCosto','Costo','required');
        $this->form_validation->set_rules('txtPrecioCatalogo','Precio Catalogo','required');
        $detalle='';
        
        //$this->form_validation->set_rules('cboTipoEmpresa','Tipo Empresa','required');
        if($this->form_validation->run()===FALSE){
                $this->data['titulo']="Usuario - Agregar";
                //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
                
                $this->load->view("template/header",$this->data);
                $this->load->view("mantenedores/productos/agregar",$detalle);
                $this->load->view("template/footer",$this->data);
        }else{
            $this->load->model("productos_model");
            $campos=array("CodigoProducto"=>$this->input->post("txtCodigo"),
                "CodigocatalogoProducto"=> $this->input->post("txtCodigoCatalogo"),
                "DescripcionProducto"=>$this->input->post("txtDescripcion"),
                "PreciocompraProducto"=>$this->input->post("txtCosto"),
                "PrecioventaProducto"=>$this->input->post("txtPrecioCatalogo"));
            
          
            if($this->productos_model->crear($campos)){
                
                redirect('listado_productos');
            }else{
                $this->data['titulo']="Usuario - Agregar";
                //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
                
                $this->load->view("template/header",$this->data);
                $this->load->view("mantenedores/productos/agregar",$detalle);
                $this->load->view("template/footer",$this->data);
            }
          
        }
    }
    public function modificar($id_producto){
        
        $this->load->library('form_validation');
        $this->load->model("productos_model");
        $detalle['id_producto']=$id_producto;
        $this->form_validation->set_rules('txtCodigo','C&oacute;digo','required');
        $this->form_validation->set_rules('txtCodigoCatalogo','C&oacute;digo Catalogo','required');
        $this->form_validation->set_rules('txtDescripcion','Descripci&oacute;n','required');
        $this->form_validation->set_rules('txtCosto','Costo','required');
        $this->form_validation->set_rules('txtPrecioCatalogo','Precio Catalogo','required');
         if($this->form_validation->run()===FALSE){
            $this->load->model("productos_model");
            $detalle['producto']=$this->productos_model->get_listado_productos("*",$id_producto);
            $this->data['titulo']="Usuario - Modificar";
            //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();

            $this->load->view("template/header",$this->data);
            $this->load->view("mantenedores/productos/modificar",$detalle);
            $this->load->view("template/footer",$this->data);
        }else{
           
            $campos=array("CodigoProducto"=>$this->input->post("txtCodigo"),
                "CodigocatalogoProducto"=> $this->input->post("txtCodigoCatalogo"),
                "DescripcionProducto"=>$this->input->post("txtDescripcion"),
                "PreciocompraProducto"=>$this->input->post("txtCosto"),
                "PrecioventaProducto"=>$this->input->post("txtPrecioCatalogo"));
            
          
            if($this->productos_model->modificar($id_producto,$campos)){
                redirect('listado_productos');
            }else{
                $this->load->model("productos_model");
                $detalle['producto']=$this->productos_model->get_listado_productos("*",$id_producto);
                $this->data['titulo']="Usuario - Modificar";
                //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
            
                $this->load->view("template/header",$this->data);
                $this->load->view("mantenedores/productos/modificar",$detalle);
                $this->load->view("template/footer",$this->data);
            }
        }
    }
    public function eliminar($id_producto){
        $this->load->model("productos_model");
        $this->productos_model->eliminar($id_producto);
        redirect('listado_productos');
    }
}
