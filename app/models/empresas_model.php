<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Empresas_model extends CI_Model{
    public function __construct(){
            parent::__construct();
    }

    public function get_tipo_empresa(){
            $result=$this->db->get('tipoempresa');
            return $result->result_array();
    }

    public function add_empresa(){
            //$rutempresa=$this->input->post('hdIdEmpresa');
            //$this->db->set('RutProveedor',$this->input->post('txtRutEmpresa'));
            $this->db->set('NombreProveedor',$this->input->post('txtNombreEmpresa'));
            $this->db->set('RazonSocial',$this->input->post('txtRazonSocial'));
            /*$this->db->set('Telefonocontacto1Proveedor',$this->input->post('txtTelefono'));
            $this->db->set('Correocontacto1Proveedor',$this->input->post('txtDireccion'));
            $this->db->set('IdComuna', $this->input->post('cboComuna'));
            //$this->db->set('IdTipoempresa',$this->input->post('cboTipoEmpresa'));
            //$this->db->set('IdMaestra',$id_maestra);*/
            $this->db->insert('proveedores');
/*
            $this->db->set('RutEmpresa',$this->input->post('txtRutEmpresa'));
            $this->db->set('NombreSucursal','Matriz');
            $this->db->set('TelefonoSucursal',$this->input->post('txtTelefono'));
            $this->db->set('DireccionSucursal',$this->input->post('txtDireccion'));
            $this->db->set('IdComuna', $this->input->post('cboComuna'));
            $this->db->set('IdMaestra',$id_maestra);
            $this->db->insert('sucursal');*/

    }
    public function modificar_empresa(){


            $data=array('NombreProveedor'=>$this->input->post('txtNombreEmpresa'),
                            'RazonSocial'=>$this->input->post('txtRazonSocial')
                            
            );
            $this->db->where('idProveedor',$this->input->post('hdIdProveedor'));
            $this->db->update('proveedores',$data);

         

    }
    public function modificar($idProveedor,$campos=array()){

            $this->db->where('idProveedor',$idProveedor);
            $this->db->set($campos);
            $this->db->update('proveedores');

         

    }
    public function valida_rut($rut){
            $this->db->select("*");
            $this->db->where(array('RutProveedor'=>$rut,"idEstadoproveedor"=>1));
            $result=$this->db->get('proveedores');
            
            if($result->num_rows()){
                echo "true";
                    return true;
                    
            }
            else
            {
                echo "false";
                    return false;
            }

    }
    public function listado_empresas($id_maestra,$filtro=array()){
        
            

            $this->db->select('idProveedor,NombreProveedor, RutProveedor, RazonSocial, Contacto1Proveedor, Telefonocontacto1Proveedor, Correocontacto1Proveedor');
            $this->db->from('proveedores');
            if(is_array($filtro)){
                if(count($filtro)>0){
                    $this->db->where($filtro);
                }
                
            }
            //$this->db->join('tipoempresa','tipoempresa.IdTipoempresa=empresa.IdTipoempresa');
            //$this->db->where('IdMaestra',$id_maestra);
            $result=$this->db->get();

            if($result->num_rows()){
                    return $result->result_array();

            }else{
                    return false;
            }
    }
    public function get_empresa($idEmpresa){
            $this->db->select('idProveedor,NombreProveedor, RutProveedor, RazonSocial, Contacto1Proveedor, Telefonocontacto1Proveedor, Correocontacto1Proveedor,Contacto2Proveedor, Telefonocontacto2Proveedor, Correocontacto2Proveedor, IdComuna');
            $this->db->from('proveedores');
            //$this->db->join('tipoempresa','tipoempresa.IdTipoempresa=empresa.IdTipoempresa');
            $this->db->where(array('idProveedor'=>trim($idEmpresa),"idEstadoproveedor"=>1));

            $result=$this->db->get();

            if($result->num_rows()){
                    return $result->row_array();

            }else{
                    return false;
            }
    }
}