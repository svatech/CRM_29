$(document).ready(function(){
	var ctr=document.getElementById("counterno");
	if(ctr!=null){
	var obj=ctr.value;
	addcounterinsession(obj);
	var custarr=['bike','car','van'];
	
		$('#ind_cust_name').autocomplete({
		source: cust_array
	});
				$('#veh_no').autocomplete({
			source: truck_array,
			minLength: 3
			
		});
				$('#cust_name').autocomplete({
					source: retail_cust_array
				});
	}
});

/*$(document).ready(function() {
	
    $("#mob_no").bind('paste', function (e){
    		$(e.target).keyup(getInput);
    });

    function getInput(e){
    	var inputText = $(e.target).val();
        if(isNaN(inputText) || (parseInt(inputText)!=inputText)){
        $(e.target).val('');
        }
        
        $(e.target).unbind('keyup');
        
    }
});
*/
/*$(function(){$("#selectall").click(function(){
	$('.cust_id').attr('checked',this.checked);
	});
$('.cust_id').click(function(){
	if($('.cust_id').length==$('.cust_id:checked').length)
	{
		$("#selectall").attr('checked',this.checked);
		}
	else{
		$("#selectall").removeAttr("checked");
		}
	});
});
*/
/*$(function(){$('#selectall').click(function(){$(':cust_id').attr("checked",this.checked);});
$(':cust_id').click(function(){this.checkedthis.checkedif($(':cust_id').length==$(':cust_id:checked').length){$('#selectall').attr("checked","checked");}else{$('#selectall').removeAttr("checked");}});});
*/




    
   

$("#cheque_date").datepicker({
	dateFormat: 'yy-mm-dd', 	
	defaultDate: new Date()		
});

$("#acct_date").datepicker({
	dateFormat: 'yy-mm-dd', maxDate: '+0d',		
	defaultDate: new Date()		
});

$("#start_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',onClose:function(selectedDate){$("#end_date").datepicker("option","minDate",selectedDate);},		
	defaultDate: new Date()		
});
$("#oil_service_dob").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',onClose:function(selectedDate){$("#end_date").datepicker("option","minDate",selectedDate);},		
	defaultDate: new Date()		
});
$("#oil_service_wedding_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',onClose:function(selectedDate){$("#end_date").datepicker("option","minDate",selectedDate);},		
	defaultDate: new Date()		
});
/*$("#indent_dob").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',onClose:function(selectedDate){$("#end_date").datepicker("option","minDate",selectedDate);},		
	defaultDate: new Date()		
});*/
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    		
    if (charCode > 31 && (charCode < 48 || charCode > 57 ))
        return false;
    return true;
}

function isFloatKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    		
    if (charCode > 31 && charCode!=46 && (charCode < 48 || charCode > 57 ))
        return false;
    return true;
}

function get_veh_info(obj){
	var cust_type='';
	$.post(site_url+"/sales/check_cust_type",{veh:obj},function(data){
		cust_type = data.split('!@#');
		if(cust_type[0]=='yes'){
			
			document.getElementById("ind_cust_name").value=cust_type[1];
			document.getElementById("veh_no").value=obj;
			document.getElementById("in_sales").click();
			checkIndentCust();
		}
		if(cust_type[0]=='no'){
			document.getElementById("indent_status_tbl").style.display='none';
			document.getElementById("ca_sales").click();
			document.getElementById("veh_no").value=obj;
			get_retail_customer_details(obj);
	
		}
	});
}

$("#end_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',		
	defaultDate: new Date()		
});

function getCounterShift(obj){
	$.post(site_url+"/sales/getCounterShift",{counter:obj},function(data){
		if(data!='null' && data!=""){
		 var arr=data.split("::");
		 document.getElementById("shift_row").innerHTML=arr[0];
		 document.getElementById("shift").value=arr[0];
		 document.getElementById("shift_row").style.background='';
		 document.getElementById("shift_row").style.color='#990000';
		 document.getElementById("acct_date_row").innerHTML=arr[1];
		 document.getElementById("acct_date_row").style.color='#990000';
		 document.getElementById("acct_date").value=arr[1];

		}
		else{
			 document.getElementById("shift_row").innerHTML="No shift is currently Opened";
			 document.getElementById("shift").value='';
			 document.getElementById("shift_row").style.background='red';
			 document.getElementById("shift_row").style.color='white';
			 document.getElementById("acct_date_row").innerHTML="";
			 document.getElementById("acct_date").value='';
		}
	});
}

function checkIndentCust(){
	if(document.getElementById("in_sales").checked==true){
		var obj=document.getElementById("ind_cust_name").value;
	$.post(site_url+"/sales/checkIndentCust",{cust_name:obj},function(data){
		if(data=='yes'){
			getVehList(obj);
		}
		else{
			alert("The given Customer is not in List. Please Select a customer from List");
			document.getElementById("ind_cust_name").value='';
			document.getElementById("ind_cust_name").focus();
			return false;
		}
	});
	}
}

function getVehList(obj){
			  var vehlist='';
			  $.post(site_url+"/sales/getVehList",{cust_name:obj},function(data){
			  vehlist = data.split('-');
			  vehlist.push('New Vehicle');
			  $("#veh_no").autocomplete({
			        source: vehlist,
			        change: function( event, ui ) {
			        	  val = $(this).val();
			        	  exists = $.inArray(val,vehlist);
			        	  if (exists<0) {
			        	    $(this).val("");
			        	    alert("The Vehicle No is not in the list.");
			        	    $(this).focus();
			        	    return false;
			        	  }
			        	 }
			    });
			  
			  $.post(site_url+"/sales/get_cust_id/",{cust_name:obj},function(data){
				 // alert(data);
							//document.getElementById('cust_id').value=data;
						$.post(site_url+"/sales/get_indent_limit/",{cust_id:data},function(result){
							indent_details=result.split('::');
							document.getElementById('indent_entitled').innerHTML=indent_details[0];
							document.getElementById('indent_taken').innerHTML=indent_details[1];
							var indent_available=+indent_details[0] - +indent_details[1];
							document.getElementById('indent_available').innerHTML=indent_available.toFixed(2);
							if(indent_available<1){
								document.getElementById("indent_available_row").style.background='red';
								document.getElementById("indent_available_row").style.color='white';
							}
							document.getElementById('indent_status_tbl').style.display='';
							document.getElementById('mob_no').value=indent_details[2].trim();
							//document.getElementById('indent_dob').value=indent_details[3];
						
					    });
					});
			 // alert(updatepop.document);
			  
			  if(updatepop){
				 // alert(updatepop.document);
				  
			  $(updatepop.document).contents().find('#veh_no').autocomplete({
					source: vehlist
				});
			  salemode=updatepop.document.getElementById("sales_mode").value;
			  if(salemode=='Indent_sales'){
				  $.post(site_url+"/sales/get_cust_id/",{cust_name:obj},function(data){
					  //updatepop.alert(data);
					  updatepop.document.getElementById("cust_id").value=data;
				  });
			  }
			  }
	});
		
}

function get_retail_customer_details(vehicle)
{
	
	//alert(vehicle);
	if(vehicle.trim() != "" && document.getElementById("in_sales").checked==false){
		//alert();
	$.get(site_url + "/sales/get_retail_customer_details/"+vehicle,function(data){
		
		cust_details=data.split('!');
		if(cust_details[7] > 0){
			
		document.getElementById("cust_name").value=cust_details[0];
		document.getElementById("mob_no").value=cust_details[1];
		document.getElementById("pump_no").focus();
		}
		else{
			document.getElementById("cust_name").value="";
			document.getElementById("mob_no").value="";	
		}
	});
	$.get(site_url + "/sales/check_vehicle/"+vehicle,function(result) {
		if(result != 0){
		document.getElementById("rowcount").value=result;
		}else{
		document.getElementById("rowcount").value=result;
		}
	}); 
	
	
	$("#contentData").html("<p align='right' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
$.get(site_url+"/sales/last_five_trans_petro/"+vehicle,function(data){
//alert(vehicle);
	$("#contentData").html("");
	$("#contentData").append(data);
	
});

	}
}

function get_other_pdts_customer_details(customer)
{

	var retail_customer_id="";
	var vehicle=document.getElementById("veh_no").value;
	if(customer.trim()!=''){
	var select=document.getElementById('cust_id');
	for (i=0;i<=select.length;  i++) {
		select.remove(select.selectedIndex);
		select.remove(i);
	  }
		$.get(site_url + "/sales/get_retail_cust_id/"+customer,function(result) {
			var custidlist=result.split('!');
			if(custidlist[0] > 0){
				 document.getElementById("same_name").style.display='';
				 document.getElementById("cust_id").focus();
			}else{
				document.getElementById("same_name").style.display='none';	
			}
			var array_length=(parseInt(custidlist[0])+2);
		if(custidlist[0] > 0){
			for(i=2;i<array_length;i++)
			{
			var opt = document.createElement("option");
			document.getElementById("cust_id").options.add(opt);
			var cust=custidlist[i].split("T");
			n=(parseInt(custidlist[0])+1);
			opt.text =cust[1] +" - "+customer+" - "+custidlist[i+n];
		    opt.value = custidlist[i];
		    
		    }}
		var opt1 = document.createElement("option");
		document.getElementById("cust_id").options.add(opt1);
		opt1.text = "New Customer";
	    opt1.value = "New";
		
	$.get(site_url + "/sales/get_other_pdts_customer_details/"+custidlist[2],function(data){
		cust_details=data.split('!');
		if(cust_details[7] > 0){
		  document.getElementById("veh_no").value=cust_details[0];
		  document.getElementById("mob_no").value=cust_details[1];
		  document.getElementById("avg_km").value=cust_details[2];
		  document.getElementById("km_reading").value=cust_details[3];
		 //document.getElementById("item1").focus();
		  document.getElementById("Oil_service_status").value=cust_details[4];
		  document.getElementById("oil_service_dob").value=cust_details[5];
		  document.getElementById("oil_service_wedding_date").value=cust_details[6];
		  if(cust_details[4]  == "1")
			  {
		  document.getElementById("oil_service").checked=true;
		  document.getElementById("show_avg").style.visibility = 'visible';
		  document.getElementById("show_km").style.visibility = 'visible';
		  document.getElementById("show_dob").style.visibility = 'visible';
		  document.getElementById("show_wed").style.visibility = 'visible';
			  }else if(cust_details[4]  == "0")
				  {
				  document.getElementById("oil_service").checked=false;
				  
				  	document.getElementById("show_avg").style.visibility = 'hidden';
					  document.getElementById("show_km").style.visibility = 'hidden';
					  document.getElementById("show_dob").style.visibility = 'hidden';
					  document.getElementById("show_wed").style.visibility = 'hidden';
					  }
		}
		else{
			document.getElementById("veh_no").value="";
			document.getElementById("mob_no").value="";	
			document.getElementById("oil_service").value="";
			document.getElementById("avg_km").value="";
			document.getElementById("km_reading").value="";
			document.getElementById("Oil_service_status").value="0";
			document.getElementById("oil_service_dob").value="";
			document.getElementById("oil_service_wedding_date").value="";
			
			//document.getElementById("veh_no").focus();
		}
	}); 
	
	$.get(site_url + "/sales/check_customer/"+custidlist[2],function(result) {
		if(result != 0){
		document.getElementById("rowcount").value=result;
		}else{
		document.getElementById("rowcount").value=result;
		}
	}); });
		
		$("#contentData").html("<p align='right' style='color: #000; font-size: 1.5em'><br /><br /><img src='../../images/ajax_loader.gif' /><br>Please wait while loading..</p>");
		$.get(site_url+"/sales/last_five_trans_others/"+customer,function(data){
			//alert(data);
			$("#contentData").html("");
			$("#contentData").append(data);
		});
		
		
		
	}
}

function check_customer(){
	
}

function fetch_other_pdts_customer(cust_id)
{
	
	if(cust_id =="New")
		{
		document.getElementById("rowcount").value=0;
		document.getElementById("veh_no").value="";
		document.getElementById("mob_no").value="";
		 document.getElementById("oil_service").checked=false;
		 document.getElementById("Oil_service_status").value="0";
		 document.getElementById("show_avg").style.visibility = 'hidden';
		  document.getElementById("show_km").style.visibility = 'hidden';
		  document.getElementById("show_dob").style.visibility = 'hidden';
		  document.getElementById("show_wed").style.visibility = 'hidden';
		}else{
	$.get(site_url + "/sales/get_other_pdts_customer_details/"+cust_id,function(data){
		cust_details=data.split('!');
		if(cust_details[7] > 0){
		document.getElementById("veh_no").value=cust_details[0];
		document.getElementById("mob_no").value=cust_details[1];
		
		
		}
		else{
			document.getElementById("veh_no").value="";
			document.getElementById("mob_no").value="";	
			
			
			}
	
	
	});
		}
	}

$( "#pump_no" ).blur(function() {
	
//	document.getElementById("item1").size='2';
	pmp=document.getElementById("pump_no").value;
	if(pmp!='default'){
	$.post(site_url+"/sales/get_pdt_of_pump",{pump_no:pmp},function(data){
		
		var opts = document.getElementById("item1").options;
		for(var i = 0; i < opts.length; i++) {
		    if(opts[i].innerText == data) {
		     indx=i; 
		        break;
		    }
		}
		document.getElementById("item1").selectedIndex=i;
		
	});
	document.getElementById("item1").focus();
	document.getElementById("pump_no").style.background="";
	document.getElementById("item1").style.background="#F3F781";
	}
	});

function addshiftinsession(obj){
	//alert(obj);
	$.post(site_url+"/sales/add_shift_session",{shift:obj},function(data){
	//alert(data+" returned");
});
	var shift=obj;
	
	
	if(shift == 1){	
		
		document.getElementById("shift1_row").style.background='#87afc7';
	document.getElementById("shift2_row").style.background='';
	document.getElementById("shift3_row").style.background='';
	}else if(shift==2){	
		
	document.getElementById("shift1_row").style.background='';
	document.getElementById("shift2_row").style.background='#87afc7';
	document.getElementById("shift3_row").style.background='';
	}else{	
	document.getElementById("shift1_row").style.background='';
	document.getElementById("shift2_row").style.background='';
	document.getElementById("shift3_row").style.background='#87afc7';
	}
}

function focusId(obj){
	document.getElementById(obj).focus();
}

function addcounterinsession(obj){
	//alert("hai");
	var select=document.getElementById('pump_no');
	if(select){
	var length=select.length;
	for (i=0;i<=length;i++) {
		select.remove(select.selectedIndex);
		/*alert(select.selectedIndex);
		alert(select.length);
		select.remove(i);*/
		}
	}
	$.post(site_url+"/sales/add_counter_session",{counter:obj},function(data){
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
	
	var select1=document.getElementById('2toilpump');
	if(select1){
	var length=select1.length;
	for (i=0;i<=length;i++) {
		select1.remove(select1.selectedIndex);
		/*alert(select.selectedIndex);
		alert(select.length);
		select.remove(i);*/
		}
	}
	$.post(site_url+"/sales/get_2toil_pumps",{counter:obj},function(data){
		if(data!='no'){
			if(document.getElementById("twotoil_table")!=null){
		document.getElementById("twotoil_table").style.display='';
			}
		var pumplist=data.split('!');
		var default_opt = document.createElement("option");
		document.getElementById("2toilpump").options.add(default_opt);
		default_opt.text = 'Select';
		default_opt.value = 'default';
		for(i=1;i<pumplist.length;i++)
		{
		var opt = document.createElement("option");
		if(document.getElementById("2toilpump")){
		document.getElementById("2toilpump").options.add(opt);
		opt.text = pumplist[i];
	    opt.value = pumplist[i];
		}
		}
		}
		else{
			if(document.getElementById("twotoil_table")!=null){
			document.getElementById("twotoil_table").style.display='none';
			}
		}
	});
	getCounterShift(obj);
}
/*$(function() {
   updateClock();
});*/

document.onkeydown = function(e){
    e = e || window.event;
    var key = e.which || e.keyCode;
    if(key===112){
    	document.getElementById("ca_sales").click();
    	document.getElementById("indent_status_tbl").style.display='none';
    	return false;
    }
    else if(key===113){
    	document.getElementById("in_sales").click();
    	return false;
    } 
    else if(key===114){
    	document.getElementById("cr_sales").click();
    	document.getElementById("indent_status_tbl").style.display='none';
    	return false;
    }
    else if(key===115){
    	document.getElementById("xr_sales").click();
    	document.getElementById("indent_status_tbl").style.display='none';
    	return false;
    }
    else if(key===116){
    	document.getElementById("fc_sales").click();
    	document.getElementById("indent_status_tbl").style.display='none';
    	return false;
    }
    else if(key===117){
    	document.getElementById("ef_sales").click();
    	document.getElementById("indent_status_tbl").style.display='none';
    	return false;
    }
    else if(key==118){
    	document.getElementById("ch_sales").click();
    	document.getElementById("indent_status_tbl").style.display='none';
    	return false;
    }
    else if(key==119){
    	document.getElementById("indent_status_tbl").style.display='none';
    	return false;
    }
}
;

function addrowbyslash(e){
	e = e || window.event;
    var key = e.which || e.keyCode;
    if(key===191||key===111){
    	addrow();
    }
}
var updateClock = function() {
    function pad(n) {
        return (n < 10) ? '0' + n : n;
    }
    var now = new Date();
    var hours=now.getHours();    
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
      var t=pad(now.getDate()) + '/' +
   			pad(now.getMonth()+1) + '/' +
   			pad(now.getFullYear())+ ' ' +
   			hours+':'+
            pad(now.getMinutes())+' '+ampm;
            document.getElementById('timedisp').value=t;
            var delay = 1000 - (now % 1000);
            setTimeout(updateClock, delay);
};



function addrow(){
	var cnt=document.getElementById('count').value;
	var cntinc=++cnt;
	//alert(cntinc);
	//document.getElementById('billtable').innerHTML += "<tr><td><select name=Itemlist[] id='item"+cntinc+"' style='width:100%;' onchange='javascript:get_rate(this.value,"+cntinc+")'><option value='default'>Select</option><option value='Petrol'>Petrol</option><option value='Diesel'> Diesel</option></select></td><td><input type='text' name='qty"+cntinc+"' id='qty"+cntinc+"' /></td><td><input type='text' name='rate"+cntinc+"' id='rate"+cntinc+"' /></td><td><input type='text' id='val"+cntinc+"' /></td></tr> ";
	$('.bill_table ').append("<tr align='center'><td><select name='item"+cntinc+"' id='item"+cntinc+"' style='width:200px;text-align:right;font-size:17px;' onblur='javascript:get_rate(this.value,"+cntinc+")' onfocus=\"this.style.background='#F3F781'\"></select></td><td><input type='text' name='qty"+cntinc+"' id='qty"+cntinc+"' value='0' style='text-align:right;width:70px;font-size:18px;' onkeyup='javascript:cal_amt(this.value,"+cntinc+")' onkeydown='addrowbyslash(event)' /></td><td><input type='text' id='val"+cntinc+"' name='val"+cntinc+"' value='0' style='text-align:right;width:100px;font-size:18px;' onblur='' onkeyup='javascript:crt_amt(this.value,"+cntinc+")' onkeydown='addrowbyslash(event)'/></td><td><input type='text' name='rate"+cntinc+"' id='rate"+cntinc+"' value='0' readonly='readonly' style='background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;font-size:18px;'/></td></tr>");
	//var numbers = [1, 2, 3, 4, 5];

	
	/*var numbers =document.getElementById('item1').options;
	for (i=0;i<numbers.length;i++){
		   $('<option/>').val(numbers[i]).html(numbers[i]).appendTo('#item'+cntinc);
		}*/
	document.getElementById('item'+cntinc).innerHTML=document.getElementById('item1').innerHTML;
	document.getElementById('item'+cntinc).focus();
	document.getElementById('item'+cntinc).style.background='#F3F781';
	document.getElementById('count').value=cntinc;
	
}
function changefocus_topump()
{
	document.getElementById("pump_no").focus();
}
function changefocus_toadd()
{
	document.getElementById("add_link").focus();
}
function get_rate(obj,id){
	//alert(obj+""+id);
	if(obj!="default"){
		$.post(site_url+"/sales/get_rate",{pdt:obj},function(data){
			
		document.getElementById("rate"+id).value=data;
				var rate=data;
				var qty=document.getElementById("qty"+id).value;
				var amt=rate*qty;
				document.getElementById("val"+id).value=amt.toFixed(2);
				
				var cnt=document.getElementById("count").value;
				
				var tot_amt=0;
				for(i=1;i<=cnt;i++){
					temp=document.getElementById("val"+i).value;
					tot_amt= +tot_amt + +temp;
				}
				if(document.getElementById("2toilqty")!=null){
				tot_amt= +tot_amt + +document.getElementById("2toilval").value;
				
				}
			document.getElementById("item"+id).style.background="";
			document.getElementById("total").value=tot_amt.toFixed(2);
	
	//		alert(data);
			
		});
	}
	else
		{
		document.getElementById("rate"+id).value=0;
 //		document.getElementById("qty"+id).value=0;
		document.getElementById("val"+id).value=0;
		if(id==1){
		document.getElementById("total").value=0;
		}
		document.getElementById("item"+id).style.background="";
		}
}

function get_2toil_rate(obj){
	if(obj!="default"){
		$.post(site_url+"/sales/get_rate",{pdt:'2TOIL_LOOSE'},function(data){
			document.getElementById("2toilrate").value=data;
			var rate=data;
			var qty=document.getElementById("2toilqty").value;
			var amt=rate*qty;
			document.getElementById("2toilval").value=amt.toFixed(2);
			
			var cnt=document.getElementById("count").value;
			var tot_amt=0;
			for(i=1;i<=cnt;i++){
				temp=document.getElementById("val"+i).value;
				tot_amt= +tot_amt + +temp;
			}
			
			tot_amt= +tot_amt + +amt.toFixed(2);
		document.getElementById("2toilpump").style.background="";
		document.getElementById("total").value=tot_amt.toFixed(2);
		});
	}
	else{
		document.getElementById("2toilqty").value=0;
		document.getElementById("2toilval").value=0;
		document.getElementById("2toilrate").value=0;
	}
}


function cal_amt(obj,id){
	if(isNaN(obj)==true){
	alert("Quantity should be a Number");
	return false;
	}
	var rate=document.getElementById("rate"+id).value;
	var qty=obj;
	var amt=rate*qty;
	document.getElementById("val"+id).value=amt.toFixed(2);
	
	var cnt=document.getElementById("count").value;
	var tot_amt=0;
	for(i=1;i<=cnt;i++){
		temp=document.getElementById("val"+i).value;
		tot_amt= +tot_amt + +temp;
	}
	if(document.getElementById("2toilval")!=null){
	twotamt=document.getElementById("2toilval").value;
	tot_amt= +tot_amt + +twotamt;
	}
	document.getElementById("total").value=tot_amt.toFixed(2);

}
function cal_amt_2toil(obj){
	if(isNaN(obj)==true){
		alert("Quantity should be a Number");
		return false;
		}
		var rate=document.getElementById("2toilrate").value;
		var qty=obj;
		var amt=rate*qty;
		document.getElementById("2toilval").value=amt.toFixed(2);
		var cnt=document.getElementById("count").value;
		var tot_amt=0;
		for(i=1;i<=cnt;i++){
			temp=document.getElementById("val"+i).value;
			tot_amt= +tot_amt + +temp;
		}
		tot_amt= +tot_amt + +amt.toFixed(2);
		document.getElementById("total").value=tot_amt.toFixed(2);
}
function cashform_valid(){
	
	if(document.getElementById("veh_no").value==""){
		alert("Please Enter Vehicle No");
		document.getElementById("veh_no").focus();
		return false;
	}
	else if(document.getElementById("mob_no").value.length!="10" && document.getElementById("mob_no").value.trim()!=""){
		alert("Mobile No should contain 10 digits");
		document.getElementById("mob_no").focus();
		return false;
	}
	else if(isNaN(document.getElementById("mob_no").value) && (parseInt(document.getElementById("mob_no").value))!=document.getElementById("mob_no").value){
		alert("Mobile No should contain digits only");
		document.getElementById("mob_no").focus();
		return false;
	}
	 else if(document.getElementById("pump_no").value=="default")
		 {
		alert("Please Select Pump No");
		document.getElementById("pump_no").focus();
		return false;
	}
	 else if(document.getElementById("shift").value=="")
	 {
	alert("Please Open Shift");
	document.getElementById("shift").focus();
	return false;
	 }
	else if(document.getElementById("item1").value=="default")
	{
		alert("Please Select any Product");
		document.getElementById("item1").focus();
		return false;
	}
	else if((document.getElementById("qty1").value=="0")||(document.getElementById("qty1").value=="")){
		alert("Please Enter Quantity");
		document.getElementById("qty1").focus();
		return false;
	}
	else if(document.getElementById("in_sales").checked==true && document.getElementById("indent_no").value=="")
		{
		alert("Please Enter Indent No");
		document.getElementById("in_sales").focus();
		return false;
		}
	else if(document.getElementById("ch_sales").checked==true && document.getElementById("cheque_no").value=="")
	{
	alert("Please Enter Cheque No");
	document.getElementById("cheque_no").focus();
	return false;
	}
	else if(document.getElementById("ch_sales").checked==true && document.getElementById("cheque_date").value=="")
	{
	alert("Please Enter Cheque Date");
	document.getElementById("cheque_date").focus();
	return false;
	}
	else if(document.getElementById("ch_sales").checked==true && document.getElementById("bank_name").value=="")
	{
	alert("Please Enter Bank Name");
	document.getElementById("bank_name").focus();
	return false;
	}
	else if(document.getElementById("total").value=='0' || document.getElementById("total").value==''){
		alert("Please check the Total Amount");
		document.getElementById("total").focus();
		return false;
	}

	else
		{
		var shift=document.getElementById("shift").value;
		var acct_date=document.getElementById("acct_date").value;
		var counterno=document.getElementById("counterno").value;
		$.post(site_url+"/sales/check_shift_open",{shft:shift,act_date:acct_date,ctr:counterno},function (data){
			if(data!='yes'){
				alert("Please check the shift is opened or not");
				window.location.reload();
			}
			else if(data=='yes'){
				$.post(site_url+"/sales/cash_form",$("#cashform").serialize(),function(data){
					var sms_bill=document.getElementById("bill_sms").value;
					//alert(sms_bill);
					 var sms_no=document.getElementById("mob_no").value;
					if(sms_bill=='active' && sms_no!=''){
						if(document.getElementById("in_sales").checked==true)
						{
						  var sms_name=document.getElementById("ind_cust_name").value;
						}
						else{
						  var sms_name=document.getElementById("cust_name").value;
						}
						 
						  
						$.post(site_url+"/sales/sms_bill_info",{bill:data,smsname:sms_name,smsno:sms_no},function(res){
							//alert(res);
							if(res!=null){
								$.post(site_url+"/sales/bill_print",{bill:data,copy:'original'},function(res){
									//var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
									
									var disp_setting="scrollbars=yes,width=420px, height=200px";
									var content_value = res;
									var docprint=window.open("","",disp_setting);
									docprint.document.open();
									docprint.document.write("<html ><head>");
									docprint.document.write("</head><body style='width:420px;height:200px;'><center>");
									docprint.document.write(content_value);
									docprint.document.write('</center></body></html>');
									docprint.print();
									docprint.document.close();
									docprint.focus();
									window.location.reload();
									
								});
							}
						});
					}
					else{
						$.post(site_url+"/sales/bill_print",{bill:data,copy:'original'},function(res){
							//var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
							var disp_setting="scrollbars=yes,width=420px, height=200px";
							var content_value = res;
							var docprint=window.open("","",disp_setting);
							docprint.document.open();
							docprint.document.write("<html ><head>");
							docprint.document.write("</head><body style='width:420px;height:200px;'><center>");
							docprint.document.write(content_value);
							docprint.document.write('</center></body></html>');
							docprint.print();
							docprint.document.close();
							docprint.focus();
							window.location.reload();
							
						});
					}
					
				});
			}
		});
		
		
		
		} 
		
	//var adate=document.getElementById("acct_date").value;
	//var shift=document.getElementById("shift").value;
	//alert(adate+shift);
	
	}

function reprint_pd_bill(billno){
	$.post(site_url+"/sales/bill_print",{bill:billno,copy:'duplicate'},function(res){
		//var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
		var disp_setting="scrollbars=yes,width=420px, height=200px";
		var content_value = res;
		var docprint=window.open("","",disp_setting);
		docprint.document.open();
		docprint.document.write('<html><head>');
		docprint.document.write("</head><body style='width:420px;height:200px;' onLoad='self.print()'>");
		docprint.document.write(content_value);
		docprint.document.write('</body></html>');
		docprint.document.close();
		docprint.focus();
		//window.location.reload();
		
	});
}

function other_sales_form_valid(){
	if(document.getElementById("item1").value=="default")
	{
		alert("Please Select any Product");
		document.getElementById("item1").focus();
		return false;
	}
	else if(document.getElementById("mob_no").value.length!="10" && document.getElementById("mob_no").value.trim()!=""){
		alert("Mobile No should contain 10 digits");
		document.getElementById("mob_no").focus();
		return false;
	}
	else if(isNaN(document.getElementById("mob_no").value) && (parseInt(document.getElementById("mob_no").value))!=document.getElementById("mob_no").value){
		alert("Mobile No should contain digits only");
		document.getElementById("mob_no").focus();
		return false;
	}
		else if(document.getElementById("mob_no").value == '0'){
			alert("wrong");
			return false;
		
	}
		else if(document.getElementById("mob_no").value == '0000000000'){
			alert("invalid mobile number");
			return false;
		
	}
	
	else if(document.getElementById("shift").value=="")
	{
		alert("Please Open a Shift");
		document.getElementById("shift").focus();
		return false;
	}
	else if((document.getElementById("qty1").value=="0")||(document.getElementById("qty1").value=="")){
		alert("Please Enter Quantity");
		document.getElementById("qty1").focus();
		return false;
	}
	else if(document.getElementById("in_sales").checked==true && document.getElementById("indent_no").value=="")
	{
	alert("Please Enter Indent No");
	document.getElementById("in_sales").focus();
	return false;
	}
	else if(document.getElementById("total").value=='0' || document.getElementById("total").value==''){
		document.getElementById("total").focus();
		alert("Please check the Total Amount");
	return false;
	}
	else if(document.getElementById("ch_sales").checked==true && document.getElementById("cheque_no").value=="")
	{
	alert("Please Enter Cheque No");
	document.getElementById("cheque_no").focus();
	return false;
	}
	else if(document.getElementById("ch_sales").checked==true && document.getElementById("cheque_date").value=="")
	{
	alert("Please Enter Cheque Date");
	document.getElementById("cheque_date").focus();
	return false;
	}
	else if(document.getElementById("ch_sales").checked==true && document.getElementById("bank_name").value=="")
	{
	alert("Please Enter Bank Name");
	document.getElementById("bank_name").focus();
	return false;
	}
	
	else if(document.getElementById('oil_service').checked == true && document.getElementById("avg_km").value==""){
		alert("Please Enter Average Kilometer value");
		document.getElementById("avg_km").focus();
		return false;
		}
		
	else if(document.getElementById('oil_service').checked == true && document.getElementById("km_reading").value=="")
		{
		alert("Please Enter  Kilometer reading value");
		document.getElementById("km_reading").focus();
		return false;
		}
	else if(document.getElementById('oil_service').checked == true && document.getElementById("mob_no").value=="")
	{
	alert("Please Enter Mobile Number");
	document.getElementById("mob_no").focus();
	return false;
	}
	
	
	else
		{
		var sms_bill=document.getElementById("bill_sms").value;
		var shift=document.getElementById("shift").value;
		var acct_date=document.getElementById("acct_date").value;
		var counterno=document.getElementById("counterno").value;
		$.post(site_url+"/sales/check_shift_open",{shft:shift,act_date:acct_date,ctr:counterno},function (data){
			if(data!='yes'){
				alert("Please check the shift is opened or not");
				window.location.reload();
			}
			else if(data=='yes'){
				$.post(site_url+"/sales/other_sales_form",$("#other_sales_entry").serialize(),function(data){
					//alert(data);
					
					
					if(sms_bill=='active'){
						if(document.getElementById("in_sales").checked==true)
						{
						  var sms_name=document.getElementById("ind_cust_name").value;
						}
						else{
						  var sms_name=document.getElementById("cust_name").value;
						}
						  var sms_no=document.getElementById("mob_no").value;
						  $.post(site_url+"/sales/sms_other_bill_info",{bill:data,smsname:sms_name,smsno:sms_no},function(res){
								if(res!=null){
									$.post(site_url+"/sales/other_bill_print",{bill_no:data,copy:'original'},function(res){
										//var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
										var disp_setting="scrollbars=yes,width=420px, height=200px";
										var content_value = res;
										var docprint=window.open("","",disp_setting);
										docprint.document.open();
										docprint.document.write('<html><head>');
										docprint.document.write('</head><body style="width:420px;height:200px;" onLoad="self.print()"><center>');
										docprint.document.write(content_value);
										docprint.document.write('</center></body></html>');
										docprint.document.close();
										docprint.focus();
										window.location.reload();
										
									});
								}
						  });
							
					}
					else{
						$.post(site_url+"/sales/other_bill_print",{bill_no:data,copy:'original'},function(res){
							//var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
							//alert(data);
							var disp_setting="scrollbars=yes,width=420px, height=200px";
							var content_value = res;
							var docprint=window.open("","",disp_setting);
							docprint.document.open();
							docprint.document.write('<html><head>');
							docprint.document.write('</head><body style="width:420px;height:200px;" onLoad="self.print()"><center>');
							docprint.document.write(content_value);
							docprint.document.write('</center></body></html>');
							docprint.document.close();
							docprint.focus();
							window.location.reload();
							
						});
					}
				
				//	alert(data);
					
				});
			}
		});
			
		}
}
/*function avg_kms(val){
	
	
	var avg_km = parseFloat(val);
	
 if(isNaN(avg_km) || (avg_km === 0))
	{
	alert("Please Enter Valid Input");
	document.getElementById("avg_km").focus();
	return false;
	}
else if(avg_km == ""){
	alert("enter the average km value");
	document.getElementById("avg_km").focus();
	return false;
	}
}

function km_readings(val){
	
	var km_reading=parseFloat(val);

	if(isNaN(km_reading) || (km_reading === 0))
		{
		alert("Please Enter Valid Input");
		document.getElementById("km_reading").focus();
		return false;
		}
	else if(km_reading == ""){
		alert("enter the km reading value");
		document.getElementById("km_reading").focus();
		return false;
		}
	}
*/
function reprint_other_products_bill(billno){
	$.post(site_url+"/sales/other_bill_print",{bill_no:billno,copy:'duplicate'},function(res){
		//var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
		var disp_setting="scrollbars=yes,width=420px, height=200px";
		var content_value = res;
		var docprint=window.open("","",disp_setting);
		docprint.document.open();
		docprint.document.write('<html><head>');
		docprint.document.write('</head><body style="width:420px;height:200px;" onLoad="self.print()"><center>');
		docprint.document.write(content_value);
		docprint.document.write('</center></body></html>');
		docprint.document.close();
		docprint.focus();
		//window.location.reload();
		
	});
}
function testform_valid(){
	if(document.getElementById("shift").value=="")
	{
		alert("Please Select any Shift");
		
		return false;
	}
	else if((document.getElementById("counterno").value=="default")){
		alert("Please Select a Counter");
		return false;
	}
	else if((document.getElementById("pump_no").value=="")){
		alert("Please Select a Pump");
		return false;
	}
	else if((document.getElementById("test_litres").value=="")||(document.getElementById("test_litres").value=='0')){
		alert("Please Enter Test Litres");
		return false;
	}
	else if(isNaN(document.getElementById("test_litres").value)){
		alert("Test Litres should be a number");
		return false;
	}
	else{
		var shift=document.getElementById("shift").value;
		var acct_date=document.getElementById("acct_date").value;
		var counterno=document.getElementById("counterno").value;
		$.post(site_url+"/sales/check_shift_open",{shft:shift,act_date:acct_date,ctr:counterno},function (data){
			if(data!='yes'){
				alert("Please check the shift is opened or not");
				window.location.reload();
			}
			else if(data=='yes'){
				$.post(site_url+"/sales/test_litres_form",$("#testform").serialize(),function(data){
					
					$.post(site_url+"/sales/test_bill_print",{bill_no:data},function(res){
						//var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
						var disp_setting="scrollbars=yes,width=420px, height=200px";
						var content_value = res;
						var docprint=window.open("","",disp_setting);
						docprint.document.open();
						docprint.document.write('<html><head>');
						docprint.document.write('</head><body style="width:420px;height:200px;" onLoad="self.print()"><center>');
						docprint.document.write(content_value);
						docprint.document.write('</center></body></html>');
						docprint.document.close();
						docprint.focus();
						window.location.reload();
						
					});
					
				});
			}
		});
	}
}
function formsubmit(e){
	if(e.keyCode==13){
		//alert("hai");
		cashform_valid();
	}
		//alert("hai");
}
function otherformsubmit(e){
	if(e.keyCode==13){
		//alert("hai");
		other_sales_form_valid();
	}
		//alert("hai");
}

function formsubmit_testbill(e){
	if(e.keyCode==13){
		testform_valid();
	}
}
function show_textbox(){
	
	document.getElementById("cust_row").style.display='none';
	document.getElementById("indent_box").style.display='';
	document.getElementById("indent_cust_row").style.display='';
	document.getElementById("refno_row").style.display='';
	document.getElementById("ind_cust_name").focus();
	//document.getElementById("show_indent_dob").style.display='';
	//$('#veh_no').autocomplete({
		//source: cust_array
	//});
	document.getElementById("cash_row").style.background='';
	document.getElementById("credit_row").style.background='';
	document.getElementById("xtra_row").style.background='';
	document.getElementById("fleet_row").style.background='';
	document.getElementById("indent_row").style.background='#006666';
	document.getElementById("easy_row").style.background='';
	document.getElementById("cheque_row").style.background='';
	document.getElementById("chequeno_row").style.display='none';
	document.getElementById("bankname_row").style.display='none';
	document.getElementById("indent_status_tbl").style.display='';
      
	//alert();
}


function hide_textbox(salemode){
	document.getElementById("indent_box").style.display='none';
	document.getElementById("indent_cust_row").style.display='none';
	document.getElementById("cust_row").style.display='';
	document.getElementById("refno_row").style.display='none';
	document.getElementById("indent_status_tbl").style.display='none';
	document.getElementById("veh_no").focus();
	$('#veh_no').autocomplete({
		source: truck_array
	});
	if(salemode == 'Cash_sales'){
	document.getElementById("cash_row").style.background='#006666';
	document.getElementById("credit_row").style.background='';
	document.getElementById("xtra_row").style.background='';
	document.getElementById("fleet_row").style.background='';
	document.getElementById("indent_row").style.background='';
	document.getElementById("easy_row").style.background='';
	document.getElementById("cheque_row").style.background='';
	document.getElementById("chequeno_row").style.display='none';
	document.getElementById("bankname_row").style.display='none';
	}else if (salemode == 'Credit_card_sales'){
		document.getElementById("cash_row").style.background='';
		document.getElementById("credit_row").style.background='#006666';
		document.getElementById("xtra_row").style.background='';
		document.getElementById("fleet_row").style.background='';
		document.getElementById("indent_row").style.background='';
		document.getElementById("easy_row").style.background='';
		document.getElementById("cheque_row").style.background='';
		document.getElementById("chequeno_row").style.display='none';
		document.getElementById("bankname_row").style.display='none';
}else if (salemode == 'Xtra_reward_sales'){
	document.getElementById("cash_row").style.background='';
	document.getElementById("credit_row").style.background='';
	document.getElementById("xtra_row").style.background='#006666';
	document.getElementById("fleet_row").style.background='';
	document.getElementById("indent_row").style.background='';
	document.getElementById("easy_row").style.background='';
	document.getElementById("cheque_row").style.background='';
	document.getElementById("chequeno_row").style.display='none';
	document.getElementById("bankname_row").style.display='none';
}
else if (salemode == 'Easy_fuel_sales'){
	document.getElementById("cash_row").style.background='';
	document.getElementById("credit_row").style.background='';
	document.getElementById("xtra_row").style.background='';
	document.getElementById("fleet_row").style.background='';
	document.getElementById("indent_row").style.background='';
	document.getElementById("easy_row").style.background='#006666';
	document.getElementById("cheque_row").style.background='';
	document.getElementById("chequeno_row").style.display='none';
	document.getElementById("bankname_row").style.display='none';
}
else if (salemode == 'Cheque_sales'){
	document.getElementById("chequeno_row").style.background='';
	document.getElementById("bankname_row").style.background='';
	document.getElementById("cash_row").style.background='';
	document.getElementById("credit_row").style.background='';
	document.getElementById("xtra_row").style.background='';
	document.getElementById("fleet_row").style.background='';
	document.getElementById("indent_row").style.background='';
	document.getElementById("easy_row").style.background='';
	document.getElementById("cheque_row").style.background='#006666';
	document.getElementById("chequeno_row").style.display='';
	document.getElementById("bankname_row").style.display='';
}
else{
	document.getElementById("cash_row").style.background='';
	document.getElementById("credit_row").style.background='';
	document.getElementById("xtra_row").style.background='';
	document.getElementById("fleet_row").style.background='#006666';
	document.getElementById("indent_row").style.background='';
	document.getElementById("easy_row").style.background='';
	document.getElementById("cheque_row").style.background='';
}
}

function crt_amt(obj,id,evt){
	if(isNaN(obj)==true){
		alert("Value should be a Number");
		return false;
		}
	var amt=obj;
	var rate=document.getElementById("rate"+id).value;
	var qty=amt/rate;
	document.getElementById("qty"+id).value=qty.toFixed(2);
	
	var cnt=document.getElementById("count").value;
	var tot_amt=0;
	var temp;
	for(i=1;i<=cnt;i++){
		temp=document.getElementById("val"+i).value;
		tot_amt= +tot_amt + +temp;
	}
	if(document.getElementById("2toilval")!=null){
	twotamt=document.getElementById("2toilval").value;
	tot_amt= +tot_amt + +twotamt;
	}
	document.getElementById("total").value=tot_amt.toFixed(2);
	
	}

function crt_amt_2toil(obj){
	if(isNaN(obj)==true){
		alert("Value should be a Number");
		return false;
		}
	var amt=obj;
	var rate=document.getElementById("2toilrate").value;
	var qty=amt/rate;
	document.getElementById("2toilqty").value=qty.toFixed(2);
	
	var cnt=document.getElementById("count").value;
	var tot_amt=0;
	var temp;
	for(i=1;i<=cnt;i++){
		temp=document.getElementById("val"+i).value;
		tot_amt= +tot_amt + +temp;
	}
	tot_amt= +tot_amt + +amt;
	document.getElementById("total").value=tot_amt.toFixed(2);
}

String.prototype.trim = function()
{return ((this.replace(/^[\s\xA0]+/, "")).replace(/[\s\xA0]+$/, ""));};

String.prototype.startsWith = function(str)
{return (this.match(str)==str);};

String.prototype.endsWith = function(str)
{return (this.match(str+"$")==str);};

String.prototype.endsWithbill = function(str)
{return (this.match(str+"")==str);};
function searchbybillno()
{
	var billno=document.getElementById('billno').value;
	filterTableBybillno(billno);
}
function searchbybillnolog()
{
	var billno=document.getElementById('billno').value;
	filterTableBybillnolog(billno);
}
function filterTableBybillnolog(str){
	
	str.trim();
	 var rowid, colid, rowc,vbid;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="bill_no"+i;
	    var lstr=(str.toString()).toLowerCase();
	    displayRowEndsWithbill(rowid,colid,lstr);
	  }
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
	function displayRowEndsWithbill(rowid,colid,str){
	var row = document.getElementById(rowid);
      var searchcol= document.getElementById(colid);
     var colstr=searchcol.value;
     var lcolstr=(colstr.toString()).toLowerCase();
      if (lcolstr.endsWithbill(str))
          row.style.display = '';
      else
          row.style.display = 'none';
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
	    colid="cust"+i;
	    var lstr=(str.toString()).toLowerCase();
	    displayRowStartsWith(rowid,colid,lstr);
	  }
	}

function searchbyindentno()
{
	var indentno=document.getElementById('indent_no').value;
	filterTableByIndentNo(indentno);
}

function filterTableByIndentNo(str){
	
	str.trim();
	 var rowid, colid, rowc,vbid;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="indentno"+i;
	    var lstr=(str.toString()).toLowerCase();
	    displayRowStartsWith(rowid,colid,lstr);
	  }
	}

function searchbyvehiclenumber()
{
	var vehiclenumber=document.getElementById('vehicle_number').value;
	filterTableByvehiclenumber(vehiclenumber);
}

function filterTableByvehiclenumber(str){
	
	str.trim();
	 var rowid, colid, rowc,vbid;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="vehicle"+i;
	    var lstr=(str.toString()).toLowerCase();
	    displayRowEndsWith(rowid,colid,lstr);
	  }
	}
function searchbysalesmode()
{
	var salesmode=document.getElementById('salesmode').value;
	filterTableBysalesmode(salesmode);
}

function filterTableBysalesmode(str){
	
	str.trim();
	 var rowid, colid, rowc,vbid;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="sales"+i;
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
function updatebill(billno)
{
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=1027, height=550,toolbar=no,addressbar=no");
	var generatedContent="<html><head><title>Update Bill Info</title><script type='text/javascript' src='../../js/jquery-1.js'></script><script type='text/javascript' src='../../js/jquery-ui-1.8.18.custom.min.js'></script><style type='text/css'>div.ui-datepicker{font-size:10px;width:150px;height:150px;}</style><link rel='stylesheet' media='' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /></head>"+
	 "<body background='' bgcolor='' ><div style='height:auto;background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Bill Information </span></p>"+
	 "<hr width='100%'>"+
	 "<div id='retailbill' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:300px;margin-bottom:30px'><input type=\"button\" id='update' value='Update' style='margin-right:25px;' class='button' onclick='opener.updatebillprint()'/><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
	 updatepop.document.write(generatedContent);   
	 $.get(site_url + "/sales/update_bill_info/"+billno,function(data){	
		 updatepop.document.getElementById('retailbill').innerHTML=data;
		 $.get(site_url + "/sales/get_sale_mode/"+billno,function(data){	
		 		//updatepop.alert(data);
		 		if(data == "Cheque_sales")
				{
				 updatepop.$("#cheque_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
				 updatepop.$("#clearance_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
				}
			if(data == "Indent_sales")
				{
				$(updatepop.document).contents().find('#cust_name').autocomplete({
					source: cust_array
				});
				}
			 
			 });
		 }); 
	 	
}

function update_chequestatus(cheque_status){
	//updatepop.alert(cheque_status);
		if(cheque_status=='CLEARED'){
			updatepop.document.getElementById("clearance_date").disabled=false;
			updatepop.document.getElementById("clearance_date").style.background='';
		}
		else{
			updatepop.document.getElementById("clearance_date").disabled=true;
			updatepop.document.getElementById("clearance_date").style.background='#f0f0f0';
		}
	
	
}

function addanotherrow()
{

		var cnt=updatepop.document.getElementById('count').value;
		var cntinc=++cnt;
		//updatepop.document.getElementById('billtable').innerHTML +=("<tr align='center'><td><select name='item"+cntinc+"' style='width:100%;' id='item"+cntinc+"' onblur='opener.get_ratepop(this.value,"+cntinc+")'></select></td><td><input type='text' name='qty"+cntinc+"' id='qty"+cntinc+"' value='0' onchange='opener.cal_amtpop(this.value,"+cntinc+")' style='text-align:right;width:70px;'/></td><td><input type='text' id='value"+cntinc+"' name='value"+cntinc+"' value='0'onchange='opener.crt_amtpop(this.value,"+cntinc+")' style='text-align:right;width:70px;'/></td><td><input type='text' name='rate"+cntinc+"' id='rate"+cntinc+"' value='0' style='background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;'/></td></tr>");
		$('.billtable',updatepop.document).append("<tr align='center'><td><select name='item"+cntinc+"' style='width:100%;' id='item"+cntinc+"' onblur='opener.get_ratepop(this.value,"+cntinc+")'></select></td><td><input type='text' name='qty"+cntinc+"' id='qty"+cntinc+"' value='0' onchange='opener.cal_amtpop(this.value,"+cntinc+")' style='text-align:right;width:70px;'/></td><td><input type='text' id='value"+cntinc+"' name='value"+cntinc+"' value='0'onchange='opener.crt_amtpop(this.value,"+cntinc+")' style='text-align:right;width:70px;'/></td><td><input type='text' name='rate"+cntinc+"' id='rate"+cntinc+"' value='0' style='background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;'/><img id='load"+cntinc+"' src='../../images/dnameloader.gif'  style='display: none'/></td></tr>");
		updatepop.document.getElementById('item'+cntinc).innerHTML=updatepop.document.getElementById('item1').innerHTML;
		updatepop.document.getElementById('item'+cntinc).focus();
		updatepop.document.getElementById('count').value=cntinc;
}

function cal_amtpop(obj,id){
	var rate=updatepop.document.getElementById("rate"+id).value;
	var qty=obj;
	var amt=rate*qty;
	updatepop.document.getElementById("value"+id).value=amt.toFixed(2);
	
	var cnt=updatepop.document.getElementById("count").value;
	var tot_amt=0;
	for(i=1;i<=cnt;i++){
		temp=updatepop.document.getElementById("value"+i).value;
		tot_amt= +tot_amt + +temp;
	}
	if(updatepop.document.getElementById("twotoilval")){
	twotamt=updatepop.document.getElementById("twotoilval").value;
	tot_amt= +tot_amt + +twotamt;
	}
	updatepop.document.getElementById("total").value=tot_amt.toFixed(2);

}

function cal_twotoilamtpop(obj){
	var rate=updatepop.document.getElementById("twotoilrate").value;
	var qty=obj;
	var amt=rate*qty;
	updatepop.document.getElementById("twotoilval").value=amt.toFixed(2);
	
	var cnt=updatepop.document.getElementById("count").value;
	var tot_amt=0;
	for(i=1;i<=cnt;i++){
		temp=updatepop.document.getElementById("value"+i).value;
		tot_amt= +tot_amt + +temp;
	}
		tot_amt=+tot_amt + +amt;
	updatepop.document.getElementById("total").value=tot_amt.toFixed(2);
}
function get_ratepop(obj,id){
	//alert(obj+""+id);
	updatepop.document.getElementById("load"+id).style.display='';
	if(obj!="default"){
		$.post(site_url+"/sales/get_rate",{pdt:obj},function(data){
			updatepop.document.getElementById("rate"+id).value=data;
				var rate=data;
				
				var qty=updatepop.document.getElementById("qty"+id).value;
				var amt=rate*qty;
				updatepop.document.getElementById("value"+id).value=amt;
				
				var cnt=updatepop.document.getElementById("count").value;
				var tot_amt=0;
				for(i=1;i<=cnt;i++){
					temp=updatepop.document.getElementById("value"+i).value;
					tot_amt= +tot_amt + +temp;
				}
				if(updatepop.document.getElementById("twotoilval")){
				twotamt=updatepop.document.getElementById("twotoilval").value;
				tot_amt= +tot_amt + +twotamt;
				}
				updatepop.document.getElementById("item"+id).style.background="";
				updatepop.document.getElementById("total").value=tot_amt.toFixed(2);
				updatepop.document.getElementById("load"+id).style.display='none';
	
	//		alert(data); */
			
		});
	}else{
		var cnt=updatepop.document.getElementById("count").value;
		updatepop.document.getElementById("rate"+id).value=0;
		updatepop.document.getElementById("qty"+id).value=0;
		updatepop.document.getElementById("value"+id).value=0;

		var cnt=updatepop.document.getElementById("count").value;
		var tot_amt=0;
		for(i=1;i<=cnt;i++){
			temp=updatepop.document.getElementById("value"+i).value;
			tot_amt= +tot_amt + +temp;
		}
		if(updatepop.document.getElementById("twotoilval")){
		twotamt=updatepop.document.getElementById("twotoilval").value;
		tot_amt= +tot_amt + +twotamt;
		}
		updatepop.document.getElementById("item"+id).style.background="";
		updatepop.document.getElementById("total").value=tot_amt.toFixed(2);

	}
}
function get_2toilratepop(obj){
	twotpump=updatepop.document.getElementById("2toilpump").value;
	if(twotpump!="default"){
		
		$.post(site_url+"/sales/get_rate",{pdt:obj},function(data){
		
			updatepop.document.getElementById("twotoilrate").value=data;
			var rate=data;
			var qty=updatepop.document.getElementById("twotoilqty").value;
			var amt=rate*qty;
			updatepop.document.getElementById("twotoilval").value=amt.toFixed(2);
			var cnt=updatepop.document.getElementById("count").value;
			var tot_amt=0;
			for(i=1;i<=cnt;i++){
				temp=updatepop.document.getElementById("value"+i).value;
				tot_amt= +tot_amt + +temp;
			}
			
			tot_amt=+tot_amt + +amt;
			updatepop.document.getElementById("total").value=tot_amt.toFixed(2);
			//updatepop.document.getElementById("load"+id).style.display='none';
			
		});
	}
	else{
		
		updatepop.document.getElementById("twotoilrate").value=0;
		updatepop.document.getElementById("twotoilqty").value=0;
		updatepop.document.getElementById("twotoilval").value=0;

		var cnt=updatepop.document.getElementById("count").value;
		var tot_amt=0;
		for(i=1;i<=cnt;i++){
			temp=updatepop.document.getElementById("value"+i).value;
			tot_amt= +tot_amt + +temp;
		}
		if(updatepop.document.getElementById("twotoilval")){
		twotamt=updatepop.document.getElementById("twotoilval").value;
		tot_amt= +tot_amt + +twotamt;
		}
		updatepop.document.getElementById("total").value=tot_amt.toFixed(2);
	}
}
function crt_amtpop(obj,id,evt){
	var amt=obj;
	var rate=updatepop.document.getElementById("rate"+id).value;
	var qty=amt/rate;
	updatepop.document.getElementById("qty"+id).value=qty.toFixed(2);
	
	var cnt=updatepop.document.getElementById("count").value;
	var tot_amt=0;
	var temp;
	for(i=1;i<=cnt;i++){
		temp=updatepop.document.getElementById("value"+i).value;
		tot_amt= +tot_amt + +temp;
	}
	if(updatepop.document.getElementById("twotoilval")){
	twotamt=updatepop.document.getElementById("twotoilval").value;
	tot_amt= +tot_amt + +twotamt;
	}
	updatepop.document.getElementById("total").value=tot_amt.toFixed(2);
	
	}

function crt_twotoilamtpop(obj){
	var amt=obj;
	var rate=updatepop.document.getElementById("twotoilrate").value;
	var qty=amt/rate;
	updatepop.document.getElementById("twotoilqty").value=qty.toFixed(2);
	
	var cnt=updatepop.document.getElementById("count").value;
	var tot_amt=0;
	var temp;
	for(i=1;i<=cnt;i++){
		temp=updatepop.document.getElementById("value"+i).value;
		tot_amt= +tot_amt + +temp;
	}
		tot_amt= +tot_amt + +amt;
	
	updatepop.document.getElementById("total").value=tot_amt.toFixed(2);
	
}
function updatebillprint()
{	
	var collect={};
	var bill_no=updatepop.document.getElementById("bill_no").value;		
	var cust_name=updatepop.document.getElementById("cust_name").value;
	var veh_no=updatepop.document.getElementById("veh_no").value;
	if(veh_no==''){
		updatepop.alert("Please Enter a Vehicle No");
		//updatepop.focus();
		updatepop.document.getElementById("veh_no").focus();
		return false;
	}
	else if(updatepop.document.getElementById("mob_no").value.length!="10" && updatepop.document.getElementById("mob_no").value.trim()!=""){
		updatepop.alert("Mobile No should contain 10 digits");
		updatepop.document.getElementById("mob_no").focus();
		return false;
	}
	else if(isNaN(updatepop.document.getElementById("mob_no").value) && (parseInt(updatepop.document.getElementById("mob_no").value))!=updatepop.document.getElementById("mob_no").value){
		updatepop.alert("Mobile No should contain digits only");
		updatepop.document.getElementById("mob_no").focus();
		return false;
	}
	var clearance_date;
	var mob_no=updatepop.document.getElementById("mob_no").value;
	var pump_no=updatepop.document.getElementById("pump_no").value;
	var shift=updatepop.document.getElementById("shift").value;
	var counter=updatepop.document.getElementById("counter").value;
	var sales_mode=updatepop.document.getElementById("sales_mode").value;
	var total=updatepop.document.getElementById("total").value;
	var count=updatepop.document.getElementById("count").value;
	var old_total=updatepop.document.getElementById("old_total").value;
	var item1=updatepop.document.getElementById("item1").value;
	if(item1=='default'){
		updatepop.alert("Please Enter a Vehicle No");
		updatepop.focus();
		updatepop.document.getElementById("item1").focus();
		return false;
	}
	if(sales_mode == 'Indent_sales')
	{
	var indent_no=updatepop.document.getElementById("indent_no").value;
	if(indent_no=='NULL' || indent_no==''){
		updatepop.alert("Please Enter Indent No");
		return false;
	}
	var cust_id=updatepop.document.getElementById("cust_id").value;
	if(cust_id=='NULL' || cust_id==''){
		updatepop.alert("Please Select an Indent Customer");
		return false;
	}
	
	} else {
		indent_no="NULL";
		cust_id="NULL";
	}
	
	if(sales_mode == 'Cheque_sales')
	{
	var cheque_no=updatepop.document.getElementById("cheque_no").value;
	if(cheque_no=='NULL' || cheque_no==''){
		updatepop.alert("Please Enter Cheque No");
		return false;
	}
	var cheque_date=updatepop.document.getElementById("cheque_date").value;
	if(cheque_date=='NULL' || cheque_date==''){
		updatepop.alert("Please Enter Cheque Date");
		return false;
	}
	var cheque_status=updatepop.document.getElementById("chequestatus").value;
	
	if(cheque_status=='CLEARED'){
		clearance_date=updatepop.document.getElementById("clearance_date").value;
	}
	else{
		clearance_date="NULL";
	}
	
	var bank_name=updatepop.document.getElementById("bank_name").value;
	
	if(bank_name=='NULL' || bank_name==''){
		updatepop.alert("Please Enter Bank Name");
		return false;
	}
	} else {
		cheque_no="NULL";
		cheque_date="NULL";
		cheque_status="NULL";
		bank_name="NULL";
		clearance_date='NULL';
	}
	
	var qty1=updatepop.document.getElementById("qty1").value;
	if(qty1=='' || qty1=='0'){
		
		updatepop.alert("Please Enter Quantity");
		updatepop.focus();
		updatepop.document.getElementById("qty1").focus();
		return false;
	}
	var meter_reading=updatepop.document.getElementById("meter_reading").value;
	 $.get(site_url+"/sales/delete_bill_details/"+bill_no,function(data){
		 });
	 updatepop.alert("Bill Updated");
	for(i=1;i<=count;i++){
		var item="item"+i;
		var qty="qty"+i;
		var rate="rate"+i;
		var value="value"+i;
		
		var prod=updatepop.document.getElementById(item).value;
		if(prod != 'default'){
		var qty=updatepop.document.getElementById(qty).value;
		var rate=updatepop.document.getElementById(rate).value;
		var value=updatepop.document.getElementById(value).value;
		var bill_status=updatepop.document.getElementById("bill_version").value;
		//alert("bill updated");
		var details={};
		details["bill_no"]=bill_no;
		details["prod"]=prod;
		details["qty"]=qty;
		details["rate"]=rate;
		details["value"]=value;
		details["bill_status"]=parseInt(bill_status)+1;
			$.post(site_url+"/sales/update_billdetails/",details,function(data){
			    });
			}
			
	}
	
	var twotoilpump=updatepop.document.getElementById("2toilpump").value;
	var twotoilqty=updatepop.document.getElementById("twotoilqty").value;
	
	if(twotoilpump!='default' && twotoilqty!=0){
		//alert(twotoilpump);
		var twotoilrate=updatepop.document.getElementById("twotoilrate").value;
		var twotoilval=updatepop.document.getElementById("twotoilval").value;
		var bill_status=updatepop.document.getElementById("bill_version").value;
		var details={};
		details["bill_no"]=bill_no;
		details["prod"]='2TOIL_LOOSE';
		details["qty"]=twotoilqty;
		details["rate"]=twotoilrate;
		details["value"]=twotoilval;
		details["bill_status"]=parseInt(bill_status)+1;
			$.post(site_url+"/sales/update_billdetails/",details,function(data){
			    });
	}
	var ref_no=updatepop.document.getElementById("ref_no").value;
	if(ref_no!=''){
		collect["ref_no"]=ref_no;
	}
	else{
		collect["ref_no"]='NULL';
	}
	collect["bill_no"]=bill_no;
	collect["cust_name"]=cust_name;
	collect["veh_no"]=veh_no;
	collect["mob_no"]=mob_no;
	collect["pump_no"]=pump_no;
	collect["shift"]= shift;
	collect["counter"]=counter;
	collect["sales_mode"]=sales_mode;
	collect["cheque_no"]=cheque_no;
	collect["cheque_date"]=cheque_date;
	collect["cheque_status"]=cheque_status;
	collect["bank_name"]=bank_name;
	collect["clearance_date"]=clearance_date;
	collect["indent_no"]=indent_no;
	collect["total"]=total;  
	collect["cust_id"]=cust_id;
	collect["meter_reading"]=meter_reading;
	if(twotoilpump!='default'){
		twotpump=twotoilpump;
	}else{
		twotpump='NULL';
	}
	collect["twotoilpump"]=twotpump;
	collect["old_total"]=old_total;
	
	$.post(site_url+"/sales/retailbill_update/",collect,function(data){
		
		   //updatepop.document.getElementById('retailbill').innerHTML=data;
		   
		   var bill_no=updatepop.document.getElementById("bill_no").value;
			
			/*$.post(site_url+"/sales/bill_print",{bill:bill_no},function(res){
				
				var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
				disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
				var content_value = res;
				var docprint=window.open("","",disp_setting);
				docprint.document.open();
				docprint.document.write('<html><head>');
				docprint.document.write('</head><body onLoad="self.print()"><center>');
				docprint.document.write(content_value);
				docprint.document.write('</center></body></html>');
				docprint.document.close();
				docprint.focus();
				//window.location.reload();
				
				
				
			});*/
			updatepop.close();
			PD_Editbill_form();
	    });
	
}

function salesmode(mode)
{
if(mode != 'Indent_sales')	
	{
		
		updatepop.document.getElementById('indent_no1').style.display="none";
		updatepop.document.getElementById('indent_no2').style.display="none";
		updatepop.document.getElementById('custid_row').style.display="none";
		

	}else{
		$(updatepop.document).contents().find('#cust_name').autocomplete({
			source: cust_array
		});
		updatepop.document.getElementById('indent_no1').style.display="block";
		updatepop.document.getElementById('indent_no2').style.display="block";	
		updatepop.document.getElementById('custid_row').style.display="";
		}

if(mode != 'Cheque_sales')	
{
	
	updatepop.document.getElementById('chequeno_row').style.display="none";
	updatepop.document.getElementById('chequedate_row').style.display="none";
	updatepop.document.getElementById('clearancedate_row').style.display="none";
	}
else{
	updatepop.document.getElementById('chequeno_row').style.display="";
	updatepop.document.getElementById('chequedate_row').style.display="";
	updatepop.document.getElementById('clearancedate_row').style.display="";
	updatepop.$("#cheque_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
	updatepop.$("#clearance_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
	}
}

function update_other_products_bill(billno)
{
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=1027, height=550,toolbar=no,addressbar=no");
	var generatedContent="<html><head><title>Update Other Product Bill Info</title><script type='text/javascript' src='../../js/jquery-1.js'></script><script type='text/javascript' src='../../js/jquery-ui-1.8.18.custom.min.js'></script><style type='text/css'>div.ui-datepicker{font-size:10px;width:150px;height:150px;}</style><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /></head>"+
	 "<body background='' bgcolor=''><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Bill Information </span></p>"+
"<hr width='100%'>"+
"<div id='otherproduct_bill' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:300px;margin-bottom:30px'><input type=\"button\" id='update' value='Update' style='margin-right:25px;' class='button' onclick='opener.update_other_product_billprint()'/><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
	 updatepop.document.write(generatedContent);   
	 $.get(site_url + "/sales/show_otherproduct_bill_info/"+billno,function(data){	
		 updatepop.document.getElementById('otherproduct_bill').innerHTML=data;
		
		}); 	
	 
	 $.get(site_url + "/sales/get_other_product_sale_mode/"+billno,function(data){
		
		 if(data == "Indent_sales")
				{
				$(updatepop.document).contents().find('#cust_name').autocomplete({
					source: cust_array
				});
				}
		 if(data == "Cheque_sales")
			{
			 updatepop.$("#cheque_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
			 updatepop.$("#clearance_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
			}
			 });
	 
	}
function update_other_product_billprint()
{
	var collect={};
	var bill_no=updatepop.document.getElementById("bill_no").value;		
	var cust_name=updatepop.document.getElementById("cust_name").value;
	var veh_no=updatepop.document.getElementById("veh_no").value;
	var mob_no=updatepop.document.getElementById("mob_no").value;
	var shift=updatepop.document.getElementById("shift").value;
	var counter=updatepop.document.getElementById("counter").value;
	var sales_mode=updatepop.document.getElementById("sales_mode").value;
	var total=updatepop.document.getElementById("total").value;
	var item1=updatepop.document.getElementById("item1").value;
	var qty1=updatepop.document.getElementById("qty1").value;
	var old_total=updatepop.document.getElementById("old_total").value;
	var ref_no=updatepop.document.getElementById("ref_no").value;
	var clearance_date;
	if(item1=='default'){
		updatepop.alert("Please Select a Product");
		updatepop.focus();
		updatepop.document.getElementById("item1").focus();
		return false;
	}
	else if(updatepop.document.getElementById("mob_no").value.length!="10" && updatepop.document.getElementById("mob_no").value.trim()!=""){
		updatepop.alert("Mobile No should contain 10 digits");
		updatepop.document.getElementById("mob_no").focus();
		return false;
	}
	else if(isNaN(updatepop.document.getElementById("mob_no").value) && (parseInt(updatepop.document.getElementById("mob_no").value))!=updatepop.document.getElementById("mob_no").value){
		updatepop.alert("Mobile No should contain digits only");
		updatepop.document.getElementById("mob_no").focus();
		return false;
	}
	if(qty1=='' || qty1=='0'){
		updatepop.alert("Please Enter Quantity");
		updatepop.focus();
		updatepop.document.getElementById("qty1").focus();
		return false;
	}
	if(sales_mode == 'Indent_sales')
	{
	var indent_no=updatepop.document.getElementById("indent_no").value;
	if(indent_no=='NULL' || indent_no==''){
		updatepop.alert("Please Enter Indent No");
		return false;
	}
	var cust_id=updatepop.document.getElementById("cust_id").value;
	if(cust_id=='NULL' || cust_id==''){
		updatepop.alert("Please Select an Indent Customer");
		return false;
	}
	
	}else {
		indent_no="NULL";
		cust_id="NULL";
	}
	
	if(sales_mode == 'Cheque_sales')
	{
	var cheque_no=updatepop.document.getElementById("cheque_no").value;
	if(cheque_no=='NULL' || cheque_no==''){
		updatepop.alert("Please Enter Cheque No");
		return false;
	}
	var cheque_date=updatepop.document.getElementById("cheque_date").value;
	if(cheque_date=='NULL' || cheque_date==''){
		updatepop.alert("Please Enter Cheque Date");
		return false;
	}
	var cheque_status=updatepop.document.getElementById("chequestatus").value;
	if(cheque_status=='CLEARED'){
		clearance_date=updatepop.document.getElementById("clearance_date").value;
	}
	else{
		clearance_date="NULL";
	}
	var bank_name=updatepop.document.getElementById("bank_name").value;
	if(bank_name=='NULL' || bank_name==''){
		updatepop.alert("Please Enter Bank Name");
		return false;
	}
	} else {
		cheque_no="NULL";
		cheque_date="NULL";
		cheque_status="NULL";
		bank_name="NULL";
		clearance_date="NULL";
	}
	
	//var category=updatepop.document.getElementById("category").value;
	var count=updatepop.document.getElementById("count").value;
	 $.get(site_url+"/sales/delete_other_product_bill_details/"+bill_no,function(data){
		 });
	 updatepop.alert("Bill Updated");
	for(i=1;i<=count;i++){
		var item="item"+i;
		var qty="qty"+i;
		var rate="rate"+i;
		var value="value"+i;
		
		var prod=updatepop.document.getElementById(item).value;
		if(prod != 'default'){
		var qty=updatepop.document.getElementById(qty).value;
		var rate=updatepop.document.getElementById(rate).value;
		var value=updatepop.document.getElementById(value).value;
		var bill_status=updatepop.document.getElementById("bill_version").value;
		//alert("bill updated");
		var details={};
		details["bill_no"]=bill_no;
		details["prod"]=prod;
		details["qty"]=qty;
		details["rate"]=rate;
		details["value"]=value;
		//details["category"]=category;
		details["bill_status"]=parseInt(bill_status)+1;
			$.post(site_url+"/sales/update_other_product_billdetails/",details,function(data){
			    }); 
			} 
			
	}
	collect["bill_no"]=bill_no;
	collect["cust_name"]=cust_name;
	collect["veh_no"]=veh_no;
	collect["mob_no"]=mob_no;
	
	collect["shift"]= shift;
	collect["counter"]=counter;
	collect["sales_mode"]=sales_mode;
	collect["cheque_no"]=cheque_no;
	collect["cheque_date"]=cheque_date;
	collect["cheque_status"]=cheque_status;
	collect["bank_name"]=bank_name;
	collect["clearance_date"]=clearance_date;
	collect["indent_no"]=indent_no;
	collect["total"]=total;  
	collect["cust_id"]=cust_id;
	collect["old_total"]=old_total;
	if(ref_no!=''){
		collect["ref_no"]=ref_no;
	}
	else{
		collect["ref_no"]='NULL';
	}
	
	$.post(site_url+"/sales/update_other_product_bill/",collect,function(data){
		
		   //updatepop.document.getElementById('otherproduct_bill').innerHTML=data;
			/*$.post(site_url+"/sales/other_bill_print",{bill_no:bill_no},function(res){
			var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
			disp_setting+="scrollbars=yes,width=600, height=600, left=100, top=25";
			var content_value = res;
			var docprint=window.open("","",disp_setting);
			docprint.document.open();
			docprint.document.write('<html><head>');
			docprint.document.write('</head><body onLoad="self.print()"><center>');
			docprint.document.write(content_value);
			docprint.document.write('</center></body></html>');
			docprint.document.close();
			docprint.focus();
			//window.location.reload();
			
		});*/
		updatepop.close();
		other_pdts_Editbill_form();
	    });
	
	

}
function check_indent_no(indentnum)
{
	var indent_no=indentnum.trim();
	var cust_id=updatepop.document.getElementById("cust_id").value;
	$.post(site_url + "/sales/check_indent_duplication/",{indentno:indent_no},function(data){
		if(data==0){
	 
		 $.get(site_url + "/sales/check_indent_no/"+cust_id,function(data){	
			 
			var indent=data.split('!');
			indent_start=indent[0];
			indent_end=indent[1]; 
			if(indent_start <= indent_no && indent_no <= indent_end)
				{
				updatepop.document.getElementById('indent').innerHTML="OK";
				}
			else{
				updatepop.document.getElementById('indent').innerHTML="out of range";
				
			}
		});
		}
		else{
			updatepop.document.getElementById("indent_no").value='';
			updatepop.document.getElementById("indent_no").focus();
			updatepop.alert("Indent No is already used. Please type another Indent No");
		}
		});
}

function chk_ind_no(indent_no){
	
	var obj=document.getElementById("ind_cust_name").value;
	if(obj==''){
		alert("Please Select any customer");
	}
	else{
	$.post(site_url+"/sales/get_cust_id/",{cust_name:obj},function(data){
	var cust_id=data;
	$.post(site_url + "/sales/check_indent_duplication/",{indentno:indent_no},function(data){
		if(data==0){
	 $.get(site_url + "/sales/check_indent_no/"+cust_id,function(data){	
		var indent=data.split('!');
		indent_start=indent[0];
		indent_end=indent[1]; 
		if(indent_start <= indent_no && indent_no <= indent_end)
			{
			document.getElementById('incorrect').style.display="none";
			document.getElementById('correct').style.display="";
			}
		else{
			document.getElementById('correct').style.display="none";
			document.getElementById('incorrect').style.display="";
			
		}
	});
		}
		else{
			document.getElementById("indent_no").value='';
			document.getElementById("indent_no").focus();
			
			alert("Indent No is already used. Please type another Indent No");
			
			
			
		}
	});
	});
	}
}

function changecounterinsession(obj){
	$.post(site_url+"/sales/change_counter_session",{counter:obj},function(data){
	});
}


function open_close_shift(){
	var counter=document.getElementById("counter").value;
	var shift=document.getElementById("shift").value;
	var action=document.getElementById("action").value;
	var acct_date=document.getElementById("acct_date").value;
	if(counter=='default'){
		alert("Please Select Counter");
		return false;
	}
	else if(shift=='default'){
		alert("Please Select Shift");
		return false;
	}
	else if(action=='default'){
		alert("Please Select any Action");
		return false;
	}
	else if(acct_date==''){
		alert("Please Select a date");
		return false;
	}
	$.post(site_url+"/sales/check_tank_stock/",{actn:action,act_date:acct_date},function(data1){
		if(data1=='ok'){
			$.post(site_url+"/sales/insert_open_close_shift/",{ctr:counter,shft:shift,actn:action,act_date:acct_date},function(data){
				//alert(data);
				var arr=data.split(":::");
				if(arr[1]){
				changecounterinsession(arr[1]);
				}
				alert(arr[0]);
				window.location.reload();
				});
		}
		else{
			alert("Please Enter Tank Stock For :"+data1);
		}
	});
	/**/
	//
	}
	function PD_Editbill_form()
	{
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
						$.post(site_url + "/sales/PD_bill_details",date,function(data) {
						$("#contentData").html("");
						$("#contentData").append(data);
	
						}); 
						}
	}
	function testing_bill_form()
	{
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
						$.post(site_url + "/sales/testing_bill_details",date,function(data) {
						$("#contentData").html("");
						$("#contentData").append(data);
	
						}); 
						}
	}
	function other_pdts_Editbill_form()
	{
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
						$.post(site_url + "/sales/other_pdts_bill_details",date,function(data) {
						$("#contentData").html("");
						$("#contentData").append(data);
	
						}); 
						}
	}
	
	function managed_retail_bill_form()
	{
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
						$.post(site_url + "/sales/managed_retail_bill_details",date,function(data) {
						$("#contentData").html("");
						$("#contentData").append(data);
	
						}); 
						}
	}
	function showbilldetails(billversion)
	{
		var bill=billversion.split("-");
		var bill_no=bill[0];
		var version=bill[1];
		updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=1027, height=550,toolbar=no,addressbar=no");
		var generatedContent="<html><head><title>Update Bill Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /></head>"+
		 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Bill Information </span></p>"+
		 "<hr width='100%'>"+
		 "<div id='retailbill' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:300px;margin-bottom:30px'><input type=\"button\" id='close' value='Close' class='' onclick='javascript:self.close()'/></div></body></html>";
		 updatepop.document.write(generatedContent);   
		
		$.get(site_url + "/sales/fetch_no_of_version/"+bill_no,function(data){
			
			if(version == data)
			{
			$.get(site_url + "/sales/fetch_current_version/"+bill_no,function(data){
				if(data != 0)
					{
				updatepop.document.getElementById('retailbill').innerHTML=data;
					}	else
					{
						var bill_details={};
						bill_details["bill_no"]=bill_no;
						bill_details["version"]=version;
						$.post(site_url+"/sales/fetch_old_version/",bill_details,function(data){
						
							updatepop.document.getElementById('retailbill').innerHTML=data;
						
						});
					}
			});
			
			}else
			{
				var bill_details={};
				bill_details["bill_no"]=bill_no;
				bill_details["version"]=version;
				$.post(site_url+"/sales/fetch_old_version/",bill_details,function(data){
				
					updatepop.document.getElementById('retailbill').innerHTML=data;
				
				});
			}
		});
			
	}
	function managed_other_pdts_bill_form()
	{
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
						$.post(site_url + "/sales/managed_other_pdts_bill_details",date,function(data) {
						$("#contentData").html("");
						$("#contentData").append(data);
	
						}); 
						}
	}
	function show_otherpdts_billdetails(billversion)
	{
		var bill=billversion.split("-");
		var bill_no=bill[0];
		var version=bill[1];
		updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=1027, height=550,toolbar=no,addressbar=no");
		var generatedContent="<html><head><title>Update Bill Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /></head>"+
		 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Bill Information </span></p>"+
		 "<hr width='100%'>"+
		 "<div id='otherpdtsbill' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:300px;margin-bottom:30px'><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
		 updatepop.document.write(generatedContent);   
		
		$.get(site_url + "/sales/fetch_no_of_version_other/"+bill_no,function(data){
			if(version == data)
			{
			$.get(site_url + "/sales/fetch_current_version_other/"+bill_no,function(data){
				
				if(data != 0)
				{
					updatepop.document.getElementById('otherpdtsbill').innerHTML=data;
				}	else
				{
					var bill_details={};
					bill_details["bill_no"]=bill_no;
					bill_details["version"]=version;
					$.post(site_url+"/sales/fetch_old_version_other/",bill_details,function(data){
					
						updatepop.document.getElementById('otherpdtsbill').innerHTML=data;
					
					});
				}
			
			});
			
			}else
			{
				var bill_details={};
				bill_details["bill_no"]=bill_no;
				bill_details["version"]=version;
				$.post(site_url+"/sales/fetch_old_version_other/",bill_details,function(data){
				
					updatepop.document.getElementById('otherpdtsbill').innerHTML=data;
				
				});
			}
		});
	
	}
	function cancelbill(bill_no)
	{
	document.getElementById("cancel_msg").style.display='inline';
	var reason=prompt("Reason for Cancelling Bill. Bill No:"+bill_no,"Wrong Entry");
	if(reason != null && reason != "")
		{
		var collect={};
		collect["bill_no"]= bill_no;
		collect["reason"]=reason;
		$.post(site_url+"/sales/cancelbill/",collect,function(data){
			//alert("Bill Cancelled Successfully");
			document.getElementById("cancel_msg").style.display='none';
			PD_Editbill_form();
			   });
		
		}else if (reason == ""){
		alert("Please Enter the Reason");
		}else{
			//alert("Operation Interrupted");
			document.getElementById("cancel_msg").style.display='none';
		}
	
	}
	
	function cancel_testing_bill(bill_no)
	{
		//alert(bill_no);
		document.getElementById("cancel_msg").style.display='inline';
	var reason=prompt("Reason for Cancelling Bill. Bill No:"+bill_no,"Wrong Entry");
	if(reason != null && reason != "")
		{
		var collect={};
		collect["bill_no"]= bill_no;
		collect["reason"]=reason;
		
		$.post(site_url+"/sales/cancel_testing_bill/",collect,function(data){
			//alert("Bill Cancelled Successfully");
			document.getElementById("cancel_msg").style.display='none';
			testing_bill_form();
			   });
		
		}else if (reason == ""){
		alert("Please Enter the Reason");
		}else{
			document.getElementById("cancel_msg").style.display='none';
		}
	
	}
	
	function cancelbill_other(bill_no)
	{
		document.getElementById("cancel_msg").style.display='inline';
	var reason=prompt("Reason for Cancelling Bill. Bill No:"+bill_no,"Wrong Entry");
	if(reason != null && reason != "")
		{
		var collect={};
		collect["bill_no"]= bill_no;
		collect["reason"]=reason;
		$.post(site_url+"/sales/cancelbill_other/",collect,function(data){
			//alert("Bill Cancelled Successfully");
			document.getElementById("cancel_msg").style.display='none';
			other_pdts_Editbill_form();
			   });
		
		}else if (reason == ""){
		alert("Please Enter the Reason");
		}else{
			document.getElementById("cancel_msg").style.display='none';
		}
		
	}
	
	function get_cancelled_bills()
	{
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
					$.post(site_url + "/sales/get_cancelled_bills",date,function(data) {
					$("#contentData").html("");
					$("#contentData").append(data);

					}); 
					}
}
	
	function get_cancelled_testing_bills()
	{
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
					$.post(site_url + "/sales/get_cancelled_testing_bills",date,function(data) {
					$("#contentData").html("");
					$("#contentData").append(data);

					}); 
					}
}
	function show_cancelbill_details(bill_no)
	{
		updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=1027, height=550,toolbar=no,addressbar=no");
		var generatedContent="<html><head><title>Cancel Bill Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /></head>"+
		 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Bill Information </span></p>"+
		 "<hr width='100%'>"+
		 "<div id='cancelbill' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:300px;margin-bottom:30px'><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
		 updatepop.document.write(generatedContent);   
		
		$.get(site_url + "/sales/cancel_bill_details/"+bill_no,function(data){
			updatepop.document.getElementById('cancelbill').innerHTML=data;		
		});
	
	}

	function get_cancelled_bills_other()
	{
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
					$.post(site_url + "/sales/get_cancelled_bills_other",date,function(data) {
					$("#contentData").html("");
					$("#contentData").append(data);

					}); 
					}
}
	function show_cancelbill_details_other(bill_no)
	{
		updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=1027, height=550,toolbar=no,addressbar=no");
		var generatedContent="<html><head><title>Cancel Bill Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /></head>"+
		 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Bill Information </span></p>"+
		 "<hr width='100%'>"+
		 "<div id='cancelbill_other' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:300px;margin-bottom:30px'><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
		 updatepop.document.write(generatedContent);   
		
		$.get(site_url + "/sales/cancel_bill_details_other/"+bill_no,function(data){
			updatepop.document.getElementById('cancelbill_other').innerHTML=data;		
		});
	}
	
	function show_kms(){
		//if(document.other_sales_entry.checkbox.checked==true)
		var checkbox=document.getElementById('oil_service');
		// if (checkbox.checked==true)
			if(checkbox.checked == true){
			
			document.getElementById("show_avg").style.visibility = 'visible';
			document.getElementById("show_km").style.visibility = 'visible';
			document.getElementById("show_dob").style.visibility = 'visible';
			document.getElementById("show_wed").style.visibility = 'visible';
			document.getElementById("Oil_service_status").value = '1';
			document.getElementById("mbn").innerHTML = 'Mobile Number <font color=red size=5px> *</font>';
				}
			
		
		else if(checkbox.checked == false){
			//alert(checkbox.checked)
			document.getElementById("show_avg").style.visibility = 'hidden';
			document.getElementById("show_km").style.visibility = 'hidden';
			document.getElementById("show_dob").style.visibility = 'hidden';
			document.getElementById("show_wed").style.visibility = 'hidden';
			document.getElementById("Oil_service_status").value = '0';
			document.getElementById("mbn").innerHTML = 'Mobile Number';
			
		}
	}
