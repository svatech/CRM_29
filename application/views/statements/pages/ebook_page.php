<?php
 print("<table  border='1' align='left' cellpadding='1' cellspacing='1' style='overflow:scroll;border-collapse:collapse;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='color:white;border-right:1px solid white; '>");
       print("<td width='5%' align='center'><span class='txt1_color'>Date</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>Opening Volume as per Tank</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>Opening Balance</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>Quantity Received</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>Total Stock Qty</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>Quantity Sold</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>Quantity Tested</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>Cumulative Sales</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>Closing Balance</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>Loss/Gain</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>EL</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>Tank Loss(4%)</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>EL+TL</span></td>");
       print("</tr>");
       $next_day_open=0;
       $total_stock=0;
       $direct_sales=0;
       $total_sales=0;
       $cumm_sales=0;
       $open_bal=0;
       $closing_bal=0;
       $loss_gain=0;
       $el=0;
       $total_loss=0;
       foreach ($ebook as $openrow){
	   print("<tr class='small'>"); //try using j\<\s\u\p\>S\<\/\s\u\p\> also to give suffix superscript
	   print("<td width='5%' align='center'>".date('jS M', strtotime($openrow["Date"]))."</td>");
	   print("<td width='7%' align='center'>".$openrow["volume"]."</td>");
	   if($next_day_open==0){
	   	$open_bal=$openrow["volume"];
	   }
	   else{
	   	$open_bal=$next_day_open;
	   }
	   print("<td width='7%' align='center'>".$open_bal."</td>");
	   print("<td width='7%' align='center'>".$openrow["received"]."</td>");
	   $total_stock=$open_bal+$openrow["received"];
	   print("<td width='7%' align='center'>".$total_stock."</td>");
	   $direct_sales=round($openrow["sold"],3);
	   print("<td width='7%' align='center'>".$direct_sales."</td>");
	   print("<td width='7%' align='center'>".round($openrow["test"],3)."</td>");
	   $cumm_sales+=$direct_sales;
	   print("<td width='7%' align='center'>".round($cumm_sales,3)."</td>");
	   $closing_bal=$total_stock-$direct_sales;
	   $next_day_open=$closing_bal;
	   print("<td width='7%' align='center'>".round($closing_bal,3)."</td>");
	   $loss_gain=$openrow["volume"]-$open_bal;
	   print("<td width='7%' align='center'>".round($loss_gain,3)."</td>");
	   $el=$direct_sales*0.006;
	   print("<td width='7%' align='center'>".round($el,3)."</td>");
	   $tl=$openrow["volume"]*.04;
	   print("<td width='7%' align='center'>".round($tl,3)."</td>");
	   $total_loss=$tl+$el;
	    print("<td width='7%' align='center'>".round($total_loss,3)."</td>");
	   print("</tr>");
       }
       print("</table>");
       
       if(empty($ebook))
			{
			print("<div style='padding:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}