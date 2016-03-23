<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of carrito
 *
 * @author John
 */
class Carrito extends My_Controller {
    //put your code here
    public  function __construct() {
        parent::__construct();
    }
    public function agregar_carrito($id_producto){
    
        $this->load->model("productos_model");
        $productos=$this->productos_model->get_listado_productos("*",$id_producto);
        $cantidad=$this->input->post("txtCantidad");
        foreach ($this->cart->contents() as $items){
            if($items['idProducto']==$productos['idproductos']){
                if(($productos['StockProducto']-$productos['ReservaProducto'])>=($cantidad+$items['qty'])){
                    $cantidad+=$items['qty'];
                }else{
                    $cantidad=($productos['StockProducto']-$productos['ReservaProducto']);
                }
            }
        }
        
        $array=array(
            "idProducto"=>$productos['idproductos'],
            "id"=>$productos['CodigoProducto'],
            "qty"=>$cantidad,
            "price"=>$productos['PrecioventaProducto'],
            "name"=>$productos['DescripcionProducto'],
            "catalogo"=>$productos['CodigocatalogoProducto'],
            "comision"=>$productos['ComisionProducto'],
            "total"=>($productos['StockProducto']-$productos['ReservaProducto'])
        );
        $this->cart->insert($array);
        redirect($this->input->post("url"));
    }
    public function listado(){
            $this->data['scripts']="
        <script>
            function validar(cantidad,texto){
                
                if(cantidad<texto.value){
                    alert('La cantidad excede el sotck');
                    texto.value=cantidad;
                    return false;
                }
                return true;
            }
        </script>";
        $this->load->view("template/header");
        $this->load->view("clientes/carrito");
        $this->load->view("template/footer",$this->data);
    }
    public function eliminar($producto){
        $data = array(
               'rowid' => $producto,
               'qty'   => 0
            );
        $this->cart->update($data);
        redirect(base_url()."carrito");
    }
}
