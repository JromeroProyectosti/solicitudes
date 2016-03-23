<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of calculoproducto
 *
 * @author John
 */
class Crearproductos {
    public function __construct() {
        
    }
    function calculo_iva($precio_catalogo){
        return $precio_catalogo-($precio_catalogo/1.19);
    }
    
   function redondear_a_10($valor) { 

        // Convertimos $valor a entero 
        $valor = intval($valor); 

        // Redondeamos al múltiplo de 10 más cercano 
        $n = round($valor, -1); 

        // Si el resultado $n es menor, quiere decir que redondeo hacia abajo 
        // por lo tanto sumamos 10. Si no, lo devolvemos así. 
        return $n < $valor ? $n + 10 : $n; 
    }
}