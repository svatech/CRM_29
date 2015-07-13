<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">E-Book</center>
 </div>
  -->
<div class='lengthy_form'>
<table width="100%" border="0" align="left" cellpadding="2" style="height:40px;">
	<tr class="tab_header_bg">
		<td width="5%" align="center" style="border-right:1px solid black;"><img width="25" id='ebook_dwnld' height="20" src="<?php echo base_url(); ?>images/xls_download.png" alt="Download to XLS" /></td>
		<td width="10%" align="right" style="color:black;font-weight:bold">E-Book of</td>
		<td width="12%" align="" style="color:black;font-weight:bold">Tank Name</td>
		<td width="10%"><select name='tank_name' id='tank_name' style=''>
							<option value='default'>Select</option>
							<?php foreach($tanks as $tank){ ?>
							<option value="<?php echo $tank["tank_no"];?>" ><?php echo $tank["tank_no"];?></option>
							<?php } ?>
							
						</select>
		</td> 
		<td width="16%" align="center">for the Month of</td>
		<td width="10%"><select name='month' id='month' style=''>
						<option value='01'>January</option>
						<option value='02'>February</option>
						<option value='03'>March</option>
						<option value='04'>April</option>
						<option value='05'>May</option>
						<option value='06'>June</option>
						<option value='07'>July</option>
						<option value='08'>August</option>
						<option value='09'>September</option>
						<option value='10'>October</option>
						<option value='11'>November</option>
						<option value='12'>December</option>
						</select></td>
		<td width="10%" align="right">and Year</td>
		<td width="10%"><select name='year' id='year' style=''>
						<option value='2014'>2014</option>
						<option value='2015'>2015</option>
						<option value='2016'>2016</option>
						<option value='2017'>2017</option>
						<option value='2018'>2018</option>
						<option value='2019'>2019</option>
						<option value='2020'>2020</option>
						<option value='2021'>2021</option>
						<option value='2022'>2022</option>
						<option value='2023'>2023</option>
						<option value='2024'>2024</option>
						<option value='2025'>2025</option>
						</select></td>
		
		<td width="10%" align="LEFT"><input type='button' value='  Get Report  ' class='txt2_color' onclick="javascript:get_ebook();" style="width:100px;"/> </td>
		
		<td width="8%" align="center" style="border-left:1px solid black;">
		<img  alt="print" id='print_ebook_stmt' src="<?php echo base_url();?>images/printer1.png" title='Print'  width="35" height="35" />
		</td>
	</tr>
</table>
<hr width="100%" style="margin-top:40px;">
<div id="contentData" class='report_content'>
</div>

</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/statements.js"></script>