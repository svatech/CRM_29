<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:1.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Petrol/Diesel Bill Entry</center>
</div>
  -->
<div class='short_form'>
<form name="sale_entry_form" id="sale_entry_form" method="post" action="<?php echo site_url("sales/pet_sales_entry"); ?>" >
<p style="height:40px;color:#4c0000;padding:20px 0px 0px 20px;" align="center"><span style="font-weight:bolder;font-size:20pt;">Shift wise Sales Information</span></p>
<hr width="100%">
<div align="center" style="margin:20px 0px 0px 10px;">

<table style="width:100%">
<tr>
<td>Counter No</td>
		<td><select name="counterno" id="counterno"  onchange="javascript:get_pumps(this.value)">
		<option value="default">Select</option>
	<?php foreach($counters as $counter){ ?>
			<option value="<?php echo $counter["counter"];?>" ><?php echo ucfirst($counter["counter"]);?></option>
			<?php } ?>
		</select>
	</td>
</tr>
	<tr>
		<td>Pump No</td>
		<td><select name="pump_no" id="pump_no" style="width:120px;" onblur="javascript:get_open_rdng()" >
			
			
			
			</select>
		</td>
	</tr>
	<tr>
		<td>Account Date</td>
		<td><input name="acct_date" id="acct_date" type="text" style="width:120px;height:20px;" onchange="get_open_rdng()"></td>
	</tr>
	<tr>
		<td>Shift</td>
		<td><input type="radio" name="shift" id="shift1" value="I" checked onchange="get_open_rdng()"/> <label for='shift1' style="display:inline;font-weight:normal;">I shift</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="shift" id="shift2" value="II" onchange="get_open_rdng()"/> <label for='shift2' style="display:inline;font-weight:normal;">II shift</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="shift" id="shift3" value="III" onchange="get_open_rdng()"/> <label for='shift3' style="display:inline;font-weight:normal;">III shift</label></td>
	</tr>
	<tr>
		<td>Closing Meter Reading</td>
		<td><input name="close_rdng" id="close_rdng" type="text" onkeypress="return isFloatKey(event)" onblur="javascript:cal_sales('amt');" style="width:120px;height:20px;text-align:right;"></td>
	</tr>
	<tr>
		<td>Opening Meter Reading</td>
		<td><input name="open_rdng" id="open_rdng" type="text" onkeypress="return isFloatKey(event)" style="width:120px;height:20px;text-align:right;" onblur="javascript:cal_sales('test_ltrs');"></td>
	</tr>
	<tr>
		<td>Sales Litres&nbsp;&nbsp;(Ltrs)</td>
		<td><input name="sales_ltrs" id="sales_ltrs" type="text" onkeypress="return isFloatKey(event)" value='0' style="width:120px;height:20px;text-align:right;"></td>
	    <td><p id='diff_cash_sales' align='center' style="color:red"></p></td>
	</tr>
		<tr>
		<td>Testing Litres&nbsp;&nbsp;(Ltrs)</td>
		<td><input name="test_ltrs" id="test_ltrs" type="text" readonly='readonly' value='0' onblur="javascript:cal_sales('reg_btn');" style="width:120px;height:20px;text-align:right;"></td>
	</tr>
	<tr>
		<td>Net Sales&nbsp;&nbsp;(Ltrs)</td>
		<td><input name="net_sales" id="net_sales" type="text"  onkeypress="return isFloatKey(event)" value='0' style="width:120px;height:20px;text-align:right;"></td>
	</tr>
	<tr>
		<td>Rate &nbsp;&nbsp;(Rs)</td>
		<td><input name="rate" id="rate" type="text" readonly='readonly' value="0" style="width:120px;height:20px;text-align:right;"></td>
	</tr>
	<tr>
		<td ><font style="font-size:18px;">Amount&nbsp;&nbsp;(Rs)</font></td>
		<td><input name="amt" id="amt" type="text" value="0" readonly='readonly' style="width:120px;height:28px;font-size:20px;text-align:right;"></td>
	</tr>
</table>

</div>
<br>
<p align="center"  ><input type="button" id="reg_btn" value="Register" style="width:70px;margin-right:50px;" class="button" onclick="javascript:sales_entry_valid()"/></p>
</form>

</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/sales_entry.js"></script>
