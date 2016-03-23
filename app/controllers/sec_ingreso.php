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
        $this->load->model("compras_model");
        
        $this->data['titulo']="Compras - Listado";
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-compras').DataTable({
                responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
    });
</script>";
        $detalle['listado']=$this->compras_model->get_listado_compra("*",NULL,array("c.idEstadoCompra !="=>3));
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
            if($id_factura>0){
                $this->load->model("compras_model");
                $detalle['compra']=$this->compras_model->get_listado_compra("*",$id_factura);
                if($detalle['compra'] === false){
                    redirect('listado_compras');
                }else{
                    $this->load->view("template/header",$this->data);
                    $this->load->view("documentos/compras/mod_factura",$detalle);
                    $this->load->view("template/footer",$this->data);
                }

            }else{
                $this->load->view("template/header",$this->data);
                $this->load->view("documentos/compras/ing_factura");
                $this->load->view("template/footer",$this->data);
            }
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
                "FecharegistroCompra"=>$this->input->post("txtFecha"),
                "NumeroCompra"=>$this->input->post("txtNumero"),
                "Monto"=>$this->input->post("txtMonto")
                );
            $id_compra=$this->compras_model->crear($campos);
            //$compra=$this->compras_model->get_ult_compra();
            redirect('ingresar_producto/'.$id_compra);
        }
        
        
    }
    public function producto($id_compra,$id_producto=NULL){
        $this->data['titulo']="Compras - Listado";
        $this->load->model("compras_model");
        $this->load->library("cart");
        $detalle['id_compra']=$id_compra;
        
        if($this->input->post()){
            $campos_compra=array(
              "NumeroCompra"=>$this->input->post("txtNumero") ,
                "FecharegistroCompra"=>$this->input->post("txtFecha"),
                "Monto"=>$this->input->post("txtMonto")
            );

            $this->compras_model->modificar_compra($id_compra,$campos_compra);
        }
        $str_campos="p.idproductos,"
                . "CodigoProducto as id,"
                . "CantidadDetallecompra as qty, "
                . "DescripcionProducto as name, "
                . "PreciocompraProducto as price,"
                . "PrecioventaProducto as catalogo,"
                . "IvaProducto as iva,"
                . "NetoProducto as neto,"
                . "ComisionProducto as comision,"
                . "RetencionProducto as retencion,"
                . "ApagarProducto as apagar,"
                . "GananciaProducto as ganancia,"
                . "UtilidadProducto as utilidad";
        $productos=$this->compras_model->get_listado_productos($id_compra,$str_campos);
        $detalle['compra']=$this->compras_model->get_listado_compra("*",$id_compra);
          
        if($productos!=false){
            $this->cart->destroy();
            $this->cart->insert($productos);
        }
        
      
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/compras/ing_producto",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function agregar_detalle($id_compra){
        $this->load->library("cart");
        $this->load->model("compras_model");
        
      
        if($this->input->post("txtCodigo")){
            $this->load->model("productos_model");
            $str_campos="p.idproductos,"
            . "CodigoProducto as id,"
            . "CodigoProducto as qty,"
            . "DescripcionProducto as name, "
            . "PreciocompraProducto as price,"
            . "PrecioventaProducto as catalogo,"
            . "IvaProducto as iva,"
            . "NetoProducto as neto,"
            . "ComisionProducto as comision,"
            . "RetencionProducto as retencion,"
            . "ApagarProducto as apagar,"
            . "GananciaProducto as ganancia,"
            . "UtilidadProducto as utilidad";
            $productos=$this->productos_model->get_listado_productos($str_campos,NULL,array("CodigoProducto"=>$this->input->post("txtCodigo")));
            
           
            if($productos!=false){
               // echo "el producto existe, se carga en cart";
                //echo $this->input->post('txtCantidad');
                $productos[0]['qty']=$this->input->post('txtCantidad');
                //print_r($productos);
                $this->cart->insert($productos);
               
            }else{
                //echo "paso a creacion de producto ";
                $campos=array("CodigoProducto"=>$this->input->post("txtCodigo"),
                "CodigocatalogoProducto"=> $this->input->post("txtCodigoCatalogo"),
                "DescripcionProducto"=>$this->input->post("txtDescripcion"),
                "PreciocompraProducto"=>$this->input->post("txtCosto"),
                "PrecioventaProducto"=>$this->input->post("txtPrecioCatalogo"));
            
                if($this->productos_model->crear($campos)){
                    $productos=$this->productos_model->get_listado_productos($str_campos,NULL,array("CodigoProducto"=>$this->input->post("txtCodigo")));
                    if($productos!=false){
                        $productos[0]['qty']=$this->input->post('txtCantidad');
                        $this->cart->insert($productos);
                        
                        
                    }
                }
            }
            
        }
        $detalle['compra']=$this->compras_model->get_listado_compra("*",$id_compra);
        $this->data['titulo']="Compras - Listado";
        $detalle['id_compra']=$id_compra;
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/compras/ing_producto",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    function eliminar_detalle($key_cart,$id_compra){
        $data=array(
            'rowid'=>$key_cart,
            'qty'=>0
        );
        
        $this->load->library("cart");
        $this->cart->update($data);
        $this->load->model("compras_model");
        $detalle['compra']=$this->compras_model->get_listado_compra("*",$id_compra);
        $this->data['titulo']="Compras - Listado";
        $detalle['id_compra']=$id_compra;
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/compras/ing_producto",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function finaliza($id_compra){
        $this->load->model("compras_model");
        $this->compras_model->eliminar_detalle(null,array("IdCompra"=>$id_compra));
        
        $this->load->library("cart");
         foreach($this->cart->contents() as $items){
             $campos=array(
                 "IdCompra"=>$id_compra,
                 "idproductos"=>$items["idproductos"],
                 "CantidadDetallecompra"=>$items["qty"],
                 "PrecioDetallecompra"=>$items["price"]
             );
             $this->compras_model->insertar_detalle($campos);
         }
        $detalle['listado']=$this->compras_model->get_listado_productos($id_compra,"*",null);
        $detalle['compra']=$this->compras_model->get_listado_compra("*",$id_compra);
        $this->data['titulo']="Compras - Listado";
        $detalle['id_compra']=$id_compra;
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/compras/ing_finalizar",$detalle);
        $this->load->view("template/footer",$this->data);
        
        
    }
    public function terminar_proceso($id_compra){
        $this->load->model("compras_model");
        $this->load->model("productos_model");
        $this->load->library("cart");
         $campos="p.idproductos,CantidadDetallecompra";
         $productos=$this->compras_model->get_listado_productos($id_compra,$campos);
         foreach($productos as $items){
            
             $stock=$this->productos_model->get_listado_productos("StockProducto",$items["idproductos"]);
             $this->productos_model->modificar($items['idproductos'],array("StockProducto"=>$items['CantidadDetallecompra']+$stock['StockProducto']),false);
             
         }
         $campos=array(
            "idEstadoCompra"=>2
        );
        $this->compras_model->modificar_compra($id_compra,$campos);
        $this->cart->destroy();
        redirect("listado_compras");
    }
    public function detalle($id_compra){
        $this->load->model("compras_model");
        $detalle['listado']=$this->compras_model->get_listado_productos($id_compra,"*",null);
        $detalle['compra']=$this->compras_model->get_listado_compra("*",$id_compra);
        $this->data['titulo']="Compras - Listado";
        $detalle['id_compra']=$id_compra;
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/compras/detalle",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function eliminar_compra($id_compra){
        $this->load->model("compras_model");
        $this->load->model("productos_model");
        $campos="p.idproductos,CantidadDetallecompra";
        $productos=$this->compras_model->get_listado_productos($id_compra,$campos,null,array("idEstadoCompra"=>2));
        if(is_array($productos)){
            foreach($productos as $items){
                $stock=$this->productos_model->get_listado_productos("StockProducto",$items["idproductos"]);
                $this->productos_model->modificar($items['idproductos'],array("StockProducto"=>$stock['StockProducto']-$items['CantidadDetallecompra']),false);

             }
        }
         $campos=array(
            "idEstadoCompra"=>3
        );
         $this->compras_model->modificar_compra($id_compra,$campos);
         redirect("listado_compras");
    }
}
