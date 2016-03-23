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
class Cuentas extends MY_Controller{
    public function __construct() {
        parent::__construct(true);
         $this->data['scripts']="<script>
                $(document).ready(function() {
                    $('#datatable-cuentas').DataTable({
                            responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
                    });
                });
            </script>";
    }
    
    public function listar_todos($estado=0){
        $this->data['titulo']="Estado de Cuentas";
        $filtro=array();
        if($estado==1){
            $filtro=array(
                "c.idEstadocuenta"=>$estado
            );
        }
        $this->load->model("cuentas_model");
        $detalle['listado']=$this->cuentas_model->get_cuentas("*",$filtro);
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/cuentas/listado",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function listar_atrasados(){
        $this->data['titulo']="Estado de Cuentas";
        
        $filtro=array(
          "c.idEstadocuenta"=>4
            
           
        );
       
        $this->load->model("cuentas_model");
        $detalle['listado']=$this->cuentas_model->get_cuentas("*",$filtro);
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/cuentas/listado",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function detalle($id_cuenta){
        
        $this->data['titulo']="Ventas";
        
        $this->load->model("cuentas_model");
        $this->load->model("common_model");
        $detalle['cuenta']=$this->cuentas_model->get_cuenta($id_cuenta);
        
        $detalle['detalle']=$this->cuentas_model->get_detalle_cuenta($id_cuenta);
        $detalle['estado_cuenta']=$this->common_model->get_estado_cuenta();
         $this->load->view("template/header",$this->data);
        $this->load->view("documentos/cuentas/detalle",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function eliminar($id_cuenta){
        $this->load->model("cuentas_model");
        $this->load->model("solicitud_model");
        $detalle=$this->cuentas_model->get_detalle_cuenta($id_cuenta,"s.idSolicitud");
        if($detalle!=false){
            foreach($detalle as $solicitudes){
                
                $this->solicitud_model->modificar_solicitud($solicitudes['idSolicitud'],array("InformadoSolicitud"=>0));
                
            }
        }
        $this->cuentas_model->eliminar($id_cuenta);
        
        redirect("listado_cuentas");
    }
    public function generar_estados_cuentas(){
        $solicitud=$this->input->post("chkIdSolicitud");
        //print_r($solicitud);
        $fecha_actual=date("Y-m-d");
        $fecha_pago=date("Y-m-d");
        
        $this->load->model("solicitud_model");
        $this->load->model("cuentas_model");
        $filtro=array(
            "date( FechaingresoSolicitud ) <="=>$fecha_actual,
            "idEstadosolicitud"=>3,
            "InformadoSolicitud"=>0
        );
        $campos="idCliente, "
                
                . "sum( TotalapagarSolicitud ) as apagar"; 
       
        $solicitud_vendedor=$this->solicitud_model->agrupar_cuenta_vendedor($campos,null,array_values($solicitud));
        
        foreach($solicitud_vendedor as $item){
            $campos_cuenta=array(
                "idCliente"=>$item['idCliente'],
                "idEstadocuenta"=>1,
                "Fechaingresocuenta"=>$fecha_actual,
                "FechapagoCuenta"=>$fecha_pago,
                "TotalapagarCuenta"=>$item['apagar']  
            );
          
            
            $idCuenta=$this->cuentas_model->crear_cuenta($campos_cuenta);
        
//            $filtro=array(
//                "s.idCliente"=>$item['idCliente'],
//                "s.idEstadosolicitud"=>3,
//                "date(FechaingresoSolicitud) <="=>$fecha_actual
//             
//            );
            //$listado_solicitudes=$this->solicitud_model->get_listado("idSolicitud",null,$solicitud);

            //print_r($solicitudes);
            $this->cuentas_model->crear_detalle($idCuenta,array_values($solicitud));
            
            
            //Eliminar Reserva y descontar de Stock
            
            $this->load->model("productos_model");
            foreach($solicitud as $id_solicitud){
                $detalle_solicitud=$this->solicitud_model->get_detalle_solicitud($id_solicitud);

                /*foreach($detalle_solicitud as $item){
                    $producto=$this->productos_model->get_listado_productos("*",$item['idproductos']);
                    $stock=0;
                    $reserva=0;

//                    if(($producto['ReservaProducto']-$item["CantidadDetallesolicitud"])>0){
//                        $reserva=($producto['ReservaProducto']-$item["CantidadDetallesolicitud"]);
//                    }
//                    if(($producto['StockProducto']-$item["CantidadDetallesolicitud"])>0){
//                        $stock=($producto['StockProducto']-$item["CantidadDetallesolicitud"]);
//                    }
//                    $array_campos=array(
//                        "StockProducto"=>$stock,
//                        "ReservaProducto"=>$reserva
//                    );


                   $this->productos_model->modificar($item['idproductos'],null,false);
                }*/

                $this->solicitud_model->modificar_solicitud($id_solicitud,array(
                    "idEstadosolicitud"=>4
                    
                     ));
            }
            redirect(base_url()."detalle_venta/".$idCuenta);
        }
    }
    public function informe(){
        $this->data['titulo']="Estado de Cuentas";
        $this->data['scripts']="<script>
        $(document).ready(function() {
             $('#btnExportar').click(function(event) {
             $('#datos_a_enviar').val( $('<div>').append( $('#cuentas_table').eq(0).clone()).html());
             
            $('#FormularioExportacion').submit();
        });
        });
</script>";
        if($this->input->post()){
            $filtro=array(
                "FechaingresoCuenta >="=>$this->input->post("txtFechaInicio"),
                "FechaingresoCuenta <="=>$this->input->post("txtFechaFin"),
                "c.idEstadocuenta"=>1
            );
            
        }else{
             $filtro=array(
               
                "c.idEstadocuenta"=>1
            );
            
        }
        
        $this->load->model("cuentas_model");
        $detalle['listado']=$this->cuentas_model->get_cuentas("*",$filtro);
        $this->load->view("template/header",$this->data);
        $this->load->view("informes/cuentas",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function modificar_venta(){
        
        $this->load->model("cuentas_model");
        $this->load->model("solicitud_model");
        
        $estado_cuenta=$this->input->post("cboEstado");
        $fecha_pago=$this->input->post("txtFecha");
        $idCuenta=$this->input->post("hdCuenta");
        
        
         
        $solicitudes=$this->cuentas_model->get_detalle_cuenta($idCuenta,"d.idSolicitud");
        
        foreach($solicitudes as $values){
            $this->solicitud_model->modificar_solicitud($values['idSolicitud'],array("idEstadosolicitud"=>4));    
        }
        
        if($estado_cuenta==2){
            $campos=array(
                "idEstadocuenta"=>$estado_cuenta,
                "FechapagadoCuenta"=>date("Y-m-d")
            );
            $this->cuentas_model->modificar($idCuenta,$campos);
            $this->data='';
            $this->load->view("template/header",$this->data);
            $this->load->view("documentos/cuentas/susses");
            $this->load->view("template/footer",$this->data);
        }else{
            $campos=array(
            "idEstadocuenta"=>$estado_cuenta,
            "FechapagoCuenta"=>$fecha_pago
            );
            $this->cuentas_model->modificar($idCuenta,$campos);
            redirect(base_url()."detalle_venta/".$idCuenta);
        }
        
            
    }
}