

/*$(function() {
	updateDate();
});*/
$("#acct_date").datepicker({
	dateFormat: 'yy-mm-dd',	maxDate: '+0d',	
	defaultDate: new Date()		
});
/*var updateDate = function() {
    function pad(n) {
        return (n < 10) ? '0' + n : n;
    }
    var now = new Date();
    var s = pad(now.getFullYear()) + '-'+
   			pad(now.getMonth()+1) + '-' +   			
   			pad(now.getDate());

   // $('#clock').html(s);
   	  document.getElementById('acct_date').value=s;

    var delay = 10000000;
    setTimeout(updateDate, delay);
};*/
function isFloatKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    		
    if (charCode > 31 && charCode!=46 && (charCode < 48 || charCode > 57 ))
        return false;
    return true;
}

function sales_entry_valid(){
	var ctr=document.getElementById("counterno").value;
	var act_date=document.getElementById("acct_date").value;
	var shift;
	if(ctr=='default'){
		alert("Please Select any Counter");
		return false;
	}
	else if(act_date==''){
		alert("Please Select Account Date");
		return false;
	}
	else if(isNaN(document.getElementById("close_rdng").value)){
		alert("Close Meter Reading should contain digits only");
		document.getElementById("close_rdng").focus();
		return false;
	}
	else if(isNaN(document.getElementById("open_rdng").value)){
		alert("Open Meter Reading should contain digits only");
		document.getElementById("open_rdng").focus();
		return false;
	}
	else if(isNaN(document.getElementById("sales_ltrs").value)){
		alert("Sales Litres should contain digits only");
		document.getElementById("sales_ltrs").focus();
		return false;
	}
	else if(isNaN(document.getElementById("net_sales").value)){
		alert("Net Sales should contain digits only");
		document.getElementById("net_sales").focus();
		return false;
	}
	if(document.getElementById("shift1").checked==true){
		shift='I';
	}
	else if(document.getElementById("shift2").checked==true){
		shift='II';
	}
	else if(document.getElementById("shift3").checked==true){
		shift='III';
	}
	$.post(site_url+"/sales/check_shift_closed/",{counter:ctr,acct_date:act_date,shft:shift},function(data){
		
		if(data=='no'){
			alert("This Shift is not Closed. Please Close the Shift");
			return false;
		}
		else{
			if(document.getElementById("pump_no").value=="default"){
				alert("Please Select a pump");
				return false;
			}
			 else if((document.getElementById("close_rdng").value=="")||(document.getElementById("close_rdng").value=="0"))
				 {
				alert("Please Enter Closing Reading");
				return false;
			}
			
			else if((document.getElementById("open_rdng").value=="")||(document.getElementById("open_rdng").value=="0"))
			{
				alert("Please Enter Opening Reading");
				return false;
			}
			
			else
				{
				document.forms["sale_entry_form"].submit();
				}
		}
	});
	
		
}

function get_open_rdng(){
	obj=document.getElementById("pump_no").value;
	if(obj=='default'){
		alert("Please Select any valid pump");
		return false;
	}
	else if(obj==''){
		alert("Please Select a Counter");
		return false;
	}
	else{
		//$.post(site_url+"/sales/get_acct_date",{pump:obj},function(data){});
		$.post(site_url+"/sales/get_open_reading/"+obj,function(data){
			if(data!='nodata'){
				var response=data;
				var responseArray=response.split("::");
				document.getElementById("open_rdng").value=responseArray[0].trim();
				document.getElementById("rate").value=responseArray[1].trim();
				document.getElementById("close_rdng").focus();
			}
			else{
				document.getElementById("open_rdng").value="";
				document.getElementById("rate").value="";
				//alert();
			}
	});
		
		var acct_date=document.getElementById("acct_date").value;
		var shift;
		if(document.getElementById("shift1").checked==true){
			shift='I';
		}
		else if(document.getElementById("shift2").checked==true){
			shift='II';
		}
		else if(document.getElementById("shift3").checked==true){
			shift='III';
		}
		
		$.post(site_url+"/sales/get_test_litres/",{act_date:acct_date,shft:shift,pump:obj},function(data){
			if(data!='nodata'){
				var response=+data;
				document.getElementById("test_ltrs").value=response.toFixed(3);
				
			}
			else{
				document.getElementById("test_ltrs").value="";
				
			}
		});
		
}
	var edate=document.getElementById("acct_date").value;
	
	var shift;
	if(document.getElementById('shift1').checked==true)
		{
		shift='I';
		}
	else if(document.getElementById('shift2').checked==true)
		{
		shift='II';
		}
	else if(document.getElementById('shift3').checked==true)
		{
		shift='III';
		}
	$.post(site_url+"/sales/check_sales_entry",{chk_date:edate,chk_shift:shift,chk_pump:obj},function(data){
		//alert(data);
		if(data != 0){
			alert("Sales Entry Already entered for this pump. Do you want to continue");
		}
	});
}

function cal_sales(obj){
	
		var close=document.getElementById("close_rdng").value;
		var open=document.getElementById("open_rdng").value;
		var diff=close-open;
		document.getElementById("sales_ltrs").value=diff.toFixed(3);
		var test=document.getElementById("test_ltrs").value;
		var net_sale=diff-test;
		document.getElementById("net_sales").value=net_sale.toFixed(3);
		var rate=document.getElementById("rate").value;
		var amt=rate*net_sale;
		document.getElementById("amt").value=amt.toFixed(3);
		document.getElementById(obj).focus();
		var acct_date=document.getElementById("acct_date").value;
		var shift;
		if(document.getElementById('shift1').checked==true)
			{
			shift='I';
			}
		else if(document.getElementById('shift2').checked==true)
			{
			shift='II';
			}
		else if(document.getElementById('shift3').checked==true)
			{
			shift='III';
			}
		var pump_no=document.getElementById("pump_no").value;
		var counter_no=document.getElementById("counterno").value;
		$.post(site_url+"/sales/get_bill_cash_sales",{act_date:acct_date,shft:shift,pmp_no:pump_no,cnt_no:counter_no}, function(data){
		if(data < diff){
			document.getElementById("diff_cash_sales").innerHTML="Billed Cash Sales Value is Low";
			}
		else if(data > diff){
			
			document.getElementById("diff_cash_sales").innerHTML="Billed Cash Sales Value is High";
		}
		else{
			document.getElementById("diff_cash_sales").innerHTML="";
			
		}
		
		});
		
}

function get_pumps(obj){
	//alert("hai");
	if(obj!='default'){
	var select=document.getElementById('pump_no');
	if(select){
	var length=select.length;
	for (i=0;i<=length;i++) {
		if(select.selectedIndex >= 0){
		select.remove(select.selectedIndex);
		}
		/*alert(select.selectedIndex);
		alert(select.length);
		select.remove(i);*/
		}
	}
	$.post(site_url+"/sales/get_pumps_sales_entry",{counter:obj},function(data){
		var default_opt = document.createElement("option");
		if(document.getElementById("pump_no")){
			document.getElementById("pump_no").options.add(default_opt);
			default_opt.text = 'Select';
			default_opt.value = 'default';
			}
		
		var pumplist=data.split('!');
		for(i=1;i<pumplist.length;i++)
		{
		var opt = document.createElement("option");
		if(document.getElementById("pump_no")){
		document.getElementById("pump_no").options.add(opt);
		opt.text = i+" "+pumplist[i];
	    opt.value = pumplist[i];
		
		}
		}
	});
	
	$.post(site_url+"/sales/get_acct_date",{counter:obj},function(data){
		if(data!='nodata'){
			var details=data.split(':::');
			document.getElementById("acct_date").value=details[0].trim();
			shift=details[1].trim();
			//alert(shift);
			if(shift=='I'){
				document.getElementById("shift1").checked=true;
			}
			else if(shift=='II'){
				document.getElementById("shift2").checked=true;
			}
			else if(shift=='III'){
				document.getElementById("shift3").checked=true;
			}
		}
		else
			{
			alert("No Shift is closed for this counter");
			document.getElementById("acct_date").value='';
			document.getElementById("shift1").checked=true;
			}
		
	});
	}
	else
		{
		alert("Please Select a valid Counter");
		}
}