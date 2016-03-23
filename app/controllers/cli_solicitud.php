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
class Cli_solicitud extends MY_Controller{
    //put your code here
    public function __construct() {
        parent::__construct(true);
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-solicitudes').DataTable({
                responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
    });
    $(function() {
      var availableTags = [
        'ActionScript',
        'AppleScript',
      ];
      $( '#tags' ).autocomplete({
        source: availableTags
      });
    });
</script>";
    }
    public function solicitudes($id_estado=0,$page="solicitud",$cliente=0){
        $this->data['titulo']="Solicitudes";
        $this->data['vender']=false;
        $filtro=null;
  
        if($id_estado>0){

            if($cliente>0){
                $filtro=array("e.idEstadosolicitud"=>$id_estado,"s.IdCliente"=>$cliente);
                $this->data['vender']=true;
            }else{
                $filtro=array("e.idEstadosolicitud"=>$id_estado);
            }
        }
        
        $this->load->model("solicitud_model");
        
        switch($this->session->userdata('rol')){
            case "Vendedor":
                $detalle['listado']=$this->solicitud_model->get_listado("*",array(
                    "idVendedor"=>$this->session->userdata('id_usuario'),
                    "e.idEstadosolicitud"=>$id_estado
                    ));
                break;
            default:
                $detalle['listado']=$this->solicitud_model->get_listado("*",$filtro);
                break;
        }
        
        
        $detalle['modifica']=$page;
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/solicitudes/listado",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    
    public function solicitudes_abiertas(){
        $this->solicitudes(1,"abiertas");
        $this->load->model("solicitud_model");
        
        
    }
    public function abiertas($id_solicitud){
        $this->load->model("solicitud_model");
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-productos').DataTable({
                responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
    });
</script>";
        
        //reservando
        if($this->input->post("hdAccion")){
//            $this->load->model("productos_model");
//            $detalle_solicitud=$this->solicitud_model->get_detalle_solicitud($id_solicitud);
//           
//            foreach($detalle_solicitud as $item){
//                $producto=$this->productos_model->get_listado_productos("*",$item['idproductos']);
//                
//                $array_campos=array(
//                    "ReservaProducto"=>($producto['ReservaProducto']+$item["CantidadDetallesolicitud"])
//                );
//                
//                
//               $this->productos_model->modificar($item['idproductos'],$array_campos,false);
//            }
//            $this->solicitud_model->modificar_solicitud($id_solicitud,array("idEstadosolicitud"=>$this->input->post("hdAccion")));
            
            redirect("solicitudes_abiertas");
            
        }
       
        $detalle['formaenvio']=$this->common_model->get_forma_envio();
        
        $detalle['estado']=$this->common_model->get_estado_solicitud();
        $detalle['solicitud']=$this->solicitud_model->get_solicitud($id_solicitud);
    
        $detalle['detalle']=$this->solicitud_model->get_detalle_solicitud($id_solicitud);
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/solicitudes/abiertas",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    
    
    public function solicitudes_reservada(){
        
        $this->solicitudes(2,"reservadas");
        
        
    }
    public function solicitudes_reservada_cliente($cliente){
        
        $this->solicitudes(3,"despachadas",$cliente);
        
        
    }
    public function reservadas($id_solicitud){
        $this->load->model("solicitud_model");
        $this->load->model("productos_model");
        
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-productos').DataTable({
                responsive: true ,
                
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
        
    });
    
    $('#addProducto').on('show.bs.modal', function (event) {
        var modal = $(this)
        modal.find('#datatable-productos-add').DataTable({
                responsive: true ,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        }); 
    });
    function validar(cantidad,texto,reservado){
        if((cantidad+reservado)<texto.value){
            alert('La cantidad excede el stock');
            texto.value=(cantidad+reservado);
            return false;
        }
        return true;
    }
    
    function validar_add(cantidad,texto){
        if(cantidad<texto.value){
            alert('La cantidad excede el stock');
            texto.value=cantidad;
            return false;
        }
        return true;
    }
</script>";
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('txtRutUsuario','Rut','required|callback_valida_rut');
        
        $this->form_validation->set_rules('txtNumeroenvio','Numero de envio','required');
       
        if($this->form_validation->run()===FALSE){
            if($this->input->post("hdIdDetalle")!=""){
                $this->modificar_detalle($id_solicitud);
           }
           
           
            ////SE MUESTRAN LAS RESERVADAS
            $detalle['estado']=$this->common_model->get_estado_solicitud();
            $detalle['solicitud']=$this->solicitud_model->get_solicitud($id_solicitud);
            $detalle['formaenvio']=$this->common_model->get_forma_envio();
            $detalle['comuna']=$this->common_model->get_comuna();
            
            $detalle['detalle']=$this->solicitud_model->get_detalle_solicitud($id_solicitud);
            $filtro=array("EstadoProducto"=>1);
            
            $detalle['listado']=$this->productos_model->get_listado_productos("*",NULL,$filtro);
            $this->load->view("template/header",$this->data);
            $this->load->view("documentos/solicitudes/reservadas",$detalle);
            $this->load->view("template/footer",$this->data);
        }else{
            ///Se despachan los productos....
            if($this->input->post("hdAccion")){
                
                
                $detalle_solicitud=$this->solicitud_model->get_detalle_solicitud($id_solicitud);

                foreach($detalle_solicitud as $item){
                    $producto=$this->productos_model->get_listado_productos("*",$item['idproductos']);
                    $stock=0;
                    $reserva=0;

                    if(($producto['ReservaProducto']-$item["CantidadDetallesolicitud"])>0){
                        $reserva=($producto['ReservaProducto']-$item["CantidadDetallesolicitud"]);
                    }
                    if(($producto['StockProducto']-$item["CantidadDetallesolicitud"])>0){
                        $stock=($producto['StockProducto']-$item["CantidadDetallesolicitud"]);
                    }
                    $array_campos=array(
                        "StockProducto"=>$stock,
                        "ReservaProducto"=>$reserva
                    );


                   $this->productos_model->modificar($item['idproductos'],$array_campos,false);
                }
                
                $this->solicitud_model->modificar_solicitud($id_solicitud,array(
                    "idEstadosolicitud"=>$this->input->post("hdAccion"),
                    "NumeroenvioSolicitud"=>$this->input->post("txtNumeroenvio"),
                    "idFormaenvio"=>$this->input->post("cboFormaenvio")
                     ));

                //redirect("generar_venta/".$id_solicitud);
                redirect("solicitudes_despachada");

            }
        }
        
    }
    public function solicitudes_despachada(){
        $this->solicitudes(3,"despachadas");
    }
    public function despachadas($id_solicitud){
        $this->load->model("solicitud_model");
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-productos').DataTable({
                responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
    });
    function validar(cantidad,texto){
        if(cantidad<texto.value){
            alert('La cantidad excede el stock');
            texto.value=cantidad;
            return false;
        }
        return true;
    }
</script>";
        if($this->input->post("hdAccion")){
            
            $this->solicitud_model->modificar_solicitud($id_solicitud,array("idEstadosolicitud"=>$this->input->post("hdAccion")));
            //redirect("solicitudes_reservadas");
            redirect("generar_venta/".$id_solicitud);
            
        }
        
        $detalle['estado']=$this->common_model->get_estado_solicitud();
        $detalle['solicitud']=$this->solicitud_model->get_solicitud($id_solicitud);
        $detalle['formaenvio']=$this->common_model->get_forma_envio();
        $detalle['comuna']=$this->common_model->get_comuna();
        
        $detalle['detalle']=$this->solicitud_model->get_detalle_solicitud($id_solicitud);
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/solicitudes/despachadas",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function solicitudes_pagada(){
        $this->solicitudes(4,"pagadas");
    }
    public function pagadas($id_solicitud){
        $this->load->model("solicitud_model");
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-productos').DataTable({
                responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
    });
</script>";
        if($this->input->post("hdAccion")){
            
        $this->solicitud_model->modificar_solicitud($id_solicitud,array("idEstadosolicitud"=>$this->input->post("hdAccion")));
            
            redirect("solicitudes_reservadas");
            
        }
        
        $detalle['estado']=$this->common_model->get_estado_solicitud();
        $detalle['solicitud']=$this->solicitud_model->get_solicitud($id_solicitud);
        $detalle['formaenvio']=$this->common_model->get_forma_envio();
        $detalle['comuna']=$this->common_model->get_comuna();
        $detalle['detalle']=$this->solicitud_model->get_detalle_solicitud($id_solicitud);
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/solicitudes/pagadas",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    public function solicitudes_anulada(){
        $this->solicitudes(6,"anuladas");
    }
    public function anuladas($id_solicitud){
        $this->load->model("solicitud_model");
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-productos').DataTable({
                responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
    });
</script>";
        if($this->input->post("hdAccion")){
            
        $this->solicitud_model->modificar_solicitud($id_solicitud,array("idEstadosolicitud"=>$this->input->post("hdAccion")));
            
            redirect("solicitudes_reservadas");
            
        }
        
          $detalle['estado']=$this->common_model->get_estado_solicitud();
        $detalle['solicitud']=$this->solicitud_model->get_solicitud($id_solicitud);
          $detalle['formaenvio']=$this->common_model->get_forma_envio();
        
        $detalle['detalle']=$this->solicitud_model->get_detalle_solicitud($id_solicitud);
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/solicitudes/reservadas",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    
    public function modificar($id_solicitud){
        $this->load->model("solicitud_model");
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-productos').DataTable({
                responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
    });
</script>";
        if($this->input->post()){
            $campos=array(
                "idEstadosolicitud"=>$this->input->post("cboEstado"),
                "idFormaenvio"=>$this->input->post("cboFormaenvio"),
                "NumeroenvioSolcitud"=>$this->input->post("txtNumeroenvio")
            );
            
            $this->solicitud_model->modificar_solicitud($id_solicitud,$campos);
            
            redirect("solicitudes_abiertas");
            
        }
        
        $detalle['estado']=$this->common_model->get_estado_solicitud();
        
        $detalle['formaenvio']=$this->common_model->get_forma_envio();
        $detalle['solicitud']=$this->solicitud_model->get_solicitud($id_solicitud);
    
        $detalle['detalle']=$this->solicitud_model->get_detalle_solicitud($id_solicitud);
        $this->load->view("template/header",$this->data);
        $this->load->view("documentos/solicitudes/modificar",$detalle);
        $this->load->view("template/footer",$this->data);
    }
    
    public function modificar_detalle($id_solicitud){
        $idDetalle=$this->input->post("hdIdDetalle");
        $idProducto=$this->input->post("hdIdProducto");
        $precios=$this->input->post("txtPrecioCatalogo");
        $cantidad=$this->input->post("txtCantidad");
        
        $this->load->model("solicitud_model");
        $this->load->model("common_model");
        $suma=0;
        if(count($idDetalle)){
            for($i=0;$i<count($idDetalle);$i++){
               
                $precio_num=str_replace(".","",$precios[$i]);
                $campos=array(
                    "PreciocatalogoDetallesolicitud"=>$precio_num,
                    "CantidadDetallesolicitud"=>$cantidad[$i]
                );
                $filtro=array(
                    "idDetallesolicitud"=>$idDetalle[$i]
                );
                $this->solicitud_model->modificar_detalle($id_solicitud,$campos,$filtro);
                $this->common_model->recalcular_reservas($idProducto[$i]);
                $suma+=($precio_num*$cantidad[$i]);
            }
            $this->solicitud_model->modificar_solicitud($id_solicitud,array("TotalapagarSolicitud"=>$suma));
        }
        
    }
    public function agregar_detalle($id_solicitud){
        
        $this->load->model("solicitud_model");
        $this->load->model("common_model");
        $this->load->model("productos_model");
        
        
        $idProducto=$this->input->post("hdIdProducto");
        $cantidad=$this->input->post("txtCantidad");
        $precio=$this->input->post("hdPrecio");
        $url=$this->input->post("url");
       
        $detalle=array(
            "idproductos"=>$idProducto,
            "CantidadDetallesolicitud"=>$cantidad,
            "PreciocatalogoDetallesolicitud"=>$precio
        );
      
        $this->solicitud_model->ingresar_detalle($id_solicitud,$detalle);
        
        $detalle_productos=$this->productos_model->get_listado_productos("*",$idProducto);
        
        $array_campos=array(
            "ReservaProducto"=>($detalle_productos['ReservaProducto']+$cantidad)
        );
        $this->productos_model->modificar($idProducto,$array_campos,false);
        
        $solicitud=$this->solicitud_model->get_solicitud($id_solicitud);
        
        $totalApagar=$solicitud['TotalapagarSolicitud']+($cantidad*$precio);
        $this->solicitud_model->modificar_solicitud($id_solicitud,array("TotalapagarSolicitud"=>$totalApagar));
        
        redirect($url);
        
    }
    public function eliminar_detalle($id_solicitud,$id_detalle){
        
        $this->load->model("solicitud_model");
        $this->load->model("common_model");
        $this->load->model("productos_model");
        
        $detalle_solicitud=$this->solicitud_model->get_detalle_solicitud($id_solicitud,"d.idproductos,d.CantidadDetallesolicitud,d.PreciocatalogoDetallesolicitud",array("d.idDetallesolicitud"=>$id_detalle));
       
        
        $this->solicitud_model->elimina_detalle($id_detalle);
        
        $detalle_productos=$this->productos_model->get_listado_productos("*",$detalle_solicitud[0]["idproductos"]);
        
        $array_campos=array(
            "ReservaProducto"=>($detalle_productos['ReservaProducto']-$detalle_solicitud[0]["CantidadDetallesolicitud"])
        );
        $this->productos_model->modificar($detalle_solicitud[0]["idproductos"],$array_campos,false);
        
        $solicitud=$this->solicitud_model->get_solicitud($id_solicitud);
        
        $totalApagar=$solicitud['TotalapagarSolicitud']-($detalle_solicitud[0]["CantidadDetallesolicitud"]*$detalle_solicitud[0]["PreciocatalogoDetallesolicitud"]);
        $this->solicitud_model->modificar_solicitud($id_solicitud,array("TotalapagarSolicitud"=>$totalApagar));
        
        redirect("modificar_reservadas/".$id_solicitud);
        
    }
    public function eliminar($id_solicitud){
        $this->load->model("solicitud_model");
        
        $resultado=$this->solicitud_model->get_solicitud($id_solicitud);
        
        if($resultado['idEstadosolicitud']>=1 && $resultado['idEstadosolicitud']<=4){
            
       
        
            $this->load->model("productos_model");
            $detalle_solicitud=$this->solicitud_model->get_detalle_solicitud($id_solicitud);
           
            foreach($detalle_solicitud as $item){
                $producto=$this->productos_model->get_listado_productos("*",$item['idproductos']);

                switch($resultado['idEstadosolicitud']){
                    case 2:
                        if(($producto['ReservaProducto']-$item["CantidadDetallesolicitud"])<=0){
                            $array_campos=array("ReservaProducto"=>0);
                        }else{
                            $array_campos=array(
                                "ReservaProducto"=>($producto['ReservaProducto']-$item["CantidadDetallesolicitud"])
                            );
                        }
                        break;
                    case 3:
                    case 4:
                        if(($producto['StockProducto']+$item["CantidadDetallesolicitud"])<=0){
                            $array_campos=array("StockProducto"=>0);
                        }else{
                            $array_campos=array(
                                "StockProducto"=>($producto['StockProducto']+$item["CantidadDetallesolicitud"])
                            );
                        }
                        break;
                    default:
                        $array_campos=array();

                }
                
                
                
               $this->productos_model->modificar($item['idproductos'],$array_campos,false);
            }
        }
        $this->solicitud_model->modificar_solicitud($id_solicitud,array("idEstadosolicitud"=>6));
        
        redirect("solicitudes_abiertas");
            

    }
    
    public function exportar_pdf(){
        
        $this->load->model("solicitud_model");
        $this->load->model("common_model");
        $this->load->model("usuarios_model");
        $solicitud=$this->solicitud_model->get_solicitud($this->input->post("hdIdSolicitud"));
       // print_r($solicitud);
        $comuna=$this->common_model->get_comuna(0,$solicitud['IdComuna']);
        $ciudad=$this->common_model->get_ciudad(0,$solicitud['IdCiudad']);
        $usuario=$this->usuarios_model->get_usuario_id($solicitud['idVendedor']);
        //print_r($comuna);
        $this->load->library("pdf");
        
        $pdf = new $this->pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('HNS Nutrition');
        $pdf->SetTitle('Solicitud n');
        $pdf->SetSubject('Solicitud');
        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        //$pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
         
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('courier', '', 10, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
        $html='<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table width="100%">
            <tr>
                <td width="120">
                    <img src="'.base_url().'img/logoHNS.png">
                </td>
                <td width="400">HEALTY NUTRITION STORE S.A.<br />
                    giro:IMPORT.EXPORT.DISTRIBUCION DE SUPLEMENTOS ALIMENTICIOS<br />
                    AV. San Martin 347 206 - BUIN<br />
                    Vendedor: '.$usuario['NombreUsuario']." ".$usuario['ApellidoUsuario'].'
             
                </td>
                <td width="100">
                    <table border="1" >
                    <tr><td width="100" heigth="200">
                    SOLICITUD<br>
                       N&deg; '.$this->input->post("hdIdSolicitud").' 
                    
                    </td></tr>
                    </table>
                </td>  
            </tr>
        </table>
        <br>
        <Br>
        <table>
            <tr>
                <td>
                    SEÑOR
                </td>
                <td colspan="3">:'.$solicitud["NombreCliente"]." ".$solicitud["ApellidoCliente"].'</td>
            </tr>
            <tr>
                <td>
                    RUT
                </td>
                <td colspan="3">:'.$solicitud["RutCliente"].'</td>
            </tr>
            
            <tr>
                <td>
                    DIRECCI&Oacute;N
                </td>
                <td colspan="3">:'.$solicitud["DireccionCliente"].'</td>
            </tr>
            <tr>
                <td>
                    COMUNA
                </td>
                <td>:'.$comuna[0]['NombreComuna'].'</td>
                <td>CIUDAD</td>
                <td>:'.$ciudad[0]['NombreCiudad'].'</td>
            </tr>
            <tr>
                <td>
                    CONTACTO
                </td>
                <td colspan="3">:</td>
            </tr>
        </table>
        <br />
        ';
        $pdf->writeHTML($html);
        
        $solicitud_detalle=$this->solicitud_model->get_detalle_solicitud($solicitud['idSolicitud']);
        $html_d='<table border="1" cellpadding="0" cellspacing="0">
            <tr>
               <th align="center"><strong>C&oacute;digo</strong></th>
               <th align="center"><strong>Descripci&oacute;n</strong></th>
               <th align="center"><strong>Cantidad</strong></th>
               <th align="center"><strong>Precio</strong></th>
               <th align="center"><strong>Valor</strong></th>
            </tr>';
        $total=0;
        foreach($solicitud_detalle as $item){
            $html_d.='<tr>
                <td>'.$item['CodigoProducto'].'</td>
                <td>'.$item['DescripcionProducto'].'</td>
                <td align="center">'.$item['CantidadDetallesolicitud'].'</td>
                <td align="rigth">'.number_format($item['PreciocatalogoDetallesolicitud'],0,",",".").'</td>
                <td align="rigth">'.number_format(($item['PreciocatalogoDetallesolicitud']*$item['CantidadDetallesolicitud']),0,",",".").'</td>
            </tr>';
            $total+=($item['PreciocatalogoDetallesolicitud']*$item['CantidadDetallesolicitud']);
        }
        
        
         //
         
         $html_d.='<tr>
                    <td colspan="2"></td>
                    <td colspan="3" align="rigth"><strong>TOTAL: '.number_format($total,0,",",".").'</strong></td>
                    </tr>
                </table>';
         $pdf->writeHTML($html_d);
         
         $html='</body>
        </html>';
         
        
       $pdf->writeHTML($html);
        $pdf->Output(base_url()."tmp/solicitud.php", 'I');
    }
}
