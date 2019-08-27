<!-- DataTables -->
<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">



    <style type="text/css">
    
    .uppercase{

        text-transform: uppercase;
    }
</style>


 <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
<!--                                                         <h4 class="page-title">Tax Type</h4>
 -->

 <?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
                    <div class="alert btn-info alert-micro btn-rounded pastel light dark" >
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <?php print_r($msg); ?>
                    </div>
                    <?php } ?>


                    <?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
                    <div class="alert alert-micro btn-rounded alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <?php print_r($msg); ?>
                    </div>
                    <?php } ?>
                       

          
                     <div class="row">
                        <div class="col-sm-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
                                <header class="panel-heading" style="color:rgb(255, 255, 255)">
              <i class="zmdi zmdi-shopping-cart-plus">&nbsp;Item Reports</i>
                                </header>
                                <div class="card-box table-responsive">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                        </a>
                                    </div>
                         <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Item N0</th>
                                            <th>Item Name</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i=1;
                                        foreach($item as $u)
                                            {?><tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo date('d-m-Y',strtotime($u['itemno']));?></td>
                                        <td><?php echo $u['itemno'];?></td>
                                        <td><?php echo $u['itemname'];?></td>
                                        <td><?php echo $u['price'];?></td>
                                        <td>
                                         <div class="btn-group">
                                                    <button type="button" class="btn
                                                    btn-info dropdown-toggle waves-effect waves-light"
                                                    data-toggle="dropdown" aria-expanded="false">Manage</button>
                                                    <ul class="dropdown-menu"
                                                    role="menu" style="background: #1EBFB9 none repeat scroll
                                                    0% 0%;width:14px;min-width:100%">                                                           
                                                    <li><a href="#edit<?php echo $u['id'];?>" data-toggle="modal" 
                                                    data-overlayspeed="100" data-overlaycolor="#36404a" style="color:
                                                    white; font-weight: bold; background-color: #1EBFB9" data-toggle="modal">Edit</a></li>

                                                   
                                                    <li> <a href="#delete<?php echo $u['id'];?>" data-toggle="modal"  style="color:
                                                    white; font-weight: bold; background-color: #1EBFB9">Delete</a></li>
                                                    </ul>   
                                                </div>
                                                </td>
                                    </tr>
                                   <?php } ?>
                                </tbody>
                            </table>
                                </div>
                            </div>
                        </div>
                    </div>


<?php foreach($item as $row) {?>

  <div id="delete<?php echo $row['id'];?>" class="modal fade">
            <section class="panel panel-info panel-color" style="margin: 57px 24px 9px 395px; position: absolute;">
                <header class="panel-heading">
                    <h2 class="panel-title">Delete</h2>
                </header>
                <div class="panel-body" style="background-color: #fff;">
                    <div class="modal-wrapper">
                        <div class="modal-text">
                    <p>Are u sure to delete this data?</p>
                        </div>
                    </div>

                    <div class="row m-t-20">
                        <div class="col-md-12 text-right">
                        <form name="form" action="<?php echo base_url();?>item/delete" method="post" id="form1">
                        <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                        <div class="col-offset-4" align="center">
                        </div>
                      
                            <button id="dialogConfirm" class="btn btn-primary waves-effect waves-light">Confirm</button>
                            <button id="dialogCancel" data-dismiss="modal" class="btn btn-default waves-effect">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

            </section>
        </div>
<?php }?>




<?php foreach($item as $row) {?>

  <div id="edit<?php echo $row['id'];?>" class="modal fade">
            <section class="panel panel-info panel-color" style="margin: 144px 242px 3px 274px; position: absolute;">
                <header class="panel-heading">
                    <h2 class="panel-title"> <i class="zmdi zmdi-edit">&nbsp;Edit&nbsp;</h2></i>
                </header>
                <div class="panel-body" style="background-color: #fff;">
                  

                    <div class="row m-t-20">
                        <div class="col-md-12 text-right">
                        <form class="form-horizontal"  method="post" action="<?php echo base_url();?>item/update">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Item No</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="itemno" id="itemno" value="<?php echo $row['itemno'];?>" readonly>
                                                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                                <div id="name_valid"></div>
                                            </div>
                                            <label class="col-md-2 control-label" >Item Name</label>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" name="itemname" id="itemname" value="<?php echo $row['itemname'];?>" >
                                                <div id="itemname_valid"></div>
                                                <div id="itemnames_valid"></div>
                                            </div>
                                            <label class="col-md-1 control-label">Price</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="price" id="price" value="<?php echo $row['price'];?>" onkeypress="return isNumberKey(event)">
                                                <div id="price_valid"></div>
                                                <div id="prices_valid"></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-offset-4">
                                            <button  class="btn btn-info" id="submit">Update</button>
                                            <button  class="btn btn-default" data-dismiss="modal" id="submit">Cancel</button>
                                        </div>
                      
                        
                            </form>
                        </div>
                    </div>
                </div>

            </section>
        </div>
<?php }?>


        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

         <script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>

 <script src="<?php echo base_url();?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>        


 
<script type="text/javascript">
//   //number..........................
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

function validateEmail(emailField){
        var reg = /^([a-za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField.value) == false) 
        {
            alert('Invalid Email Address');

             $('#email').focus();
            return false;
        }

        return true;

}
$('.decimal').keyup(function(){
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2)
          val =val.replace(/\.+$/,"");
    }
    $(this).val(val);
});
</script>