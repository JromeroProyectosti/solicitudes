                
        </div>
    </div>
      <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?=base_url();?>bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url();?>bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url();?>bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?=base_url();?>bootstrap/bower_components/raphael/raphael-min.js"></script>
    <script src="<?=base_url();?>bootstrap/bower_components/morrisjs/morris.min.js"></script>
  
    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url();?>bootstrap/dist/js/sb-admin-2.js"></script>
    <script src="<?=base_url();?>js/ajax.js" type="text/javascript"></script>
    <script src="<?=base_url()?>bootstrap/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>bootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <?php
    
    if(isset($scripts)){
     echo $scripts;
    }
    ?>
</body>
</html>