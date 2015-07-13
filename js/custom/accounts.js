/**
 * 
 */
$("#trans_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',		
	defaultDate: new Date()		
});
$("#start_date").datepicker({
	dateFormat: 'yy-mm-dd', maxDate: '+0d',		
	defaultDate: new Date()		
});
$("#end_date").datepicker({
	dateFormat: 'yy-mm-dd', maxDate: '+0d',		
	defaultDate: new Date()		
});

function isFloatKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    		
    if (charCode > 31 && charCode!=46 && (charCode < 48 || charCode > 57 ))
        return false;
    return true;
}

function cust_acct_history(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var cust_name=document.getElementById("cust_name").value;
	var info={};
	info["cust_name"]=cust_name;
	$.post(site_url+"/accounts/get_acct_history/",info,function(data){
		$("#contentData").html("");
		$("#contentData").append(data);
	});
}

function make_cust_payment(cust_id){
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=600, height=450,toolbar=no,addressbar=no");
	var generatedContent="<html><head><title>Make Payment Page</title><script type='text/javascript' src='../../js/jquery-1.js'></script><script type='text/javascript' src='../../js/jquery-ui-1.8.18.custom.min.js'></script><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /><style type='text/css'>div.ui-datepicker{font-size:10px;width:150px;height:150px;}</style></head>"+
	 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 10px;width:90%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Make Payment </span></p>"+
	 "<hr width='100%'>"+
	 "<div id='indent_stmt_details' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:180px;margin-bottom:30px'><input type=\"button\" id='submit' value='Submit' class='button' onclick='javascript:opener.submit_payment()'/><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
	 updatepop.document.write(generatedContent);   
	$.get(site_url + "/accounts/make_cust_payment/"+cust_id,function(data){
		updatepop.document.getElementById('indent_stmt_details').innerHTML=data;
		updatepop.$(".clearance_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		updatepop.$("#payment_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		updatepop.$("#cheque_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		updatepop.$("#dd_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
	});
}

function check_paytype(pay_type){
	//updatepop.alert(pay_type);
	if(pay_type=='advance'){
		updatepop.document.getElementById("billno_row").style.display='none';
		updatepop.document.getElementById("billamt_row").style.display='none';
		updatepop.document.getElementById("amtpaid_row").style.display='none';
		updatepop.document.getElementById("balamt_row").style.display='none';
		updatepop.document.getElementById("payment_date_row").style.display='';
		updatepop.document.getElementById("payment_mode_row").style.display='';
		updatepop.document.getElementById("advance_payment_row").style.display='none';
		
	}
	else if(pay_type=='bill'){
		updatepop.document.getElementById("billno_row").style.display='';
		updatepop.document.getElementById("billamt_row").style.display='';
		updatepop.document.getElementById("amtpaid_row").style.display='';
		updatepop.document.getElementById("balamt_row").style.display='';
		updatepop.document.getElementById("payment_date_row").style.display='';
		updatepop.document.getElementById("payment_mode_row").style.display='';
		updatepop.document.getElementById("advance_payment_row").style.display='none';
	}
	else if(pay_type=='deduce'){
		updatepop.document.getElementById("billno_row").style.display='';
		updatepop.document.getElementById("billamt_row").style.display='';
		updatepop.document.getElementById("amtpaid_row").style.display='';
		updatepop.document.getElementById("balamt_row").style.display='';
		updatepop.document.getElementById("payment_date_row").style.display='none';
		updatepop.document.getElementById("payment_mode_row").style.display='none';
		updatepop.document.getElementById("advance_payment_row").style.display='';
		updatepop.document.getElementById("refno_row").style.display='none';
	}
	if(updatepop.document.getElementById("payment_mode_row").style.display!='none'){
		check_paymode(updatepop.document.getElementById("payment_mode").value);
	}
	else{
		check_paymode("Hide");
		}
}

function get_bill_details(bill_no){
	var info={};
	var bal_amt;
	var bill_info={};
	info["bill_no"]=bill_no;
	$.post(site_url+"/accounts/get_bill_details/",info,function(data){
		
		bill_info=data.split(':::');
		bal_amt=+bill_info[0] - +bill_info[1];
		if(bal_amt > 0){
			updatepop.document.getElementById("bill_amt").value=bill_info[0].trim();
			updatepop.document.getElementById("paid_amt").value=bill_info[1];
			updatepop.document.getElementById("bal_amt").value=bal_amt.toFixed(2);
		}
		else{
			updatepop.document.getElementById("bill_amt").value=bill_info[0];
			updatepop.document.getElementById("paid_amt").value=bill_info[1];
			updatepop.document.getElementById("bal_amt").value=bal_amt.toFixed(2);
			updatepop.document.getElementById("submit").style.display='none';
		}
	});
}

function check_paymode(paymode){
	
	if(paymode=='CHEQUE'){
		//updatepop.alert();
		updatepop.document.getElementById("chequeno_row").style.display='';
		updatepop.document.getElementById("chequedate_row").style.display='';
		updatepop.document.getElementById("bankname_row").style.display='';
		updatepop.document.getElementById("refno_row").style.display='none';
	}
	
	else if(paymode=='DEMAND_DRAFT'){
		updatepop.document.getElementById("ddno_row").style.display='';
		updatepop.document.getElementById("dddate_row").style.display='';
		updatepop.document.getElementById("bankname_row").style.display='';
		updatepop.document.getElementById("refno_row").style.display='none';
	}
	
	else if(paymode=='NEFT'|| paymode=='RTGS' || paymode=='CREDIT_CARD'){
		updatepop.document.getElementById("chequeno_row").style.display='none';
		updatepop.document.getElementById("chequedate_row").style.display='none';
		updatepop.document.getElementById("bankname_row").style.display='none';
		updatepop.document.getElementById("refno_row").style.display='';
	}
	
	else{
		updatepop.document.getElementById("chequeno_row").style.display='none';
		updatepop.document.getElementById("chequedate_row").style.display='none';
		updatepop.document.getElementById("ddno_row").style.display='none';
		updatepop.document.getElementById("dddate_row").style.display='none';
		updatepop.document.getElementById("bankname_row").style.display='none';
		updatepop.document.getElementById("refno_row").style.display='none';
	}
	
}

function submit_payment(){
	var details={};
	var pay_type=updatepop.document.getElementById("pay_type").value;
	if(pay_type=='bill'){
	details["bill_no"]=updatepop.document.getElementById("bill_no").value;
	details["payment_date"]=updatepop.document.getElementById("payment_date").value;
	details["payment_mode"]=updatepop.document.getElementById("payment_mode").value;
	details["payment_amount"]=updatepop.document.getElementById("payment_amount").value;
	if(details["bill_no"].trim()=="" || details["bill_no"]=='0')
	{
		updatepop.alert("Please Check Bill No");
		updatepop.document.getElementById("bill_no").focus();
		return false;
	}
	if(details["payment_date"].trim()=="" || details["payment_date"]=='0')
	{
		updatepop.alert("Please Check Payment Date");
		updatepop.document.getElementById("payment_date").focus();
		return false;
	}
	if(details["payment_amount"].trim()=="" || details["payment_amount"]=='0')
	{
		updatepop.alert("Please Check Payment Amount");
		updatepop.document.getElementById("payment_amount").focus();
		return false;
	}
	else if(isNaN(details["payment_amount"].trim())){
		updatepop.alert("Amount should contain digits only");
		updatepop.document.getElementById("payment_amount").focus();
		return false;
	}
	if(details["payment_mode"]=='CHEQUE'){
		details["cheque_no"]=updatepop.document.getElementById("cheque_no").value;
		details["cheque_date"]=updatepop.document.getElementById("cheque_date").value;
		details["bank_name"]=updatepop.document.getElementById("bank_name").value;
		details["status"]='NOT_CLEARED';
		details["ref_no"]='';
	}
	else if(details["payment_mode"]=='DEMAND_DRAFT'){
		details["cheque_no"]=updatepop.document.getElementById("dd_no").value;
		details["cheque_date"]=updatepop.document.getElementById("dd_date").value;
		details["bank_name"]=updatepop.document.getElementById("bank_name").value;
		details["status"]='CLEARED';
		details["ref_no"]='';
	}
	else if(details["payment_mode"]=='NEFT' || details["payment_mode"]=='RTGS' || details["payment_mode"]=='CREDIT_CARD'){
		details["cheque_no"]='';
		details["cheque_date"]='';
		details["bank_name"]='';
		details["status"]='CLEARED';
		details["ref_no"]=updatepop.document.getElementById("ref_no").value;
	}
	else{
		details["cheque_no"]='';
		details["cheque_date"]='';
		details["bank_name"]='';
		details["status"]='CLEARED';
		details["ref_no"]='';
	}
	 $.post(site_url + "/accounts/submit_payment/",details,function(data){
		 	updatepop.close();
		});
	}
	
	else if(pay_type=='advance')
	{
		details["cust_id"]=updatepop.document.getElementById("cust_id").value;
		details["payment_date"]=updatepop.document.getElementById("payment_date").value;
		details["payment_mode"]=updatepop.document.getElementById("payment_mode").value;
		details["payment_amount"]=updatepop.document.getElementById("payment_amount").value;
		
		if(details["payment_date"].trim()=="" || details["payment_date"]=='0')
		{
			updatepop.alert("Please Check Payment Date");
			updatepop.document.getElementById("payment_date").focus();
			return false;
		}
		if(details["payment_amount"].trim()=="" || details["payment_amount"]=='0')
		{
			updatepop.alert("Please Check Payment Amount");
			updatepop.document.getElementById("payment_amount").focus();
			return false;
		}
		else if(isNaN(details["payment_amount"].trim())){
			updatepop.alert("Amount should contain digits only");
			updatepop.document.getElementById("payment_amount").focus();
			return false;
		}
		if(details["payment_mode"]=='CHEQUE'){
			details["cheque_no"]=updatepop.document.getElementById("cheque_no").value;
			details["cheque_date"]=updatepop.document.getElementById("cheque_date").value;
			details["bank_name"]=updatepop.document.getElementById("bank_name").value;
			details["status"]='NOT_CLEARED';
			details["ref_no"]='';
		}
		else if(details["payment_mode"]=='NEFT' || details["payment_mode"]=='RTGS'){
			details["cheque_no"]='';
			details["cheque_date"]='';
			details["bank_name"]='';
			details["status"]='CLEARED';
			details["ref_no"]=updatepop.document.getElementById("ref_no").value;
		}
		else{
			details["cheque_no"]='';
			details["cheque_date"]='';
			details["bank_name"]='';
			details["status"]='CLEARED';
			details["ref_no"]='';
		}
		
		 $.post(site_url + "/accounts/submit_adv_payment/",details,function(data){
			 	updatepop.close();
			});
	}
	
	else if(pay_type=='deduce'){
		if(details["bill_no"].trim()=="" || details["bill_no"]=='0')
		{
			updatepop.alert("Please Check Bill No");
			updatepop.document.getElementById("bill_no").focus();
			return false;
		}
		details["bill_no"]=updatepop.document.getElementById("bill_no").value;
		details["payment_amount"]=updatepop.document.getElementById("payment_amount").value;
		details["payment_mode"]="DEBIT FROM ADVANCE";
		$.post(site_url + "/accounts/submit_deduce_payment/",details,function(data){
		 	updatepop.close();
		});
	}
}

function add_new_cash_in(){
	var trans_date=document.getElementById("trans_date").value;
	var remarks=document.getElementById("remarks").value;
	var cash_source=document.getElementById("cash_source").value;
	var amount=document.getElementById("amount").value;
	if(trans_date.trim()=="" || trans_date=='0')
	{
		alert("Please Check Transaction Date");
		document.getElementById("trans_date").focus();
		return false;
	}
	if(cash_source.trim()=="" || cash_source=='0')
	{
		alert("Please Check Cash Source");
		document.getElementById("cash_source").focus();
		return false;
	}
	if(amount.trim()=="" || amount=='0')
	{
		alert("Please Check Amount");
		document.getElementById("amount").focus();
		return false;
	}
	else if(isNaN(amount)){
		alert("Amount should contain digits only");
		document.getElementById("amount").focus();
		return false;
	}
	if(remarks.trim()=="" || remarks=='0')
	{
		alert("Please Check Remarks");
		document.getElementById("remarks").focus();
		return false;
	}
	var details={};
	details["trans_date"]=trans_date;
	details["remarks"]=remarks;
	details["cash_source"]=cash_source;
	details["amount"]=amount;
	
	$.post(site_url+"/accounts/add_new_cash_in",details,function(data){
//		alert(data);
		window.location.reload();
	});
}

function get_cash_in_list(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var start=document.getElementById("start_date").value;
	var end=document.getElementById("end_date").value;
	
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
					$.post(site_url + "/accounts/get_cash_in_list",date,function(data) {
					$("#contentData").html("");
					$("#contentData").append(data);
					}); 
					}
}

function update_entry(trans_id){
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=600, height=400,toolbar=no,addressbar=no");
	var generatedContent="<html><head><title>Update Cash Inflow Info</title><script type='text/javascript' src='../../js/jquery-1.js'></script><script type='text/javascript' src='../../js/jquery-ui-1.8.18.custom.min.js'></script><link rel='stylesheet' media='' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /><style type='text/css'>div.ui-datepicker{font-size:10px;width:150px;height:150px;}</style></head>"+
	 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:90%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Update Expenses Info </span></p>"+
	 "<hr width='100%'>"+
	 "<div id='cash_inflow_detail' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:35%;margin-bottom:30px'><input type=\"button\" id='update' value='Update' style='margin-right:25px;' class='button' onclick='opener.update_cash_inflow()'/><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
	 updatepop.document.write(generatedContent);   
	 $.post(site_url + "/accounts/update_cash_inflow_info/",{transaction_id:trans_id},function(data){	
		 updatepop.document.getElementById('cash_inflow_detail').innerHTML=data;
		 updatepop.$("#trans_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		 }); 
}

function update_cash_inflow(){
	var details={};
	details["transaction_id"]=updatepop.document.getElementById("transaction_id").value;
	details["trans_date"]=updatepop.document.getElementById("trans_date").value;
	details["cash_source"]=updatepop.document.getElementById("cash_source").value;
	details["remarks"]=updatepop.document.getElementById("remarks").value;
	details["amount"]=updatepop.document.getElementById("amount").value;
	if(details["trans_date"].trim()=="" || details["trans_date"]=='0')
	{
		updatepop.alert("Please Check Transaction Date");
		updatepop.document.getElementById("trans_date").focus();
		return false;
	}
	if(details["cash_source"].trim()=="" || details["cash_source"]=='0')
	{
		updatepop.alert("Please Check Cash Source");
		updatepop.document.getElementById("cash_source").focus();
		return false;
	}
	if(details["amount"].trim()=="" || details["amount"]=='0')
	{
		updatepop.alert("Please Check Amount");
		updatepop.document.getElementById("amount").focus();
		return false;
	}
	else if(isNaN(details["amount"])){
		updatepop.alert("Amount should contain digits only");
		updatepop.document.getElementById("amount").focus();
		return false;
	}
	if(details["remarks"].trim()=="" || details["remarks"]=='0')
	{
		updatepop.alert("Please Check Remarks");
		updatepop.document.getElementById("remarks").focus();
		return false;
	}
	 $.post(site_url + "/accounts/update_cash_inflow/",details,function(data){
		 	updatepop.close();
		 	get_cash_in_list();
		});
}

function cancel_entry(trans_id){
	var reason=prompt("Reason for Cancelling Bill. Bill No:"+trans_id,"Wrong Entry");
	if(reason != null && reason != "")
		{
		var collect={};
		collect["trans_id"]= trans_id;
		collect["reason"]=reason;
		$.post(site_url+"/accounts/cancel_cash_inflow/",collect,function(data){
			//document.getElementById("cancel_msg").style.display='none';
			get_cash_in_list();
			   });
		
		}
		else if (reason == ""){
			alert("Please Enter the Reason");
		}
		else{
			//alert("Operation Interrupted");
			document.getElementById("cancel_msg").style.display='none';
		}
}

function get_cancelled_cash_in(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
	var start=document.getElementById("start_date").value;
	var end=document.getElementById("end_date").value;
	
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
					$.post(site_url + "/accounts/get_cancelled_cash_in",date,function(data) {
					$("#contentData").html("");
					$("#contentData").append(data);
					}); 
					}
}
$("#print_ind_cust_acct_history").click(function(){
	
	//var reporthdr="<p style='font-size:12pt; font-weight:bolder; color: #3090C7'>Pricol Fuel & Lube Services</p>";
		var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
		disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=15";
		var content_value = document.getElementById("contentData").innerHTML;
		var docprint=window.open("","",disp_setting);
		docprint.document.open();
		docprint.document.write('<html><head>');
		docprint.document.write('</head><body onLoad="self.print()"><center>');
		//docprint.document.write(reporthdr);
		docprint.document.write(content_value);
		docprint.document.getElementById("make_payment").style.display='none';
		docprint.document.getElementById("hdr_row").style.color='black';
		docprint.document.getElementById("hdr_row").style.border='1px solid black';
		docprint.document.write('</center></body></html>');
		docprint.document.close();
		docprint.focus();
		window.location.reload();
	});
	

$("#ind_sal_dwnld").live("click", function(){
	ind_sal_dwnld();
	
});

function ind_sal_dwnld()
{
	cust_name=document.getElementById("cust_name").value;

	var downloadurl=site_url+"/accounts/ind_sal_dwnld/"+cust_name;
	window.location=downloadurl;
	
}
