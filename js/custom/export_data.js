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

function indent_stmt_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	//alert(cust_name);
	//alert(payment_type);
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	$.post(site_url+"/export_data/indent_statement_page/",info,function(data){
		//alert(data);
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}

$("#indent_statement_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var params=sdate+"::"+edate;
	//var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var downloadurl=site_url+"/export_data/indent_statement_dwnld/"+params;
	window.location=downloadurl;
}); 

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
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Indent Statement Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

function bank_transc_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	//alert(cust_name);
	//alert(payment_type);
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	$.post(site_url+"/export_data/bank_transc_rpt_page/",info,function(data){
		//alert(data);
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}

$("#bank_transaction_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var params=sdate+"::"+edate;
	//var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var downloadurl=site_url+"/export_data/bank_transaction_dwnld/"+params;
	window.location=downloadurl;
}); 

$("#bank_transaction_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Bank Transaction Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});


function cheque_sale_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	//alert(cust_name);
	//alert(payment_type);
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	$.post(site_url+"/export_data/cheque_sale_rpt_page/",info,function(data){
		//alert(data);
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}

$("#cheque_sale_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var params=sdate+"::"+edate;
	//var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var downloadurl=site_url+"/export_data/cheque_sale_dwnld/"+params;
	window.location=downloadurl;
}); 

$("#print_cheque_sale_rpt").click(function(){
	
	
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

function cheque_sale_nt_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	//alert(cust_name);
	//alert(payment_type);
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	$.post(site_url+"/export_data/cheque_sale_nt_rpt_page/",info,function(data){
		//alert(data);
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}

$("#cheque_sale_nt_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var params=sdate+"::"+edate;
	//var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var downloadurl=site_url+"/export_data/cheque_sale_nt_dwnld/"+params;
	window.location=downloadurl;
}); 

$("#print_cheque_sale_nt_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Cheque Sales(Not cleared) Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});
function indent_stmt_payment_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	//alert(cust_name);
	//alert(payment_type);
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	$.post(site_url+"/export_data/indent_statement_payment_page/",info,function(data){
		//alert(data);
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}

$("#indent_statement_payment_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var params=sdate+"::"+edate;
	//var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var downloadurl=site_url+"/export_data/indent_statement_payment_dwnld/"+params;
	window.location=downloadurl;
}); 

$("#print_indent_stmt_payment_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Indent Statement Payment Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});


function icici_bank_transc_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	//alert(cust_name);
	//alert(payment_type);
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	$.post(site_url+"/export_data/icici_bank_transc_rpt_page/",info,function(data){
		//alert(data);
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}

$("#icici_bank_transaction_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var params=sdate+"::"+edate;
	//var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var downloadurl=site_url+"/export_data/icici_bank_transaction_dwnld/"+params;
	window.location=downloadurl;
}); 

$("#icici_bank_transaction_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>ICICI Credit Card Bank Transaction Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

function hdfc_bank_transc_rpt(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	//alert(cust_name);
	//alert(payment_type);
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	$.post(site_url+"/export_data/hdfc_bank_transc_rpt_page/",info,function(data){
		//alert(data);
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}

$("#hdfc_bank_transc_rpt_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var params=sdate+"::"+edate;
	//var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var downloadurl=site_url+"/export_data/hdfc_bank_transc_rpt_dwnld/"+params;
	window.location=downloadurl;
}); 

$("#print_hdfc_bank_transc_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>HDFC Credit Card Bank Transaction Report "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});


function updateexport_data()
{
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=700, height=550,toolbar=no,addressbar=yes");
	var generatedContent="<html><head><title>Update Pump Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /></head>"+
	 "<body background='' bgcolor=''><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:0px solid black ;border-radius:0px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Export Data Settings </span></p>"+
"<hr width='100%'>"+
"<div id='mypump' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:200px;margin-bottom:30px'><input style='margin-right:25px;' class='button' type=\"button\" id='update' value='Update' onclick='opener.updateexport_dataFinish()'/><input class='button' type=\"button\" id='close' value='Close' onclick='javascript:self.close()'/></div></body</html>";
	 updatepop.document.write(generatedContent);   
	 $.get(site_url + "/export_data/fetch_export_info/",function(data){	
		 updatepop.document.getElementById('mypump').innerHTML=data;
		}); 
}

function updateexport_dataFinish(){
	var section_code=updatepop.document.getElementById("section_code").value;		
	var business_area=updatepop.document.getElementById("business_area").value;
	var sap_sale_code=updatepop.document.getElementById("sap_sale_code").value;
	var cost_center=updatepop.document.getElementById("cost_center").value;
	var profit_center=updatepop.document.getElementById("profit_center").value;
	var indent_stmt_rpt_ref=updatepop.document.getElementById("indent_stmt_rpt_ref").value;		
	var bank_trans_rpt_ref=updatepop.document.getElementById("bank_trans_rpt_ref").value;
	var cheque_sales_rpt_ref=updatepop.document.getElementById("cheque_sales_rpt_ref").value;
	var indent_pmt_rpt_ref=updatepop.document.getElementById("indent_pmt_rpt_ref").value;
	var credit_sales_rpt_ref=updatepop.document.getElementById("credit_sales_rpt_ref").value;
	var hdfc_credit_sales_ref=updatepop.document.getElementById("hdfc_credit_sales_ref").value;
	var cash_sales_rpt_ref=updatepop.document.getElementById("cash_sales_rpt_ref").value;
	if(section_code==''){
		updatepop.alert("Please Enter Section Code");
		return false;
	}
	else if(business_area==''){
		updatepop.alert("Please Enter Business Area");
		return false;
	}
	else if(sap_sale_code==''){
		updatepop.alert("Please Enter SAP Sale Code");
		return false;
	}
	else if(cost_center==''){
		updatepop.alert("Please Enter Cost Center");
		return false;
	}
	else if(profit_center==''){
		updatepop.alert("Please Enter Profit Center");
		return false;
	}
	else if(indent_stmt_rpt_ref==''){
		updatepop.alert("Please Enter Indent Statement Report Reference");
		return false;
	}
	else if(bank_trans_rpt_ref==''){
		updatepop.alert("Please Enter Bank Transaction Report Reference");
		return false;
	}
	else if(cheque_sales_rpt_ref==''){
		updatepop.alert("Please Enter Cheque Sales Report Reference");
		return false;
	}
	else if(indent_pmt_rpt_ref==''){
		updatepop.alert("Please Enter Indent Statement Report Reference");
		return false;
	}
	else if(credit_sales_rpt_ref==''){
		updatepop.alert("Please Enter Credit Sales Report Reference");
		return false;
	}
	else if(hdfc_credit_sales_ref==''){
		updatepop.alert("Please Enter Credit Sales Report Reference");
		return false;
	}
	else if(cash_sales_rpt_ref==''){
		updatepop.alert("Please Enter Credit Sales Report Reference");
		return false;
	}
	var collect={};
	collect["section_code"]=section_code;
	collect["business_area"]=business_area;
	collect["sap_sale_code"]=sap_sale_code;
	collect["cost_center"]=cost_center;
	collect["profit_center"]=profit_center;
	collect["indent_stmt_rpt_ref"]=indent_stmt_rpt_ref;
	collect["bank_trans_rpt_ref"]=bank_trans_rpt_ref;
	collect["cheque_sales_rpt_ref"]=cheque_sales_rpt_ref;
	collect["indent_pmt_rpt_ref"]=indent_pmt_rpt_ref;
	collect["credit_sales_rpt_ref"]=credit_sales_rpt_ref;
	collect["hdfc_credit_sales_ref"]=hdfc_credit_sales_ref;
	collect["cash_sales_rpt_ref"]=cash_sales_rpt_ref;
	
	   $.post(site_url+"/export_data/export_data_master_update",collect,function(data){
		   updatepop.document.getElementById('mypump').innerHTML=data;
		   updatepop.document.getElementById('update').style.display="none";
		   updatepop.document.getElementById('close').style.marginLeft="30px";
		   window.location.reload();	
	    });
  }

function cash_sale_report(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	//alert(cust_name);
	//alert(payment_type);
	var info={};
	info["sdate"]=sdate;
	info["edate"]=edate;
	$.post(site_url+"/export_data/cash_sale_rpt_page/",info,function(data){
		//alert(data);
		$("#contentData").html("");
		$("#contentData").append(data);
	});
	}

$("#cash_sale_dwnld").live("click", function(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var params=sdate+"::"+edate;
	//var filter=document.getElementById("filter").value;
	//alert(sdate+" "+edate+" "+filter);
	var downloadurl=site_url+"/export_data/cash_sale_dwnld/"+params;
	window.location=downloadurl;
}); 

$("#print_cash_sale_rpt").click(function(){
	
	
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Cash Sales Report from "+sdate+" to "+edate+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

