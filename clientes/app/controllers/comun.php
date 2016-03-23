<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comun extends CI_Controller{
    public function __construct(){		
            parent::__construct();
    }

    public function generaoptionciudad(){
        $region=$this->input->post('region');
      
        //$region=$this->input->get('region');
        $comuna=array();
        if($this->input->post('comuna')){
            $comuna=$this->common_model->get_comuna(0,$this->input->post('comuna'));
            
        }
        
        $data=$this->common_model->get_ciudad($region);
        $option='<option value=0>--Selecciona una Ciudad--</option>';
        foreach ($data as  $value) {
                # code...
                
                $option.='<option value="'.$value['IdCiudad'].'" ';
                if($value['IdCiudad']==$comuna[0]['IdCiudad']){
                    $option.= ' Selected ';
                }
                $option.='>'.$value['NombreCiudad'].'</option>';
        }

        echo $option;
    }
    public function generaoptioncomuna(){
        $ciudad=0;
        $region=0;
        if($this->input->post('ciudad')){
            $ciudad=$this->input->post('ciudad');
        }
        if($this->input->post('region')){
            $region=$this->input->post('region');
           
        }
        $data=$this->common_model->get_comuna($ciudad,0,$region);
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
    public function generajsonproductos($codigo){
        $this->load->model("productos_model");
        $resultado=$this->productos_model->get_listado_productos("*",null,array("CodigoProducto"=>$codigo,"EstadoProducto"=>1));
        echo json_encode($resultado);
    }
}