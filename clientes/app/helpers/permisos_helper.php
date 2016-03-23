<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Helper para extraer las acciones de cada permiso
 * y seteando estos como default segun el usuario
 * and open the template in the editor.
 */

/**
 * Description of permisos_helper
 *
 * @author John
 */
if(!function_exists('get_acciones')){

    function get_acciones($id_permiso,$rut){
        $CI =& get_instance();
        
        $check_box="<div class='form-group'>";
        
        $array_acciones=$CI->usuarios_model->get_acciones($id_permiso);
        $array_permisos=$CI->usuarios_model->get_acciones($id_permiso,$rut);
        //print_r($array_acciones);
        
       // print_r($array_permisos);
        foreach($array_acciones as $row){
            $check_box.="
                
                    <div class='checkbox'>
                <label>
                    <input type='checkbox' value='".$row['idPermisoaccion']."' name='checkpermisos[]' ";
            if($array_permisos!=false){
                if(in_array($row['NombrePermisoaccion'],$array_permisos, TRUE)){
                        $check_box.=" checked";
                }
            }
            
            $check_box.= ">".$row['NombrePermisoaccion'];
            $check_box.="</label>"
                    . "</div>";
                    
        }
        $check_box.= "</div>";
        return $check_box;
    }
    
    
}