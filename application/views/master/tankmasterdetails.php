<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Tank Details</center>
 </div>
  -->
  <div class='lengthy_form'>
<div class='filter_info' style="margin-left: 40px;margin-top:20px;"><font size="2px">Sort by Product</font>&nbsp;&nbsp;&nbsp;&nbsp;
<select name="product" id="product"  style="width:125px;height:24px;" onchange="javascript:sortproduct()" class="dropdown">
			<option value="">All</option>
			<?php foreach ($product as $product_list) {?>
			<option value="<?php echo $product_list->PRODUCT_NAME;?>"><?php echo $product_list->PRODUCT_NAME;?></option>
			<?php  } ?>
			</select>
			<input type="button" value="Download Tank Master" style="height:25px;width:170px;margin-left:150px;" onclick="javascript:tank_master_dwnld()">
			</div>
			
			<div style="margin-left: 75%;font-weight:bold"><a  href="<?php echo site_url("master/tank_master");?>"><font color='#4c0000' size="3px" >Add New Tank</font></a> </div>
			<hr width="100%">


			<div style="">
			<table border="0" width="100%">
			<tr bgcolor="#559999">
			<td align="center" width="15%" style="border-right:1px solid white;"><span class="txt1_color">Tank Name</span></td>
			<td align="center" width="14%" style="border-right:1px solid white;"><span class="txt1_color">Product</span></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><span class="txt1_color">Capacity(Ltrs)</span></td>
			<td align="center" width="12%" style="border-right:1px solid white;"><span class="txt1_color">Status</span></td>
			<td align="center" width="16%" style="border-right:1px solid white;"><span class="txt1_color">Updated by</span></td>
			<td align="center" width="20%" style="border-right:1px solid white;"><span class="txt1_color">Updated Date</span></td>
			<td align="center"><span class="txt1_color">Modify</span></td>
			</tr>
			</table>
			

<?php
   $counter=0;
   print("<table width='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($tankmaster as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $tank_id="tank_no".$counter;  
        $tank_no=$row->tank_no;            
        print("<td width='15%' ><input type='text' class='plain_txt' id='$tank_id'  value='$tank_no' /></td>");
    	$prod_id="prod".$counter;
        print("<td width='14%' ><input type='text' class='plain_txt' readonly='readonly' id='$prod_id' value='".$row->product."' /></td>");
        $cap_id="cap".$counter;
        print("<td width='15%'><input type='text'  class='plain_txt' readonly='readonly' id='$cap_id' value='".$row->capacity."' style='text-align:center;' /></td>");
        $stat_id="status".$counter;
        if($row->status == 1){
        print("<td width='12%'><input type='text'  class='plain_txt' readonly='readonly' id='$stat_id' value='Active' style='text-align:center;' /></td>");}
   else{
        print("<td width='12%'><input type='text'  class='plain_txt' readonly='readonly' id='$stat_id' value='Inactive' style='text-align:center;' /></td>");}
        $user_id="user".$counter;
        print("<td width='16%'><input type='text'  class='plain_txt' readonly='readonly' id='$user_id' value='".$row->updated_by."' style='text-align:center;' /></td>");
		 $date_id="date".$counter;
        print("<td width='20%'><input type='text'  class='plain_txt' readonly='readonly' id='$date_id' value='".$row->updated_date."' style='text-align:center;' /></td>");
        $edit_id="edit".$counter;
        print("<td width=''><a style='margin-left:15px;' href='javascript:updatetank(\"".$tank_no."\");' id='edit_id'><font color=''>Edit </font></a></td>");
		print("</tr>");    	

   }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
?>  
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/master_validation.js"></script>