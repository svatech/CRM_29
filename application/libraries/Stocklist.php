	<?php class Stocklist{
		   public function Export($data,$title){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_$title.xls");?>
			 <p id="fuels_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">Fuel Stock  </p>
			 <table border="0" width="100%" id="fuels_heading_table" style="display:none;">
			<tr bgcolor="#518C9C">
			<td align="center" width="25%" style="border-right:1px solid white;"><font color="white">Product</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Opening Stock</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Purchase Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Total Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Sale Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Closing Stock</font></td>
			
			</tr></table>
			<?php
	  		 print("<table id='fuels_table' width='100%' border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;display:none;margin-bottom:20px;'>");
			
         	 foreach($fuels as $fuelsdetails) {
 			print("<tr class='small'>");
         	 print("<td width='25%' align='center'>".$fuelsdetails->product."</td>");
             print("<td width='15%' align='center'>".$fuelsdetails->opening_stock."</td>");
             print("<td width='15%' align='center'>".$fuelsdetails->Purchase."</td>");
             print("<td width='15%' align='center'>".$fuelsdetails->Total."</td>");
             print("<td width='15%' align='center'>".$fuelsdetails->Sales."</td>");
             print("<td width='15%' align='center'>".$fuelsdetails->Closing_Stock."</td>");             
             print("</tr>");
               		}
              print("</table>");
          ?>
          
           <p id="oil_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">Oil Stock </p>
           <table border="0" width="100%" id="oil_heading_table" style="display:none;">
			<tr bgcolor="#518C9C">
			<td align="center" width="25%" style="border-right:1px solid white;"><font color="white">Product</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Opening Stock</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Purchase Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Total Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Sale Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Closing Stock</font></td>
			
			</tr>
			</table><?php 
 			print("<table id='oil_table'  width='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='border-collapse:collapse;display:none;margin-bottom:20px;'>");
      		 foreach($oil as $oildetails) {
         	 print("<tr class='small'>");
			 print("<td width='25%' align='center'>".$oildetails->product_name."</td>");
             print("<td width='15%' align='center'>".$oildetails->Opening_Stock."</td>");
             print("<td width='15%' align='center'>".$oildetails->purchase."</td>");
             print("<td width='15%' align='center'>".$oildetails->Total."</td>");
             print("<td width='15%' align='center'>".$oildetails->Sales."</td>");
             print("<td width='15%' align='center'>".$oildetails->Closing_Stock."</td>");             
             print("</tr>");
               		}
              print("</table>");?>
             
			<p id="grease_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">Grease Stock </p>
			 <table border="0" width="100%" id="grease_heading_table" style="display:none;">
			<tr bgcolor="#518C9C">
			<td align="center" width="25%" style="border-right:1px solid white;"><font color="white">Product</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Opening Stock</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Purchase Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Total Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Sale Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Closing Stock</font></td>
			
			</tr>
			</table><?php 
              print("<table width='100%'  id='grease_table' border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;display:none;margin-bottom:20px;'>");
      		 foreach($grease as $greasedetails) {
         	 print("<tr class='small'>");
			 print("<td width='25%' align='center'>".$greasedetails->product_name."</td>");
             print("<td width='15%' align='center'>".$greasedetails->Opening_Stock."</td>");
             print("<td width='15%' align='center'>".$greasedetails->purchase."</td>");
             print("<td width='15%' align='center'>".$greasedetails->Total."</td>");
             print("<td width='15%' align='center'>".$greasedetails->Sales."</td>");
             print("<td width='15%' align='center'>".$greasedetails->Closing_Stock."</td>");             
             print("</tr>");
               		}
              print("</table>");?>
             
             <p id="others_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">Others Stock </p>
             <table border="0" width="100%" id="others_heading_table" style="display:none;">
			<tr bgcolor="#518C9C">
			<td align="center" width="25%" style="border-right:1px solid white;"><font color="white">Product</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Opening Stock</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Purchase Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Total Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Sale Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Closing Stock</font></td>
			
			</tr>
			</table><?php 
              print("<table width='100%' id='others_table'  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;display:none;margin-bottom:20px;'>");
      		 foreach($others as $othersdetails) {
         	 print("<tr class='small'>");
			 print("<td width='25%' align='center'>".$othersdetails->product_name."</td>");
             print("<td width='15%' align='center'>".$othersdetails->Opening_Stock."</td>");
             print("<td width='15%' align='center'>".$othersdetails->purchase."</td>");
             print("<td width='15%' align='center'>".$othersdetails->Total."</td>");
             print("<td width='15%' align='center'>".$othersdetails->Sales."</td>");
             print("<td width='15%' align='center'>".$othersdetails->Closing_Stock."</td>");             
             print("</tr>");
               		}
              print("</table>");?>
             <p id="twotoil_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">2T OIL  Stock </p>
             <table border="0" width="100%" id="twotoil_heading_table" style="display:none;">
			<tr bgcolor="#518C9C">
			<td align="center" width="25%" style="border-right:1px solid white;"><font color="white">Product</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Opening Stock</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Purchase Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Total Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Sale Quantity</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font color="white">Closing Stock</font></td>
			
			</tr>
			</table><?php 
              print("<table width='100%' id='twotoil_table'  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;display:none;margin-bottom:0px;'>");
      		 foreach($twotoil as $twotoildetails) {
         	 print("<tr class='small'>");
			 print("<td width='25%' align='center'>".$twotoildetails->product_name."</td>");
             print("<td width='15%' align='center'>".$twotoildetails->Opening_Stock."</td>");
             print("<td width='15%' align='center'>".$twotoildetails->purchase."</td>");
             print("<td width='15%' align='center'>".$twotoildetails->Total."</td>");
             print("<td width='15%' align='center'>".$twotoildetails->Sales."</td>");
             print("<td width='15%' align='center'>".$twotoildetails->Closing_Stock."</td>");             
             print("</tr>");
               		}
              print("</table>");
		
		    ?>
      <?php  }  }?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/statements.js"></script>