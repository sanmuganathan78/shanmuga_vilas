<?php $data=$this->db->get('profile')->result();
                        foreach($data as $r)
                        ?>
<title>
  <?php echo $r->companyname;?>
</title>
<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<style type="text/css">
.uppercase {
  text-transform: uppercase;
}
</style>
<div class="content-page">
  <div class="content">
    <div class="container">
      <?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
      <div class="alert btn-info alert-micro btn-rounded pastel light dark">
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
              <i class="zmdi zmdi-apps">&nbsp;Account Header</i></header>
            <div class="card-box">
              <div class="row">
                <form class="form-horizontal" method="post" action="<?php echo base_url();?>headers/insert">
                  <div class="form-group">
                    <label class="col-md-2 control-label">Header Name</label>
                    <div class="col-md-3">
                      <input type="text" class="form-control uppercase" name="name" id="name" required onkeypress="return onlyAlphabets(event)">
                      <div id="tax_valid"></div>
                      <div id="tax_valid1"></div>
                    </div>
                    <div class="col-md-2">
                      <button class="btn btn-info" id="submit">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
            <header class="panel-heading" style="color:rgb(255, 255, 255)">
              <i class="zmdi zmdi-apps">&nbsp;Account Header Reports</i>
            </header>
            <div class="card-box table-responsive">
              <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                </a>
              </div>
              <table id="datatable-keytable" class="table table-striped">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Date</th>
                    <th>Account Header</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                            $i=1;
                                            foreach ($vat as  $row) 
                                                { ?>
                    <tr>
                      <td>
                        <?php echo $i++;?>
                      </td>
                      <td>
                        <?php echo date('d-m-Y',strtotime($row['date']));?>
                      </td>
                      <td class="uppercase">
                        <?php echo $row['name'];?>
                      </td>
                      <td>
                        <a href="#delete<?php echo $row['id'];?>" data-toggle="modal" style="color:
                                                    white; font-weight: bold; background-color: #57C5A5" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr>
                    <?php }?>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
    <?php foreach($vat as $r) {?>
    <div id="delete<?php echo $r['id'];?>" class="modal fade">
      <div class="modal-dialog" style="width:40%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Delete </h4>
          </div>
          <div class="modal-text">
            <br>
            <p align="center">Are you sure to delete this data?</p>
          </div>
          <div class="modal-body">
            <div class="row">
              <form name="form" action="<?php echo base_url();?>headers/delete" method="post" id="form1">
                <input type="hidden" value="<?php echo $r['id'];?>" name="id">
                <div class="col-offset-4" align="center">
                </div>
                <div align="center">
                  <button id="dialogConfirm" class="btn btn-primary waves-effect waves-light">Confirm</button>
                  <button id="dialogCancel" data-dismiss="modal" class="btn btn-default waves-effect">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php }?>
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('.decimal').keyup(function() {
        var val = $(this).val();
        if (isNaN(val)) {
          val = val.replace(/[^0-9\.]/g, '');
          if (val.split('.').length > 2)
            val = val.replace(/\.+$/, "");
        }
        $(this).val(val);
      });
      $('#submit').click(function() {
        var taxtype = $('#taxtype');
        var taxname = $('#taxname');
        if (taxtype.val() == '') {
          taxtype.focus();
          $('#tax_valid').html('<span><font color="red"> Enter the taxtype  </span>');
          taxtype.keyup(function() {
            $('#tax_valid').html('');
          });
          return false;
        }
        if (taxname.val() == '') {
          taxname.focus();
          $('#taxname_valid').html('<span><font color="red"> Enter the tax</span>');
          taxname.keyup(function() {
            $('#taxname_valid').html('');
          });
          return false;
        }
      });
    });
    </script>
    <script type="text/javascript">
    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
      return true;
    }

    function onlyAlphabets(evt) {
      var charCode;
      if (window.event)
        charCode = window.event.keyCode; //for IE
      else
        charCode = evt.which; //for firefox
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
