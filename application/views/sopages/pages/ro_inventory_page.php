

			 <p id="fuels_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">Fuel Stock  </p>
			 <table border="0" width="100%" id="fuels_heading_table" style="display:none;border-collapse:collapse;">
			<tr bgcolor="#559999" id="hdr_row_1" style='color:Black;border-right:1px solid Black; '>
			<td align="center" width="25%" >Product</td>
			<td align="center" width="15%" >Opening Stock</td>
			<td align="center" width="15%" >Purchase Quantity(Ltrs)</td>
			<td align="center" width="15%" >Total Quantity(Ltrs)</td>
			<td align="center" width="15%" >Sale Quantity(Ltrs)</td>
			<td align="center" width="15%" >Closing Stock</td>
			
			</tr></table>
			<?php
	  		 print("<table id='fuels_table' width='100%' border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;display:none;margin-bottom:20px;'>");
			
         	 foreach($fuels as $fuelsdetails) {
 			print("<tr class='small'>");
         	 print("<td width='25%' align='center'>".$fuelsdetails->product."</td>");
             print("<td width='15%' align='center'>".$fuelsdetails->opening_stock."</td>");
             print("<td width='15%' align='center'>".$fuelsdetails->Purchase."</td>");
             print("<td width='15%' align='center'>".round($fuelsdetails->Total,3)."</td>");
             print("<td width='15%' align='center'>".round($fuelsdetails->Sales,3)."</td>");
             print("<td width='15%' align='center'>".round($fuelsdetails->Closing_Stock,3)."</td>");             
             print("</tr>");
               		}
              print("</table>");
          ?>
          
           <p id="oil_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">Oil Stock </p>
           <table border="0" width="100%" id="oil_heading_table" style="display:none;border-collapse:collapse;">
			<tr bgcolor="#559999" id="hdr_row_2" style='color:Black;border-right:1px solid Black; '>
			<td align="center" width="25%" >Product</td>
			<td align="center" width="15%" >Opening Stock</td>
			<td align="center" width="15%" >Purchase Quantity</td>
			<td align="center" width="15%" >Total Quantity</td>
			<td align="center" width="15%" >Sale Quantity</td>
			<td align="center" width="15%" >Closing Stock</td>
			
			</tr>
			</table><?php 
 			print("<table id='oil_table'  width='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='border-collapse:collapse;display:none;margin-bottom:20px;'>");
      		 foreach($oil as $oildetails) {
         	 print("<tr class='small'>");
			 print("<td width='25%' align='center'>".$oildetails->product_name."</td>");
             print("<td width='15%' align='center'>".$oildetails->Opening_Stock."</td>");
             print("<td width='15%' align='center'>".$oildetails->purchase."</td>");
             print("<td width='15%' align='center'>".round($oildetails->Total,3)."</td>");
             print("<td width='15%' align='center'>".round($oildetails->Sales,3)."</td>");
             print("<td width='15%' align='center'>".round($oildetails->Closing_Stock,3)."</td>");             
             print("</tr>");
               		}
              print("</table>");?>
             
			<p id="grease_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">Grease Stock </p>
			 <table border="0" width="100%" id="grease_heading_table" style="display:none;border-collapse:collapse;">
			<tr bgcolor="#559999" id="hdr_row_3" style='color:Black;border-right:1px solid Black;'>
			<td align="center" width="25%" >Product</td>
			<td align="center" width="15%" >Opening Stock</td>
			<td align="center" width="15%" >Purchase Quantity</td>
			<td align="center" width="15%" >Total Quantity</td>
			<td align="center" width="15%" >Sale Quantity</td>
			<td align="center" width="15%" >Closing Stock</td>
			
			</tr>
			</table><?php 
              print("<table width='100%'  id='grease_table' border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;display:none;margin-bottom:20px;'>");
      		 foreach($grease as $greasedetails) {
         	 print("<tr class='small'>");
			 print("<td width='25%' align='center'>".$greasedetails->product_name."</td>");
             print("<td width='15%' align='center'>".$greasedetails->Opening_Stock."</td>");
             print("<td width='15%' align='center'>".$greasedetails->purchase."</td>");
             print("<td width='15%' align='center'>".round($greasedetails->Total,3)."</td>");
             print("<td width='15%' align='center'>".round($greasedetails->Sales,3)."</td>");
             print("<td width='15%' align='center'>".round($greasedetails->Closing_Stock,3)."</td>");             
             print("</tr>");
               		}
              print("</table>");?>
             
             <p id="others_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">Others Stock </p>
             <table border="0" width="100%" id="others_heading_table" style="display:none;border-collapse:collapse;">
			<tr bgcolor="#559999" id="hdr_row_4" style='color:Black;border-right:1px solid Black;'>
			<td align="center" width="25%" >Product</td>
			<td align="center" width="15%" >Opening Stock</td>
			<td align="center" width="15%" >Purchase Quantity</td>
			<td align="center" width="15%" >Total Quantity</td>
			<td align="center" width="15%" >Sale Quantity</td>
			<td align="center" width="15%" >Closing Stock</td>
			
			</tr>
			</table><?php 
              print("<table width='100%' id='others_table'  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;display:none;margin-bottom:20px;'>");
      		 foreach($others as $othersdetails) {
         	 print("<tr class='small'>");
			 print("<td width='25%' align='center'>".$othersdetails->product_name."</td>");
             print("<td width='15%' align='center'>".$othersdetails->Opening_Stock."</td>");
             print("<td width='15%' align='center'>".$othersdetails->purchase."</td>");
             print("<td width='15%' align='center'>".round($othersdetails->Total,3)."</td>");
             print("<td width='15%' align='center'>".round($othersdetails->Sales,3)."</td>");
             print("<td width='15%' align='center'>".round($othersdetails->Closing_Stock,3)."</td>");             
             print("</tr>");
               		}
              print("</table>");?>
             <p id="twotoil_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">2T Oil  Stock </p>
             <table border="0" width="100%" id="twotoil_heading_table" style="display:none;border-collapse:collapse;">
			<tr bgcolor="#559999" id="hdr_row_5" style='color:Black;border-right:1px solid Black;'>
			<td align="center" width="25%" >Product</td>
			<td align="center" width="15%" >Opening Stock</td>
			<td align="center" width="15%" >Purchase Quantity(Ltrs)</td>
			<td align="center" width="15%" >Total Quantity(Ltrs)</td>
			<td align="center" width="15%" >Sale Quantity(Ltrs)</td>
			<td align="center" width="15%" >Closing Stock</td>
			
			</tr>
			</table><?php 
              print("<table width='100%' id='twotoil_table'  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;display:none;margin-bottom:0px;'>");
      		 foreach($twotoil as $twotoildetails) {
         	 print("<tr class='small'>");
			 print("<td width='25%' align='center'>".$twotoildetails->product_name."</td>");
             print("<td width='15%' align='center'>".$twotoildetails->Opening_Stock."</td>");
             print("<td width='15%' align='center'>".$twotoildetails->purchase."</td>");
             print("<td width='15%' align='center'>".round($twotoildetails->Total,3)."</td>");
             print("<td width='15%' align='center'>".round($twotoildetails->Sales,3)."</td>");
             print("<td width='15%' align='center'>".round($twotoildetails->Closing_Stock,3)."</td>");             
             print("</tr>");
               		}
              print("</table>");
		
              ?>
      
