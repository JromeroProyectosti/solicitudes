<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SE_Controller
 *
 * @author John
 */
class My_Controller extends CI_Controller
{
    protected $secured_controller;
    protected $secure_actions;
    
    function __construct() {
        parent::__construct();
        
        if(!$this->session->userdata('id_cliente')){        
            redirect(base_url()."login");
        }
    }
    
}
