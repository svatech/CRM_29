<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:1.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Open/Close Shift</center>
 </div>
  -->
<div class='lengthy_form'>
<table border="0" align="left" cellpadding="2" style="width:100%;" class="tab_header_bg">
	<tr>
		
		<td width="8%" align="right">Counter</td>
		<td width="8%">
		<select name='counter' id='counter' style='width:auto;'>
							<option value='default'>Select</option>
							<?php foreach($counters as $ctrs){ ?>
							<option value="<?php echo $ctrs["counter"];?>" ><?php echo ucfirst($ctrs["counter"]);?></option>
							<?php } ?>
							
		</select>
		</td>
		<td width="8%" align="right">Shift</td>
		<td width="8%">
		<select name='shift' id='shift' style='width:80px;'>
							<option value='default'>Select</option>
							<option value='I'>I Shift</option>
							<option value='II'>II Shift</option>
							<option value='III'>III Shift</option>
							</select>
		</td>
		<td width="8%" align="right">Action</td>
		<td width="8%">
		<select name='action' id='action' style='width:120px;'>
							<option value='default'>Select</option>
							<option value='open'>Open Shift</option>
							<option value='close'>Close Shift</option>
							</select>
		</td>
		<td width="15%" align="center">Account Date</td>
		<td width="10%"><input type="text" id="acct_date"  class="datefld_txt" style="width:100px;" /></td>
		<td width="10%" align="LEFT"><input type='button' value='Apply' onclick="javascript:open_close_shift();" style="width:70px;"/> </td>
		<td width="25%" align="LEFT"></td>
		
	</tr>
</table>
<hr width="100%" style="margin-top:40px;">
<div id="contentData" style="height:100%;overflow:scroll;">
<table border="1" width="100%" class=''>
			<tr align='center' style='font-size:18px;color:#4c0000;font-weight:bolder;border-right:1px solid white;'>
			<td colspan='7'> Counters Recent Action
			</td>
			</tr>
			<tr bgcolor="#559999" style='background-color:#559999;color:Black;font-weight:bolder;border-right:1px solid white;'>
			<td align="center" width="15%" >Account Date</td>
			<td align="center" width="15%" >Counter</td>
			<td align="center" width="15%" >Shift</td>
			<td align="center" width="15%" >Action</td>
			<td align="center" width="20%" >Action User</td>
			<td align="center" width="20%" >Action Time</td>
			</tr>
	<?php 
			
		foreach ($status as $row) { 
			if($row["action"]=='open'){
			echo "<tr bgcolor='#CC9999' style='color:#4c0000;font-weight:bolder'>";
			}else {
				echo "<tr bgcolor='#FFFFFF' style='color:#003300;font-weight:bold'>";
			}
			?>
			<td align="center" width="15%" ><?php echo date('d-m-Y',strtotime($row["account_date"]))?></td>
			<td align="center" width="15%" ><?php echo ucfirst($row["counter"])?></td>
			<td align="center" width="15%" ><?php echo $row["shift"]?></td>
			<td align="center" width="15%" ><?php echo ucfirst($row["action"])?></td>
			<td align="center" width="20%" ><?php echo $row["user"]?></td>
			<td align="center" width="20%" ><?php echo $row["added_date"]?></td>
			
	<?php echo "</tr>"; }?>
			</table>
<table border="1" width="100%" class=''>
			<tr align='center' style='font-size:18px;font-weight:bolder;color:#4c0000;border-right:1px solid white;'>
			<td colspan='7'> Recent Shift Open/Close Entries
			</td>
			</tr>
			<tr bgcolor="#559999" style='background-color:#559999;color:Black;font-weight:bolder;border-right:1px solid white;'>
			<td align="center" width="15%" >Account Date</td>
			<td align="center" width="15%" >Counter</td>
			<td align="center" width="15%" >Shift</td>
			<td align="center" width="15%" >Action</td>
			<td align="center" width="20%" >Action User</td>
			<td align="center" width="20%" >Action Time</td>
			</tr>
	<?php 
			
		foreach ($entry_list as $row) { 
			if($row["action"]=='open'){
			echo "<tr bgcolor='#CC9999' style='color:#4C0000;font-weight:bolder'>";
			}else {
				echo "<tr bgcolor='#FFFFFF' style='color:#003300;font-weight:bold'>";
			}
			?>
			<td align="center" width="15%" ><?php echo date('d-m-Y',strtotime($row["account_date"]))?></td>
			<td align="center" width="15%" ><?php echo ucfirst($row["counter"])?></td>
			<td align="center" width="15%" ><?php echo $row["shift"]?></td>
			<td align="center" width="15%" ><?php echo ucfirst($row["action"])?></td>
			<td align="center" width="20%" ><?php echo $row["user"]?></td>
			<td align="center" width="20%" ><?php echo $row["added_date"]?></td>
			
	<?php echo "</tr>"; }?>
			</table>

</div>

</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/cash_sales.js"></script>