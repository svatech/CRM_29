<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">

<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">SMS Control Master</center>
 </div>
  -->
 <div class='lengthy_form'>
 <table align="center" border='1'>
 	<tr align="center" style="font-weight:bold;font-size:15pt;height:30px;background-color:#559999;color:white;border-right:1px solid  black;"><td width='50%'><span style="color:#550033">Name</span></td><td width='50%'><span style="color:#550033">Status</span></td></tr>
 	<tr  class='small' align="center" style="font-size:10pt;height:30px;color:black;border-right:1px solid  black;"><td width='50%'>SMS Bill After Purchase</td><td width='50%'>
 		<select name='smsbill' id='smsbill' onchange='change_sms_bill_opt(this.value)'>
 			<?php foreach($sms_status as $row){
 				$bill_flag=$row["bill_sms"];
 			}?>
 			<option value='active' <?php if($bill_flag=='active') echo "selected" ?> >Active</option>
 			<option value='inactive' <?php if($bill_flag=='inactive') echo "selected" ?> >Inactive</option>
 		</select>
 	</td></tr>
 </table>
 </div>
 
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/master_validation.js"></script>