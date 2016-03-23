<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Controller extends CI_Controller
{
    protected $secured_controller;
    protected $secure_actions;
    
    function __construct($secured_controller=FALSE) {
        parent::__construct();
        $this->secured_controller=$secured_controller;
        $this->load->model("permisos_model");
        $this->_check_user();
        
        $this->secure_actions = $this->permisos_model->lista_permisos($this->session->userdata("id_usuario"),$this->router->class);
       /* print_r($this->secure_actions);
        echo $this->router->method;*/
        if($this->secured_controller){
            $this->_check_security();
        }
    }
    protected function _check_user(){
        if(!$this->session->userdata("id_usuario"))
        {
            redirect("login");  
        }
    }
    protected function _check_security()
    {
	if(!$this->_access_granted($this->router->method))
	{
            $this->config->load('security');
            $redirectURL = $this->config->item('unauthorized_redirect');
            if(isset($redirectURL))
            {
                redirect($redirectURL);
            }
            else
            {
                show_error('Unauthorized access');
            }
	}
    }
    protected function _access_granted( $action_name)
    {
        if(!$this->secured_controller)
        {
            return TRUE;
        }
        else
        {
            
            if(is_array($this->secure_actions)){
                //echo array_key_exists($action_name,$this->secure_actions);
                //print_r($this->secure_actions);
                if(in_array($action_name,$this->secure_actions))
                {
                    return TRUE;
                }
                else
                {
                    foreach($this->secure_actions as $recursivo){
                        $actions_array=explode(",",$recursivo);
                        //print_r($actions_array);
                        if(in_array($action_name,$actions_array)){
                            return TRUE;
                            exit;
                        }
                    }
                    return FALSE;
                }
            }else{
               return false;
            }
        }
    }
    
}

