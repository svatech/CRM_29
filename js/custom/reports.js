$(document).ready(function(){
			$('#vehicle_no').autocomplete({
			source: vehicles_array
		});
				
	
});
$("#start_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',onClose:function(selectedDate){$("#end_date").datepicker("option","minDate",selectedDate);},	
	defaultDate: new Date()		
});

$("#end_date").datepicker({
	dateFormat: 'yy-mm-dd',	maxDate: '+0d',	
	defaultDate: new Date()		
});

$("#acct_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',		
	defaultDate: new Date()		
});
String.prototype.trim = function()
{return ((this.replace(/^[\s\xA0]+/, "")).replace(/[\s\xA0]+$/, ""));};

String.prototype.startsWith = function(str)
{return (this.match(str)==str);};

String.prototype.endsWith = function(str)
{return (this.match(str+"$")==str);};


function get_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
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
	$.post(site_url+"/reports/get_report/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
		
	});
}
	}
function oil_service_sms(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
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
	$.post(site_url+"/reports/oil_service_sms_report/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
		
	});
}
	}

function searchbycustomername()
{
	 var customer=document.getElementById('customer').value;
	 //alert(customer);
	 filterTableBycustomername(customer);
	 
}
function filterTableBycustomername(str){
	
	str.trim();
	 var rowid, colid, rowc;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="cust_name"+i;
	    var lstr=(str.toString()).toLowerCase();
	    displayRowStartsWith(rowid,colid,lstr);
	  }
	}
function displayRowStartsWith(rowid,colid,str){
	var row = document.getElementById(rowid);
      var searchcol= document.getElementById(colid);
     var colstr=searchcol.value;
     var lcolstr=(colstr.toString()).toLowerCase();
      if (lcolstr.startsWith(str))
    	  row.style.display = '';
      else
          row.style.display = 'none';
}



function other_sale_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var pdt=document.getElementById("product").value;
	var shift=document.getElementById("shift").value;
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
	info["product"]=pdt;
	info["shift"]=shift;
	$.post(site_url+"/reports/other_sale_report/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}
}
function ind_sal_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var cust_name=document.getElementById("cust_name").value;
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
	info["cust_name"]=cust_name;
	$.post(site_url+"/reports/ind_sal_report/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}
}

function get_pur_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var pdt_type=document.getElementById("pdt_type").value;
	//alert(sdate+" "+edate+" "+pdt_type);
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
	info["product_type"]=pdt_type;
	$.post(site_url+"/reports/pet_pur_report/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}
}

function get_cash_inflow(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
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
	$.post(site_url+"/reports/cash_inflow_report/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}
}
function other_pur_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var supp_name=document.getElementById("supp_name").value;
	if(document.getElementById("show_det").checked==true){
		details="yes";
	}
	else{
		details="no";
	}
	//alert(sdate+" "+edate+" "+supp_name);
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
	info["supp_name"]=supp_name;
	info["details"]=details;
	$.post(site_url+"/reports/other_pur_report/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}
}
function tank_stock_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var tank_no=document.getElementById("tank_no").value;
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	info["tank_no"]=tank_no;
	$.post(site_url+"/reports/tank_stock_rpt/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
	});
}
function get_test_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var pump_no=document.getElementById("pump_no").value;
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	info["pump_no"]=pump_no;
	$.post(site_url+"/reports/test_reg_rpt/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
	});
}
function shift_close_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var acct_date=document.getElementById("acct_date").value;
	var ctr=document.getElementById("counter").value;
	var shift=document.getElementById("shift").value;
	var info={};
	info["acct_date"]=acct_date;
	info["counter"]=ctr;
	info["shift"]=shift;
	if(acct_date==''){
		alert("Please Select any Date");
	}
	else
	{
		$.post(site_url+"/reports/check_shift_closed/",info,function(data){
			if(data=='yes'){
				$.post(site_url+"/reports/shift_close_report/",info,function(data){
					
					$("#contentData").html("");
					$("#contentData").append(data);
				});
			}
			else
				{
				$("#contentData").html("");
				$("#contentData").append("<div style='margin:150px 0px 0px 370px'><font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >The Shift is Not Closed...!</font></div>");
				}
		});
		
	}
}

$("#print_pet_sale_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var filter=document.getElementById("filter").value;
	if(filter=='allshift'){
		stmt='for All Three Shifts';
	}
	else if(filter=='1'){
		stmt='for I Shift';
	}
	else if(filter=='2'){
		stmt='for II Shift';
	}
	else if(filter=='3'){
		stmt='for III Shift';
	}
	else if(filter=='date'){
		stmt='-Datewise Cumulative Report';
	}
	else if(filter=='month'){
		stmt=' -Monthwise Cumulative Report';
	}
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Petrol / Diesel Sales Report from "+sdate+" to "+edate+" "+stmt +"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

$("#print_oil_service_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	/*var filter=document.getElementById("filter").value;
	if(filter=='allshift'){
		stmt='for All Three Shifts';
	}
	else if(filter=='1'){
		stmt='for I Shift';
	}
	else if(filter=='2'){
		stmt='for II Shift';
	}
	else if(filter=='3'){
		stmt='for III Shift';
	}
	else if(filter=='date'){
		stmt='-Datewise Cumulative Report';
	}
	else if(filter=='month'){
		stmt=' -Monthwise Cumulative Report';
	}*/
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Oil Service SMS Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

$("#print_oth_sal_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	/*var filter=document.getElementById("filter").value;
	if(filter=='allshift'){
		stmt='for All Three Shifts';
	}
	else if(filter=='1'){
		stmt='for I Shift';
	}
	else if(filter=='2'){
		stmt='for II Shift';
	}
	else if(filter=='3'){
		stmt='for III Shift';
	}
	else if(filter=='date'){
		stmt='-Datewise Cumulative Report';
	}
	else if(filter=='month'){
		stmt=' -Monthwise Cumulative Report';
	}*/
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Other Products Sales Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

$("#print_ind_sal_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Indent Sales Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

$("#print_pet_pur_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Petrol / Diesel Purchase Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

$("#print_oth_pur_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Other Products Purchase Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

$("#print_test_reg").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Testing Register Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

$("#print_tank_stock_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Tank Stock Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("tab_hdr").style.color='black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});
$("#pet_sal_dwnld").live("click", function(){
	pet_sal_dwnld();
	
});


$("#print_shift_close_report").live("click", function(){
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	//var sdate=document.getElementById("start_date").value;
	//var edate=document.getElementById("end_date").value;
	
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	//docprint.document.write("<p align='center' style='color: #FF0033'>Other Products Sales Report from "+sdate+" to "+edate+"</p>");
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
function pet_sal_dwnld(){
	//alert();
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var params=sdate+"::"+edate+"::"+filter;
	var downloadurl=site_url+"/reports/pet_sal_dwnld/"+params;
	window.location=downloadurl;
	//$.post(site_url+"/reports/pet_sal_dwnld",{s_date:sdate,e_date:edate,s_filter:filter},function(data){
		//window.location=data;
	//});
}

$("#oth_sal_dwnld").live("click", function(){
	oth_sal_dwnld();
	
});

function oth_sal_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var pdt=document.getElementById("product").value;
	var shift=document.getElementById("shift").value;
	var params=sdate+"::"+edate+"::"+pdt+"::"+shift;
	var downloadurl=site_url+"/reports/oth_sal_dwnld/"+params;
	window.location=downloadurl;
	
}

$("#ind_sal_dwnld").live("click", function(){
	ind_sal_dwnld();
	
});

function ind_sal_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var cust_id=document.getElementById("cust_name").value;
	var params=sdate+"::"+edate+"::"+cust_id;
	var downloadurl=site_url+"/reports/ind_sal_dwnld/"+params;
	window.location=downloadurl;
	
}

$("#pet_pur_dwnld").live("click", function(){
	pet_pur_dwnld();
	
});

function pet_pur_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var pdt=document.getElementById("pdt_type").value;
	var params=sdate+"::"+edate+"::"+pdt;
	var downloadurl=site_url+"/reports/pet_pur_dwnld/"+params;
	window.location=downloadurl;
	
}

$("#oth_pur_dwnld").live("click", function(){
	oth_pur_dwnld();
	
});

function oth_pur_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var supp=document.getElementById("supp_name").value;
	if(document.getElementById("show_det").checked==true){
		details="yes";
	}
	else{
		details="no";
	}
	var params=sdate+"::"+edate+"::"+supp+"::"+details;
	var downloadurl=site_url+"/reports/oth_pur_dwnld/"+params;
	window.location=downloadurl;
	
}

$("#tank_stock_dwnld").live("click", function(){
	tank_stock_dwnld();
	
});

function tank_stock_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var tank=document.getElementById("tank_no").value;
	var params=sdate+"::"+edate+"::"+tank;
	var downloadurl=site_url+"/reports/tank_stock_dwnld/"+params;
	window.location=downloadurl;
	
}
$("#test_reg_dwnld").live("click", function(){
	test_reg_dwnld();
	
});

function test_reg_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var pump=document.getElementById("pump_no").value;
	var params=sdate+"::"+edate+"::"+pump;
	var downloadurl=site_url+"/reports/test_reg_dwnld/"+params;
	window.location=downloadurl;
	
}

$("#pet_reg_dwnld").live("click", function(){
	pet_reg_dwnld();
	
});

function pet_reg_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var filter=document.getElementById("filter").value;
	var vehicle_no=document.getElementById("vehicle_no").value;
	var params=sdate+"::"+edate+"::"+filter+"::"+vehicle_no;
	var downloadurl=site_url+"/reports/pet_reg_dwnld/"+params;
	window.location=downloadurl;
	
}

$("#oth_reg_dwnld").live("click", function(){
	oth_reg_dwnld();
	
});

function oth_reg_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var filter=document.getElementById("filter").value;
	var vehicle_no=document.getElementById("vehicle_no").value;
	var params=sdate+"::"+edate+"::"+filter+"::"+vehicle_no;
	var downloadurl=site_url+"/reports/oth_reg_dwnld/"+params;
	window.location=downloadurl;
	
}


$("#shift_close_dwnld").live("click", function(){
	shift_close_dwnld();
	
});

function shift_close_dwnld(){
	var acct_date=document.getElementById("acct_date").value;
	var counter=document.getElementById("counter").value;
	var shift=document.getElementById("shift").value;
	var params=acct_date+"::"+counter+"::"+shift;
	var downloadurl=site_url+"/reports/shift_close_dwnld/"+params;
	window.location=downloadurl;
	
}
function get_pet_bill_register(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var filter=document.getElementById("filter").value;
	var vehicle_no=document.getElementById("vehicle_no").value;
	//var pdt_type=document.getElementById("pdt_type").value;
	//alert(sdate+" "+edate+" "+pdt_type);
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	info["filter"]=filter;
	info["vehicle_no"]=vehicle_no;
	//info["product_type"]=pdt_type;
	$.post(site_url+"/reports/get_pet_bill_register/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
	});
}
function get_other_bill_register(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var filter=document.getElementById("filter").value;
	var vehicle_no=document.getElementById("vehicle_no").value;
	//var pdt_type=document.getElementById("pdt_type").value;
	//alert(sdate+" "+edate+" "+pdt_type);
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	info["filter"]=filter;
	info["vehicle_no"]=vehicle_no;
	//info["product_type"]=pdt_type;
	$.post(site_url+"/reports/get_other_bill_register/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
	});
}

function get_expenses_report(){
	
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
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
	$.post(site_url+"/reports/get_expenses_report/",info,function(data){
		
		$("#contentData").html("");
		$("#contentData").append(data);
		
	});
}
	}

$("#print_expenses_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Expenses Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

$("#expenses_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var params=sdate+"::"+edate+"::"+filter;
	var downloadurl=site_url+"/reports/expenses_dwnld/"+params;
	window.location=downloadurl;
	
});

function get_transactions_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var filter=document.getElementById("filter").value;
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
	$.post(site_url+"/reports/get_transactions_report/",info,function(data){
		$("#contentData").html("");
		$("#contentData").append(data);
		
	});
	}
}

$("#print_transactions_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Transactions Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

$("#transactions_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var filter=document.getElementById("filter").value;
	var params=sdate+"::"+edate+"::"+filter;
	var downloadurl=site_url+"/reports/transactions_dwnld/"+params;
	window.location=downloadurl;
	
});

function ind_stmt_payment_report(){
$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
var sdate=document.getElementById("start_date").value;
var edate=document.getElementById("end_date").value;
var cust_name=document.getElementById("cust_name").value;
var payment_type=document.getElementById("payment_type").value;
//alert(cust_name);
//alert(payment_type);
var info={};
info["sdate"]=sdate;
info["edate"]=edate;
info["cust_name"]=cust_name;
info["payment_type"]=payment_type;
$.post(site_url+"/reports/ind_stmt_payment_report/",info,function(data){
	//alert(data);
	$("#contentData").html("");
	$("#contentData").append(data);
});
}

$("#print_ind_stmt_paymt_rpt").click(function(){	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Payment Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

function get_rfid_veh_info()
{
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	
	if(sdate == "")
		{
		alert("Please Select start date");
		}else if(edate == "")  
		{
		alert("Please Select end date");
		}else {
						var date={};
						date['sdate']=sdate;
						date['edate']=edate;
					$.post(site_url + "/reports/rfid_vehicles_rpt",date,function(data) {
					$("#contentData").html("");
					$("#contentData").append(data);

					}); 
					}
}

function show_rfid_details(bill_no)
{
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=1027, height=550,toolbar=no,addressbar=no");
	var generatedContent="<html><head><title>Cancel Bill Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /></head>"+
	 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Bill Information </span></p>"+
	 "<hr width='100%'>"+
	 "<div id='retailbill' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:300px;margin-bottom:30px'><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
	 updatepop.document.write(generatedContent);   
	
	$.get(site_url + "/reports/rfid_bill_details/"+bill_no,function(data){
		updatepop.document.getElementById('retailbill').innerHTML=data;		
	});

}

$("#print_rfid_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Rfid Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});
$("#ind_stmt_paymt_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var cust_name=document.getElementById("cust_name").value;
	var payment_type=document.getElementById("payment_type").value;
	var params=sdate+"::"+edate+"::"+cust_name+"::"+payment_type;
	var downloadurl=site_url+"/reports/ind_stmt_paymt_dwnld/"+params;
	window.location=downloadurl;
	
});

$("#rfid_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	//var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var params=sdate+"::"+edate;
	var downloadurl=site_url+"/reports/rfid_dwnld/"+params;
	window.location=downloadurl;
	
});
$("#cash_inflow_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	//var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var params=sdate+"::"+edate;
	var downloadurl=site_url+"/reports/cash_inflow_dwnld/"+params;
	window.location=downloadurl;
	
});

function indent_stmt_details(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var cust_name=document.getElementById("cust_name").value;
		var info={};
		info["sdate"]=sdate;
		info["edate"]=edate;
		info["cust_name"]=cust_name;
		$.post(site_url+"/reports/indent_stmt_rpt_det/",info,function(data){
			
			$("#contentData").html("");
			$("#contentData").append(data);
		});
	}

$("#print_indent_stmt_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Indent Statements Report From "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});
$("#indent_stmt_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var cust_id=document.getElementById("cust_name").value;
	var params=sdate+"::"+edate+"::"+cust_id;
	//var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var downloadurl=site_url+"/reports/indent_stmt_dwnld/"+params;
	window.location=downloadurl;
});
function cheque_sal_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	//alert(cust_name);
	//alert(payment_type);
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	$.post(site_url+"/reports/cheque_sal_rpt_page/",info,function(data){
		//alert(data);
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}

$("#cheque_sal_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var params=sdate+"::"+edate;
	//var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var downloadurl=site_url+"/reports/cheque_sal_dwnld/"+params;
	window.location=downloadurl;
});

$("#print_cheque_sal_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Cheque Sales Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});