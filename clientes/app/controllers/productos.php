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
class productos extends My_Controller{
    //put your code here

    public function __construct() {
        parent::__construct();
        $this->data['titulo']="";
        
    }
    public function listar($id_categoria=0){
        $this->load->model("productos_model");
        
        $this->data['titulo']="Productos - Listado";
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-productos').DataTable({
                responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
    });
    
    function validar(cantidad,form){
        
        if(cantidad<form.txtCantidad.value){
            alert('La cantidad excede el sotck');
            form.txtCantidad.value=cantidad;
            return false;
        }
        return true;
    }
</script>";
        $filtro=array("EstadoProducto"=>1);
        if($id_categoria>0){
            $filtro=array("EstadoProducto"=>1,
                "c.idCategoria"=>$id_categoria);
        }
        $detalle['listado']=$this->productos_model->get_listado_productos("*",NULL,$filtro);
        $this->load->view("template/header",$this->data);
        $this->load->view("clientes/listado",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    
}
