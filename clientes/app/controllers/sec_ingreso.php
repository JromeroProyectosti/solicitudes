<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sec_ingreso
 *
 * @author jonathan
 */
class sec_ingreso extends My_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function listar(){
        $this->load->model("productos_model");
        
        $this->data['titulo']="Compras - Listado";
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-compras').DataTable({
                responsive: true
        });
    });
</script>";
        $detalle['listado']=$this->productos_model->get_listado_productos("*",NULL,array("EstadoProducto"=>1));
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/compras/listado",$detalle);
        $this->load->view("template/footer",$this->data);
    
    }
    public function factura($id_factura=0){
        
        $detalle['estado']=$this->common_model->get_estado_usuario();
        $detalle['tipo']=$this->common_model->get_tipo_usuario();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtRutEmpresa','Rut','required');
        $this->form_validation->set_rules('txtNombreEmpresa','Nombre','required');
        $this->form_validation->set_rules('txtNumero','N&deg; Factura','required');
        $this->form_validation->set_rules('txtMonto','Monto','required');
        if($this->form_validation->run()===FALSE){
            $this->data['titulo']="Compras - Ingreso factura";
            $this->load->view("template/header",$this->data);
            $this->load->view("documentos/compras/ing_factura");
            $this->load->view("template/footer",$this->data);
        }else{
            $empresa=$this->empresas_model->get_empresa($this->input->post("txtRutEmpresa"));
            if($empresa==false){
                $this->empresas_model->add_empresa();
                $empresa=$this->empresas_model->get_empresa($this->input->post("txtRutEmpresa"));
            }
            $this->load->model("compras_model");
            $campos=array("idProveedor"=>$empresa['idProveedor'],
                            "idUsuario"=>$this->session->userdata("id_usuario"),
                            "idEstadoCompra"=>1,
                "fecharegistroCompra"=>$this->input->post("txtFecha"),
                "NumeroCOmpra"=>$this->input->post("txtNumero"),
                "Monto"=>$this->input->post("txtMonto")
                );
            $id_compra=$this->compras_model->crear($campos);
            //$compra=$this->compras_model->get_ult_compra();
            redirect('ingresar_producto/'.$id_compra);
        }
        
    }
    public function producto($id_compra){
        $this->data['titulo']="Compras - Listado";
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/compras/ing_producto");
        $this->load->view("template/footer",$this->data);
    }
    public function compra(){
        
    }
    public function modificar(){
        
    }
    public function eliminar(){
        
    }
  
}
