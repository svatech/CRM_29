<!-- <script type="text/javascript">
var cust_array=<?php echo json_encode($indent_cust)?>;
</script> -->
<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:1.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Petrol/Diesel Bills Log</center>
 </div>
  -->
<div class='lengthy_form'>
	
	<div style="margin:10px 0px 0px 30px;">	
	<p style="margin-left: 30px;font-size:15px;display:inline;font-weight:bold;">Managed Bills From</p>
	<input type="text" id="start_date"  class="datefld_txt" style="width:100px;height:20px;margin-left:20px"/>
	<p style="margin-left: 50px;font-size:15px;display:inline;font-weight:bold;">To</p>
	<input type="text" id="end_date"  class="datefld_txt" style="width:100px;height:20px;margin-left:20px" />
	<input type="button" id="" class='txt2_color' style="width:100px;height:20px;margin-left:50px" value="Get Details"  onclick="javascript:managed_retail_bill_form()"/>
	
	</div>
	
	
<div style="margin-left: 15px;margin-top:10px;margin-bottom:10px;font-weight:bold;font-size:12px;">
<table><tr><td>
<p style="display:inline;font-weight:bold;">Search by Bill No</p>
</td><td>
<input type="text" class="input" name="billno" id="billno"  style="width:70px;height:18px;" onkeyup="javascript:searchbybillnolog()" >
</td><td>
<font  style="font-weight:bold">Customer Name</font>
</td><td>
<input type="text" class="input" name="customer" id="customer"  style="width:125px;height:18px;" onkeyup="javascript:searchbycustomername()" >
</td><td>
<font  style="font-weight:bold">Vehicle Number</font>
</td><td>
<input type="text" class="input" name="vehicle_number" id="vehicle_number"  style="width:70px;height:18px;" onkeyup="javascript:searchbyvehiclenumber()" >
</td><td>
<font style="font-weight:bold">Sales Mode</font>
</td><td>
<select   class="dropdown" name="salesmode" id="salesmode" style="width:70px;height:20px;" onchange="javascript:searchbysalesmode()" >
<option value="">All</option>
<option value="Cash_sales">Cash Sales</option>
<option value="Indent_sales">Indent Sales</option>
<option value="Credit_card_sales">Credit Sales</option>
<option value="Xtra_reward_sales">XtraReward Card Sales</option>
<option value="Fleet_card_sales">XtraPower Card Sales</option>
<option value="Easy_fuel_sales">Easy Fuel Sales</option>
<option value="Cheque_sales">Cheque Sales</option>
</select>
</td></tr></table>
</div>
		
		
			
			<hr width="100%">

 	
			<div style="margin-left:0px;margin-bottom:10px;margin-right:0px;height:82%;overflow:scroll;">
			<table border="0" width="100%">
			<tr bgcolor="#559999">
			<td align="center" width="12%" style="border-right:1px solid white;"><span class="txt1_color">Bill No</span></td>
			<td align="center" width="16%" style="border-right:1px solid white;"><span class="txt1_color">Customer Name</span></td>
			<td align="center" width="10%" style="border-right:1px solid white;"><span class="txt1_color">Vehicle No</span></td>
			<td align="center" width="10%" style="border-right:1px solid white;"><span class="txt1_color">Account Date</span></td>
			<td align="center" width="5%" style="border-right:1px solid white;"><span class="txt1_color">Shift</span></td>
			<td align="center" width="5%" style="border-right:1px solid white;"><span class="txt1_color">Counter</span></td>
			<td align="center" width="8%" style="border-right:1px solid white;"><span class="txt1_color">Amount(Rs)</span></td>
			<td align="center" width="10%" style="border-right:1px solid white;"><span class="txt1_color">Sales Mode</span></td>
			<td align="center" width="14%" style="border-right:1px solid white;"><span class="txt1_color">Bill Time</span></td>
			<td align="center" width="5%" style="border-right:1px solid white;"><span class="txt1_color">User</span></td>
			<td align="center" width="5%"><span class="txt1_color">Details</span></td>
			</tr>
			</table>
			
<div id="contentData" style=''>
</div>

 
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/cash_sales.js"></script> 
