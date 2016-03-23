<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of productos_model
 *
 * @author John
 */
class compras_model extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function get_listado_compra($str_compra="*",$id_compra=null,$filtro=false){
        $this->db->select($str_compra);
        $this->db->from("compras c");
        $this->db->join("estadocompra e","e.idEstadoCompra=c.idEstadoCompra");
        $this->db->join("usuarios u","u.idUsuario=c.idUsuario");
        $this->db->join("proveedores p","p.idProveedor=c.idProveedor");
        
       
        if($filtro){
            
            $this->db->where($filtro);
        }
        if($id_compra==NULL){
            $result=$this->db->get();
            if($result->num_rows()){
                
                return $result->result_array();
            
            }
             
        }else{
            $this->db->where("idCompra",$id_compra);
            $result=$this->db->get();
            if($result->num_rows()){
                return $result->row_array();
            }
        }
        
        return false;
    }
    /**
    * detalle de productos
    *
    * @access	publico
    * @param    Int $idCompra, Contiene el id del documento.
    * @param    String $tablas, Los campos que se quiere devolver separados por coma(,), si se desean todos los campos colocar "*"
    * @param    Int $id_producto, se utiliza cuando se quiere extraer un producto en particular
    * @return	Row_array o un Result_array con los campos especificados en $tablas
    */
    public function get_listado_productos($idCompra,$tablas="*",$id_producto=null,$filtro=null){
        $this->db->select($tablas);
        $this->db->from("detallecompra d");
        $this->db->join("productos p","p.idproductos=d.idproductos");
        $this->db->join("compras c","c.IdCompra=d.IdCompra");
        $this->db->where("d.idCompra",$idCompra);
        if($filtro!=null){
            $this->db->where($filtro);
        }
        if($id_producto!=null){
            $this->db->where("idproducto",$id_producto);
            $result=$this->db->get();
            if($result->num_rows()){
                return $result->row_array();
            }else{
                return false;
            }
           
        }else{
           $result=$this->db->get();
           if($result->num_rows()){
               return $result->result_array();
           }else{
               
               return false;
           }
        }
        
        
    }
    /**
    * Creacion de productos
    *
    * @access	publico
    * @param    String[] array_campos, contiene los campos a insertar Array('campo1'=>'valor1','campo2'=>'valor2')
    * @return	boolean
    */
    public function crear($array_campos=FALSE){
        if($array_campos==FALSE){

            return FALSE;
            
        }else{

            $this->db->insert("compras",$array_campos);
            return $this->db->insert_id();
        }
    } 
    
    public function eliminar_detalle($id_producto=null, $filtro=null){
      
        if($id_producto!=null){
            $this->db->where("idproductos",$id_producto);
        }
        if($filtro!=null){
            $this->db->where($filtro);
        }
        $this->db->delete("detallecompra");
    
        
    }
     /**
    * Insertar Detalle
    *
    * @access	publico
    * @param    Array $campos array con los campos a insertar array("IdCompra"=>$id_compra,"idproductos"=>$id_producto,"CantidadDetallecompra"=>$cantidad,"PrecioDetallecompra"=>$precio)
    */
    public function insertar_detalle($campos){
        $this->db->set($campos);
        $this->db->insert("detallecompra");
    }
     /**
    * Modificar productos
    *
    * @access	publico
      * @param int $id_producto Id interno del producto
    * @param    String[] array_campos, contiene los campos a insertar Array('campo1'=>'valor1','campo2'=>'valor2')
    * @return	boolean
    */
    public function modificar($id_producto,$array_campos){
        if($array_campos==NULL){
            return FALSE;
        }else{
            $this->db->where("idproductos",$id_producto);
            $this->db->update("productos",$array_campos);
            return TRUE;
        }
    }
    public function modificar_compra($id_compra,$array_campos){
        if($array_campos==NULL){
            return FALSE;
        }else{
            $this->db->where("IdCompra",$id_compra);
            $this->db->update("compras",$array_campos);
            return TRUE;
        }
    } 
}