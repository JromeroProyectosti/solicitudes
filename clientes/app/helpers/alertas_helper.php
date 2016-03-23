<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of alertas_helper
 *
 * @author John
 */
if(!function_exists('get_alerta_carrito')){

    function get_alerta_carrito(){
        $CI =& get_instance();
        $CI->load->library("cart");
        $count_cart=$CI->cart->total_items();
        
       
        $html="<li class='dropdown'>
                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                        <i class='fa fa-shopping-cart fa-fw'></i>  <span class='badge'>$count_cart</span>
                    </a><ul class='dropdown-menu dropdown-alerts'>";
        
        foreach ($CI->cart->contents() as $items):
      
            $html.=" 
                        <li>
                            <a href='#'>
                                <div>
                                    <i class='fa fa-comment fa-fw'></i>".$items['name']." 
                                    <span class='pull-right text-muted small'>".$items['qty']."</span>
                                </div>
                            </a>
                        </li>
                    
                    <li class='divider'></li>
                    ";
               
        endforeach;
        $html.="            <li>
                            <a class='text-center' href='".  base_url()."carrito'>
                                <strong>Ver Carrito</strong>
                                <i class='fa fa-angle-right'></i>
                            </a>
                        </li>
                        </ul>
                </li>";     
        return $html;
        
    }
}
if(!function_exists('get_solicitudes_abierta')){

    function get_solicitudes_abierta($id_estado){
        $CI =& get_instance();
        $CI->load->model("solicitud_model");
        $numero_solicitudes=$CI->solicitud_model->get_listado("*",array("e.idEstadosolicitud"=>$id_estado,"s.idCliente"=>$CI->session->userdata('id_cliente')));
        $contador=0;
        if($numero_solicitudes!=false){
            $contador=count($numero_solicitudes);
        }
       
        if($contador){
            return "<span class='badge'>$contador</span>";
        }
        return "";
    }
}

if(!function_exists('get_alerta_solicitudes')){

    function get_alerta_solicitudes(){
        $CI =& get_instance();
        $CI->load->model("solicitud_model");
        $filtro=array(
            "e.idEstadosolicitud !="=>5,
             "e.idEstadosolicitud !="=>4,
            "VistoSolicitud ="=>0
            
            
            );
        
        $solicitudes=$CI->solicitud_model->get_solicitudes($CI->session->userdata("id_cliente"),"*",$filtro);
            
        $html="<li class='dropdown'>
                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                        <i class='fa fa-envelope fa-fw'></i> <i class='fa fa-caret-down'></i>";
        if($solicitudes!=false){
            $count_cart=count($solicitudes);
            $html.="<span class='badge'>$count_cart</span>";
        }
        
        $html.=" </a><ul class='dropdown-menu dropdown-alerts'>";
        if($solicitudes!=false){
            foreach ($solicitudes as $items):
                switch($items['OrdenEstadosolicitud']){
                    case "1":
                        $clase_bar="-danger";
                        break;
                    case "2":
                        $clase_bar="-warning";
                        break;
                    case "3":
                        $clase_bar="-info";
                        break;
                    case "4":
                        $clase_bar="-success";
                        break;
                    case "6":
                        $clase_bar="-danger";
                        break;
                    case "5":
                         $clase_bar="-danger";
                         break;
                    default:
                        $clase_bar="-info";
                        break;
                }
                $html.="<li>
                                <a href='".  base_url()."detalle_solicitud/".$items['idSolicitud']."'>
                                    <div>
                                        <p>
                                            <strong>".$items['NumeroSolicitud']." ".$items['FechaingresoSolicitud']."</strong>
                                            <span class='pull-right text-muted'>".$items['NombreEstadosolicitud']."</span>
                                        </p>
                                        <div class='progress progress-striped active'>
                                            <div class='progress-bar progress-bar$clase_bar' role='progressbar' aria-valuenow='".$items['OrdenEstadosolicitud']."' aria-valuemin='0' aria-valuemax='3' style='width: ".($items['OrdenEstadosolicitud']*33.3)."%'>
                                                <span class='sr-only'>".$items['NombreEstadosolicitud']."</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class='divider'></li>";



            endforeach;
        }
        $html.=" </ul>
              </li>";     
        return $html;
        
    }
}
if(!function_exists('get_cuentas_estado')){

    function get_cuentas_estado($id_estado){
        $CI =& get_instance();
        $CI->load->model("cuentas_model");
        $numero_solicitudes=$CI->cuentas_model->get_cuentas("*",array("c.idEstadocuenta"=>$id_estado,"c.idCliente"=>$CI->session->userdata('id_cliente')));
        $contador=0;
        if($numero_solicitudes!=false){
            $contador=count($numero_solicitudes);
        }
       
        if($contador){
            return "<span class='badge'>$contador</span>";
        }
        return "";
    }
}
if(!function_exists('get_alerta_cuentas')){

    function get_alerta_cuentas(){
        $CI =& get_instance();
        $CI->load->model("cuentas_model");
       
           $filtro=array(
            "e.idEstadocuenta"=>1,
            "c.idCliente"=>$CI->session->userdata("id_cliente")
            ); 
       
        $cuentas=$CI->cuentas_model->get_cuentas("*",$filtro);
            
        $html="<li class='dropdown'>
                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                        <i class='glyphicon glyphicon-credit-card'></i> <i class='fa fa-caret-down'></i>";
        if($cuentas!=false){
            $count_cart=count($cuentas);
            $html.="<span class='badge'>$count_cart</span>";
        }
        
        $html.=" </a><ul class='dropdown-menu dropdown-alerts'>";
        if($cuentas!=false){
            foreach ($cuentas as $items):
                
                $html.="<li>
                            <a href='".base_url()."detalle_cuentas/".$items['idCuenta']."'>
                                <div>
                                    <i class='fa fa-comment fa-fw'></i>".$items['FechapagoCuenta']." 
                                    <span class='pull-right text-muted small'>Creado: ".$items['FechaingresoCuenta']."</span>
                                </div>
                            </a>
                        </li>
                    
                    <li class='divider'></li>";



            endforeach;
        }
        $html.=" </ul>
              </li>";     
        return $html;
        
    }
}
if(!function_exists('get_menu_categorias')){

    function get_menu_categorias(){
        
        $CI =& get_instance();
        $CI->load->model("productos_model");
        $html="";
        $detalle=$CI->productos_model->get_listado_categorias();
        if($detalle!=false){
            foreach($detalle as $menu){
                $html.="
                 <li>
                    <a href='".base_url()."listado_productos/".$menu['idCategoria']."'>".$menu['NombreCategoria']."</a>
                </li>";

            }
        }
        return $html;
    }
}