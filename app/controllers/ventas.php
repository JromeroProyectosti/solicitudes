<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ventas
 *
 * @author informatica
 */
class Ventas extends MY_Controller{
    //put your code here
    public function __construct() {
        parent::__construct(true);
         $this->data['scripts']="<script>
                $(document).ready(function() {
                    $('#datatable-cuentas').DataTable({
                            responsive: true,
                'language':{
                    'url':'http://cdn.datatables.net/plug-ins/f2c75b7247b/i18n/Spanish.json'
                }
                    });
                });
            </script>";
    }
}
