<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sec_productos extends My_Controller{

    public function __construct() {
        parent::__construct(true);
        $this->data['titulo']="";

    }

    public function listar(){

        $this->load->model("productos_model");

        $this->data['titulo']="Productos - Listado";        
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-productos').DataTable({
                responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
    });
</script>";
        $detalle['listado']=$this->productos_model->get_listado_productos("*",NULL,array("EstadoProducto"=>1));
        $this->load->view("template/header",$this->data);

        $this->load->view("mantenedores/productos/listado",$detalle);

        $this->load->view("template/footer",$this->data);

    }
     public function listar_categoria(){

        $this->load->model("productos_model");
        $this->data['titulo']="Productos - Listado";
        $this->data['scripts']="<script>
    $(document).ready(function() {
        $('#datatable-productos').DataTable({
                responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
        });
    });
</script>";

        $detalle['listado']=$this->productos_model->get_listado_categorias();

        $this->load->view("template/header",$this->data);

        $this->load->view("mantenedores/categorias/listado",$detalle);

        $this->load->view("template/footer",$this->data);

    }

    public function crear(){



        $this->load->library('form_validation');

 

        $this->form_validation->set_rules('txtCodigo','C&oacute;digo','required');

       // $this->form_validation->set_rules('txtCodigoCatalogo','C&oacute;digo Catalogo','required');

        $this->form_validation->set_rules('txtDescripcion','Descripci&oacute;n','required');

        $this->form_validation->set_rules('txtCosto','Costo','required');

        $this->form_validation->set_rules('txtPrecioCatalogo','Precio Catalogo','required');

        $detalle='';

        $detalle['categorias']=$this->common_model->get_categorias();

        //$this->form_validation->set_rules('cboTipoEmpresa','Tipo Empresa','required');

        if($this->form_validation->run()===FALSE){

                $this->data['titulo']="Usuario - Agregar";

                //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();

                

                $this->load->view("template/header",$this->data);

                $this->load->view("mantenedores/productos/agregar",$detalle);

                $this->load->view("template/footer",$this->data);

        }else{

            $this->load->model("productos_model");

            $campos=array("CodigoProducto"=>$this->input->post("txtCodigo"),

                "DescripcionProducto"=>$this->input->post("txtDescripcion"),

                "PreciocompraProducto"=>$this->input->post("txtCosto"),

                "PrecioventaProducto"=>$this->input->post("txtPrecioCatalogo"),

                "idCategoria"=>$this->input->post("cboCategoria"),

                "StockProducto"=>$this->input->post("txtStock")

                );

            

          

            if($this->productos_model->crear($campos)){

                

                redirect('listado_productos');

            }else{

                $this->data['titulo']="Usuario - Agregar";

                //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();

                

                $this->load->view("template/header",$this->data);

                $this->load->view("mantenedores/productos/agregar",$detalle);

                $this->load->view("template/footer",$this->data);

            }

          

        }

    }

    public function crear_categoria(){



        $this->load->library('form_validation');

 

        $this->form_validation->set_rules('txtNombre','Nombre','required');

       

        $detalle='';

        

        //$this->form_validation->set_rules('cboTipoEmpresa','Tipo Empresa','required');

        if($this->form_validation->run()===FALSE){

                $this->data['titulo']="Categoria - Agregar";

                //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();

                

                $this->load->view("template/header",$this->data);

                $this->load->view("mantenedores/categorias/agregar",$detalle);

                $this->load->view("template/footer",$this->data);

        }else{

            $this->load->model("productos_model");

            $campos=$this->input->post("txtNombre");
            if($this->productos_model->crear_categoria($campos)){
                redirect('listado_categoria');

            }else{

                $this->data['titulo']="Categoria - Agregar";

                //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();

                

                $this->load->view("template/header",$this->data);

                $this->load->view("mantenedores/categorias/agregar",$detalle);

                $this->load->view("template/footer",$this->data);

            }

          

        }

    }

    public function modificar($id_producto){

        

        $this->load->library('form_validation');

        $this->load->model("productos_model");

        $detalle['id_producto']=$id_producto;

        $this->form_validation->set_rules('txtCodigo','C&oacute;digo','required');

        //$this->form_validation->set_rules('txtCodigoCatalogo','C&oacute;digo Catalogo','required');

        $this->form_validation->set_rules('txtDescripcion','Descripci&oacute;n','required');

        $this->form_validation->set_rules('txtCosto','Costo','required');

        $this->form_validation->set_rules('txtPrecioCatalogo','Precio','required');

        $detalle['categorias']=$this->common_model->get_categorias();

         if($this->form_validation->run()===FALSE){

            //$this->load->model("productos_model");
            $detalle['producto']=$this->productos_model->get_listado_productos("*",$id_producto);
            $this->data['titulo']="Usuario - Modificar";
            //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
            $this->load->view("template/header",$this->data);
            $this->load->view("mantenedores/productos/modificar",$detalle);
            $this->load->view("template/footer",$this->data);
        }else{
            $campos=array("CodigoProducto"=>$this->input->post("txtCodigo"),
                "DescripcionProducto"=>$this->input->post("txtDescripcion"),
                "PreciocompraProducto"=>$this->input->post("txtCosto"),
                "PrecioventaProducto"=>$this->input->post("txtPrecioCatalogo"),
                "idCategoria"=>$this->input->post("cboCategoria"),
                "StockProducto"=>$this->input->post("txtStock"));

            if($this->productos_model->modificar($id_producto,$campos)){

                redirect('listado_productos','refresh');

            }else{
                //$this->load->model("productos_model");
                $detalle['producto']=$this->productos_model->get_listado_productos("*",$id_producto);
                $this->data['titulo']="Usuario - Modificar";
                //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();
                $this->load->view("template/header",$this->data);
                $this->load->view("mantenedores/productos/modificar",$detalle);
                $this->load->view("template/footer",$this->data);

            }

        }

    }

    public function modificar_categoria($id_categoria){

        

        $this->load->library('form_validation');

        $this->load->model("productos_model");

        $detalle['id_categoria']=$id_categoria;

        $this->form_validation->set_rules('txtNombre','Nombre','required');

       

         if($this->form_validation->run()===FALSE){

            $this->load->model("productos_model");

            $detalle['producto']=$this->productos_model->get_listado_categorias($id_categoria);

            $this->data['titulo']="Categoria - Modificar";

            //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();



            $this->load->view("template/header",$this->data);

            $this->load->view("mantenedores/categorias/modificar",$detalle);

            $this->load->view("template/footer",$this->data);

        }else{



            if($this->productos_model->modificar_categoria($id_categoria,$this->input->post("txtNombre"))){

                redirect('listado_categoria');

            }else{

                $this->load->model("productos_model");

                $detalle['producto']=$this->productos_model->get_listado_categorias($id_categoria);

                $this->data['titulo']="Categorias - Modificar";

                //$detalle['tipo_empresa']=$this->empresas_model->get_tipo_empresa();

            

                $this->load->view("template/header",$this->data);

                $this->load->view("mantenedores/categorias/modificar",$detalle);

                $this->load->view("template/footer",$this->data);

            }

        }

    }

    public function eliminar($id_producto){

        $this->load->model("productos_model");

        $this->productos_model->eliminar($id_producto);

        redirect('listado_productos');

    }

    public function eliminar_categoria($id_categoria){

        $this->load->model("productos_model");

        $productos=$this->productos_model->get_listado_productos("*",$NULL,array("idCategoria"=>$id_categoria));

        

        if($productos!=false){

            $this->data="";

            $this->load->view("template/header",$this->data);

            $this->load->view("mantenedores/categorias/error_categoria");

            $this->load->view("template/footer",$this->data);

        }else{

            $this->productos_model->eliminar_categoria($id_categoria);

            redirect('listado_categoria');

        }

    }
    public function stock_mas_vendido(){
        $this->load->model("productos_model");

        if($this->input->post()){

            $filtro=array(
                "date(FechaingresoSolicitud) >="=>$this->input->post("txtFechaInicio"),
                "date(FechaingresoSolicitud) <="=>$this->input->post("txtFechaFin")
            );

            

        }else{

             $filtro=null;

            

        }

        $this->data['titulo']="Productos - Listado";

        $this->data['scripts']="<script>

        $(document).ready(function() {

             $('#btnExportar').click(function(event) {

             $('#datos_a_enviar').val( $('<div>').append( $('#datatable-productos').eq(0).clone()).html());

             $('#FormularioExportacion').submit();

        });

        });

</script>";

        $detalle['listado']=$this->productos_model->mas_vendidos("*",$filtro);

        $this->load->view("template/header",$this->data);

        $this->load->view("informes/mas_vendido",$detalle);

        $this->load->view("template/footer",$this->data);

    }

   
}