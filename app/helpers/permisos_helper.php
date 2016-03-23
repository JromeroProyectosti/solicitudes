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

if(!function_exists("get_menu_rol")){
    function get_menu_rol(){
        $CI=&get_instance();
        $html="";
        if($CI->session->userdata('rol')=='Administrador'){
            $html='<li>
                        <a href="#"><i class="fa  fa-wrench fa-fw"></i> Mantenedores<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="'.base_url().'listado_empresas" >Proveedores</a>
                            </li>
                            <li>
                                <a href="'.base_url().'listado_usuarios">Usuarios</a>
                            </li>
                            <li>
                                <a href="'.base_url().'listado_clientes">Clientes</a>
                            </li>
                            <li>
                                <a href="'.base_url().'listado_productos">Productos</a>
                            </li>
                            <li>
                                <a href="'.base_url().'listado_categoria">Categorias</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i> Documentos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="'.base_url().'listado_compras" >Compras</a>

                            </li>  
                            <li><a href="'.base_url().'ventas">Ventas</a>
                                </li>
                            
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                   <li>
                        <a href="#"><i class="fa  fa-shopping-cart fa-fw"></i> Solicitudes<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                            <a href="'.base_url().'listado_solicitudes">Todos  </a>
                            </li>
                     
                            <li>
                                <a href="'.base_url().'solicitudes_reservadas">Solicitudes Reservadas '.
get_solicitudes_abierta(2).' </a>
                            </li>
                            <li>
                                <a href="'.base_url().'solicitudes_despachada">Solicitudes Despachadas '.
get_solicitudes_abierta(3).' </a>
                            </li>
                            
                            <li>
                                <a href="'.base_url().'solicitudes_anulada">Solicitudes Anulada </a>
                            </li>    
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa  fa-shopping-cart fa-fw"></i> Informes<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                            <a href="'.base_url().'informes/stock">Stock  </a>
                            </li>
                             <li>
                            <a href="'.base_url().'informes/ventas">Ventas  </a>
                            </li>
                            <li>
                                <a href="'.base_url().'informes/productos">Productos</a>
                            </li>
                            
                        </ul>
                    </li>';
        }
        if($CI->session->userdata('rol')=='Vendedor'){
            $html='<li>
                        <a href="#"><i class="fa  fa-wrench fa-fw"></i> Mantenedores<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">  
                            <li>
                                <a href="'.base_url().'listado_clientes">Clientes</a>
                            </li>
                            
                            <li>
                                <a href="'.base_url().'listado_categoria">Categorias</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i> Documentos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                            <a href="'.base_url().'ventas">Ventas <span class="fa arrow"></span></a>
                    
                            <li>
                           
                       
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                   <li>
                        <a href="#"><i class="fa  fa-shopping-cart fa-fw"></i> Solicitudes<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                            <a href="'.base_url().'listado_solicitudes">Todos  </a>
                            </li>
                            <li>
                            <a href="'.base_url().'solicitudes_abiertas">Nuevas solicitudes '.
get_solicitudes_abierta(1).' </a>
                            </li>
                            <li>
                                <a href="'.base_url().'solicitudes_reservadas">Solicitudes Reservadas '.
get_solicitudes_abierta(2).' </a>
                            </li>
                            <li>
                                <a href="'.base_url().'solicitudes_despachada">Solicitudes Despachadas '.
get_solicitudes_abierta(3).' </a>
                            </li>
                            
                            <li>
                                <a href="'.base_url().'solicitudes_anulada">Solicitudes Anulada </a>
                            </li>    
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    ';
        }
        if($CI->session->userdata('rol')=='Informe'){
            $html='<li>
                        <a href="#"><i class="fa  fa-shopping-cart fa-fw"></i> Informes<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                            <a href="'.base_url().'informes/stock">Stock  </a>
                            </li>
                             <li>
                            <a href="'.base_url().'informes/ventas">Ventas  </a>
                            </li>
                            <li>
                                <a href="'.base_url().'informes/productos">Productos</a>
                            </li>
                            
                        </ul>
                    </li>';
        }
        return $html;
    }
}