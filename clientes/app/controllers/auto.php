<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auto
 *
 * @author John
 */
class auto extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    //put your code here
    
    function index(){
        $this->load->view("template/autocomplete");
        
    }
}
