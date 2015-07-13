$("#start_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',onClose:function(selectedDate){$("#end_date").datepicker("option","minDate",selectedDate);},		
	defaultDate: new Date()		
});


$("#end_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',		
	defaultDate: new Date()		
});

$("#ebook_month").datepicker({
	dateFormat: 'yy-mm-dd',		
	defaultDate: new Date()		
});

String.prototype.startsWith = function(str)
{return (this.match(str)==str);};

String.prototype.endsWith = function(str)
{return (this.match(str+"$")==str);};


function get_ind_sales_stmt(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while Loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var cust_name=document.getElementById("cust_name").value;
	if(cust_name=='default'){
		alert("Please Select a customer");
		return false;
	}
	else
		{
		//alert(cust_name);
		var info={};
		info["sdate"]=sdate;
		info["edate"]=edate;
		info["cust_name"]=cust_name;
		$.post(site_url+"/statements/indent_stmt_page/",info,function(data){
			
			$("#contentData").html("");
			$("#contentData").append(data);
			$("#bill_date").datepicker({
				dateFormat: 'yy-mm-dd',		
				defaultDate: new Date()		
			});
			
		});
		
		}
	
}

function cumulative_sales_stmt(){
	
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var category=document.getElementById("category").value;
	
	if(sdate=='' || edate==''){
		alert("Please Select Start date and End date");
		return false;
	}
	else
		{
		$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while Loading..</p>");
		//alert(cust_name);
		var info={};
		info["sdate"]=sdate;
		info["edate"]=edate;
		info["category"]=category;
		$.post(site_url+"/statements/cumulative_sales_stmt_rpt/",info,function(data){
			
			$("#contentData").html("");
			$("#contentData").append(data);
		});
		
		}
}

function searchbycustomername()
{
	 var customer=document.getElementById('customer').value;
	 
	 filterTableBycustomername(customer);
	 
}

function filterTableBycustomername(str){
	
	str.trim();
	 var rowid, colid, rowc,vbid;
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

$("#print_indent_stmt").click(function(){
	
		var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
		disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
		//var date_value = document.getElementById("date_val").value;
		var content_value = document.getElementById("contentData").innerHTML;
		var docprint=window.open("","",disp_setting);
		docprint.document.open();
		docprint.document.write('<html><head>');
		docprint.document.write('</head><body onLoad="self.print()"><center>');
		docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Indent Statements Report</p>");
		//docprint.document.write(reporthdr);
		//docprint.document.write("<p align='left' style='color: #FF0033'>Statement for Fuel/Lube/Other Sales on</p>");
		//docprint.document.write(content_head);
		docprint.document.write(content_value);
		//docprint.document.getElementById("bill_date").value=document.getElementById("bill_date").value;
		//docprint.document.getElementById("bill_no").value=document.getElementById("bill_no").value;
		docprint.document.getElementById("bill_date").style.display='none';
		docprint.document.getElementById("hdr_row").style.color='black';
		docprint.document.getElementById("hdr_row").style.border='1px solid black';
		//docprint.document.getElementsByTagName("tr").removeClass('td_rows');
		docprint.document.write('</center></body></html>');
		docprint.document.close();
		docprint.focus();
		//window.location.reload();
	});


$("#print_stock_stmt").click(function(){
	
	//var reporthdr="<p style='font-size:12pt; font-weight:bolder; color: #FF0033'>Pricol Fuel & Lube Services</p>";
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	//var date_value = document.getElementById("date_val").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	//docprint.document.write(reporthdr);
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Stock Statement from "+sdate+" to "+edate+"</p>");
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


$("#print_ebook_stmt").click(function(){
	
	//var reporthdr="<p style='font-size:12pt; font-weight:bolder; color: #FF0033'>Pricol Fuel & Lube Services</p>";
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var tank_name=document.getElementById("tank_name").value;
	var month=document.getElementById("month").value;
	var year=document.getElementById("year").value;
	//var date_value = document.getElementById("date_val").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	//docprint.document.write(reporthdr);
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>E-Book for "+tank_name+" for the Month of "+month+"-"+year+"</p>");
	//docprint.document.write(content_head);
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});
$("#print_cumulative_sales_stmt").click(function(){
	
	//var reporthdr="<p style='font-size:12pt; font-weight:bolder; color: #FF0033'>Pricol Fuel & Lube Services</p>";
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
	disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var content_value = document.getElementById("contentData").innerHTML;
	var docprint=window.open("","",disp_setting);
	docprint.document.open();
	docprint.document.write('<html><head>');
	docprint.document.write('</head><body onLoad="self.print()"><center>');
	docprint.document.write("<p align='center' style='font-weight:bolder;color: #FF0033'>Cumulative Sales Statement from "+sdate+" to "+edate+"</p>");
	docprint.document.write(content_value);
	docprint.document.getElementById("hdr_row").style.color='black';
	docprint.document.getElementById("hdr_row").style.border='1px solid black';
	docprint.document.write('</center></body></html>');
	docprint.document.close();
	docprint.focus();
	
	
	});

function get_stock_stmt()
{
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while Loading..</p>");
	var start=document.getElementById("start_date").value;
	var end=document.getElementById("end_date").value;
	var category=document.getElementById("category").value;
	if(start == "")
		{
		alert("Please Select start date");
		}else if(end == "")  
		{
		alert("Please Select end date");
		}else {
						var date={};
						date['start']=start;
						date['end']=end;
					$.post(site_url + "/statements/full_stock_list",date,function(data) {
					$("#contentData").html("");
					$("#contentData").append(data);
					if(category == "all"){
						//document.getElementById("fuels_table").style.display="";
						document.getElementById("fuels_heading_table").style.display="";
						document.getElementById("fuels_cati").style.display="";
						//document.getElementById("oil_table").style.display="";
						document.getElementById("oil_heading_table").style.display="";
						document.getElementById("oil_cati").style.display="";
						//document.getElementById("grease_table").style.display="";
						document.getElementById("grease_heading_table").style.display="";
						document.getElementById("grease_cati").style.display="";
						//document.getElementById("others_table").style.display="";
						document.getElementById("others_heading_table").style.display="";
						document.getElementById("others_cati").style.display="";
						//document.getElementById("twotoil_table").style.display="";
						document.getElementById("twotoil_heading_table").style.display="";
						document.getElementById("twotoil_cati").style.display="";
					}else if(category == "FUEL"){
						//document.getElementById("fuels_table").style.display="";
						document.getElementById("fuels_heading_table").style.display="";
						document.getElementById("fuels_cati").style.display="";
						}else if(category == "OIL"){
							//document.getElementById("oil_table").style.display="";
							document.getElementById("oil_heading_table").style.display="";
							document.getElementById("oil_cati").style.display="";
						}else if(category == "GREASE"){
							//document.getElementById("grease_table").style.display="";
							document.getElementById("grease_heading_table").style.display="";
							document.getElementById("grease_cati").style.display="";
						}else if(category == "OTHERS"){
							//document.getElementById("others_table").style.display="";
							document.getElementById("others_heading_table").style.display="";
							document.getElementById("others_cati").style.display="";
						}else if(category == "2T_OIL_LOOSE"){
							//document.getElementById("twotoil_table").style.display="";
							document.getElementById("twotoil_heading_table").style.display="";
							document.getElementById("twotoil_cati").style.display="";
										}
		}); 
			}
}
function call(category)
{
alert(category);	
}

function get_ebook(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while Loading..</p>");
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
		$.post(site_url+"/statements/ebook_page/",info,function(data){
			
			$("#contentData").html("");
			$("#contentData").append(data);
			
		});
		
		}
	
}

$("#ebook_dwnld").live("click", function(){
	ebook_dwnld();
	
});

function ebook_dwnld(){
	var tank=document.getElementById("tank_name").value;
	var month=document.getElementById("month").value;
	var year=document.getElementById("year").value;
	var params=tank+"::"+month+"::"+year;
	var downloadurl=site_url+"/statements/ebook_dwnld/"+params;
	window.location=downloadurl;
	
}

$("#stock_stmt_dwnld").live("click", function(){
	stock_stmt_dwnld();
	
});

function stock_stmt_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var cat=document.getElementById("category").value;
	var params=sdate+"::"+edate+"::"+cat;
	var downloadurl=site_url+"/statements/stock_stmt_dwnld/"+params;
	window.location=downloadurl;
	
}

$("#cumulative_sales_stmt_dwnld").live("click", function(){
	cumulative_sales_stmt_dwnld();
	
});

function cumulative_sales_stmt_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var category=document.getElementById("category").value;
	var params=sdate+"::"+edate+"::"+category;
	var downloadurl=site_url+"/statements/cumulative_sales_stmt_dwnld/"+params;
	window.location=downloadurl;
	
}

function indent_stmt_details(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while Loading..</p>");
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	
		var info={};
		info["sdate"]=sdate;
		info["edate"]=edate;
		$.post(site_url+"/statements/indent_stmt_details/",info,function(data){
			
			$("#contentData").html("");
			$("#contentData").append(data);
		});
	}

function reprint_indent_bill(bill_no,bill_date){
	$.post(site_url+"/statements/reprint_indent_stmt/",{billno:bill_no},function(data){
		var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
		disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
		var content_value =data;
		var docprint=window.open("","",disp_setting);
		docprint.document.open();
		docprint.document.write('<html><head>');
		docprint.document.write('</head><body onLoad="self.print()"><center>');
		docprint.document.write(content_value);
		docprint.document.getElementById("bill_date").style.display='none';
		docprint.document.getElementById("bill_no").style.display='none';
		docprint.document.getElementById("billdate").innerHTML=bill_date;
		docprint.document.getElementById("billno").innerHTML=bill_no;
		docprint.document.getElementById("billno_row").style.display='';
		docprint.document.getElementById("hdr_row").style.color='black';
		docprint.document.write('</center></body></html>');
		docprint.document.close();
		docprint.focus();
	});
	
}

function show_details(bill_no){
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=1027, height=550,toolbar=no,addressbar=no");
	var generatedContent="<html><head><title>Indent Statement Info</title><script type='text/javascript' src='../../js/jquery-1.js'></script><script type='text/javascript' src='../../js/jquery-ui-1.8.18.custom.min.js'></script><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /><style type='text/css'>div.ui-datepicker{font-size:10px;width:150px;height:150px;}</style></head>"+
	 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 10px;width:90%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Bill Information </span></p>"+
	 "<hr width='100%'>"+
	 "<div id='indent_stmt_details' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:300px;margin-bottom:30px'><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
	 updatepop.document.write(generatedContent);   
	$.get(site_url + "/statements/indent_stmt_info/"+bill_no,function(data){
		updatepop.document.getElementById('indent_stmt_details').innerHTML=data;
		updatepop.$(".clearance_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
	});
}

function make_payment(bill_no){
	//updatepop.alert(bill_no);
	paymentpop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=600, height=400,toolbar=no,addressbar=no");
	var generatedContent="<html><head><title>Make Payment</title><script type='text/javascript' src='../../js/jquery-1.js'></script><script type='text/javascript' src='../../js/jquery-ui-1.8.18.custom.min.js'></script><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /><style type='text/css'>div.ui-datepicker{font-size:10px;width:150px;height:150px;}</style></head>"+
	 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Payment Information </span></p>"+
	 "<hr width='100%'>"+
	 "<div id='indent_payment_details' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:200px;margin-bottom:30px'><input type=\"button\" id='submit' value='Submit' class='button' onclick='javascript:opener.submit_payment()'/><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
	 paymentpop.document.write(generatedContent);
	 $.get(site_url + "/statements/make_payment/"+bill_no,function(data){
			paymentpop.document.getElementById('indent_payment_details').innerHTML=data;	
			paymentpop.$("#payment_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
			paymentpop.$("#cheque_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		});
}

function check_paymode(paymode){
	if(paymode=='CHEQUE'){
		paymentpop.document.getElementById("chequeno_row").style.display='';
		paymentpop.document.getElementById("chequedate_row").style.display='';
		paymentpop.document.getElementById("bankname_row").style.display='';
		paymentpop.document.getElementById("refno_row").style.display='none';
	}
	else if(paymode=='NEFT'||paymode=='RTGS'){
		paymentpop.document.getElementById("chequeno_row").style.display='none';
		paymentpop.document.getElementById("chequedate_row").style.display='none';
		paymentpop.document.getElementById("bankname_row").style.display='none';
		paymentpop.document.getElementById("refno_row").style.display='';
	}
	else{
		paymentpop.document.getElementById("chequeno_row").style.display='none';
		paymentpop.document.getElementById("chequedate_row").style.display='none';
		paymentpop.document.getElementById("bankname_row").style.display='none';
		paymentpop.document.getElementById("refno_row").style.display='none';
	}
}

function submit_payment(){
	var details={};
	details["bill_no"]=paymentpop.document.getElementById("bill_no").value;
	details["payment_date"]=paymentpop.document.getElementById("payment_date").value;
	details["payment_mode"]=paymentpop.document.getElementById("payment_mode").value;
	details["payment_amount"]=paymentpop.document.getElementById("payment_amount").value;
	if(details["payment_mode"]=='CHEQUE'){
		details["cheque_no"]=paymentpop.document.getElementById("cheque_no").value;
		details["cheque_date"]=paymentpop.document.getElementById("cheque_date").value;
		details["bank_name"]=paymentpop.document.getElementById("bank_name").value;
		details["status"]='NOT_CLEARED';
		details["ref_no"]='';
	}
	else if(details["payment_mode"]=='NEFT' || details["payment_mode"]=='RTGS'){
		details["cheque_no"]='';
		details["cheque_date"]='';
		details["bank_name"]='';
		details["status"]='CLEARED';
		details["ref_no"]=paymentpop.document.getElementById("ref_no").value;
	}
	else{
		details["cheque_no"]='';
		details["cheque_date"]='';
		details["bank_name"]='';
		details["status"]='CLEARED';
		details["ref_no"]='';
	}
	 $.post(site_url + "/statements/submit_payment/",details,function(data){
			//paymentpop.document.getElementById('indent_payment_details').innerHTML=data;
			//paymentpop.document.getElementById('submit').style.display='none';
		 	paymentpop.close();
		 	updatepop.close();
		 	show_details(data);
		});
}

function update_chequestatus(cheque_status,id){
	var pid=updatepop.document.getElementById("pid"+id).value;
	$.post(site_url + "/statements/update_chequestatus/",{payid:pid,status:cheque_status},function(data){
		
		if(cheque_status=='CLEARED'){
			updatepop.document.getElementById("cleardate"+id).disabled=false;
			updatepop.document.getElementById("cleardate"+id).style.background='';
		}
		else{
			updatepop.document.getElementById("cleardate"+id).disabled=true;
			updatepop.document.getElementById("cleardate"+id).style.background='#f0f0f0';
		}
	});
	
}

function update_clearancedate(clear_date,id){
	var pid=updatepop.document.getElementById("pid"+id).value;
	$.post(site_url + "/statements/update_clearancedate/",{payid:pid,clearance_date:clear_date},function(data){
	});
}

function cancel_indent_bill(bill_no){
	var ask = confirm("Do you want to cancel this Bill No:"+bill_no);
	{
		if(ask==true){	
	$.post(site_url + "/statements/cancel_indent_bill/",{billno:bill_no},function(data){
		indent_stmt_details();
	});
		}
	}
}
function indent_customer_statement_sms(bill_no){
	//alert(document.getElementById("indent_sms").value);
	var ask = confirm("Do you want send sms to this Bill No:"+bill_no);
	{
		if(ask==true){	
	$.post(site_url + "/statements/indent_customer_statement_sms/",{billno:bill_no},function(data){
		//alert(data);
		
		indent_stmt_details();
	});
		}
	}
}

function cancel_payment(payid){
	var bill_no=updatepop.document.getElementById("bill_no").value;
	$.post(site_url + "/statements/cancel_indent_payment/",{pid:payid},function(data){
		//updatepop.alert(data);
		updatepop.close();
		show_details(bill_no);
	});
}
$("#indent_stmt_dwnld").live("click", function(){
	indent_stmt_dwnld();
	
});

function indent_stmt_dwnld(){
	var sdate=document.getElementById("start_date").value;
	var edate=document.getElementById("end_date").value;
	var cust_name=document.getElementById("cust_name").value;
	var params=sdate+"::"+edate+"::"+cust_name;
	var downloadurl=site_url+"/statements/Indent_stmt_dwnld/"+params;
	window.location=downloadurl;
	
}
function generate_bill(){
	
	var details={};
	details["from_date"]=document.getElementById("start_date").value;
	details["to_date"]=document.getElementById("end_date").value;
	details["bill_date"]=document.getElementById("bill_date").value;
	details["cust_id"]=document.getElementById("cust_name").value;
	details["total"]=document.getElementById("grand_tot").value;
	//alert(document.getElementById("cust_name").value);
	if(details["bill_date"]==''){
		alert("Please Enter Bill Date");
		document.getElementById("bill_date").focus();
		return false;
	}
	//details["old_arrears"]=document.getElementById("old_arrears").value;
	else{
	$.post(site_url+"/statements/get_indentstmt_billno/",details,function(data){
		//var reporthdr="<p style='font-size:12pt; font-weight:bolder; color: #FF0033'>Pricol Fuel & Lube Services</p>";
		var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
		disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
		//var date_value = document.getElementById("date_val").value;
		var content_value = document.getElementById("contentData").innerHTML;
		var docprint=window.open("","",disp_setting);
		docprint.document.open();
		docprint.document.write('<html><head>');
		docprint.document.write('</head><body onLoad="self.print()"><center>');
		//docprint.document.write(reporthdr);
		//docprint.document.write("<p align='left' style='color: #FF0033'>Statement for Fuel/Lube/Other Sales on</p>");
		//docprint.document.write(content_head);
		docprint.document.write(content_value);
		//docprint.document.getElementById("bill_date").value=document.getElementById("bill_date").value;
		//docprint.document.getElementById("bill_no").value=document.getElementById("bill_no").value;
		docprint.document.getElementById("bill_date").style.display='none';
		docprint.document.getElementById("bill_no").style.display='none';
		docprint.document.getElementById("billdate").innerHTML=document.getElementById("bill_date").value;
		docprint.document.getElementById("billno").innerHTML="IS"+data;
		docprint.document.getElementById("billno_row").style.display='';
		docprint.document.getElementById("hdr_row").style.color='black';
		//docprint.document.getElementsByTagName("tr").removeClass('td_rows');
		docprint.document.write('</center></body></html>');
		docprint.document.close();
		docprint.focus();
		window.location.reload();
	});
	
	
	
	}
	
	
	};



