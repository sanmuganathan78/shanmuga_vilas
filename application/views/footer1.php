     
      <?php $data=$this->db->get('profile')->result();
                        foreach($data as $r)
                        ?>
   <?php 
	$this->db->select('*');
	$this->db->from('preference_settings');
	$row=$this->db->get()->row_array();
	?>
    <footer class="footer">
   <?php echo date('Y');?> © <a  class="text-muted">&nbsp;<?php echo $row['cmp_companyname'];?></a>
   <span class="pull-right"><i class="fa fa-home"></i><?php echo $row['cmp_address1'];?>, <?php echo $row['cmp_address2'];?> - <?php echo $row['cmp_pincode'];?> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-phone"></i> <?php echo $row['cmp_phoneno'];?> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-mobile"></i> <?php echo $row['cmp_mobileno'];?></span>
</footer>
        <script>
            var resizefunc = [];
        </script>


        <!-- jQuery  -->
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/detect.js"></script>
        <script src="<?php echo base_url();?>assets/js/fastclick.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
                <script src="<?php echo base_url();?>assets/js/wow.min.js"></script>

       
       
        <!-- Datatables-->
        <script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
      
       

        <!-- App js -->
        <script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>