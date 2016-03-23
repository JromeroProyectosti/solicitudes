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
class productos_model extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    /**
    * Devuelve listado completo de prodsuctos
    *
    * @access	publico
    * @param    String str_productos es un texto que contiene los campos que se quiere que se devuelva separados por coma(,).
    * @param    int $id_producto es el id principal del producto 
    * @return	un row_array o un result_array dependiendo del @param
    */
    public function get_listado_productos($str_productos="*",$id_producto=NULL,$filtro=NULL){
        $this->db->select($str_productos);
        $this->db->from("productos p");
        $this->db->join("categoria c","c.idCategoria=p.idCategoria");
        if($filtro){
            
            $this->db->where($filtro);
        }
        if($id_producto==NULL){
            $result=$this->db->get();
            if($result->num_rows()){
                return $result->result_array();
            
            }
            
        }else{
            $this->db->where("idproductos",$id_producto);
            $result=$this->db->get();
            if($result->num_rows()){
                return $result->row_array();
            }
        }
        
        return false;
    }
    /**
    * Creacion de productos
    *
    * @access	publico
    * @param    String[] array_campos, contiene los campos a insertar Array('campo1'=>'valor1','campo2'=>'valor2')
    * @return	boolean
    */
    public function get_listado_categorias($id_categoria=null){
        $this->db->select("*");
        $this->db->from("categoria");
        
        if($id_categoria==NULL){
            $result=$this->db->get();
            if($result->num_rows()){
                return $result->result_array();
            
            }
            
        }else{
            $this->db->where("idCategoria",$id_categoria);
            $result=$this->db->get();
            if($result->num_rows()){
                return $result->row_array();
            }
        }
        
        return false;
    }
     public function modificar($id_producto,$array_campos,$recalcular=true){
        if($array_campos==NULL){
            return FALSE;
        }else{
           
            $this->db->where("idproductos",$id_producto);
            $this->db->update("productos",$array_campos);
         
            
            return TRUE;
        }
    }
}
