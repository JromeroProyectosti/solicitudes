<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comun extends CI_Controller{
    public function __construct(){		
            parent::__construct();
    }

    public function generaoptionciudad(){
        $region=$this->input->post('region');
        //$region=$this->input->get('region');

        $data=$this->common_model->get_ciudad($region);
        $option='<option value=0>--Selecciona una Ciudad--</option>';
        foreach ($data as  $value) {
                # code...
                $option.='<option value="'.$value['IdCiudad'].'">'.$value['NombreCiudad'].'</option>';
        }

        echo $option;
    }
    public function generaoptioncomuna(){
        $ciudad=$this->input->post('ciudad');
        $data=$this->common_model->get_comuna($ciudad);
        $option='<option value=0>--Selecciona una Comuna--</option>';
        foreach ($data as  $value) {
                # code...
                $option.='<option value="'.$value['IdComuna'].'">'.$value['NombreComuna'].'</option>';
        }

        echo $option;
    }
    public function generaoptionestadousuario(){
        $estado=$this->input->post('estadousuario');
        $data=$this->common_model->get_estado_usuario($estado);
        $option='<option value=0>--Selecciona un Estado--</option>';
        foreach ($data as  $value) {
                # code...
                $option.='<option value="'.$value['IdEstadousuario'].'">'.$value['NombreEstadousuario'].'</option>';
        }

        echo $option;
    }
    public function generaoptionestadovendedor(){
        $estado=$this->input->post('estadovendedor');
        $this->load->model("vendedor_model");
        $data=$this->vendedor_model->get_estado_vendedor($estado);
        $option='<option value=0>--Selecciona un Estado--</option>';
        foreach ($data as  $value) {
                # code...
                $option.='<option value="'.$value['IdEstadousuario'].'">'.$value['NombreEstadousuario'].'</option>';
        }

        echo $option;
    }
    public function generaoptionestadosolicitud(){
        $estado=$this->input->post('estadosolicitud');
        $this->load->model("vendedor_model");
        $data=$this->vendedor_model->get_estado_vendedor($estado);
        $option='<option value=0>--Selecciona un Estado--</option>';
        foreach ($data as  $value) {
                # code...
                $option.='<option value="'.$value['IdEstadousuario'].'">'.$value['NombreEstadousuario'].'</option>';
        }

        echo $option;
    }
    public function generaoptiontipousuario(){
        $tipousuario=$this->input->post('tipousuario');
        $data=$this->common_model->get_tipo_usuario($tipousuario);
        $option='<option value=0>--Selecciona un Rol--</option>';
        foreach ($data as  $value) {
                # code...
                $option.='<option value="'.$value['IdTipousuario'].'">'.$value['NombreTipousuario'].'</option>';
        }

        echo $option;
    }
    public function generaoptionformaenvio(){
        $tipousuario=$this->input->post('formaenvio');
        $data=$this->common_model->get_forma_envio();
        $option='<option value=0>--Selecciona una forma de envio--</option>';
        foreach ($data as  $value) {
                # code...
                $option.='<option value="'.$value['idFormaenvio'].'">'.$value['NombreFormaenvio'].'</option>';
        }

        echo $option;
    }
    public function generajsonproductos($codigo){
        $this->load->model("productos_model");
        $resultado=$this->productos_model->get_listado_productos("*",null,array("CodigoProducto"=>$codigo,"EstadoProducto"=>1));
        echo json_encode($resultado);
    }
    public function generajsonempresas($codigo){
        $this->load->model("empresas_model");
        $resultado=$this->empresas_model->listado_empresas(0,array("RutProveedor"=>trim($codigo)));
        echo json_encode($resultado);
    }
    public function exportar(){
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=ficheroExcel.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo $this->input->post("hdExportar");
    }
}