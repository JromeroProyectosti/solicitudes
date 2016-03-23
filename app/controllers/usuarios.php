<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->data['nombre_completo']=$this->session->userdata('nombre_completo');
        $this->data['nombre_empresa']=$this->session->userdata('nombre_empresa');
        $this->data['sucursales']=$this->session->userdata('sucursales');
        $this->data['usuario']=$this->session->userdata('username');
    }

    public function index(){
        $this->data['titulo']=ucfirst("Login");
        $this->data['error']="";
        //$this->load->view("template/header",$this->data);
        $this->load->view("login",$this->data);
        //$this->load->view("template/footer",$this->data);
        $this->session->sess_destroy();
        //$this->config->set_item("navigation","");
    }
    public function ini_session(){
        $usuario=$_POST['txtUsuario'];
        $password=$_POST['txtPassword'];
        $query=$this->usuarios_model->very_user($usuario,$password);
        if($query){
            $id_usuario=0;
            $nombre_completo='';
            $nombre_empresa='';
            $tipo_empresa='';
            $rol='';
            $idMaestra='';
            $logo='';
            $sucursales='';
            foreach($query as $row){
                $id_usuario=$row['IdUsuario'];
                $nombre_completo=$row['NombreUsuario']." ".$row['ApellidoUsuario'];
                //$nombre_empresa=$row['NombreEmpresa'];
                //$tipo_empresa=$row['TipoEmpresa'];
                $rol=$row['NombreTipousuario'];
                //$idMaestra=$row['IdMaestra'];
                //$logo=$row['Logo'];
                //$sucursales.=$row['NombreSucursal']."<br>";

            }
            $this->session->set_userdata(array(
                    'id_usuario'=>$id_usuario,
                    'username'=>$usuario,
                    'nombre_completo'=>$nombre_completo,
                    'nombre_empresa'=>$nombre_empresa,
                    'tipo_empresa'=>$tipo_empresa,
                    'rol'=>$rol,
                    'idMaestra'=>$idMaestra,
                    'logo'=>$logo,
                    'sucursales'=>$sucursales));
            $menu=array(
                    'HOME'=> array(
                            'id'=>'home',
                            'title'=>'Home',
                            'link'=>'#'),
                    'Empresas'=>array(
                            'id'=>'empresa',
                            'title'=>'Empresas',
                            'link'=>'listado_empresa'),
                    'Usuario'=>array(
                            'id'=>'usuario',
                            'title'=>'Usuario',
                            'link'=>'#')
                    );
            //$this->config->item("navigation",$menu);
            
            switch ($rol){
                case "Informe":
                    redirect("informes/stock");
                    break;
                case "Vendedor";
                    redirect(base_url()."solicitudes_reservadas");
                    break;
                case "Administrador";
                    redirect(base_url()."solicitudes_reservadas");
            }
        }else{
            $this->data['titulo']=ucfirst("Login");
            $this->data['error']="<div class='alert alert-error'>El Usuario/Password es incorrecto</div>";
            //$this->load->view("template/header",$this->data);
            $this->load->view("login",$this->data);
            //$this->load->view("template/footer",$this->data);
            $this->session->sess_destroy();
        }
    }
    public function cli_ini_session($id_vendedor){
        $this->load->model("vendedor_model");
        $query=$this->vendedor_model->very_user($id_vendedor);
        if($query){
            $id_vendedor=0;
            $nombre_completo='';
            $usuario='';
            $nombre_empresa='';
            $tipo_empresa='';
            $rol='';
            $idMaestra='';
            $logo='';
            $sucursales='';
            foreach($query as $row){
                $id_vendedor=$row['idCliente'];
                $nombre_completo=$row['NombreCliente']." ".$row['ApellidoCliente'];
                $usuario=$row['CorreoCliente'];
                //$nombre_empresa=$row['NombreEmpresa'];
                //$tipo_empresa=$row['TipoEmpresa'];
                //$rol=$row['IdTipousuario'];
                //$idMaestra=$row['IdMaestra'];
                //$logo=$row['Logo'];
                //$sucursales.=$row['NombreSucursal']."<br>";

            }
            $this->session->set_userdata(array(
                    'id_cliente'=>$id_vendedor,
                    'username_cliente'=>$usuario,
                    'nombre_completo_cliente'=>$nombre_completo,
                    'nombre_empresa_cliente'=>$nombre_empresa,
                    'tipo_empresa_cliente'=>$tipo_empresa,
                    'rol_cliente'=>$rol,
                    'idMaestra_cliente'=>$idMaestra,
                    'logo_cliente'=>$logo,
                    'sucursales_cliente'=>$sucursales));
            $menu=array(
                    'HOME'=> array(
                            'id'=>'home',
                            'title'=>'Home',
                            'link'=>'#'),
                    'Empresas'=>array(
                            'id'=>'empresa',
                            'title'=>'Empresas',
                            'link'=>'listado_empresa'),
                    'Usuario'=>array(
                            'id'=>'usuario',
                            'title'=>'Usuario',
                            'link'=>'#')
                    );
            //$this->config->item("navigation",$menu);
            $base_url=  str_replace("admin/", "", base_url());
            redirect(base_url()."clientes");
        }else{
            $this->data['titulo']=ucfirst("Login");
            $this->data['error']="<div class='alert alert-error'>El Usuario/Password es incorrecto</div>";
            $this->load->view("template/header",$this->data);
            $this->load->view("listado_clientes",$this->data);
            $this->load->view("template/footer",$this->data);
            //$this->session->sess_destroy();
        }
    }
}