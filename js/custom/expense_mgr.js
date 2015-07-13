$("#exp_date").datepicker({
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

function checkVendor(vendor){
	if(vendor=='new_vendor'){
		document.getElementById("new_vendor_row").style.display='';
	}
	else{
		document.getElementById("new_vendor_row").style.display='none';
	}
}

function add_new_expense(){
	var exp_date=document.getElementById("exp_date").value;
	var bill_no=document.getElementById("bill_no").value;
	var vendor_name=document.getElementById("vendor_name").value;
	var items=document.getElementById("items").value;
	var amount=document.getElementById("amount").value;
	if(exp_date=="" || exp_date=='0')
	{
		alert("Please Check Date");
		document.getElementById("exp_date").focus();
		return false;
	}
	if(bill_no.trim()=="" || bill_no=='0')
	{
		alert("Please Check Bill No");
		document.getElementById("bill_no").focus();
		return false;
	}
	if(items.trim()=="" || items=='0')
	{
		alert("Please Check Items");
		document.getElementById("items").focus();
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
	if(vendor_name=='new_vendor' && (document.getElementById("new_vendor").value.trim()=='' || document.getElementById("new_vendor").value=='0')){
		alert("Please Check Vendor Name");
		document.getElementById("new_vendor").focus();
		return false;
	}
	var details={};
	details["exp_date"]=exp_date;
	details["bill_no"]=bill_no;
	details["vendor_name"]=vendor_name;
	if(vendor_name=="new_vendor"){
		
		details["new_vendor_name"]=document.getElementById("new_vendor").value;
	}
	else{
		details["new_vendor_name"]="";
	}
	details["items"]=items;
	details["amount"]=amount;
	
	$.post(site_url+"/expense_mgr/add_new_expense",details,function(data){
//		alert(data);
		window.location.reload();
	});
}

function get_expenses_list(){
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
					$.post(site_url + "/expense_mgr/get_expenses_list",date,function(data) {
					$("#contentData").html("");
					$("#contentData").append(data);
					}); 
					}
}

function update_entry(exp_id){
	
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=600, height=400,toolbar=no,addressbar=no");
	var generatedContent="<html><head><title>Update Expenses Info</title><script type='text/javascript' src='../../js/jquery-1.js'></script><script type='text/javascript' src='../../js/jquery-ui-1.8.18.custom.min.js'></script><link rel='stylesheet' media='' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /><style type='text/css'>div.ui-datepicker{font-size:10px;width:150px;height:150px;}</style></head>"+
	 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:90%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Update Expenses Info </span></p>"+
	 "<hr width='100%'>"+
	 "<div id='expense_detail' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:35%;margin-bottom:30px'><input type=\"button\" id='update' value='Update' style='margin-right:25px;' class='button' onclick='opener.update_expense()'/><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
	 updatepop.document.write(generatedContent);   
	 $.post(site_url + "/expense_mgr/update_expense_info/",{expense_id:exp_id},function(data){	
		 updatepop.document.getElementById('expense_detail').innerHTML=data;
		 updatepop.$("#exp_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});

		 }); 
}

function update_expense(){
	var details={};
	details["bill_no"]=updatepop.document.getElementById("bill_no").value;
	details["expense_id"]=updatepop.document.getElementById("expense_id").value;
	details["exp_date"]=updatepop.document.getElementById("exp_date").value;
	details["vendor_name"]=updatepop.document.getElementById("vendor_name").value;
	details["items"]=updatepop.document.getElementById("items").value;
	details["amount"]=updatepop.document.getElementById("amount").value;
	if(details["vendor_name"]=="new_vendor"){
		details["new_vendor_name"]=updatepop.document.getElementById("new_vendor").value;
	}
	else{
		details["new_vendor_name"]="";
	}
	if(details["exp_date"].trim()=="" || details["exp_date"]=='0')
	{
		updatepop.alert("Please Check Date");
		updatepop.document.getElementById("exp_date").focus();
		return false;
	}
	if(details["bill_no"].trim()=="" || details["bill_no"]=='0')
	{
		updatepop.alert("Please Check Bill No");
		updatepop.document.getElementById("bill_no").focus();
		return false;
	}
	if(details["items"].trim()=="" || details["items"]=='0')
	{
		updatepop.alert("Please Check Items");
		updatepop.document.getElementById("items").focus();
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
	if(details["vendor_name"]=='new_vendor' && (updatepop.document.getElementById("new_vendor").value.trim()=='' || updatepop.document.getElementById("new_vendor").value=='0')){
		updatepop.alert("Please Check Vendor Name");
		updatepop.document.getElementById("new_vendor").focus();
		return false;
	}
	 $.post(site_url + "/expense_mgr/update_expense/",details,function(data){
		 	updatepop.close();
		 	get_expenses_list();
		});
}

function checkVendor_upd(vendor){
	if(vendor=='new_vendor'){
		updatepop.document.getElementById("new_vendor_row").style.display='';
	}
	else{
		updatepop.document.getElementById("new_vendor_row").style.display='none';
	}
}

function cancel_entry(exp_id){
	var reason=prompt("Reason for Cancelling Bill. Bill No:"+exp_id,"Wrong Entry");
	if(reason != null && reason != "")
		{
		var collect={};
		collect["exp_id"]= exp_id;
		collect["reason"]=reason;
		$.post(site_url+"/expense_mgr/cancel_entry/",collect,function(data){
			//document.getElementById("cancel_msg").style.display='none';
			get_expenses_list();
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

function get_cancelled_expenses(){
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
					$.post(site_url + "/expense_mgr/get_cancelled_expenses",date,function(data) {
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

function searchbyvendorname()
{
	var vendor=document.getElementById('vendor').value;
	filterTableByvendorname(vendor);
}

function filterTableByvendorname(str){
	
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

String.prototype.startsWith = function(str)
{return (this.match(str)==str);};

String.prototype.endsWith = function(str)
{return (this.match(str+"$")==str);};