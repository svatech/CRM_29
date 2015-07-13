$("#start_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',		
	defaultDate: new Date()		
});

$("#end_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',		
	defaultDate: new Date()		
});

function fuel_stmt(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while Loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var info={};
	info["sdate"]=sdate;
	$.post(site_url+"/statements/fuel_stmt/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	
	//alert(sdate);
}



$("#print_fuel_stmt").live("click", function(){
	var reporthdr="<p style='font-size:12pt; font-weight:bolder; color: #FF0033'>Pricol Fuel & Lube Services</p>";
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var date_value = document.getElementById("date_val").value;
	/*var content_head = "<table width='100%' border='0' cellpadding='1' cellspacing='1'><tr style='color: white; background-color: #FF0033; font-size: 11pt'>" +
	"<td width='6.5%' align='center'>SNO.</td>" +
	"<td width='17%' align='center'>TT Number</td>" +
	"<td width='27.7%' align='center'>Transpoter Name</td>" +
	"<td width='20.7%' align='center'>TT Report Time</td>" +
	"<td width='14.5%' align='center'>SerialNo</td>" +
	"<td width='13.8%' align='center'>Authorized</td></tr></table>";
	*/
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head><title>Fuel Statement</title>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	docprint.document.write(reporthdr);
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Statement for Fuel/Lube/Other Sales on "+date_value+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	if(docprint.document.getElementById("hdr_row_1")!=null){
	docprint.document.getElementById("hdr_row_1").style.color='black';
	docprint.document.getElementById("hdr_row_1").style.border='1px solid black';
	}
	if(docprint.document.getElementById("hdr_row_2")!=null){
	docprint.document.getElementById("hdr_row_2").style.color='black';
	docprint.document.getElementById("hdr_row_2").style.border='1px solid black';
	}
	if(docprint.document.getElementById("hdr_row_3")!=null){
	docprint.document.getElementById("hdr_row_3").style.color='black';
	docprint.document.getElementById("hdr_row_3").style.border='1px solid black';
	}
	if(docprint.document.getElementById("hdr_row_4")!=null){
	docprint.document.getElementById("hdr_row_4").style.color='black';
	docprint.document.getElementById("hdr_row_4").style.border='1px solid black';
	}
	if(docprint.document.getElementById("hdr_row_5")!=null){
	docprint.document.getElementById("hdr_row_5").style.color='black';
	docprint.document.getElementById("hdr_row_5").style.border='1px solid black';
	}
	if(docprint.document.getElementById("hdr_row_6")!=null){
		docprint.document.getElementById("hdr_row_6").style.color='black';
		docprint.document.getElementById("hdr_row_6").style.border='1px solid black';
		}
	if(docprint.document.getElementById("hdr_row_7")!=null){
		docprint.document.getElementById("hdr_row_7").style.color='black';
		docprint.document.getElementById("hdr_row_7").style.border='1px solid black';
		}
	//docprint.document.getElementsByTagName("tr").removeClass('td_rows');
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	});

$("#fuel_stmt_dwnld").live("click", function(){
	fuel_stmt_dwnld();
	
});

function fuel_stmt_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var downloadurl=site_url+"/statements/fuel_stmt_dwnld/"+sdate;
	window.location=downloadurl;
	
}

function cumulative_fuel_stmt(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while Loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	$.post(site_url+"/statements/cumulative_fuel_stmt_rpt/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
	});
}

$("#print_cumulative_fuel_stmt").live("click", function(){
	var reporthdr="<p style='font-size:12pt; font-weight:bolder; color: #FF0033'>Pricol Fuel & Lube Services</p>";
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate = document.getElementById("start_date").value;
	var edate = document.getElementById("end_date").value;
	/*var content_head = "<table width='100%' border='0' cellpadding='1' cellspacing='1'><tr style='color: white; background-color: #FF0033; font-size: 11pt'>" +
	"<td width='6.5%' align='center'>SNO.</td>" +
	"<td width='17%' align='center'>TT Number</td>" +
	"<td width='27.7%' align='center'>Transpoter Name</td>" +
	"<td width='20.7%' align='center'>TT Report Time</td>" +
	"<td width='14.5%' align='center'>SerialNo</td>" +
	"<td width='13.8%' align='center'>Authorized</td></tr></table>";
	*/
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head><title>Cumulative Fuel Statement</title>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	docprint.document.write(reporthdr);
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Statement for Fuel/Lube/Other Sales from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	if(docprint.document.getElementById("hdr_row_1")!=null){
	docprint.document.getElementById("hdr_row_1").style.color='black';
	docprint.document.getElementById("hdr_row_1").style.border='1px solid black';
	}
	if(docprint.document.getElementById("hdr_row_2")!=null){
	docprint.document.getElementById("hdr_row_2").style.color='black';
	docprint.document.getElementById("hdr_row_2").style.border='1px solid black';
	}
	if(docprint.document.getElementById("hdr_row_3")!=null){
	docprint.document.getElementById("hdr_row_3").style.color='black';
	docprint.document.getElementById("hdr_row_3").style.border='1px solid black';
	}
	if(docprint.document.getElementById("hdr_row_4")!=null){
	docprint.document.getElementById("hdr_row_4").style.color='black';
	docprint.document.getElementById("hdr_row_4").style.border='1px solid black';
	}
	if(docprint.document.getElementById("hdr_row_5")!=null){
	docprint.document.getElementById("hdr_row_5").style.color='black';
	docprint.document.getElementById("hdr_row_5").style.border='1px solid black';
	}
	if(docprint.document.getElementById("hdr_row_6")!=null){
		docprint.document.getElementById("hdr_row_6").style.color='black';
		docprint.document.getElementById("hdr_row_6").style.border='1px solid black';
		}
	if(docprint.document.getElementById("hdr_row_7")!=null){
		docprint.document.getElementById("hdr_row_7").style.color='black';
		docprint.document.getElementById("hdr_row_7").style.border='1px solid black';
		}
	//docprint.document.getElementsByTagName("tr").removeClass('td_rows');
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	});

$("#cumulative_fuel_stmt_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var params=sdate+"::"+edate;
	var downloadurl=site_url+"/statements/cumulative_fuel_stmt_dwnld/"+params;
	window.location=downloadurl;
	
});