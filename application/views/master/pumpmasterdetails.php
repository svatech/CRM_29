<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Pump Details</center>
 </div>
  -->
<div class='lengthy_form'>
			
			<div class='filter_info' style="margin-left: 20px;margin-top:20px;">
			<table>
			<tr><td>
			<font >Sort by Product</font>
			</td><td>
			<select name="product" id="product" class="dropdown" style="width:100px;height:20px;" onchange="javascript:sortproduct()">
			<option value="">All</option>
			<?php foreach ($product as $product_list) {?>
			<option value="<?php echo $product_list->PRODUCT_NAME;?>"><?php echo $product_list->PRODUCT_NAME;?></option>
			<?php  } ?>
			</select>
			</td><td>
			<font  style="">Sort by Tank Number</font>
			</td><td>
			<select name="tank" id="tank"  class="dropdown" style="width:80px;height:20px;" onchange="javascript:sorttank()">
			<option value="">All</option>
				
			<?php foreach($tank as $tank_list){?>
			<option value="<?php echo $tank_list->TANK_NO; ?>"><?php echo $tank_list->TANK_NO; ?></option>
			<?php  }?>
			</select>
			</td><td>
			<font style="">Sort by Counter</font>
			</td><td>
			<select name="counter" id="counter"  class="dropdown" style="width:80px;height:20px;" onchange="javascript:sortcounter()">
			<option value="">All</option>
			<option value="one">One</option>
			<option value="Two">Two</option>
			<option value="Three">Three</option>
			</select>
			</td><td>
				<input type="button" value="Download Pump Master" style="height:25px;width:150px;" onclick="javascript:pump_master_dwnld()">
				</td></tr>
				</table>
			</div>
			<div style="float:right;margin:5px 20px 0px 0px;font-weight:bold;"><a  href="<?php echo site_url("master/index");?>"><font  color='#4c0000' size="3px" >Add New Pump</font></a> </div>
			<hr width="100%">


			<div style="height:84%;overflow:scroll;" >
			<table width="100%"  align="left" cellpadding="1" cellspacing="1" >
			<tr bgcolor="#559999" >
			<td align="center" width="13%" style="border-right:1px solid white;"><span class="txt1_color">Pump Name</span></td>
			<td align="center" width="14%" style="border-right:1px solid white;"><span class="txt1_color">Product</span></td>
			<td align="center" width="14%" style="border-right:1px solid white;"> <span class="txt1_color">Tank Number</span></td>
			<td align="center" style="border-right:1px solid white;"  width='13%'><span class="txt1_color">Status</span></td>
			<td align="center" style="border-right:1px solid white;" width='16%'><span class="txt1_color">Counter</span></td>
			<td align="center" style="border-right:1px solid white;" width='17%'><span class="txt1_color">Reading</span></td>
			
			<td align="center"><span class="txt1_color">Modify</span></td>
			</tr>
			</table>
			

<?php
   $counter=0;
   print("<table width='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($pumpmaster as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $pump_id="pump_no".$counter;  
        $pump_no=$row->pump_no;            
        print("<td width='13%' ><input type='text' style='margin-left:0px;' class='plain_txt' id='$pump_id'  value='$pump_no' /></td>");
    	$prod_id="prod".$counter;
        print("<td width='14%' ><input type='text' class='plain_txt'  readonly='readonly' id='$prod_id' value='".$row->product_name."' /></td>");
        $tank_id="tank_no".$counter;
        print("<td width='14%'><input type='text'  class='plain_txt' readonly='readonly' id='$tank_id' value='".$row->tank_no."' /></td>");
        $stat_id="status".$counter;
        if($row->status == 1){
        print("<td width='13%' ><input type='text'  class='plain_txt' readonly='readonly' id='$stat_id' value='Active' style='text-align:center;'/></td>");}
   		else{
        print("<td width='13%' ><input type='text'  class='plain_txt' readonly='readonly' id='$stat_id' value='Inactive' style='text-align:center;'/></td>");}
         $count_id="count".$counter;
        print("<td width='16%' ><input type='text'  class='plain_txt' readonly='readonly' id='$count_id' value='".$row->counter."' style='text-align:center;' /></td>");
 		$reading_id="reading".$counter;
        print("<td width='17%' ><input type='text'  class='plain_txt' readonly='readonly' id='$reading_id' value='".$row->last_close_reading."' style='text-align:center;' /></td>");
        $edit_id="edit".$counter;
        print("<td width=''><a  style='margin-left:45px;' href='javascript:updatepump(\"".$pump_no."\");' id='edit_id'><font color=''>Edit</font> </a></td>");
		print("</tr>");    	

   }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
?>  
</div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/master_validation.js"></script>