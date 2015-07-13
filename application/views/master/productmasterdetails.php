<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Product Details</center>
 </div>
  -->
 <div class='lengthy_form'>
 
<div class='filter_info' style="margin-left: 10px;margin-top:30px;">

<font size="2px" style="margin-left: 20px">Sort by Category</font>&nbsp;&nbsp;&nbsp;&nbsp;
		<select name="category" id="category"  class="dropdown" style="width:125px;height:24px;" onchange="javascript:sortcategory()">
			<option value="">All</option>
			<?php foreach ($category as $category_list) {?>
			<option value="<?php echo $category_list->category;?>"><?php echo $category_list->category;?></option>
			<?php  } ?>
		</select>
			<input type="button" value="Download Product Master" style="height:25px;width:200px;margin-left:150px;" onclick="javascript:prod_master_dwnld()">
			
			</div>

			<div style="margin-left: 75%;font-weight:bold"><a  href="<?php echo site_url("master/product_master");?>"><font color='#4c0000' size="3px" >Add New Product</font></a> </div>
			<hr width="100%">


			<div style="height:84%;overflow:scroll;">
			<table width="100%" border="0 ">
			<tr bgcolor="#559999">
			<td align="center" width="22%" style="border-right:1px solid white;"><span class="txt1_color">Product Name</span></td>
			<td align="center" width="14%" style="border-right:1px solid white;"><span class="txt1_color">Product rate(Rs)</span></td>
			<td align="center"  width="15%"style="border-right:1px solid white;"><span class="txt1_color">Category</span></td>
			<td align="center" width='12%'style="border-right:1px solid white;"><span class="txt1_color">Status</span></td>
			<td align="center"   width='9%'style="border-right:1px solid white;"><span class="txt1_color">Added by</span></td>
			<td align="center"  width='17%'style="border-right:1px solid white;"><span class="txt1_color">Added Date</span></td>
			<td align="center" ><span class="txt1_color">Modify</span></td>
			</tr>
			</table>
<?php
   $counter=0;
   print("<table width='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($productmaster as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $prod_id="prod_name".$counter;  
        $prod_name=$row->product_name;            
        print("<td width='22%' ><input type='text' class='plain_txt' id='$prod_id'  value='$prod_name' style=';'/></td>");
    	$prodrate_id="prodrate".$counter;
        print("<td width='14%' ><input type='text'  class='plain_txt' readonly='readonly' id='$prodrate_id' value='".$row->product_rate."' style='text-align:center;' /></td>");
        $catg_id="category".$counter;
        print("<td width='15%'><input type='text'  class='plain_txt' readonly='readonly' id='$catg_id' value='".$row->category."' style='text-align:center;' /></td>");
        $stat_id="status".$counter;
        if($row->status == 1){
        print("<td width='12%'><input type='text' class='plain_txt' readonly='readonly' id='$stat_id' value='Active' style='text-align:center;'/></td>");}
   		else{
        print("<td width='12%'><input type='text' class='plain_txt' readonly='readonly' id='$stat_id' value='Inactive' style='text-align:center;' /></td>");}
        $user_id="user".$counter;
        print("<td width='9%'><input type='text'  class='plain_txt' readonly='readonly' id='$user_id' value='".$row->updated_by."' style='text-align:center;' /></td>");
		$date_id="date".$counter;
        print("<td width='17%'><input type='text' class='plain_txt' readonly='readonly' id='$date_id' value='".$row->updated_date."' /></td>");
        $edit_id="edit".$counter;
        print("<td width=''><a style='margin-left:30px;' href='javascript:updateproduct(\"".$prod_name."\");' id='edit_id'><font color=''>Edit</font> </a></td>");
		print("</tr>");    	

   }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
?>  
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/master_validation.js"></script>