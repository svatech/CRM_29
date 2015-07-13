<?php 

class Ro_inventory_xl_rpt{

        public function Export($param,$fuels,$oil,$grease,$others,$twotoil){
        $form_data=explode("::", $param);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=RO Inventory On ".$sdate." .xls");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
        print("<tr bgcolor='#518C9C'>");
        print("<td width='5%' align='center' colspan='13'>RO Inventory On ".$sdate." </td>");
        print("</tr>");
        print("</table>");
      ?>
    
        <p id="fuels_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">Fuel Stock  </p>
			 <table border="1" width="100%" id="fuels_heading_table" style="display:none;border-collapse:collapse;">
			<tr bgcolor="#518C9C" id="hdr_row_1" style='color:white;border-right:1px solid white; '>
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
             print("<td width='15%' align='center'>".$fuelsdetails->Total."</td>");
             print("<td width='15%' align='center'>".$fuelsdetails->Sales."</td>");
             print("<td width='15%' align='center'>".$fuelsdetails->Closing_Stock."</td>");             
             print("</tr>");
               		}
              print("</table>");
          ?>
          
          
<p id="oil_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">Oil Stock </p>
           <table border="1" width="100%" id="oil_heading_table" style="display:none;border-collapse:collapse;">
			<tr bgcolor="#518C9C" id="hdr_row_2" style='color:white;border-right:1px solid white; '>
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
             print("<td width='15%' align='center'>".$oildetails->Total."</td>");
             print("<td width='15%' align='center'>".$oildetails->Sales."</td>");
             print("<td width='15%' align='center'>".$oildetails->Closing_Stock."</td>");             
             print("</tr>");
               		}
              print("</table>");?>
            
         
			<p id="grease_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">Grease Stock </p>
			 <table border="1" width="100%" id="grease_heading_table" style="display:none;border-collapse:collapse;">
			<tr bgcolor="#518C9C" id="hdr_row_3" style='color:white;border-right:1px solid white;'>
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
             print("<td width='15%' align='center'>".$greasedetails->Total."</td>");
             print("<td width='15%' align='center'>".$greasedetails->Sales."</td>");
             print("<td width='15%' align='center'>".$greasedetails->Closing_Stock."</td>");             
             print("</tr>");
               		}
              print("</table>");?>
            
             <p id="others_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">Others Stock </p>
             <table border="0" width="100%" id="others_heading_table" style="display:none;border-collapse:collapse;">
			<tr bgcolor="#518C9C" id="hdr_row_4" style='color:white;border-right:1px solid white;'>
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
             print("<td width='15%' align='center'>".$othersdetails->Total."</td>");
             print("<td width='15%' align='center'>".$othersdetails->Sales."</td>");
             print("<td width='15%' align='center'>".$othersdetails->Closing_Stock."</td>");             
             print("</tr>");
               		}
              print("</table>");?>
           
              
             <p id="twotoil_cati" style="color:#4c0000;font-size:18px;font-weight:bold;display:none;margin:20px 0px 2px 20px;">2T OIL  Stock </p>
             <table border="1" width="100%" id="twotoil_heading_table" style="display:none;border-collapse:collapse;">
			<tr bgcolor="#518C9C" id="hdr_row_5" style='color:white;border-right:1px solid white;'>
			<td align="center" width="25%" >Product</td>
			<td align="center" width="15%" >Opening Stock</td>
			<td align="center" width="15%" >Purchase Quantity(Ltrs)</td>
			<td align="center" width="15%" >Total Quantity(Ltrs)</td>
			<td align="center" width="15%" >Sale Quantity(Ltrs)</td>
			<td align="center" width="15%" >Closing Stock</td>
			
			</tr>
			</table>
			<?php 
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
              
        
        <?php } }?>