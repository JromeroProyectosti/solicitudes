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

            $this->db->insert("productos",$array_campos);
            $this->_calcular($this->db->insert_id());
            
            return TRUE;
        }
    }
    public function crear_categoria($nombre){
       
            $this->db->insert("categoria",array("NombreCategoria"=>$nombre));
            //$this->_calcular($this->db->insert_id());
            return TRUE;
       
    }
    private function _calcular($id_producto){
        
        $datos=$this->get_listado_productos("*",$id_producto);
        $iva=0;
        $neto=0;
        $comision=0;
        $retencion=0;
        $apagar=0;
        $ganancia=0;
        $utilidad=0;

        ///Neto
        $neto=(int)($datos['PrecioventaProducto'])/1.19;
        $iva=(int)($datos['PrecioventaProducto'])-$neto;
        //comision
        $comision=$neto*0.3;

        $retencion=$comision*0.1;

        $apagar=(int)($datos['PrecioventaProducto'])+$retencion-$comision;
        $ganancia=$comision-$retencion;
        $utilidad=$neto-$comision-(int)($datos['PreciocompraProducto']);


        $campos=array("IvaProducto"=>$iva,
                      "NetoProducto"=>$neto,
                      "ComisionProducto"=>$comision,
                      "RetencionProducto"=>$retencion,
                      "ApagarProducto"=>$apagar,
                      "GananciaProducto"=>$ganancia,
                      "UtilidadProducto"=>$utilidad);
       
        $this->db->where("idproductos",$id_producto);
        $this->db->update("productos",$campos);
    }
     /**
    * Modificar productos
    *
    * @access	publico
      * @param int $id_producto Id interno del producto
    * @param    String[] array_campos, contiene los campos a insertar Array('campo1'=>'valor1','campo2'=>'valor2')
    * @param    Int $recalcular, Para todos los efectos, esta opcion recalculará el producto, para que obvie esto debes colocar un false
    * @return	boolean
    */
    public function modificar($id_producto,$array_campos,$recalcular=true){
        if($array_campos==NULL){
            return FALSE;
        }else{
           
            $this->db->where("idproductos",$id_producto);
            $this->db->update("productos",$array_campos);
         
            if($recalcular){
                $this->_calcular($id_producto);
            }
           
            return TRUE;
        }
    }
    public function modificar_categoria($id_categoria,$nombre){
        
        $this->db->where("idCategoria",$id_categoria);
        $this->db->update("categoria",array("NombreCategoria"=>$nombre));


        return TRUE;
     
    }
    public function eliminar($id_producto){
        $this->db->set("EstadoProducto",0);
        $this->db->where("idproductos",$id_producto);
        $this->db->update("productos");
    
        
    }
    public function eliminar_categoria($id_categoria){
       
        if($this->db->delete("categoria",array("idCategoria"=>$id_categoria))){
            return true;
        }
        return false;
    
        
    }
    public function mas_vendidos($campos="*",$filtro=array()){
        $this->db->select("sum(d.CantidadDetallesolicitud) as cantidad, p.DescripcionProducto,p.CodigoProducto,p.CodigocatalogoProducto");
        $this->db->from("productos p");
        $this->db->join("detallesolicitud d","d.idproductos=p.idproductos");
        $this->db->join("solicitudes s","s.idSolicitud=d.idSolicitud");
        $this->db->where("( s.idEstadosolicitud = 4 or s.idEstadosolicitud = 3)");
        if(is_array($filtro)){
            if(count($filtro)>0){
               $this->db->where($filtro);
            }
        }
        $this->db->group_by("p.idproductos");
        $this->db->order_by("cantidad","desc");
        $result=$this->db->get();
        
        if($result->num_rows()){
            return $result->result_array();
        }
        return false;
    }
   
}
