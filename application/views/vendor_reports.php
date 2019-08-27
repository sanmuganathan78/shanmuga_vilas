
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <?php $data=$this->db->get('profile')->result();
                        foreach($data as $d)
                        ?>
        <title> <?php echo $d->companyname;?></title>
<style>
body{
 	font-family: Arial, Helvetica, sans-serif;
}
.padding .heading1 {
    padding: 8px;
	font-size:15px;
}
.padding {
    padding: 8px;
	font-size:12px;
}
.heading2 {
	padding: 6px;
    font-size: 13px;
    font-weight: bold;
}
</style>
</head>
<body>



  <div align="center">
    <table width="900" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
      <tr style="border-bottom: 1px dotted #000;
      ">
      <td class="heading1" width="316"><div align="center"><strong><?php echo $d->companyname;?></strong></div></td>
      <tr align="center">
        <td class="padding" width="134"><b><?php echo $d->address1;?><?php echo $d->address2;?>
          <br>Mobile No :&nbsp;<?php echo $d->phoneno;?>,&nbsp; Email:&nbsp;<?php echo $d->emailid;?><br>GSTIN :&nbsp;<?php echo $d->gstin;?></b></td>
       
        </tr>
      </tr>
    </table>
  </div>
<div align="center">
  <table width="900" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
    <tr style="border-bottom: 1px dotted #000;
    border-top: 1px dotted #000;">
      <td class="heading1" width="316"><div align="left"><strong>Vendor Reports</strong></div></td>
      <td class="padding" width="150">From Date :<?php  echo @date('d-m-Y',strtotime($this->input->post('fromdate')));?></td>
      <td class="padding" width="134">To Date : <?php  echo @date('d-m-Y',strtotime($this->input->post('todate')));?></td>
    </tr>
  </table>
</div>
<div align="center">
  <table width="900" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
    <tr style="border-bottom: 1px dotted #000;">
      <td class="heading2">S.No</td>
      <td class="heading2">Date</td>
      <td class="heading2">Vendor Name</td>
      <td class="heading2">Mobile No</td>
      <td class="heading2">Email Id</td>
    </tr>

<?php   $count=1; foreach($cus as $p) {


		$date=date('d-m-Y',strtotime($p['date']));
     $vendorname=$p['vendorname'];
		 $mobileno=$p['phoneno'];
     $location=$p['email'];
    // $total=$p['grandtotal'];
   

		






    echo'<tr>
      <td class="padding" valign="top">'.$count++.'</td>
      <td class="padding" valign="top">'.$date.'</td>
      <td class="padding" valign="top">'.$vendorname.'</td>
      <td class="padding" valign="top">'.$mobileno.'</td>
      <td class="padding" valign="top">'.$location.'</td>
    </tr>';
    }?>
   
   
  </table>

  <table width="900" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
    <tr style="border-bottom: 1px dotted #000;
    border-top: 1px dotted #000;">
      <td class="heading1" width="316"><div align="center"><strong></strong></div></td>
    </tr>
  </table>
</div>

          <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
          <script type="text/javascript">

          $(document).ready(function(){
            window.print();

          });
          </script>