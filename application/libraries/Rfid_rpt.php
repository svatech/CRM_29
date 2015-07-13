<?php 

class Rfid_rpt{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Rfid_Vehicles_Report.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Rfid Vehicles Report</p>"); 
        print("</tr>");
    
	  
     
	 	print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  class='alt_row' style='border-collapse:collapse;'>");
       
       print("<tr bgcolor='' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white; '>");
       print("<td width='10%' align='center'>Vehicle No</td>");
       print("<td width='10%' align='center'>Actiontime</td>");
       print("<td width='10%' align='center'>Bill_No</td>");
       print("<td width='10%' align='center'>Bill_Date</td>");
       //print("<td width='10%' align='center'>Details</td>");

      foreach($data as $openrow) {
     		 print("<tr class='small'>");
       		 print("<td width='10%' align='center'>".$openrow["vehicle_no"]."</td>");
             print("<td width='10%' align='center'>".($openrow["action_time"]!='0000-00-00' ? date('d-m-Y H:m:s',strtotime($openrow["action_time"])) : '')."</td>");
             print("<td width='10%' align='center'>".$openrow["bill_no"]."</td>");
             print("<td width='10%' align='center'>".($openrow["bill_time"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["bill_time"])) : '')."</td>");
             //print("<td width='10%'><a  href='javascript:show_cancelbill_details(\"".$openrow["bill_no"]."\");' id='edit_id' ><font color=''>Click</font></a></td>"); 
          }
     
          print("</table>");
			if(empty($data))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}
        }
}
?>