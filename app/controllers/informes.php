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
class informes extends My_Controller{
    //put your code here

    public function __construct($true=true) {
        parent::__construct($true);
        $this->data['titulo']="";
        
    }
 
    
    public function exportar(){
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=excel.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        echo "<table>"
        . "<tr>"
                . "<td colspan=2>".$this->input->post('hdInforme')."</td>"
                . "</tr>"
                . "<tr>"
                . "<td>Fecha Inicio:</td><td>".$this->input->post('hdInicio')."</td>"
                . "</tr>"
                . "<tr>"
                . "<td>Fecha Fin:</td><td>".$this->input->post('hdFin')."</td>"
                . "</tr>"
                . "<tr><td></td></tr>"
                
                . "</table>";
        echo $this->input->post('datos_a_enviar');
    }
    public function ventas(){
        $this->load->model("cuentas_model");
        if($this->input->post()){

            $filtro=array(
                "date(FechaingresoCuenta) >="=>$this->input->post("txtFechaInicio"),
                "date(FechaingresoCuenta) <="=>$this->input->post("txtFechaFin")
            );
        }else{
             $filtro=null;

        }
        $campos=" p.CodigoProducto,p.DescripcionProducto,c.idCuenta,c.FechaIngresocuenta,ec.NombreEstadocuenta,cl.NombreCliente,cl.ApellidoCliente,ds.CantidadDetallesolicitud,ds.PreciocatalogoDetallesolicitud ";
        $detalle['listado']=$this->cuentas_model->get_informe_ventas("*",$filtro);
        
        
        $this->data['titulo']="Productos - Listado";

        $this->data['scripts']="<script type='text/javascript' class='init'>

        $(document).ready(function() {

            $('#datatable-ventas').DataTable({

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
        $this->load->view("template/header",$this->data);
        $this->load->view("informes/ventas",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function productos(){
        $this->load->model("cuentas_model");
        if($this->input->post()){

            $filtro=array(
                "date(FechaingresoCuenta) >="=>$this->input->post("txtFechaInicio"),
                "date(FechaingresoCuenta) <="=>$this->input->post("txtFechaFin")
            );
        }else{
             $filtro=null;

        }
        $campos=" p.CodigoProducto,p.DescripcionProducto,c.idCuenta,c.FechaIngresocuenta,ec.NombreEstadocuenta,cl.NombreCliente,cl.ApellidoCliente,ds.CantidadDetallesolicitud,ds.PreciocatalogoDetallesolicitud ";
        $detalle['listado']=$this->cuentas_model->get_informe_ventas_productos("*",$filtro);
        
        
        $this->data['titulo']="Productos - Listado";

        $this->data['scripts']="<script type='text/javascript' class='init'>

        $(document).ready(function() {

            $('#datatable-ventas').DataTable({

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
        $this->load->view("template/header",$this->data);
        $this->load->view("informes/productos",$detalle);
        $this->load->view("template/footer",$this->data);
    }
     public function stock(){

        $this->load->model("productos_model");

        

        $this->data['titulo']="Productos - Listado";

       $this->data['scripts']="<script type='text/javascript' class='init'>

        $(document).ready(function() {

            $('#datatable-productos').DataTable({

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

        $detalle['listado']=$this->productos_model->get_listado_productos("*",NULL,array("EstadoProducto"=>1));

        $this->load->view("template/header",$this->data);

        $this->load->view("informes/stock",$detalle);

        $this->load->view("template/footer",$this->data);

    }
}