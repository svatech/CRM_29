 <!--  <div style="float:right;margin:5px 20px 0px 0px;font-weight:bold;"><a  href="<?php echo site_url("master/export_data_master_dtls");?>"></a> </div>-->
				<hr width="100%">
			<div style="height:84%;overflow:scroll;" class='lengthy_form'>
			<table width="95%"  align="left" cellpadding="1" cellspacing="1" >
			<tr style="font-weight:bold;font-size:15pt;height:30px;background-color:#559999;color:white;border-right:1px solid  black;">
			<td align="center" width="50%" style="border-right:1px solid white;"><span class="txt1_color">Name</span></td>
		    <td align="center" width="50%" style="border-right:1px solid white;"><span class="txt1_color">Value</span></td>
			</tr>
			</table>
			
<?php
   $counter=0;
   print("<table width='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($export_data as $row) {
   		print("<tr class='td_rows'><td align='center' width='50%' >Section Code</td><td align='center' width='50%' ><input type='text' class='plain_txt'  readonly='readonly' value='".$row->section_code."' /></td></tr>");
   		print("<tr class='td_rows'><td align='center' width='50%' >Business Area</td><td align='center' width='50%' ><input type='text' class='plain_txt'  readonly='readonly' value='".$row->business_area."' /></td></tr>");
   		print("<tr class='td_rows'><td align='center' width='50%' >SAP Sale Code</td><td align='center' width='50%' ><input type='text' class='plain_txt'  readonly='readonly' value='".$row->sap_sale_code."' /></td></tr>");
   		print("<tr class='td_rows'><td align='center' width='50%' >Cost Center</td><td align='center' width='50%' ><input type='text' class='plain_txt'  readonly='readonly' value='".$row->cost_center."' /></td></tr>");
   		print("<tr class='td_rows'><td align='center' width='50%' >Profit Center</td><td align='center' width='50%' ><input type='text' class='plain_txt'  readonly='readonly' value='".$row->profit_center."' /></td></tr>");
   		print("<tr class='td_rows'><td align='center' width='50%' >Indent Statement Report Reference</td><td align='center' width='50%' ><input type='text' class='plain_txt'  readonly='readonly' value='".$row->indent_stmt_rpt_ref."' /></td></tr>");
   		print("<tr class='td_rows'><td align='center' width='50%' >Bank Transaction Report Reference</td><td align='center' width='50%' ><input type='text' class='plain_txt'  readonly='readonly' value='".$row->bank_trans_rpt_ref."' /></td></tr>");
   		print("<tr class='td_rows'><td align='center' width='50%' >Cheque Sales Report Reference</td><td align='center' width='50%' ><input type='text' class='plain_txt'  readonly='readonly' value='".$row->cheque_sales_rpt_ref."' /></td></tr>");
   		print("<tr class='td_rows'><td align='center' width='50%' >Indent Payments Report Reference</td><td align='center' width='50%' ><input type='text' class='plain_txt'  readonly='readonly' value='".$row->indent_pmt_rpt_ref."' /></td></tr>");
   		print("<tr class='td_rows'><td align='center' width='50%' >ICICI Credit Card Report Reference</td><td align='center' width='50%' ><input type='text' class='plain_txt'  readonly='readonly' value='".$row->credit_sales_rpt_ref."' /></td></tr>");
   		print("<tr class='td_rows'><td align='center' width='50%' >HDFC Credit Card Report Reference</td><td align='center' width='50%' ><input type='text' class='plain_txt'  readonly='readonly' value='".$row->hdfc_credit_sales_ref."' /></td></tr>");
   		print("<tr class='td_rows'><td align='center' width='50%' >Cash Sales Report Reference</td><td align='center' width='50%' ><input type='text' class='plain_txt'  readonly='readonly' value='".$row->cash_sales_rpt_ref."' /></td></tr>");
   		print("<tr class='td_rows'><td align='center' width='50%' colspan='2'><a  href='javascript:updateexport_data();' id='edit_id'><font color=''>Edit </font></a></td></tr>");
      }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
?>  

</div>
<!-- </div> -->

<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/export_data.js"></script>
