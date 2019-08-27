<?php $data=$this->db->get('profile')->result(); 
  foreach($data as $d)
    ?>
  <title> <?php echo $d->companyname;?></title>

<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">


<style type="text/css">
  .forms{ }
  .forms input{ width: 95%; }

  .uppercase {
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
<div class="alert btn-primary alert-micro btn-rounded pastel light dark" >
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
        <i class="zmdi zmdi-view-headline">&nbsp;Invoice Party Statements  </i>
      </header>
      <div class="card-box table-responsive">
        <div class="dropdown pull-right">
          <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
          </a>
        </div>
        <form name="from" id="form-filter" method="post" >
          <table >
            <tr>
              <!--<td>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="invoiceno" id="invoiceno" style="font-size:16px;width: 140px;" value="" placeholder="Invoice No">
                </div>
              </td>-->
			<input type="hidden" class="form-control" name="invoiceno" id="invoiceno" style="font-size:16px;width: 140px;" value="" placeholder="Invoice No">
              <td>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="customername" id="customername" style="font-size:16px;width: 255px;" value="" placeholder="Party Name">
                </div>
              </td>
              <td>
                <div class="col-sm-12">
                  <input type="text" class="form-control  datepicker-autoclose" name="fromdate" id="fromdate" style="font-size:16px;width:143px;" value="" placeholder="From Date">
                </div>
              </td>
              <td>
                <input type="text" class="form-control datepicker-autoclose" name="todate" id="todate" style="font-size:16px;width:143px;" value="" Placeholder="To Date">
              </td>
              <td>&nbsp;</td>       
              <td>
              </td>
              <td>&nbsp;&nbsp;&nbsp;</td>
              <td>

                <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                <button type="button" id="btn-reset" class="btn btn-default">Reset</button>

              </td>
            </tr>
          </table>
        </form>
        <br>
        <table id="table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Date</th>
              <th>Invoice No</th>
              <th>Receipt No</th>
              <th>Company Name</th>
              <th>Invoice</th>
              <th>Return Amt</th>
              <th>Receipt</th>
              <th>Payment Mode</th>
            </tr>
          </thead>
          <tbody>
<!--  <?php 
$i=1;
foreach($view as $u)
{?><tr>
<td><?php echo $i++;?></td>
<td><?php echo date('d-m-Y',strtotime($u['receiptdate']));?></td>
<td><?php echo $u['invoiceno'];?></td>
<td><?php echo $u['receiptno'];?></td>
<td><?php echo $u['suppliername'];?></td>

<td><?php echo ucfirst($u['paymentdetails']);?></td>
<td><?php echo $u['paid'];?></td>
<td>
<?php $balance=$u['balance'];

if($balance==0)
{
echo'<button class="btn btn-success btn-rounded">Paid</button>';

}

else if($balance > 0)
{
echo'<button class="btn btn-warning btn-rounded">Pending</button>';
}

?>
</td>

</tr>
<?php } ?> -->



</tbody>
</table>


        
	<div align="center">
		<form method="post" name="printForm" id="printForm" target="_blank" action="<?php echo base_url();?>invoice_statement/search_reports">
			<input type="hidden" name="sinvoiceno" id="sinvoiceno">
			<input type="hidden" name="scustomername" id="scustomername">
			<input type="hidden" name="sfromdate" id="sfromdate">
			<input type="hidden" name="stodate" id="stodate">
			<input type="hidden" name="rcbio_bill_format" id="rcbio_bill_format">
			<button id="print" class="btn btn-info" value="Print">Print</button>
		</form>
	</div>


<?php if($_POST) {?>
<form name="form" method="post" action="<?php echo base_url();?>purchase_pending/reports" target="_blank" >
  <table>
    <tr>
      <td><input type="hidden" name="fromdate" class="form-control" 
        value="<?php if($this->input->post('fromdate')){echo $this->input->post('fromdate');}?>"></td>
        <td><input type="hidden" name="todate" class="form-control" value="<?php if($this->input->post('todate')){echo $this->input->post('todate');}?>"></td>

        <td><input type="hidden" name="suppliername" class="form-control" value="<?php if($this->input->post('suppliername')){echo $this->input->post('suppliername');}?>"></td>


        <td><input type="submit" class="btn btn-info" name="submit" value="Print Reports" style="margin-left:300px;"></td>
      </tr>
    </table>
  </form>
  <?php }?>    


</div>


</div>

</div>
</div>








<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>

<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
  $('.colorpicker-default').colorpicker({
    format: 'hex'
  });
  $('.colorpicker-rgba').colorpicker();

// Date Picker
jQuery('#datepicker').datepicker();
jQuery('.datepicker-autoclose').datepicker({
  autoclose: true,
  todayHighlight: true
});
</script>
<script type="text/javascript">
  $(document).ready(function(){

    $( "#customername" ).autocomplete({
      source: function(request, response) {
        $.ajax({ 
          url: "<?php echo base_url();?>invoice/autocomplete_customername",
          data: { keyword: $("#customername").val()},
          dataType: "json",
          type: "POST",
          success: function(data){              
            response(data);
          }    
        });
      },
    });


     $( "#invoiceno" ).autocomplete({
      source: function(request, response) {
        $.ajax({ 
          url: "<?php echo base_url();?>invoice_statement/autocomplete_name",
          data: { keyword: $("#invoiceno").val()},
          dataType: "json",
          type: "POST",
          success: function(data){              
            response(data);
          }    
        });
      },
    });


  });

</script>


<script type="text/javascript">

  var table;

  $(document).ready(function() {

//datatables
table = $('#table').DataTable({ 

"processing": true, //Feature control the processing indicator.
'bnDestroy' :true,
"serverSide": true, //Feature control DataTables' server-side processing mode.
"order": [], //Initial no order.

// Load data for the table's content from an Ajax source
"ajax": {
  "url": "<?php echo site_url('invoice_statement/ajax_list')?>",
  "type": "POST",
  "data": function ( data ) {
    data.invoiceno = $('#invoiceno').val();
    data.customername = $('#customername').val();
    data.fromdate = $('#fromdate').val();
    data.todate = $('#todate').val();

  }
},

//Set column definition initialisation properties.
"columnDefs": [
{ 
"targets": [ 0 ], //first column / numbering column
"orderable": false, //set not orderable
},
],

});

$('#btn-filter').click(function(){ //button filter event click
if($('#customername').val()=='') { alert('Please select party name!'); return false; }
table.search('').draw();
$('#print').show();
table.ajax.reload(null,false);  //just reload table
});
$('#btn-reset').click(function(){ //button reset event click
	table.search('').draw();
	$('#form-filter')[0].reset();
	$('#print').show();
table.ajax.reload(null,false);  //just reload table
});
$('.dataTables_filter input').unbind().keyup(function(e) {
    var value = $(this).val();
    if (value.length>0) {
        table.search(value).draw();
		//console.log('if');
		$('#print').hide();
    } else {     
        //optional, reset the search if the phrase 
        //is less then 3 characters long
        table.search('').draw();
	  // console.log('else');
	   $('#print').show();
    }        
});


	$('#print').click(function(){
		var fromdate = $('#fromdate').val();
		var todate = $('#todate').val();
		var invoiceno = $('#invoiceno').val();
		var customername = $('#customername').val();
		$("#sfromdate").val(fromdate);
		$("#stodate").val(todate);
		$("#sinvoiceno").val(invoiceno);
		$("#scustomername").val(customername);
		$('#rcbio_bill_format').val('Print');
		$("#printForm").submit();
		
		/*$.post('<?php echo base_url();?>invoice_statement/search',{'fromdate':fromdate,'customername':customername,'todate':todate,'invoiceno':invoiceno},function(data){
			window.open('<?php echo base_url();?>invoice_statement/search_reports', '_blank');
		});*/
	});

$('#download').click(function(){
 var fromdate = $('#fromdate').val();
  var todate = $('#todate').val();
  var invoiceno = $('#invoiceno').val();
  var customername = $('#customername').val();

  $.post('<?php echo base_url();?>invoice_statement/billing_reportdownload',{'fromdate':fromdate,'todate':todate,'invoiceno':invoiceno,'customername':customername},function(data){

    window.open('<?php echo base_url();?>invoice_statement/search_reports', '_blank');

  });

});

});

function edit_person(id)
{

//alert(id);

$.post('<?php echo base_url();?>admin/add_billing/viewbilling',{'id':id},function(data){

  $('.viewdetails').html(data);

  $('#view_billing').modal('show');

});
}
  </script>      

	<script>
		// Get the modal
		var modal = document.getElementById('myModal');

		// Get the image and insert it inside the modal - use its "alt" text as a caption
		var img = document.getElementById('myImg');
		var modalImg = document.getElementById("img01");
		var captionText = document.getElementById("caption");
		img.onclick = function(){
			modal.style.display = "block";
			modalImg.src = this.src;
			captionText.innerHTML = this.alt;
		}

		// Get the <span> element that closes the modal
		var span = document.getElementById("close1");

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() { 
			modal.style.display = "none";
		}
		
		//Company Logo
		// Get the modal
		var modal = document.getElementById('myModalCmp');

		// Get the image and insert it inside the modal - use its "alt" text as a caption
		var img = document.getElementById('myImgCmp');
		var modalImg = document.getElementById("img01Cmp");
		var captionText = document.getElementById("captionCmp");
		img.onclick = function(){
			modal.style.display = "block";
			modalImg.src = this.src;
			captionText.innerHTML = this.alt;
		}

		// Get the <span> element that closes the modal
		var span = document.getElementById("closeCmp");

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() { 
			modal.style.display = "none";
		}
 	</script>
	<!--Start of Tawk.to Script-->
<script type="text/javascript">
// var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
// (function(){
// var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
// s1.async=true;
// s1.src='https://embed.tawk.to/57d9511fcccb3b470ce185bf/default';
// s1.charset='UTF-8';
// s1.setAttribute('crossorigin','*');
// s0.parentNode.insertBefore(s1,s0);
// })();
</script>
<!--End of Tawk.to Script-->