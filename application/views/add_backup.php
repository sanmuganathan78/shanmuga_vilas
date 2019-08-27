  <?php $data=$this->db->get('profile')->result();
                        foreach($data as $r)
                        ?>
        <title> <?php echo $r->companyname;?></title>

<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

<style type="text/css">
    .uppercase{
        text-transform: uppercase;
    }
</style>
<div class="content-page">
    <div class="content">
        <div class="container">
            <?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
            <div class="alert btn-info alert-micro btn-rounded pastel light dark" >
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php print_r($msg); ?>
            </div>
            <?php } ?>

            <?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
            <div class="alert btn-info btn-rounded alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php print_r($msg); ?>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
                        <header class="panel-heading" style="color:rgb(255, 255, 255)">
                            <i class="fa  fa-cloud-download ">&nbsp;Backup</i></header>
                            <div class="card-box">
                                <div class="row">
                                      <?php 
            for($i = 1; $i<= 1; $i++){
            
              if($i ==  1)  $type = 'fullbackup';
              // else if($i ==  2)$type = 'dcbill';
              
              // else if($i ==  3)$type = 'expense';
              // else if($i ==  4)$type = 'invoice';
            
              // else if($i ==  5)$type = 'quotation';
              // else if($i ==  6)$type = 'stock';
              // else if($i ==  7)$type = 'vat';
              // else if($i ==  8)$type=  'item';
              // else if($i ==  9)$type=  'membership';
            
              // else if($i ==  10)$type= 'collection';
              //else if($i  ==  11)$type= 'all';
              ?>
                                                
                            <!--        <form action="<?php echo base_url();?>admin/add_users/addusers" method="post" id="add_users" name="add_users" >
          --> 
<!--                           <td><?php echo ($type);?></td>
 -->
                    <div class="button-list">
                    <label>&nbsp;</label>
                    <label>&nbsp;</label>
                    <label>&nbsp;</label>
                     <a href="<?php echo base_url();?>backup/create/<?php echo $type;?>"><button type="button" class="btn btn-info btn-rounded waves-effect waves-light">
                        <span class="btn-label"><i class="zmdi zmdi-download"></i>
                        </span>Download</button></a> 
                      </div>
                 
                    
                     
                                    <!--    <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                                                Cancel
                                            </button>
                                        </div> -->
                                            <?php 
            }
            ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            
            
                    </div>




                    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
                    <script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
                    <script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('.decimal').keyup(function(){
                                var val = $(this).val();
                                if(isNaN(val)){
                                    val = val.replace(/[^0-9\.]/g,'');
                                    if(val.split('.').length>2)
                                        val =val.replace(/\.+$/,"");
                                }
                                $(this).val(val);
                            });
                            $('#submit').click(function(){
                                var taxtype=$('#taxtype');
                                var taxname=$('#taxname');
                                if(taxtype.val()=='')
                                {
                                    taxtype.focus();
                                    $('#tax_valid').html('<span><font color="red"> Enter the taxtype  </span>');
                                    taxtype.keyup(function(){
                                        $('#tax_valid').html('');
                                    });
                                    return false;
                                }
                                if(taxname.val()=='')
                                {
                                    taxname.focus();
                                    $('#taxname_valid').html('<span><font color="red"> Enter the tax</span>');
                                    taxname.keyup(function(){
                                        $('#taxname_valid').html('');
                                    });
                                    return false;
                                }
                            });
});
</script>
<script type="text/javascript">
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    function onlyAlphabets(evt) {
        var charCode;
        if (window.event)
charCode = window.event.keyCode;  //for IE
else
charCode = evt.which;  //for firefox
if (charCode == 32) //for &lt;space&gt; symbol
return true;
if (charCode > 31 && charCode < 65) //for characters before 'A' in ASCII Table
    return false;
if (charCode > 90 && charCode < 97) //for characters between 'Z' and 'a' in ASCII Table
    return false;
if (charCode > 122) //for characters beyond 'z' in ASCII Table
    return false;
return true;
}
</script>
