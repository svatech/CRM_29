<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:1.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Testing Litres Bill Entry</center>
 </div>
 -->
<div class='short_form'>
<form name="testform" id="testform" method="post" action="" > 
<!-- <p style="padding-top:20px;margin-left:180px"><span style="font-weight:bolder;padding-left:20px;font-size:20pt;">Bill Information</span><span style="position:inline;padding-left:600px;">Account Date <input type="text" name="timedisp" id="timedisp" value=""  /></span> </p>
<hr width="100%">  -->


<div >
<?php if(isset($this->session->userdata['counter']))
	{
		$ctr_no=$this->session->userdata['counter'];
	}else 
	{
		$ctr_no='one';	
	}
?>
<?php if(isset($this->session->userdata['shift']))
	{
		$sft=$this->session->userdata['shift'];
	}else 
	{
		$sft=1;	
	}
?>
<input type='hidden' id='shift' name='shift' />
<input type='hidden' id='acct_date' name='acct_date' />
<table style="width:50%;margin-left:20%;padding:0px;margin-top:2%;" cellpadding="0" cellspacing="0"  border="1">
<tr style="height:40px;">
	<td align="center" bgcolor='#006666' style="font-size:15px;color:white;width:40%">Shift</td><td id='shift_row' style='font-weight:bold;font-size:15px;width:60%;'></td></tr>
<tr style="border-bottom:.3px solid white;height:40px;">
	<td align="center" bgcolor='#006666' style="font-size:15px;color:white;font-size:15px;width:40%">Account Date</td><td id='acct_date_row' style='font-weight:bold;font-size:15px;width:60%;'></td></tr>
</table>
<table border="0" style="width:70%;margin-left:15%;padding:0px;float:left;margin-top:20px;" cellpadding="0" cellspacing="0">


<tr style='font-size:15px;'>
<td>Counter No</td>
		<td align='left'><select name="counterno" id="counterno"  onchange="javascript:addcounterinsession(this.value)">
		<option value="default">select</option>
	<?php foreach($counters as $counter){ ?>
			<option value="<?php echo $counter["counter"];?>" <?php if($ctr_no==$counter["counter"])echo "selected";?> ><?php echo ucfirst($counter["counter"]);?></option>
			<?php } ?>
		</select>
	</td>
	
</tr>
<tr style='font-size:15px;'>
<td>Pump No</td>
		<td align='left'><select name="pump_no" id="pump_no" style="width:150px;height:25px;" >
		
	</select>
	</td>
</tr>
<tr style='font-size:15px;'>
<td>Purpose</td>
		<td align='left'><input name="purpose" id="purpose" type="text" value='Regular Testing' style="width:120px;height:25px;" onkeypress="">
	</td>
</tr>
<tr style='font-size:15px;'>
<td>Testing Litres (Ltrs)</td>
		<td align='left'><input name="test_litres" id="test_litres" type="text" onkeypress="return isFloatKey(event)" style="width:100px;height:25px;" onkeypress="formsubmit_testbill(event)">
	</td>
</tr>

<tr align="center"><td colspan='2'>

</td></tr>
<tr align="center" style="height:40px;"><td colspan='2'>
<input type="button" value="Print Bill" style="width:70px;" onclick="javascript:testform_valid()"/>
</td></tr>
</table>
</div>





</form>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/cash_sales.js"></script>