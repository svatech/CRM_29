$("#deposited_date").datepicker({
	dateFormat: 'yy-mm-dd', maxDate: '+0d',		
	defaultDate: new Date()		
});
$("#shift_date").datepicker({
	dateFormat: 'yy-mm-dd', maxDate: '+0d',		
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

function check_bankname(bank){
	if(bank=='new_bank'){
		document.getElementById("new_bank_row").style.display='';
	}
	else{
		document.getElementById("new_bank_row").style.display='none';
	}
}

function add_new_transaction(){
	var trans_type=document.getElementById("trans_type").value;
	var deposited_date=document.getElementById("deposited_date").value;
	var bank_name=document.getElementById("bank_name").value;
	var shift_date=document.getElementById("shift_date").value;
	var amount=document.getElementById("amount").value;
	var remarks=document.getElementById("remarks").value;
	if(deposited_date.trim()=="" || deposited_date=='0')
	{
		alert("Please Check Deposited Date");
		document.getElementById("deposited_date").focus();
		return false;
	}
	
	if(amount.trim()=="" || amount=='0')
	{
		alert("Please Check Amount");
		document.getElementById("amount").focus();
		return false;
	}
	else if(isNaN(amount.trim())){
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
	if(bank_name.trim()=='new_bank' && (document.getElementById("new_bank").value.trim()=='' || document.getElementById("new_bank").value=='0')){
		alert("Please Check Bank Name");
		document.getElementById("new_bank").focus();
		return false;
	}
	var details={};
	details["trans_type"]=trans_type;
	details["deposited_date"]=deposited_date;
	details["remarks"]=remarks;
	details["bank_name"]=bank_name;
	if(bank_name=="new_bank"){
		
		details["new_bank_name"]=document.getElementById("new_bank").value;
	}
	else{
		details["new_bank_name"]="";
	}
	if(trans_type=='FLEET' || trans_type=='XTRAREWARD' || trans_type=='EASYFUELS'){
		details["from_date"]=document.getElementById("start_date").value;
		details["to_date"]=document.getElementById("end_date").value;
		details["shift_date"]='';
		if(details["from_date"].trim()=="" || details["from_date"]=='0')
		{
			alert("Please Check From Date");
			document.getElementById("start_date").focus();
			return false;
		}
		if(details["to_date"].trim()=="" || details["to_date"]=='0')
		{
			alert("Please Check To Date");
			document.getElementById("end_date").focus();
			return false;
		}
	}
	else{
		details["from_date"]='';
		details["to_date"]='';
		details["shift_date"]=shift_date;
		if(shift_date.trim()=="" || shift_date=='0')
		{
			alert("Please Check Shift Date");
			document.getElementById("shift_date").focus();
			return false;
		}
	}
	
	details["amount"]=amount;
	
	$.post(site_url+"/bank_transaction/add_new_transaction",details,function(data){
//		alert(data);
		window.location.reload();
	});
}

function get_transactions_list(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while updating..</p>");
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
					$.post(site_url + "/bank_transaction/get_transaction_list",date,function(data) {
					$("#contentData").html("");
					$("#contentData").append(data);
					}); 
					}
}

function update_entry(trans_id){
	
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=600, height=400,toolbar=no,addressbar=no");
	var generatedContent="<html><head><title>Update Expenses Info</title><script type='text/javascript' src='../../js/jquery-1.js'></script><script type='text/javascript' src='../../js/jquery-ui-1.8.18.custom.min.js'></script><link rel='stylesheet' media='' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /><style type='text/css'>div.ui-datepicker{font-size:10px;width:150px;height:150px;}</style></head>"+
	 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:90%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Update Expenses Info </span></p>"+
	 "<hr width='100%'>"+
	 "<div id='transaction_detail' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:35%;margin-bottom:30px'><input type=\"button\" id='update' value='Update' style='margin-right:25px;' class='button' onclick='opener.update_transaction()'/><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
	 updatepop.document.write(generatedContent);   
	 $.post(site_url + "/bank_transaction/update_transaction_info/",{transaction_id:trans_id},function(data){	
		 updatepop.document.getElementById('transaction_detail').innerHTML=data;
		 updatepop.$("#deposited_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		 updatepop.$("#shift_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		 updatepop.$("#start_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		 updatepop.$("#end_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		 }); 
}

function checkBank_upd(bank){
	if(bank=='new_bank'){
		updatepop.document.getElementById("new_bank_row").style.display='';
	}
	else{
		updatepop.document.getElementById("new_bank_row").style.display='none';
	}
}

function update_transaction(){
	var details={};
	var trans_type=updatepop.document.getElementById("trans_type").value;
	details["trans_type"]=trans_type;
	details["transaction_id"]=updatepop.document.getElementById("transaction_id").value;
	details["deposited_date"]=updatepop.document.getElementById("deposited_date").value;
	details["bank_name"]=updatepop.document.getElementById("bank_name").value;
	details["amount"]=updatepop.document.getElementById("amount").value;
	details["remarks"]=updatepop.document.getElementById("remarks").value;
	
	if(details["deposited_date"].trim()=="" || details["deposited_date"]=='0')
	{
		updatepop.alert("Please Check Deposited Date");
		updatepop.document.getElementById("deposited_date").focus();
		return false;
	}
	
	if(details["amount"].trim()=="" || details["amount"]=='0')
	{
		updatepop.alert("Please Check Amount");
		updatepop.document.getElementById("amount").focus();
		return false;
	}
	else if(isNaN(details["amount"].trim())){
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
	if(details["bank_name"]=='new_bank' && (updatepop.document.getElementById("new_bank").value.trim()=='' || updatepop.document.getElementById("new_bank").value=='0')){
		updatepop.alert("Please Check Bank Name");
		updatepop.document.getElementById("new_bank").focus();
		return false;
	}
	if(trans_type=='FLEET' || trans_type=='XTRAREWARD' || trans_type=='EASYFUELS'){
		details["from_date"]=updatepop.document.getElementById("start_date").value;
		details["to_date"]=updatepop.document.getElementById("end_date").value;
		details["shift_date"]='';
		if(details["from_date"].trim()=="" || details["from_date"]=='0')
		{
			updatepop.alert("Please Check From Date");
			updatepop.document.getElementById("start_date").focus();
			return false;
		}
		if(details["to_date"].trim()=="" || details["to_date"]=='0')
		{
			updatepop.alert("Please Check To Date");
			updatepop.document.getElementById("end_date").focus();
			return false;
		}
	}
	else{
		details["from_date"]='';
		details["to_date"]='';
		details["shift_date"]=updatepop.document.getElementById("shift_date").value;
		if(details["shift_date"].trim()=="" || details["shift_date"]=='0')
		{
			updatepop.alert("Please Check Shift Date");
			updatepop.document.getElementById("shift_date").focus();
			return false;
		}
	}
	if(details["bank_name"]=="new_bank"){
		details["new_bank_name"]=updatepop.document.getElementById("new_bank").value;
	}
	else{
		details["new_bank_name"]="";
	}
	
	 $.post(site_url + "/bank_transaction/update_transaction/",details,function(data){
		 	updatepop.close();
		 	get_transactions_list();
		});
}

function cancel_entry(trans_id){
	var reason=prompt("Reason for Cancelling Bill. Bill No:"+trans_id,"Wrong Entry");
	if(reason != null && reason != "")
		{
		var collect={};
		collect["trans_id"]= trans_id;
		collect["reason"]=reason;
		$.post(site_url+"/bank_transaction/cancel_entry/",collect,function(data){
			get_transactions_list();
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

function get_cancelled_transactions(){
	$("#contentData").html("<p align='center' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while updating..</p>");
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
					$.post(site_url + "/bank_transaction/get_cancelled_transactions",date,function(data) {
					$("#contentData").html("");
					$("#contentData").append(data);
					}); 
					}
}

function searchbybillno()
{
	var billno=document.getElementById('billno').value;
	filterTableBybillno(billno);
}

function filterTableBybillno(str){
	
	str.trim();
	 var rowid, colid, rowc,vbid;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="bill_no"+i;
	    var lstr=(str.toString()).toLowerCase();
	    displayRowEndsWith(rowid,colid,lstr);
	  }
	}

function displayRowEndsWith(rowid,colid,str){
	var row = document.getElementById(rowid);
      var searchcol= document.getElementById(colid);
     var colstr=searchcol.value;
     var lcolstr=(colstr.toString()).toLowerCase();
      if (lcolstr.endsWith(str))
          row.style.display = '';
      else
          row.style.display = 'none';
}

function searchbybankname()
{
	var bank=document.getElementById('bank').value;
	filterTableBybankname(bank);
}

function filterTableBybankname(str){
	
	str.trim();
	 var rowid, colid, rowc,vbid;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="cust"+i;
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

function check_trans(trans_type){
	if(trans_type=='FLEET' || trans_type=='XTRAREWARD' || trans_type=='EASYFUELS'){
		document.getElementById("trans_period_row").style.display='';
		document.getElementById("shift_date_row").style.display='none';
	}
	else{
		document.getElementById("shift_date_row").style.display='';
		document.getElementById("trans_period_row").style.display='none';
	}
}

function check_trans_upd(trans_type){
	if(trans_type=='FLEET' || trans_type=='XTRAREWARD' || trans_type=='EASYFUELS'){
		updatepop.document.getElementById("trans_period_row").style.display='';
		updatepop.document.getElementById("shift_date_row").style.display='none';
	}
	else{
		updatepop.document.getElementById("shift_date_row").style.display='';
		updatepop.document.getElementById("trans_period_row").style.display='none';
	}
}

String.prototype.startsWith = function(str)
{return (this.match(str)==str);};

String.prototype.endsWith = function(str)
{return (this.match(str+"$")==str);};