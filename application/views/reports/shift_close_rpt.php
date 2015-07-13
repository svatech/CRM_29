<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Shift Close Sales Report</center>
 </div>
  -->
 <div class='lengthy_form' style="border-radius:2px;">
<table width="100%" border="0" align="left" cellpadding="2" style="height:30px;">
	<tr class="tab_header_bg">
		<td width="5%" align="center" style="border-right:1px solid black;"><img width="25" id='shift_close_dwnld' height="20" src="<?php echo base_url(); ?>images/xls_download.png" alt="Download to XLS" /></td>
		<td width="23%" align="right" style="color:black;font-weight:bold">Select Date </td>
		<td width="5%"><input type="text" id="acct_date"  class="datefld_txt" style="width:100px;"/></td>
		<td width="12%" align="right">Counter</td>
		<td width="10%"><select name='counter' id='counter'>
							<?php foreach($counters as $counter){ ?>
							<option value="<?php echo $counter["counter"];?>" ><?php echo ucfirst($counter["counter"]);?></option>
							<?php }	?>
							<option value='all' >All Counters</option>
						</select>
		</td> 
		<td width="12%" align="right">Shift</td>
		<td width="10%"><select name='shift' id='shift'>
							<option value='I'>I Shift</option>
							<option value='II'>II Shift</option>
							<option value='III'>III Shift</option>
						</select>
		</td> 
		
		<td width="10%" align="LEFT"><input type='button' value='  Get Report  ' class='txt2_color' onclick="javascript:shift_close_report();" style="width:100px;"/> </td>
		<td width="6%" align="LEFT"></td>
		<td width="8%" align="center" style="border-left:1px solid black;">
		<img  alt="print" id='print_shift_close_report' src="<?php echo base_url();?>images/printer1.png" title='Print'  width="35" height="35" />
		</td>
	</tr>
</table>
<hr width="100%" style="margin-top:10px;">
<div id="contentData" class='report_content'>
</div>

</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/reports.js"></script>