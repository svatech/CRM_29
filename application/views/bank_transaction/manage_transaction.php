<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Bank Transaction Details</center>
 </div>
  -->
<div class='lengthy_form'>
 <div style="margin:10px 0px 0px 30px;font-weight:bold;">	
	<p style="margin-left: 30px;font-size:15px;display:inline">Transactions From</p>
	<input type="text" id="start_date"  class="datefld_txt" style="width:100px;height:20px;margin-left:20px"/>
	<p style="margin-left: 50px;font-size:15px;display:inline">To</p>
	<input type="text" id="end_date"  class="datefld_txt" style="width:100px;height:20px;margin-left:20px" />
	<input type="button" id="" class="txt2_color" style="width:100px;height:20px;margin-left:50px" value="Get Details"  onclick="javascript:get_transactions_list()"/>
	<p id="cancel_msg" style="float:right;margin-right:40px;display:none;font-size:15px;color:red;">Cancelling...</p>
	</div>
	
	
<div style="margin:10px;float:right;font-weight:bold">
<font size="2px" style="margin-left:40px">Search by</font>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" class="input" name="bank" id="bank" placeholder="Bank Name" style="width:125px;height:18px;" onkeyup="javascript:searchbybankname()" >
</div>
			<hr width="100%">
			<div style="margin-left:0px;margin-bottom:10px;margin-right:0px;height:85%;overflow:scroll;">
			<table border="0" width="100%">
			<tr bgcolor="#559999">
			<td align="center" width="25%" style="border-right:1px solid white;"><span class="txt1_color">Transaction Type</span></td>
			<td align="center" width="14%" style="border-right:1px solid white;"><span class="txt1_color">Deposited Date</span></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><span class="txt1_color">Shift Date</span></td>
			<td align="center" width="11%" style="border-right:1px solid white;"><span class="txt1_color">Amount(Rs)</span></td>
			<td align="center" width="11%" style="border-right:1px solid white;"><span class="txt1_color">Added By</span></td>
			<td align="center" width="14%" style="border-right:1px solid white;"><span class="txt1_color">Added Time</span></td>
			<td align="center" width="5%" style="border-right:1px solid white;"><span class="txt1_color">Modify</span></td>
			<td align="center" width="5%"><span class="txt1_color">Cancel</span></td>
			</tr>
			</table>
			
<div id="contentData" style=''>
</div>

 
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/bank_transaction.js"></script> 
