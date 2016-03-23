<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');/* * To change this license header, choose License Headers in Project Properties. * To change this template file, choose Tools | Templates * and open the template in the editor. *//** * Description of cli_cliente * * @author John */class Cli_cliente extends CI_Controller{    //put your code here    public function __construct() {        parent::__construct();    }    public function registro(){        $this->load->model("common_model");        $detalle['ciudad']=$this->common_model->get_ciudad();        $detalle['comuna']=$this->common_model->get_comuna();        $detalle['region']=$this->common_model->get_region();        $this->load->library('form_validation');        $this->form_validation->set_rules('txtRutUsuario','Rut','required|callback_valida_rut');        $this->form_validation->set_rules('txtNombre','Nombre','required');        $this->form_validation->set_rules('txtApellido','Apellido','required');        $this->form_validation->set_rules('txtEmail','Email','required|valid_email');        $this->form_validation->set_rules('txtEmailR','Reingreso Email','required|valid_email');        $this->form_validation->set_rules('txtApellido','Apellido','required');        $this->form_validation->set_rules('cboRegion','Region','callback_valida_combo');        $this->form_validation->set_rules('cboCiudad','Ciudad','callback_valida_combo');        $this->form_validation->set_rules('cboComuna','Comuna','callback_valida_combo');        $this->form_validation->set_rules('txtTelefono','Telefono','required');        $this->form_validation->set_rules('txtDireccion','Direccion','required');        $this->form_validation->set_rules('txtApellido','Apellido','required');        $this->form_validation->set_rules('rdExperiencia','Experiencia','required');        $this->form_validation->set_rules('rdEnteraste','Como te Enteraste','required');        $this->form_validation->set_message('valida_combo','Campo Requerido');        if($this->form_validation->run()===FALSE){            $this->load->view("clientes/registro",$detalle);        }else{            $campos=array(            "IdEstadovendedor"=>1,            "RutVendedor"=>$this->input->post("txtRutUsuario"),            "NombreVendedor"=>$this->input->post("txtNombre"),            "ApellidoVendedor"=>$this->input->post("txtApellido"),            "CorreoVendedor"=>$this->input->post("txtEmail"),            "CorreoconfirmacionVendedor"=>$this->input->post("txtEmailR"),            "DireccionVendedor"=>$this->input->post("txtDireccion"),                     "IdComuna"=>$this->input->post("cboComuna"),            "IdCiudad"=>$this->input->post("cboCiudad"),            "IdRegion"=>$this->input->post("cboRegion"),            "TelefonoVendedor"=>$this->input->post("txtTelefono"),            "ExperienciaVendedor"=>$this->input->post("rdExperiencia"),            "EnterarVendedor"=>$this->input->post("rdEnteraste"),            "FecharegistroVendedor"=>date("Y-m-d h:m:s"),            "FechasolicitudValidacion"=>date("Y-m-d h:m:s")                   );            $vendedor=$this->vendedor_model->get_vendedores("*",array("CorreoVendedor"=>$this->input->post("txtEmail")));            if($vendedor!=false){                $detalle['correo']=$this->input->post("txtEmail");                $this->load->view("clientes/error_registro",$detalle);            }else{                $this->vendedor_model->ingresar_registro($campos);                $this->load->view("clientes/registro_sussed");            }        }            }        public function valida_combo($value){                return $value=='0'?FALSE:TRUE;            }    public function valida_rut($rut){        $this->load->model('vendedor_model');        if($this->vendedor_model->get_vendedor($rut)!=FALSE){            $this->form_validation->set_message('valida_rut','El Rut ya existe en el sistema');                        return FALSE;        }        else {            $this->load->library("comun");            if($this->comun->valida_rut($rut)){                return TRUE;            }else{                $this->form_validation->set_message('valida_rut','El Rut Tiene un formato erroneo');                            return FALSE;                       }        }    }    public function ingresar_registro(){                     $campos=array(            "IdEstadovendedor"=>1,            "RutVendedor"=>$this->input->post("control8379684"),            "NombreVendedor"=>$this->input->post("control8379599-1"),            "ApellidoVendedor"=>$this->input->post("control8379599-2"),            "CorreoVendedor"=>$this->input->post("control8380379"),            "CorreoconfirmacionVendedor"=>$this->input->post("control8380379"),            "DireccionVendedor"=>$this->input->post("control8380253"),            "ComunaVendedor_text"=>$this->input->post("control8379991"),            "TelefonoVendedor"=>$this->input->post("control8492021"),            "ExperienciaVendedor"=>$this->input->post("control8380395"),            "EnterarVendedor"=>$this->input->post("control8380398"),            "FecharegistroVendedor"=>date("Y-m-d h:m:s"),            "FechasolicitudValidacion"=>date("Y-m-d h:m:s")                                               );        $vendedor=$this->vendedor_model->get_vendedores("*",array("CorreoVendedor"=>$this->input->post("control8380379")));                        if($vendedor!=false){            $detalle['correo']=$this->input->post("control8380379");            $this->load->view("clientes/error_registro",$detalle);        }else{            $this->vendedor_model->ingresar_registro($campos);            $this->load->view("clientes/registro_sussed");        }    }    public function validar($id_vendedor){        $this->load->library('form_validation');        //$this->form_validation->set_rules('txtRutUsuario','Rut','required|callback_valida_rut');        $this->form_validation->set_rules('txtPassword','Password','required');        $this->form_validation->set_rules('txtPasswordRE','Repita Password','required');                        $detalle['id_vendedor']=$id_vendedor;        if($this->form_validation->run()===FALSE){                        $this->load->view("clientes/validar",$detalle);                    }else{            if($this->input->post("txtPassword")!=$this->input->post("txtPasswordRE")){                $detalle['error']="<div class='alert alert-error'>El password debe ser igual</div>";                $this->load->view("clientes/validar",$detalle);              }else{                $this->load->model("vendedor_model");                $this->vendedor_model->modificar($id_vendedor,array("ClaveVendedor"=>md5($this->input->post("txtPassword")),"FechavalidacionVendedor"=>date("Y-m-d h:m:s")));                redirect("login");            }        }    }    public function recuperar(){        $this->load->library('form_validation');        //$this->form_validation->set_rules('txtRutUsuario','Rut','required|callback_valida_rut');        $this->form_validation->set_rules('txtCorreo','Correo','required');        if($this->form_validation->run()===FALSE){                        $this->load->view("clientes/recuperar");                    }else{                            $this->load->model("vendedor_model");                $vendedor=$this->vendedor_model->get_vendedores("*",array("CorreoVendedor"=>$this->input->post("txtCorreo")));                if($vendedor==false){                     $detalle['error']="<div class='alert alert-error'>El password debe ser igual</div>";                     $this->load->view("clientes/recuperar",$detalle);                }else{                    $this->load->library("email");                    $config['protocol'] = 'sendmail';                    $config['mailpath'] = '/usr/sbin/sendmail';                    $config['charset'] = 'iso-8859-1';                    $config['wordwrap'] = TRUE;                    $config['mailtype']='html';                    $this->email->initialize($config);                    $this->email->from("info@nutramarket.cl","informaciones");                    $this->email->to($this->input->post("txtCorreo"));                    $this->email->subject('Recuperar password');                    $base_url=str_replace("admin/","",base_url());                    $mensaje="<html><head></head><body>Para resetear su clave, debe ir a esta direccion <a href='".$base_url."validacion/".$vendedor[0]['idVendedor']."'>AQUI</a></body></html>";                    $this->email->message($mensaje);                    $mensaje_alt="Para resetear su clave, debe ir a esta direccion ".$base_url."validacion/".$vendedor[0]['idVendedor'];                                        $this->email->set_alt_message($mensaje_alt);                    $this->email->send();                    $detalle['error']="<div class='alert alert-error'>En instantes recibiras un correo para recuperar tu contrase&ntilde;a</div>";                    $this->load->view("clientes/recuperar",$detalle);                }                                   }            }    public function modificar(){        $this->load->model("common_model");        $this->load->model("vendedor_model");        $id_vendedor=$this->session->userdata("id_vendedor");        //echo $id_vendedor;        $detalle['estado']=$this->common_model->get_estado_vendedor();        $this->data['titulo']="Vendedores - Modificar";              $this->load->library('form_validation');          $this->form_validation->set_rules('txtNombreVendedor','Nombre','required');        //$this->form_validation->set_rules('txtApellidoVendedor','Apellido','required');        //$this->form_validation->set_rules('txtRutVendedor','Rut','required');        $this->form_validation->set_rules('txtCorreo','Correo','required|valid_email');        $this->form_validation->set_rules('txtTelefono','Telefono','required');        $this->form_validation->set_rules('txtDireccion','Direccion','required');        //$this->form_validation->set_rules('cboEstado','Estado','required');                if($this->form_validation->run()===FALSE){                        $detalle['vendedor']=$this->vendedor_model->get_vendedor($id_vendedor);                                }else{            if($this->input->post("chkCambiarpass")){                $campos=array(                    "NombreVendedor"=>$this->input->post("txtNombreVendedor"),                    "ApellidoVendedor"=>$this->input->post("txtApellidoVendedor"),                    "CorreoVendedor"=>$this->input->post("txtCorreo"),                    "CorreoconfirmacionVendedor"=>$this->input->post("txtCorreo"),                    "TelefonoVendedor"=>$this->input->post("txtTelefono"),                    "ComunaVendedor_text"=>$this->input->post("txtComuna"),                    "DireccionVendedor"=>$this->input->post("txtDireccion"),                    "ClaveVendedor"=>$this->input->post("txtPassword")                );            }else{                $campos=array(                    "NombreVendedor"=>$this->input->post("txtNombreVendedor"),                    "ApellidoVendedor"=>$this->input->post("txtApellidoVendedor"),                    "CorreoVendedor"=>$this->input->post("txtCorreo"),                    "CorreoconfirmacionVendedor"=>$this->input->post("txtCorreo"),                    "TelefonoVendedor"=>$this->input->post("txtTelefono"),                    "ComunaVendedor_text"=>$this->input->post("txtComuna"),                    "DireccionVendedor"=>$this->input->post("txtDireccion")                );            }            $this->vendedor_model->modificar($id_vendedor,$campos);            $detalle['vendedor']=$this->vendedor_model->get_vendedor($id_vendedor);                        $detalle['estado']="Datos Guardados satisfactoriamente";        }        $this->load->view("template/header", $this->data);        $this->load->view("clientes/modificar",$detalle);        $this->load->view("template/footer", $this->data);        //redirect("listado_vendedores");            }}