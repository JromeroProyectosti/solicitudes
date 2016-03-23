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
if(!function_exists('get_alerta')){

    function get_alerta(){
        $total_alertas=0;
        $CI =& get_instance();
        $CI->load->model("alertas_model");
        //$numero_nuevos_vendedores=$CI->alertas_model->get_nuevos_vendedores(true);
        $html='';
        //$total_alertas=$numero_nuevos_vendedores;
        
              
        if($CI->session->userdata('rol')=='Administrador'){
            
            
       
            $html="<li class='dropdown'>
                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                        <i class='fa fa-bell fa-fw'></i>  <span class='badge'>$total_alertas</span>
                    </a>
                    
                </i>"; 
        
        }
        return $html;
        
    }
}
if(!function_exists('get_solicitudes_abierta')){

    function get_solicitudes_abierta($id_estado){
        $numero_solicitudes=false;
        $CI =& get_instance();
        $CI->load->model("solicitud_model");
        
        if($CI->session->userdata('rol')=='Administrador'){
            $filtro=array(
                "e.idEstadosolicitud"=>$id_estado
            );
             
         }else{
             $filtro=array(
                "e.idEstadosolicitud"=>$id_estado,
                 "v.idVendedor"=>$CI->session->userdata('id_usuario')
            );
         }
        $numero_solicitudes=$CI->solicitud_model->get_listado("*",$filtro);
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
if(!function_exists('get_cuentas_estado')){

    function get_cuentas_estado($id_estado){
        $CI =& get_instance();
        $CI->load->model("cuentas_model");
        
          
         if($CI->session->userdata('rol')=='Administrador'){
            $filtro=array(
                "c.idEstadocuenta"=>$id_estado 
            );
             
         }else{
             $filtro=array(
                "c.idEstadocuenta"=>$id_estado,
                 "v.idVendedor"=>$CI->session->userdata('id_usuario')
            );
         }
       
        $numero_solicitudes=$CI->cuentas_model->get_cuentas("*",$filtro);
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
if(!function_exists('get_cuentas_atrasado')){

    function get_cuentas_atrasado(){
        $CI =& get_instance();
        $CI->load->model("cuentas_model");
        $filtro=array(
          "c.idEstadocuenta"=>1,
            "date( c.FechapagoCuenta ) <"=>date("Y-m-d")
        );
        $numero_solicitudes=$CI->cuentas_model->get_cuentas("*",$filtro);
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