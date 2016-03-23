                
        </div>
    </div>
    <div class="col-sm-12 text-center"><font size='1'>Powered By <a href="http://www.proyectosti.cl">Proyectos TI LTDA.</a></font></div>
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
    <!--<script src="<?=base_url()?>bootstrap/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>-->
    <script src="<?=base_url()?>bootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/jquery.table2excel.js"></script>
    <!--<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js">
	</script>-->
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.1.1/js/dataTables.buttons.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.1.1/js/buttons.flash.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.1.1/js/buttons.html5.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.1.1/js/buttons.print.min.js"></script>
    <?php
    
    if(isset($scripts)){
     echo $scripts;
    }
    ?>
</body>
</html>