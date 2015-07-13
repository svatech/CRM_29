$("#start_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',		
	defaultDate: new Date()		
});
$("#end_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',		
	defaultDate: new Date()		
});

function ro_sales(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while updating..</p>");
	var sdate=document.getElementById("start_date").value;
	var info={};
	info["sdate"]=sdate;
	$.post(site_url+"/sopages/ro_sales_rpt/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	
	//alert(sdate);
}

function ro_inventory(){
	var start=document.getElementById("start_date").value;
	var end=document.getElementById("start_date").value;
	if(start == "")
	{
	alert("Please Select  date");
	}else {
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while updating..</p>");
	
	
						var date={};
						date['start']=start;
						date['end']=end;
					$.post(site_url + "/sopages/full_stock_list",date,function(data) {
					$("#contentData").html("");
					$("#contentData").append(data);
					
						document.getElementById("fuels_table").style.display="";
						document.getElementById("fuels_heading_table").style.display="";
						document.getElementById("fuels_cati").style.display="";
						document.getElementById("oil_table").style.display="";
						document.getElementById("oil_heading_table").style.display="";
						document.getElementById("oil_cati").style.display="";
						document.getElementById("grease_table").style.display="";
						document.getElementById("grease_heading_table").style.display="";
						document.getElementById("grease_cati").style.display="";
						document.getElementById("others_table").style.display="";
						document.getElementById("others_heading_table").style.display="";
						document.getElementById("others_cati").style.display="";
						document.getElementById("twotoil_table").style.display="";
						document.getElementById("twotoil_heading_table").style.display="";
						document.getElementById("twotoil_cati").style.display="";
					
	});
	
	//alert(sdate);
}
}
$("#print_ro_inventory").click(function(){
	
	//var reporthdr="<p style='font-size:12pt; font-weight:bolder; color: #3090C7'>Pricol Fuel & Lube Services</p>";
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("start_date").value;
	//var date_value = document.getElementById("date_val").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	//docprint.document.write(reporthdr);
	docprint.document.write("<p align='center' style='color: #3090C7'>RO Inventory On "+sdate+" </p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row_1").style.color='black';
	docprint.document.getElementById("hdr_row_1").style.border='1px solid black';
	docprint.document.getElementById("hdr_row_2").style.color='black';
	docprint.document.getElementById("hdr_row_2").style.border='1px solid black';
	docprint.document.getElementById("hdr_row_3").style.color='black';
	docprint.document.getElementById("hdr_row_3").style.border='1px solid black';
	docprint.document.getElementById("hdr_row_4").style.color='black';
	docprint.document.getElementById("hdr_row_4").style.border='1px solid black';
	docprint.document.getElementById("hdr_row_5").style.color='black';
	docprint.document.getElementById("hdr_row_5").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});
$("#ro_inventory_dwnld").live("click", function(){
	ro_inventory_dwnld();
	
});

function ro_inventory_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("start_date").value;
	
	var params=sdate+"::"+edate;
	var downloadurl=site_url+"/sopages/ro_inventory_dwnld/"+params;
	window.location=downloadurl;
	
}

function ro_stockloss(){
	var tank=document.getElementById("tank_name").value;
	var month=document.getElementById("month").value;
	var year=document.getElementById("year").value;
	if(tank=='default'){
		alert("Please Select a Tank");
		return false;
	}
	else
		{
		var info={};
		info["tank"]=tank;
		info["month"]=month;
		info["year"]=year;
		$.post(site_url+"/sopages/ro_stockloss_rpt/",info,function(data){
			
			$("#contentData").html("");
			$("#contentData").append(data);
			
		});
		
		}
	
	
	
	//alert(sdate);
}


$("#ro_sales_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var downloadurl=site_url+"/sopages/ro_sales_dwnld/"+sdate;
	window.location=downloadurl;
	
});

$("#print_ro_sales").click(function(){
	
	//var reporthdr="<p style='font-size:12pt; font-weight:bolder; color: #3090C7'>Pricol Fuel & Lube Services</p>";
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	//var date_value = document.getElementById("date_val").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	//docprint.document.write(reporthdr);
	//docprint.document.write("<p align='left' style='color: #3090C7'>Statement for Fuel/Lube/Other Sales on</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	//docprint.document.getElementById("bill_date").value=document.getElementById("bill_date").value;
	//docprint.document.getElementById("bill_no").value=document.getElementById("bill_no").value;
	docprint.document.getElementById("hdr_row_1").style.color='black';
	docprint.document.getElementById("hdr_row_2").style.color='black';
	//docprint.document.getElementsByTagName("tr").removeClass('td_rows');
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});


$("#print_stockloss_stmt").click(function(){
	
	//var reporthdr="<p style='font-size:12pt; font-weight:bolder; color: #3090C7'>Pricol Fuel & Lube Services</p>";
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	//var date_value = document.getElementById("date_val").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	//docprint.document.write(reporthdr);
	//docprint.document.write("<p align='left' style='color: #3090C7'>Statement for Fuel/Lube/Other Sales on</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	//docprint.document.getElementById("bill_date").value=document.getElementById("bill_date").value;
	//docprint.document.getElementById("bill_no").value=document.getElementById("bill_no").value;
	//docprint.document.getElementById("hdr_row_1").style.color='black';
	//docprint.document.getElementById("hdr_row_2").style.color='black';
	//docprint.document.getElementsByTagName("tr").removeClass('td_rows');
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});


$("#stockloss_dwnld").live("click", function(){
	stockloss_dwnld();
	
});

function stockloss_dwnld(){
	var tank=document.getElementById("tank_name").value;
	var month=document.getElementById("month").value;
	var year=document.getElementById("year").value;
	var params=tank+"::"+month+"::"+year;
	var downloadurl=site_url+"/sopages/stockloss_dwnld/"+params;
	window.location=downloadurl;
	
}

function get_sales_chart(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while updating..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var filter=document.getElementById("filter").value;
	//var shift=document.getElementById("shift").value;
	//alert(sdate+" "+edate+" "+dtfilter+" "+shift);
if(sdate==''){
	alert("Please Select From Date");
}
else if(edate==''){
	alert("Please Select To Date");
}
else{
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	info["filter"]=filter;
	//info["shift"]=shift;
	$.post(site_url+"/sopages/get_sales_chart/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
		
	});
}
	}
function get_cumulative_sales()
{
	
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	if(sdate==''){
		alert("Please Select From Date");
	}
	else if(edate==''){
		alert("Please Select To Date");
	}
	else{
		$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while updating..</p>");
		var info={};
		info["sdate"]=sdate;
		info["edate"]=edate;
$.post(site_url+"/sopages/fetch_chart_details",info,function(data){
	
	$("#contentData").html("");
		$("#contentData").append(data);
});
	}
}
function get_fuel_sales()
{
	
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	if(sdate==''){
		alert("Please Select From Date");
	}
	else if(edate==''){
		alert("Please Select To Date");
	}
	else{
		$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while updating..</p>");
		var info={};
		info["sdate"]=sdate;
		info["edate"]=edate;
$.post(site_url+"/sopages/fetch_fuelsales_details",info,function(data){
	
	$("#contentData").html("");
		$("#contentData").append(data);
});
	}
}