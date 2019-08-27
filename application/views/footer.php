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
        <script src="<?php echo base_url();?>assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo base_url();?>assets/js/waves.js"></script>
        <script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>


        <!--Morris Chart-->
      <!-- **  // <script src="<?php echo base_url();?>assets/plugins/morris/morris.min.js"></script> -->
        <!-- ** <script src="<?php echo base_url();?>assets/plugins/raphael/raphael-min.js"></script> -->


        <!-- Counter Up  -->
        <script src="<?php echo base_url();?>assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- Dashboard init -->
<!-- **        <script src="<?php echo base_url();?>assets/pages/jquery.dashboard.js"></script> -->


        
        <!-- App js -->
        <script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>

    </body>

<!-- Mirrored from coderthemes.com/flacto_1.3/green_1_light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Sep 2016 06:39:54 GMT -->
</html>