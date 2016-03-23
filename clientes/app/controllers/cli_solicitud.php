<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */



/**

 * Description of cli_solicitud

 *

 * @author John

 */

class Cli_solicitud extends My_Controller{

    //put your code here

    public function __construct() {

        parent::__construct();

        $this->data['scripts']="<script>

    $(document).ready(function() {

        $('#datatable-solicitudes').DataTable({

                responsive: true,

                dom: 'Bfrtip',

                buttons: [

                    'copy', 'csv', 'excel', 'pdf', 'print'

                ]

                'language':{

                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'

                }

        });

    });

    

    

  

</script>

";

    }



    public function solicitudes($id_estado=0){

        $this->data['titulo']="Solicitudes";

        $filtro=null;

        if($id_estado>0){

            $filtro=array(

                "e.idEstadosolicitud"=>$id_estado,

                "v.idCliente"=>$this->session->userdata("id_cliente")

            );

        }else{

             $filtro=array(

                "v.idCliente"=>$this->session->userdata("id_cliente")

            );

        }

        $this->load->model("solicitud_model");

        $detalle['listado']=$this->solicitud_model->get_listado("*",$filtro);

        $this->load->view("template/header",$this->data);

        $this->load->view("solicitudes/listado",$detalle);

        $this->load->view("template/footer",$this->data);

    }

    

    public function solicitudes_abiertas(){

        $this->solicitudes(1);

    }

    public function solicitudes_reservada(){

        $this->solicitudes(2);

    }

    public function solicitudes_despachada(){

        $this->solicitudes(3);

    }

    public function solicitudes_pagada(){

        $this->solicitudes(4);

    }

    public function solicitudes_anulada(){

        $this->solicitudes(5);

    }

    public function ingresar_solicitud(){

        $this->load->model("solicitud_model");

       

        //print_r($this->input->post("txtCantidad"));

        $id_producto=$this->input->post("hdIdProducto");

        $cantidad=$this->input->post("txtCantidad");
        
        $precio=$this->input->post("txtPrecio");
        

        $campos=array(

            "idCliente"=>$this->session->userdata("id_cliente"),

            "idEstadosolicitud"=>2,

            "FechaingresoSolicitud"=>date("Y-m-d h:m:s")

        );

        $contador_prod=count($id_producto);

        

        if($contador_prod>0){

            $total_ganancia=0;

            $total_retencion=0;

            $total_apagar=0;

            $id_solicitud=$this->solicitud_model->crear_solicitud($campos);

            $this->load->model("productos_model");

            for($i=0;$i<$contador_prod;$i++){

                //echo $i;

                //echo $id_producto[$i];

                $detalle_productos=$this->productos_model->get_listado_productos("*",$id_producto[$i]);

                //print_r($detalle_productos);

                $detalle=array(

                    "idproductos"=>$id_producto[$i],

                    "CantidadDetallesolicitud"=>$cantidad[$i],

                    "PreciocatalogoDetallesolicitud"=>$precio[$i]
                );

                $this->solicitud_model->ingresar_detalle($id_solicitud,$detalle);

               $total_apagar+=$cantidad[$i]*$precio[$i];



                $array_campos=array(

                    "ReservaProducto"=>($detalle_productos['ReservaProducto']+$cantidad[$i])

                );

                $this->productos_model->modificar($id_producto[$i],$array_campos,false);

            }
           $campos=array(
                "TotalapagarSolicitud"=>$total_apagar

            );
            $this->solicitud_model->modificar_solicitud($id_solicitud,$campos);
            $this->cart->destroy();
            $this->load->view("template/header");
            $this->load->view("clientes/enviado");
            $this->load->view("template/footer");
        }

    }

    public function detalle($id_solicitud){

        $this->load->model("solicitud_model");
        $this->load->model("common_model");
        $this->solicitud_model->modificar_solicitud($id_solicitud,array("VistoSolicitud"=>1));
        $this->data['scripts']="";

        if($this->input->post("cboEstado")){

            $this->solicitud_model->modificar_solicitud($id_solicitud,array("idEstadosolicitud"=>$this->input->post("cboEstado")));

            

            redirect("solicitudes_abiertas");

            

        }

  

        $detalle['estado']=$this->common_model->get_estado_solicitud();

        $detalle['solicitud']=$this->solicitud_model->get_solicitud($id_solicitud);

        $detalle['detalle']=$this->solicitud_model->get_detalle_solicitud($id_solicitud);

         $detalle['formaenvio']=$this->common_model->get_forma_envio();

        

        $this->load->view("template/header",$this->data);

        $this->load->view("solicitudes/detalle",$detalle);

        $this->load->view("template/footer",$this->data);

    }

    public function eliminar($id_solicitud){

        $this->load->model("solicitud_model");

        $status=$this->solicitud_model->get_solicitud($id_solicitud,"*",array("s.idEstadosolicitud <="=>1));

        

        if($status){

            $this->solicitud_model->modificar_solicitud($id_solicitud,array("idEstadosolicitud"=>5));



            redirect("solicitudes_abiertas");

        }else{

            echo "<script>"

                . "window.history.back();"

                . "</script>";

                   

        }

        

    }

}

