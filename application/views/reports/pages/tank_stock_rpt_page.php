<?php
  print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  class='alt_row' style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999' id='tab_hdr' style='background-color:#559999;color:white;border-right:1px solid white;'>");
       print("<td width='10%' align='center'><span class='txt1_color'>Date</td>");
       print("<td width='8%' align='center'><span class='txt1_color'>Tank Name</span></td>");
       print("<td width='8%' align='center'><span class='txt1_color'>Product</span></td>");
       print("<td width='12%' align='center'><span class='txt1_color'>Volume</span></td>");
       print("<td width='12%' align='center'><span class='txt1_color'>Dip Level</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Water Level</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Density (15&deg;C)</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Actual Temp (&deg;C)</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Actual Temp Density</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Entered By</span></td>");
       print("</tr>");
       
      	    
            foreach($tank_stock as $openrow) {
        	    print("<tr class='small'>");
        	 print("<td width='10%' align='center'>".($openrow["added_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["added_date"])) : '')."</td>");
             print("<td width='8%' align='center'>".$openrow["tank_no"]."</td>");
             print("<td width='8%' align='center'>".$openrow["product"]."</td>");
             print("<td width='12%' align='center'>".$openrow["volume"]."</td>");
             print("<td width='12%' align='center'>".$openrow["dip_level"]."</td>");
             print("<td width='10%' align='center'>".$openrow["water_level"]."</td>");             
             print("<td width='10%' align='center'>".$openrow["spec_density"]."</td>");             
             print("<td width='10%' align='center'>".$openrow["actual_temp"]."</td>");             
             print("<td width='10%' align='center'>".$openrow["actual_temp_density"]."</td>");
             print("<td width='10%' align='center'>".$openrow["user"]."</td>");
             print("</tr>");
          }
          print("</table>");
  			if(empty($tank_stock))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}