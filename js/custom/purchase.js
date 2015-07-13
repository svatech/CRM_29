$("#start_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',onClose:function(selectedDate){$("#end_date").datepicker("option","minDate",selectedDate);},		
	defaultDate: new Date()		
});


$("#end_date").datepicker({
	dateFormat: 'yy-mm-dd',	maxDate: '+0d',	
	defaultDate: new Date()		
});
$(function() {
   updateClock();
});

function isFloatKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    		
    if (charCode > 31 && charCode!=46 && (charCode < 48 || charCode > 57 ))
        return false;
    return true;
}

var updateClock = function() {
    function pad(n) {
        return (n < 10) ? '0' + n : n;
    }
    var now = new Date();
      var t=pad(now.getDate()) + '/' +
   			pad(now.getMonth()+1) + '/' +
   			pad(now.getFullYear())+ ' ' +
   			pad(now.getHours()) + ':' +
            pad(now.getMinutes());
      if(document.getElementById('timedisp')!=null){
   	  document.getElementById('timedisp').value=t;
      }
    var delay = 1000 - (now % 1000);
   setTimeout(updateClock, delay);
};
$("#acct_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',		
	defaultDate: new Date()		
});

$("#inv_date").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',		
	defaultDate: new Date()		
});
function addrow(){
	var cnt=document.getElementById('count').value;
	var cntinc=++cnt;
	$('.pet_pur_tbl ').append("<tr align='center'><td><select name='item"+cntinc+"' id='item"+cntinc+"' style='width:100%;' ></select></td><td><input type='text' name='qty"+cntinc+"' id='qty"+cntinc+"' style='width:50px;text-align:right' value='0' onkeypress='return isFloatKey(event)'  onkeyup='calculate_amount(this.value,"+cntinc+")'/></td><td><input type='text' id='val"+cntinc+"' name='val"+cntinc+"' onkeypress='return isFloatKey(event)' style='width:70px;text-align:right'  value='0' onblur='javascript:tot_amt(this.value,"+cntinc+")'/></td><td><input type='text' id='inv_den"+cntinc+"' name='inv_den"+cntinc+"' onkeypress='return isFloatKey(event)' style='width:50px;text-align:right'  value='0' onchange=''/></td><td><input type='text' id='del_den"+cntinc+"' name='del_den"+cntinc+"' onkeypress='return isFloatKey(event)' style='width:50px;text-align:right'  value='0'  onblur='check_density(this.value,"+cntinc+")'/></td></tr>");
	document.getElementById('item'+cntinc).innerHTML=document.getElementById('item1').innerHTML;
	document.getElementById('count').value=cntinc;
	
}
function addanotherrow()
{
		var cnt=updatepop.document.getElementById('count').value;
		var cntinc=++cnt;
		//updatepop.document.getElementById('billtable').innerHTML +=("<tr><td><select name='item"+cntinc+"' id='item"+cntinc+"' style='width:100%;' ></select></td><td><input type='text' name='qty"+cntinc+"' id='qty"+cntinc+"'  style='width:50px;text-align:right' value='0' /></td><td><input type='text' id='amt"+cntinc+"' name='amt"+cntinc+"' style='width:70px;text-align:right'  value='0' onchange='javascript:opener.tot_amt(this.value,"+cntinc+")' /></td><td><input type='text' id='inv_den"+cntinc+"' name='inv_den"+cntinc+"' style='width:50px;text-align:right'  value='0'/></td><td><input type='text' id='del_den"+cntinc+"' name='del_den"+cntinc+"' style='width:50px;text-align:right'  value='0' onchange=''/></td></tr>");
		$('.billtable',updatepop.document).append("<tr align='center'><td><select name='item"+cntinc+"' id='item"+cntinc+"' style='width:100%;' ></select></td><td><input type='text' name='qty"+cntinc+"' id='qty"+cntinc+"' onkeypress='return opener.isFloatKey(event)'  style='width:50px;text-align:right' value='0'  onkeyup='javascript:opener.calculate_amount_pop(this.value,"+cntinc+")' /></td><td><input type='text' id='amt"+cntinc+"' name='amt"+cntinc+"' style='width:70px;text-align:right'  value='0' onchange='javascript:opener.get_tot_amt()' onkeypress='return opener.isFloatKey(event)'/></td><td><input type='text' id='inv_den"+cntinc+"' name='inv_den"+cntinc+"' style='width:50px;text-align:right'  value='0' onkeypress='return opener.isFloatKey(event)'/></td><td><input type='text' id='del_den"+cntinc+"' name='del_den"+cntinc+"' style='width:50px;text-align:right'  value='0'  onblur='javascript:opener.check_density_pop(this.value,1)' onkeypress='return opener.isFloatKey(event)'/></td></tr>");
		updatepop.document.getElementById('item'+cntinc).innerHTML=updatepop.document.getElementById('item1').innerHTML;
		updatepop.document.getElementById('item'+cntinc).focus();
		updatepop.document.getElementById('count').value=cntinc;
}

function addanotherrow_other()
{
		var cnt=updatepop.document.getElementById('count').value;
		var cntinc=++cnt;
		//updatepop.document.getElementById('billtable').innerHTML +=("<tr><td><select name='item"+cntinc+"' id='item"+cntinc+"' style='width:100%;' ></select></td><td><input type='text' name='qty"+cntinc+"' id='qty"+cntinc+"'  style='width:50px;text-align:right' value='0' /></td><td><input type='text' id='amt"+cntinc+"' name='amt"+cntinc+"' style='width:70px;text-align:right'  value='0' onchange='javascript:opener.tot_amt(this.value,"+cntinc+")' /></td><td><input type='text' id='inv_den"+cntinc+"' name='inv_den"+cntinc+"' style='width:50px;text-align:right'  value='0'/></td><td><input type='text' id='del_den"+cntinc+"' name='del_den"+cntinc+"' style='width:50px;text-align:right'  value='0' onchange=''/></td></tr>");
		$('.billtable',updatepop.document).append("<tr align='center'><td><select name='item"+cntinc+"' id='item"+cntinc+"' style='width:100%;' onchange='javascript:opener.edit_page_cal_amt()'></select></td><td><input type='text' name='qty"+cntinc+"' id='qty"+cntinc+"' onkeypress='return opener.isFloatKey(event)' style='width:50px;text-align:right' value='0' onchange='javascript:opener.edit_page_cal_amt()'/></td><td><input type='text' id='rate"+cntinc+"' name='rate"+cntinc+"' style='width:50px;text-align:right'  value='0' onkeypress='return opener.isFloatKey(event)'  onchange='javascript:opener.edit_page_cal_amt()'/></td><td><input type='text' id='amt"+cntinc+"' name='amt"+cntinc+"' style='width:70px;text-align:right'  value='0' onchange='javascript:opener.edit_page_cal_amt()' onkeypress='return opener.isFloatKey(event)' /></td></tr>");
		updatepop.document.getElementById('item'+cntinc).innerHTML=updatepop.document.getElementById('item1').innerHTML;
		updatepop.document.getElementById('item'+cntinc).focus();
		updatepop.document.getElementById('count').value=cntinc;
}

function addnewrow(){
	var cnt=document.getElementById('tnk_count').value;
	var cntinc=++cnt;
	$('.tank_split_table ').append("<tr align='center'><td><select name='tnk"+cntinc+"' id='tnk"+cntinc+"' style='width:100%' onblur='javascript:get_tnk_pdt(this.value,"+cntinc+")' ></select></td><td><input type='text' id='pdt"+cntinc+"' name='pdt"+cntinc+"' style='width:70px;'  value='' /></td><td><input type='text' id='ltrs"+cntinc+"' name='ltrs"+cntinc+"' style='width:70px;text-align:right' onkeypress='return isFloatKey(event)' value='0' /></td></tr>");
	document.getElementById('tnk'+cntinc).innerHTML=document.getElementById('tnk1').innerHTML;
	document.getElementById('tnk_count').value=cntinc;
	
}
function addanothertankrow(){
	var cnt=updatepop.document.getElementById('tank_count').value;
	var cntinc=++cnt;
	//updatepop.document.getElementById('tank_table').innerHTML +=("<tr align='center'><td><select name='tnk"+cntinc+"' id='tnk"+cntinc+"' style='width:100%'  ></select></td><td><input type='text' id='pdt"+cntinc+"' name='pdt"+cntinc+"' style='width:70px;'  value='' /></td><td><input type='text' id='ltrs"+cntinc+"' name='ltrs"+cntinc+"' style='width:70px;text-align:right'  value='0' /></td></tr>");
	$('.tank_table',updatepop.document).append("<tr align='center'><td><select name='tnk"+cntinc+"' id='tnk"+cntinc+"' style='width:100%'  onblur='javascript:opener.get_tnk_pdt_edit(this.value,"+cntinc+")' onchange='javascript:opener.get_tnk_pdt_edit(this.value,"+cntinc+")'></select></td><td><input type='text' id='pdt"+cntinc+"' name='pdt"+cntinc+"' style='width:70px;'  value='' /></td><td><input type='text' id='ltrs"+cntinc+"' name='ltrs"+cntinc+"' style='width:70px;text-align:right'  value='0' onkeypress='return opener.isFloatKey(event)' /></td></tr>");
	updatepop.document.getElementById('tnk'+cntinc).innerHTML=updatepop.document.getElementById('tnk1').innerHTML;
	//updatepop.document.getElementById('tnk'+cntinc).focus();
	updatepop.document.getElementById('tank_count').value=cntinc;
	
}
function opp_addrow(){
	var cnt=document.getElementById('count').value;
	var cntinc=++cnt;
	$('.oth_pur_tbl ').append("<tr align='center'><td><select name='item"+cntinc+"' id='item"+cntinc+"' style='width:100%;'  onchange='javascript:fetch_comm_rate(this.value,"+cntinc+")'></select></td><td><input type='text' name='qty"+cntinc+"' id='qty"+cntinc+"' style='width:50px;text-align:right' value='0' onchange='javascript:cal_amt(this.value,"+cntinc+")' onkeypress='return isFloatKey(event)' /></td><td><input type='text' name='rate"+cntinc+"' id='rate"+cntinc+"' style='width:50px;text-align:right' value='0' onchange='javascript:cal_amt(this.value,"+cntinc+")' onkeypress='return isFloatKey(event)'/></td> 	<td><input type='text' id='val"+cntinc+"' name='val"+cntinc+"' style='width:70px;text-align:right'  value='0' onchange='javascript:cal_amt(this.value,"+cntinc+")' onkeypress='return isFloatKey(event)'/></td></tr>");
	document.getElementById('item'+cntinc).innerHTML=document.getElementById('item1').innerHTML;
	document.getElementById('count').value=cntinc;
	
}



function cal_amt(obj,id){
	
	
	var rate=document.getElementById("rate"+id).value;
	var qty=document.getElementById("qty"+id).value;
	var val=rate*qty;
	document.getElementById("val"+id).value=val.toFixed(3);
	var cnt=document.getElementById("count").value;
	var tot_amt=0;
	for(i=1;i<=cnt;i++){
		temp=document.getElementById("val"+i).value;
		tot_amt= +tot_amt + +temp;
	}
	document.getElementById("total").value=tot_amt.toFixed(2);
	var cash_disc=document.getElementById("cash_disc").value;
	var cash_disc_amt=(tot_amt*cash_disc/100);
	document.getElementById("cash_disc_amt").value=cash_disc_amt.toFixed(2);
	var sch_disc=document.getElementById("sch_disc").value;
	var sch_disc_amt=(tot_amt*sch_disc/100);
	document.getElementById("sch_disc_amt").value=sch_disc_amt.toFixed(2);
	var vat=document.getElementById("vat").value;
	var vat_amt=(tot_amt*vat/100);
	document.getElementById("vat_amt").value=vat_amt.toFixed(2);
	var others=document.getElementById("other_amt").value;
	var grand_tot=+tot_amt - +cash_disc_amt - +sch_disc_amt + +vat_amt + +others;
	document.getElementById("grnd_tot").value=grand_tot.toFixed(2);


}

function edit_page_cal_amt(){
	var cnt=updatepop.document.getElementById("count").value;
	for(j=1;j<=cnt;j++){
	var prod=updatepop.document.getElementById("item"+j).value;
	
	if(prod!='default'){
	var rate=updatepop.document.getElementById("rate"+j).value;
	var qty=updatepop.document.getElementById("qty"+j).value;
	var val=rate*qty;
	updatepop.document.getElementById("amt"+j).value=val.toFixed(3);
	}
	else{
		updatepop.document.getElementById("amt"+j).value=0;
		updatepop.document.getElementById("rate"+j).value=0;
		updatepop.document.getElementById("qty"+j).value=0;
	}
	}
	var tot_amt=0;
	for(i=1;i<=cnt;i++){
		temp=updatepop.document.getElementById("amt"+i).value;
		tot_amt= +tot_amt + +temp;
	}
	updatepop.document.getElementById("total").value=tot_amt.toFixed(2);
	var sch_disc=updatepop.document.getElementById("sch_disc").value;
	var sch_disc_amt=(tot_amt*sch_disc/100);
	updatepop.document.getElementById("sch_disc_amt").value=sch_disc_amt.toFixed(2);
	var sch_disc_amt1=tot_amt-sch_disc_amt.toFixed(3);
	var cash_disc=updatepop.document.getElementById("cash_disc").value;
	var cash_disc_amt=(sch_disc_amt1*cash_disc/100);
	updatepop.document.getElementById("cash_disc_amt").value=cash_disc_amt.toFixed(2);
	var cash_disc_amt1=sch_disc_amt1-cash_disc_amt;
	var vat=updatepop.document.getElementById("vat").value;
	var vat_amt=(cash_disc_amt1*vat/100);
	updatepop.document.getElementById("vat_amt").value=vat_amt.toFixed(2);
	var others=updatepop.document.getElementById("other_amt").value;
	var grand_tot=+tot_amt - +cash_disc_amt - +sch_disc_amt + +vat_amt - +others;
	updatepop.document.getElementById("grnd_tot").value=grand_tot.toFixed(2);

}

function updatebill(billno)
{
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=1027, height=550,toolbar=no,addressbar=no");
	var generatedContent="<html><head><title>Update Bill Info</title><script type='text/javascript' src='../../js/jquery-1.js'></script><script type='text/javascript' src='../../js/jquery-ui-1.8.18.custom.min.js'></script><style type='text/css'>div.ui-datepicker{font-size:10px;width:150px;height:150px;}</style><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /></head>"+
	 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Purchase Information </span></p>"+
	 "<hr width='100%'>"+
	 "<div id='retailbill' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:300px;margin-bottom:30px'><input type=\"button\" id='update' value='Register' style='margin-right:25px;' class='button' onclick='opener.update_pet_pur()'/><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
	 updatepop.document.write(generatedContent);   
	 $.get(site_url+"/purchase/update_bill_info/"+billno,function(data){	
		 updatepop.document.getElementById('retailbill').innerHTML=data;
		 updatepop.$("#acct_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		 updatepop.$("#inv_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		 }); 
}

function updateotherbill(billno)
{
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=1027, height=550,toolbar=no,addressbar=no");
	var generatedContent="<html><head><title>Update Bill Info</title><script type='text/javascript' src='../../js/jquery-1.js'></script><script type='text/javascript' src='../../js/jquery-ui-1.8.18.custom.min.js'></script><style type='text/css'>div.ui-datepicker{font-size:10px;width:150px;height:150px;}</style><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /></head>"+
	 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Purchase Information </span></p>"+
	 "<hr width='100%'>"+
	 "<div id='retailbill' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:300px;margin-bottom:30px'><input type=\"button\" id='update' value='Register' style='margin-right:25px;' class='button' onclick='opener.update_oth_pur()'/><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
	 updatepop.document.write(generatedContent);   
	 $.get(site_url+"/purchase/update_other_bill_info/"+billno,function(data){	
		 updatepop.document.getElementById('retailbill').innerHTML=data;
		 updatepop.$("#acct_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		 updatepop.$("#inv_date").datepicker({dateFormat: 'yy-mm-dd',defaultDate: new Date()});
		 }); 
}

function get_tot_amt(){
	var cnt=updatepop.document.getElementById("count").value;
	var tot_amt=0;
	for(i=1;i<=cnt;i++){
		var pdt=updatepop.document.getElementById("item"+i).value;
		if(pdt!='default'){
		temp=updatepop.document.getElementById("amt"+i).value;
		tot_amt= +tot_amt + +temp;
		}
	}
		updatepop.document.getElementById("total").value=tot_amt.toFixed(3);
}

function update_pet_pur(){
	var collect={};
	var voucher_no=updatepop.document.getElementById("voucher_no").value;		
	var acct_date=updatepop.document.getElementById("acct_date").value;
	var inv_no=updatepop.document.getElementById("inv_no").value;
	var inv_date=updatepop.document.getElementById("inv_date").value;
	var party_name=updatepop.document.getElementById("party_name").value;
	var cnt=updatepop.document.getElementById("count").value;
	var tank_cnt=updatepop.document.getElementById("tank_count").value;
	var total_amt=updatepop.document.getElementById("total").value;
	
	var pet_qty=0;
	var die_qty=0;
	var mile_qty=0;
	var pre_qty=0;
	var ord_qty=0;
	var cnt=updatepop.document.getElementById("count").value;
	var tot_ltrs=0;
	for(i=1;i<=cnt;i++)
	{
	var temp=updatepop.document.getElementById("qty"+i).value;
	tot_ltrs= +tot_ltrs + +temp;
	var item=updatepop.document.getElementById("item"+i).value;
	if(item == 'PETROL')
		{
		var qty=updatepop.document.getElementById("qty"+i).value;
		pet_qty=pet_qty+parseInt(qty);
		}
	else if(item == 'DIESEL')
		{
			var qty=updatepop.document.getElementById("qty"+i).value;
			die_qty=die_qty+parseInt(qty);
		}
	else	if(item == 'XTRA_MILE')
		{
			var qty=updatepop.document.getElementById("qty"+i).value;
			mile_qty=mile_qty+parseInt(qty);
		}
	else 	if(item == 'XTRA_PREMIUM')
		{
			var qty=updatepop.document.getElementById("qty"+i).value;
			pre_qty=pre_qty+parseInt(qty);
		}
	else	if(item == 'XTRA_ORDINARY')
		{
			var qty=updatepop.document.getElementById("qty"+i).value;
			ord_qty=ord_qty+parseInt(qty);
		}
	}

	var split_pet_qty=0;
	var split_die_qty=0;
	var split_mile_qty=0;
	var split_pre_qty=0;
	var split_ord_qty=0;
	var tnk_cnt=updatepop.document.getElementById("tank_count").value;		
	var tot_split_ltrs=0;
	for(i=1;i<=tnk_cnt;i++)
	{
	var temp=updatepop.document.getElementById("ltrs"+i).value;
	tot_split_ltrs= +tot_split_ltrs+ +temp;
	var pdt=updatepop.document.getElementById("pdt"+i).value;
	if(pdt == 'PETROL')
	{
	var ltrs=updatepop.document.getElementById("ltrs"+i).value;
	split_pet_qty=split_pet_qty+parseInt(ltrs);
	}
	else if(pdt == 'DIESEL')
	{
		var ltrs=updatepop.document.getElementById("ltrs"+i).value;
		split_die_qty=split_die_qty+parseInt(ltrs);
	}
	else if(pdt == 'XTRA_MILE')
	{
		var ltrs=updatepop.document.getElementById("ltrs"+i).value;
		split_mile_qty=split_mile_qty+parseInt(ltrs);
	}
	else if(pdt == 'XTRA_PREMIUM')
	{
		var ltrs=updatepop.document.getElementById("ltrs"+i).value;
		split_pre_qty=split_pre_qty+parseInt(ltrs);
	}
	else if(pdt == 'XTRA_ORDINARY')
	{
		var ltrs=updatepop.document.getElementById("ltrs"+i).value;
		split_ord_qty=split_ord_qty+parseInt(ltrs);
	}
	}
	
	if(tot_ltrs != tot_split_ltrs ||  split_pet_qty != pet_qty  || split_die_qty != die_qty || split_mile_qty != mile_qty || split_pre_qty != pre_qty || split_ord_qty != ord_qty)
		{
		updatepop.alert("Purchasing details does not match with Split up details");
		}
	else if(acct_date=="")
	{
		updatepop.alert("Please Enter Account Date");
		updatepop.document.getElementById("acct_date").focus();
		return false;
	}else if(inv_no=="")
	{
		updatepop.alert("Please Enter Invoice No");
		updatepop.document.getElementById("inv_no").focus();
		return false;
	}
	else if(inv_date=="")
	{
		updatepop.alert("Please Enter Invoice Date");
		updatepop.document.getElementById("inv_date").focus();
		return false;
	}
	else if(updatepop.document.getElementById("item1").value=="default")
	{
		updatepop.alert("Please Select any product");
		
		updatepop.document.getElementById("item1").focus();
		return false;
	}
	else if((updatepop.document.getElementById("qty1").value=="0")||(updatepop.document.getElementById("qty1").value==""))
	{
		updatepop.alert("Please Enter Quantity");
		updatepop.document.getElementById("qty1").focus();
		return false;
	}
	else if(isNaN(updatepop.document.getElementById("qty1").value)){
		updatepop.alert("Quantity should contain digits only");
		updatepop.document.getElementById("qty1").focus();
		return false;
	}
	else if((updatepop.document.getElementById("amt1").value=="0")||(updatepop.document.getElementById("amt1").value==""))
	{
		updatepop.alert("Please Enter Amount");
		updatepop.document.getElementById("amt1").focus();
		return false;
	}
	else if(isNaN(updatepop.document.getElementById("amt1").value)){
		updatepop.alert("Amount should contain digits only");
		updatepop.document.getElementById("amt1").focus();
		return false;
	}
	else if(updatepop.document.getElementById("tnk1").value=="default")
	{
		updatepop.alert("Please Complete the Split up");
		updatepop.document.getElementById("tnk1").focus();
		return false;
	}
	else if((updatepop.document.getElementById("pdt1").value=="0")||(updatepop.document.getElementById("pdt1").value==""))
	{
		updatepop.alert("Please Complete the Split up");
		updatepop.document.getElementById("pdt1").focus();
		return false;
	}
	else if((updatepop.document.getElementById("ltrs1").value=="0")||(updatepop.document.getElementById("ltrs1").value==""))
	{
		updatepop.alert("Please Complete the Split up");
		updatepop.document.getElementById("ltrs1").focus();
		return false;
	}
	else if(isNaN(updatepop.document.getElementById("ltrs1").value)){
		updatepop.alert("Product Quantity should contain digits only");
		updatepop.document.getElementById("ltrs1").focus();
		return false;
	}
	else
	{
	$.post(site_url+"/purchase/delete_tank_loading_details/"+voucher_no,function(data){
	});
	
	for(i=1;i<=tank_cnt;i++){
		var tnk="tnk"+i;
		var pdt="pdt"+i;
		var ltrs="ltrs"+i;
		var tank=updatepop.document.getElementById(tnk).value;
		if(tank !='default'){
			//alert("Bill is updated Successfully"+i);
			var pdt=updatepop.document.getElementById(pdt).value;
			var ltrs=updatepop.document.getElementById(ltrs).value;
			var voucher_status1=updatepop.document.getElementById("voucher_version1").value;
			
			var info={};
			info["voucher_no"]=voucher_no;
			info["acct_date"]=acct_date;
			info["tnk"]=tank;
			info["pdt"]=pdt;
			info["ltrs"]=ltrs;
			info["voucher_status"]=parseInt(voucher_status1)+1;
			$.post(site_url+"/purchase/update_tank_loading_details/",info,function(data){
			});
			//alert("Bill is updated Successfully"+i);
			
			
		}
	}
	$.post(site_url+"/purchase/delete_pet_pur_details/"+voucher_no,function(data){
	 });
	updatepop.alert("Bill is updated Successfully");
	for(i=1;i<=cnt;i++){
		var item="item"+i;
		var qty="qty"+i;
		var amt="amt"+i;
		var inv_den="inv_den"+i;
		var del_den="del_den"+i;
		var prod=updatepop.document.getElementById(item).value;
		if(prod !='default'){
			
			var qty=updatepop.document.getElementById(qty).value;
			var amt=updatepop.document.getElementById(amt).value;
			var inv_den=updatepop.document.getElementById(inv_den).value;
			var del_den=updatepop.document.getElementById(del_den).value;
			var voucher_status=updatepop.document.getElementById("voucher_version").value;
			var details={};
			details["voucher_no"]=voucher_no;
			details["prod"]=prod;
			details["qty"]=qty;
			details["amt"]=amt;
			details["inv_den"]=inv_den;
			details["del_den"]=del_den;
			details["voucher_status"]=parseInt(voucher_status)+1;
			$.post(site_url+"/purchase/update_pet_pur_details/",details,function(data){
		    });
		}
	}
	
	collect["voucher_no"]=voucher_no;
	collect["acct_date"]=acct_date;
	collect["inv_no"]=inv_no;
	collect["inv_date"]=inv_date;
	collect["party_name"]=party_name;
	collect["total_amt"]=total_amt;
	$.post(site_url+"/purchase/pet_pur_bill_update/",collect,function(data){
		   updatepop.document.getElementById('retailbill').innerHTML=data;
		   updatepop.close();
		});
	}
}

function update_oth_pur(){
	
	var collect={};
	var voucher_no=updatepop.document.getElementById("voucher_no").value;		
	var acct_date=updatepop.document.getElementById("acct_date").value;
	var inv_no=updatepop.document.getElementById("inv_no").value;
	var inv_date=updatepop.document.getElementById("inv_date").value;
	var party_name=updatepop.document.getElementById("party_name").value;
	var paymode=updatepop.document.getElementById("pay_mode").value;
	var cnt=updatepop.document.getElementById("count").value;
	var total=updatepop.document.getElementById("total").value;
	var cash_disc=updatepop.document.getElementById("cash_disc").value;
	var cash_disc_amt=updatepop.document.getElementById("cash_disc_amt").value;
	var sch_disc=updatepop.document.getElementById("sch_disc").value;
	var sch_disc_amt=updatepop.document.getElementById("sch_disc_amt").value;
	var vat=updatepop.document.getElementById("vat").value;
	var vat_amt=updatepop.document.getElementById("vat_amt").value;
	var other_amt=updatepop.document.getElementById("other_amt").value;
	var grnd_tot=updatepop.document.getElementById("grnd_tot").value;
	if(acct_date==""){
		updatepop.alert("Please Enter Account Date");
		
		return false;
	}
	 else if(inv_no=="")
		 {
		 updatepop.alert("Please Enter Invoice No");
		return false;
	}
	
	else if(inv_date=="")
	{
		updatepop.alert("Please Enter Invoice Date");
		return false;
	}
	else if(party_name=="default")
	{
		updatepop.alert("Please Select any Party");
		return false;
	}
	else if(updatepop.document.getElementById("item1").value=="default")
	{
		updatepop.alert("Please Select any product");
		return false;
	}
	else if((updatepop.document.getElementById("qty1").value=="0")||(updatepop.document.getElementById("qty1").value=="")){
		updatepop.alert("Please Enter Quantity");
		return false;
	}
	else if(isNaN(updatepop.document.getElementById("qty1").value)){
		updatepop.alert("Quantity should contain digits only");
		updatepop.document.getElementById("qty1").focus();
		return false;
	}
	else if((updatepop.document.getElementById("amt1").value=="0")||(updatepop.document.getElementById("amt1").value=="")){
		updatepop.alert("Please Enter Amount");
		return false;
	}
	else if(isNaN(updatepop.document.getElementById("amt1").value)){
		updatepop.alert("Amount should contain digits only");
		updatepop.document.getElementById("amt1").focus();
		return false;
	}
	else if(isNaN(updatepop.document.getElementById("grnd_tot").value)){
		updatepop.alert("Grant Total should contain digits only");
		updatepop.document.getElementById("grnd_tot").focus();
		return false;
	}
	else
		{ 
	$.post(site_url+"/purchase/delete_oth_pur_details/"+voucher_no,function(data){
	 });
	updatepop.alert("Bill is updated Successfully");
	for(i=1;i<=cnt;i++){
		var item="item"+i;
		var qty="qty"+i;
		var rate="rate"+i;
		var amt="amt"+i;
		var prod=updatepop.document.getElementById(item).value;
		if(prod !='default'){
			
			var qty=updatepop.document.getElementById(qty).value;
			var amt=updatepop.document.getElementById(amt).value;
			var rate=updatepop.document.getElementById(rate).value;
			var voucher_status=updatepop.document.getElementById("voucher_version").value;
			var details={};
			details["voucher_no"]=voucher_no;
			details["prod"]=prod;
			details["qty"]=qty;
			details["rate"]=rate;
			details["amt"]=amt;
			details["voucher_status"]=parseInt(voucher_status)+1;
			$.post(site_url+"/purchase/update_oth_pur_details/",details,function(data){
		    });
		}
	}
	
	collect["voucher_no"]=voucher_no;
	collect["acct_date"]=acct_date;
	collect["inv_no"]=inv_no;
	collect["inv_date"]=inv_date;
	collect["party_name"]=party_name;
	collect["pay_mode"]=paymode;
	collect["total"]=total;
	collect["cash_disc"]=cash_disc;
	collect["cash_disc_amt"]=cash_disc_amt;
	collect["sch_disc"]=sch_disc;
	collect["sch_disc_amt"]=sch_disc_amt;
	collect["vat"]=vat;
	collect["vat_amt"]=vat_amt;
	collect["other_amt"]=other_amt;
	collect["grnd_tot"]=grnd_tot;
	$.post(site_url+"/purchase/oth_pur_bill_update/",collect,function(data){
		   updatepop.document.getElementById('retailbill').innerHTML=data;
		   updatepop.close();
		});
	
	
}}
function get_tnk_pdt(obj,no){
	if(obj!="default"){
		$.post(site_url+"/purchase/get_tnk_pdt",{tank:obj},function(data){
			
			//alert(data);
		document.getElementById("pdt"+no).value=data;
		document.getElementById("ltrs"+no).value='';
			});
		
		//alert(obj);
	}
	else{
		document.getElementById("pdt"+no).value='';
		document.getElementById("ltrs"+no).value='';
	}
}

function get_tnk_pdt_edit(obj,no){
	if(obj!="default"){
		$.post(site_url+"/purchase/get_tnk_pdt",{tank:obj},function(data){
		updatepop.document.getElementById("pdt"+no).value=data;
		updatepop.document.getElementById("ltrs"+no).value='';
			});
		
		
	}
	else{
		updatepop.document.getElementById("pdt"+no).value='';
		updatepop.document.getElementById("ltrs"+no).value='';
	}
}
function pet_form_valid(){
	
	var pet_qty=0;
	var die_qty=0;
	var mile_qty=0;
	var pre_qty=0;
	var ord_qty=0;
	var cnt=document.getElementById("count").value;
	var tot_ltrs=0;
	for(i=1;i<=cnt;i++)
	{
	var temp=document.getElementById("qty"+i).value;
	tot_ltrs= +tot_ltrs + +temp;
	var item=document.getElementById("item"+i).value;
	if(item == 'PETROL')
		{
		var qty=document.getElementById("qty"+i).value;
		pet_qty=pet_qty+parseInt(qty);
		}
	else if(item == 'DIESEL')
		{
			var qty=document.getElementById("qty"+i).value;
			die_qty=die_qty+parseInt(qty);
		}
	else	if(item == 'XTRA_MILE')
		{
			var qty=document.getElementById("qty"+i).value;
			mile_qty=mile_qty+parseInt(qty);
		}
	else 	if(item == 'XTRA_PREMIUM')
		{
			var qty=document.getElementById("qty"+i).value;
			pre_qty=pre_qty+parseInt(qty);
		}
	else	if(item == 'XTRA_ORDINARY')
		{
			var qty=document.getElementById("qty"+i).value;
			ord_qty=ord_qty+parseInt(qty);
		}
	}

	var split_pet_qty=0;
	var split_die_qty=0;
	var split_mile_qty=0;
	var split_pre_qty=0;
	var split_ord_qty=0;
	var tnk_cnt=document.getElementById("tnk_count").value;		
	var tot_split_ltrs=0;
	for(i=1;i<=tnk_cnt;i++)
	{
	var temp=document.getElementById("ltrs"+i).value;
	tot_split_ltrs= +tot_split_ltrs+ +temp;
	var pdt=document.getElementById("pdt"+i).value;
	if(pdt == 'PETROL')
	{
	var ltrs=document.getElementById("ltrs"+i).value;
	split_pet_qty=split_pet_qty+parseInt(ltrs);
	}
	else if(pdt == 'DIESEL')
	{
		var ltrs=document.getElementById("ltrs"+i).value;
		split_die_qty=split_die_qty+parseInt(ltrs);
	}
	else if(pdt == 'XTRA_MILE')
	{
		var ltrs=document.getElementById("ltrs"+i).value;
		split_mile_qty=split_mile_qty+parseInt(ltrs);
	}
	else if(pdt == 'XTRA_PREMIUM')
	{
		var ltrs=document.getElementById("ltrs"+i).value;
		split_pre_qty=split_pre_qty+parseInt(ltrs);
	}
	else if(pdt == 'XTRA_ORDINARY')
	{
		var ltrs=document.getElementById("ltrs"+i).value;
		split_ord_qty=split_ord_qty+parseInt(ltrs);
	}
	}
	
	if(tot_ltrs != tot_split_ltrs ||  split_pet_qty != pet_qty  || split_die_qty != die_qty || split_mile_qty != mile_qty || split_pre_qty != pre_qty || split_ord_qty != ord_qty)
		{
		alert("Purchasing details does not match with Split up details");
		}
	else if(document.getElementById("acct_date").value==""){
		alert("Please Enter Account Date");
		return false;
	}
	 else if(document.getElementById("inv_no").value=="")
		 {
		alert("Please Enter Invoice No");
		return false;
	}
	
	else if(document.getElementById("inv_date").value=="")
	{
		alert("Please Enter Invoice Date");
		return false;
	}
	else if(document.getElementById("item1").value=="default")
	{
		alert("Please Select any product");
		return false;
	}
	else if((document.getElementById("qty1").value=="0")||(document.getElementById("qty1").value=="")){
		alert("Please Enter Quantity");
		return false;
	}
	else if(isNaN(document.getElementById("qty1").value)){
		alert("Quantity should contain digits only");
		document.getElementById("qty1").focus();
		return false;
	}
	else if((document.getElementById("val1").value=="0")||(document.getElementById("val1").value=="")){
		alert("Please Enter Amount");
		return false;
	}
	else if(isNaN(document.getElementById("val1").value)){
		alert("Amount should contain digits only");
		document.getElementById("val1").focus();
		return false;
	}
	else if(document.getElementById("tnk1").value=="default")
	{
		alert("Please Complete the Split up");
		return false;
	}
	else if((document.getElementById("pdt1").value=="0")||(document.getElementById("pdt1").value=="")){
		alert("Please Complete the Split up");
		return false;
	}
	else if((document.getElementById("ltrs1").value=="0")||(document.getElementById("ltrs1").value=="")){
		alert("Please Complete the Split up");
		return false;
	}
	else if(isNaN(document.getElementById("ltrs1").value)){
		alert("Product Quantity should contain digits only");
		document.getElementById("ltrs1").focus();
		return false;
	}
	else if(isNaN(document.getElementById("inv_den1").value)){
		alert("Invoice Density should contain digits only");
		document.getElementById("inv_den1").focus();
		return false;
	}
	else if(isNaN(document.getElementById("del_den1").value)){
		alert("Delivery Density should contain digits only");
		document.getElementById("del_den1").focus();
		return false;
	}
	else if(document.getElementById("status").value=="0"){
		alert("Invoice Density and Observed Density differs by 3 units. Please Confirm with supply point or Sales Officer!..");
		return false;
	}
	else
		{
		document.forms["pet_pur_form"].submit();
		}
	
	//alert(document.getElementById("tnk_count").value);
	
}


function check_qty(obj,id){
	if(isNaN(obj)==true){
		document.getElementById(id).focus();
		alert("Quantity should be a number");
	}
	else if(obj==''){
		alert("Please Enter some quantity");
		document.getElementById(id).focus();
	}
	
}
	function grand_tot(obj){
		tot_amt=document.getElementById("total").value;
		var sch_disc=document.getElementById("sch_disc").value;
		var sch_disc_amt=(tot_amt*sch_disc/100);
		document.getElementById("sch_disc_amt").value=sch_disc_amt.toFixed(2);
		var sch_disc_amt1=+tot_amt- +sch_disc_amt;
		var cash_disc=document.getElementById("cash_disc").value;
		var cash_disc_amt=(sch_disc_amt1*cash_disc/100);
		document.getElementById("cash_disc_amt").value=cash_disc_amt.toFixed(2);
		var cash_disc_amt1=+sch_disc_amt1- +cash_disc_amt;
		var vat=document.getElementById("vat").value;
		var vat_amt=(cash_disc_amt1*vat/100);
		document.getElementById("vat_amt").value=vat_amt.toFixed(2);
		var others=document.getElementById("other_amt").value;
		var grand_tot=+tot_amt - +cash_disc_amt - +sch_disc_amt + +vat_amt - +others;
		document.getElementById("grnd_tot").value=grand_tot.toFixed(2);
	
	 } 

	function other_form_valid(){
		if(document.getElementById("acct_date").value==""){
			alert("Please Enter Account Date");
			
			return false;
		}
		 else if(document.getElementById("inv_no").value=="")
			 {
			alert("Please Enter Invoice No");
			return false;
		}
		
		else if(document.getElementById("inv_date").value=="")
		{
			alert("Please Enter Invoice Date");
			return false;
		}
		else if(document.getElementById("party_name").value=="default")
		{
			alert("Please Select any Party");
			return false;
		}
		else if(document.getElementById("item1").value=="default")
		{
			alert("Please Select any product");
			return false;
		}
		
		else if((document.getElementById("qty1").value=="0")||(document.getElementById("qty1").value=="")){
			alert("Please Enter Quantity");
			return false;
		}
		else if(isNaN(document.getElementById("qty1").value)){
			alert("Quantity should contain digits only");
			document.getElementById("qty1").focus();
			return false;
		}
		else if((document.getElementById("val1").value=="0")||(document.getElementById("val1").value=="")){
			alert("Please Enter Amount");
			return false;
		}
		else if(isNaN(document.getElementById("val1").value)){
			alert("Value should contain digits only");
			document.getElementById("val1").focus();
			return false;
		}
		else if(isNaN(document.getElementById("grnd_tot").value)){
			alert("Amount should contain digits only");
			document.getElementById("grnd_tot").focus();
			return false;
		}
		else
			{
			
			document.forms["other_pur_form"].submit();
			}
	}

	
	function pet_pur_details(){
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
						$.post(site_url + "/purchase/pet_pur_details",date,function(data) {
						$("#contentData").html("");
						$("#contentData").append(data);
	
						}); 
						}
		
		
	}
	String.prototype.trim = function()
	{return ((this.replace(/^[\s\xA0]+/, "")).replace(/[\s\xA0]+$/, ""));};

	String.prototype.startsWith = function(str)
	{return (this.match(str)==str);};

	String.prototype.endsWith = function(str)
	{return (this.match(str+"$")==str);};
	
	String.prototype.endsWithroman = function(str)
	{return (this.match(str+"")==str);};
	
	function searchbyvouchernoroman()
	{
		var voucher_no=document.getElementById('voucher_no').value;
		filterTableByvouchernoroman(voucher_no);
	}

	function filterTableByvouchernoroman(str){
		
		str.trim();
		 var rowid, colid, rowc,vbid;
		  rcount=document.getElementById("hrowcount");
		  rowc=rcount.value;
		  
		  for(var i=1;i<=rowc;i++){
		    rowid="row"+i;
		    colid="voucher_no"+i;
		    var lstr=(str.toString()).toLowerCase();
		    displayRowEndsWithroman(rowid,colid,lstr);
		  }
		}
	

	
	function displayRowEndsWithroman(rowid,colid,str){
		var row = document.getElementById(rowid);
	      var searchcol= document.getElementById(colid);
	     var colstr=searchcol.value;
	     var lcolstr=(colstr.toString()).toLowerCase();
	      if (lcolstr.endsWithroman(str))
	          row.style.display = '';
	      else
	          row.style.display = 'none';
	}
	function searchbyinvno()
	{
		var invno=document.getElementById('inv_no').value;
		filterTableByinvno(invno);
	}

	function filterTableByinvno(str){
		
		str.trim();
		 var rowid, colid, rowc,vbid;
		  rcount=document.getElementById("hrowcount");
		  rowc=rcount.value;
		  
		  for(var i=1;i<=rowc;i++){
		    rowid="row"+i;
		    colid="inv_no"+i;
		    var lstr=(str.toString()).toLowerCase();
		    displayRowEndsWith(rowid,colid,lstr);
		  }
		}
	
	function searchbyvoucherno()
	{
		var voucher_no=document.getElementById('voucher_no').value;
		filterTableByvoucherno(voucher_no);
	}
	function searchbysuppname()
	{
		var supp_name=document.getElementById('supp_name').value;
		filterTableBysuppname(supp_name);
	}
	function filterTableBysuppname(str){
		
		str.trim();
		 var rowid, colid, rowc,vbid;
		  rcount=document.getElementById("hrowcount");
		  rowc=rcount.value;
		  
		  for(var i=1;i<=rowc;i++){
		    rowid="row"+i;
		    colid="supp_name"+i;
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
	function filterTableByvoucherno(str){
		
		str.trim();
		 var rowid, colid, rowc,vbid;
		  rcount=document.getElementById("hrowcount");
		  rowc=rcount.value;
		  
		  for(var i=1;i<=rowc;i++){
		    rowid="row"+i;
		    colid="voucher_no"+i;
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
	

	function oth_pur_details(){
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
						$.post(site_url + "/purchase/oth_pur_details",date,function(data) {
						$("#contentData").html("");
						$("#contentData").append(data);
	
						}); 
						}
		
		
	}
	function managed_retail_purchase_form()
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
						$.post(site_url + "/purchase/managed_retail_purchase_details",date,function(data) {
						$("#contentData").html("");
						$("#contentData").append(data);
	
						}); 
						}
	}
	function showpurchasedetails(voucherversion)
	{
		var voucher=voucherversion.split("-");
		var voucher_no=voucher[0];
		var version=voucher[1];
		updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=1027, height=550,toolbar=no,addressbar=no");
		var generatedContent="<html><head><title> Purchase Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /></head>"+
		 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Bill Information </span></p>"+
		 "<hr width='100%'>"+
		 "<div id='retailpurchase' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:300px;margin-bottom:30px'><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
		 updatepop.document.write(generatedContent);   
		
		$.get(site_url + "/purchase/fetch_no_of_version/"+voucher_no,function(data){
			if(version == data)
			{
			$.get(site_url + "/purchase/fetch_current_version/"+voucher_no,function(data){
				updatepop.document.getElementById('retailpurchase').innerHTML=data;
			
			});
			
			}else
			{
				var voucher_details={};
				voucher_details["voucher_no"]=voucher_no;
				voucher_details["version"]=version;
				$.post(site_url+"/purchase/fetch_old_version/",voucher_details,function(data){
				
					updatepop.document.getElementById('retailpurchase').innerHTML=data;
				
				});
			}
		});
	
	}
	function managed_other_purchase_form()
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
						$.post(site_url + "/purchase/managed_other_purchase_details",date,function(data) {
						$("#contentData").html("");
						$("#contentData").append(data);
	
						}); 
						}
	}
	function showpurchasedetails_other(voucherversion)
	{
		var voucher=voucherversion.split("-");
		var voucher_no=voucher[0];
		var version=voucher[1];
		updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=1027, height=550,toolbar=no,addressbar=no");
		var generatedContent="<html><head><title> Purchase Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /><link rel='stylesheet' media='' type='text/css' href='../../css/jquery-ui-1.8.18.custom.css' /></head>"+
		 "<body background='' bgcolor='' ><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:1px solid black ;border-radius:20px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Bill Information </span></p>"+
		 "<hr width='100%'>"+
		 "<div id='otherpurchase' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:300px;margin-bottom:30px'><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body></html>";
		 updatepop.document.write(generatedContent);   
		
		$.get(site_url + "/purchase/fetch_no_of_version_other/"+voucher_no,function(data){
			if(version == data)
			{
			$.get(site_url + "/purchase/fetch_current_version_other/"+voucher_no,function(data){
				updatepop.document.getElementById('otherpurchase').innerHTML=data;
			
			});
			
			}else
			{
				var voucher_details={};
				voucher_details["voucher_no"]=voucher_no;
				voucher_details["version"]=version;
				$.post(site_url+"/purchase/fetch_old_version_other/",voucher_details,function(data){
				
					updatepop.document.getElementById('otherpurchase').innerHTML=data;
				
				});
			}
		});
	
	}
	
	 function calculate_amount(str,id)
	 {
		 if(str!="default"){
		var product=document.getElementById("item"+id).value;
		 var Ltrs=str;
		 $.get(site_url+"/purchase/fetch_comm_rate/"+product,function(data){
		var Rate=data;
		 var amt=(Ltrs*Rate);			
		 document.getElementById("val"+id).value=amt.toFixed(2);
		 var cnt=document.getElementById("count").value;
			
			var tot_amt=0;
			for(i=1;i<=cnt;i++){
				temp=document.getElementById("val"+i).value;
				tot_amt= +tot_amt + +temp;
			}
		document.getElementById("total").value=tot_amt.toFixed(3);

		 				}); 
		  			}
		 }
	 function calculate_amount_pop(str,id)
	 {
		 if(str!="default"){
		var product=updatepop.document.getElementById("item"+id).value;
		 var Ltrs=str;
		 $.get(site_url+"/purchase/fetch_comm_rate/"+product,function(data){
		var Rate=data;
		 var amt=(Ltrs*Rate);			
		 updatepop. document.getElementById("amt"+id).value=amt.toFixed(2);
		 var cnt=updatepop.document.getElementById("count").value;
			
			var tot_amt=0;
			for(i=1;i<=cnt;i++)
			{
				var temp=updatepop.document.getElementById("amt"+i).value;
				tot_amt= +tot_amt + +temp;
			}
			updatepop.document.getElementById("total").value=tot_amt.toFixed(3);

		 				}); 
		  			}
		 }
	 function check_density(str,id)
	 {
		 
		if(str!=""){

		var inv_den=document.getElementById("inv_den"+id).value;
		var inv_den=parseFloat(inv_den);
		var min_den=(inv_den-3);
		var max_den=(inv_den+3);
		//alert(min_den+' '+max_den+' '+str+' '+inv_den);
		if ( str < min_den || str > max_den )
			{
			alert("Invoice Density and Observed Density differs by 3 units. Please Confirm with supply point or Sales Officer!..");
			document.getElementById("status").value=0;
			}else{
				document.getElementById("status").value=1;
			}
		 } 
	 }
	 function check_density_pop(str,id)
	 {
		 
		if(str!=""){

		var inv_den=updatepop.document.getElementById("inv_den"+id).value;
		var inv_den=parseFloat(inv_den);
		var min_den=(inv_den-3);
		var max_den=(inv_den+3);
		if ( str < min_den || str > max_den )
			{
			updatepop.alert("Invoice Density and Observed Density differs by 3 units. Please Confirm with supply point or Sales Officer!..");
			updatepop.document.getElementById("status").value=0;
			updatepop.focus();
			}else{
				updatepop.document.getElementById("status").value=1;
			}
		 } 
	 }
	 function fetch_comm_rate(str,id)
	 {
		 
		 		if(str!="default"){
				var product=str;
				$.get(site_url+"/purchase/fetch_comm_rate/"+product,function(data){
				document.getElementById("rate"+id).value=data;
				}); 
				  		}
		  }
	 function get_supplier_prod(str)
	 {
		 if(str != "default")
			 {
		 $.post(site_url+"/purchase/get_supplier_prod",{supplier:str},function(data){
		 var cnt=document.getElementById("count").value;
		 for(i=1;i<=cnt;i++)
			 {
			 var select=document.getElementById('item'+i);
				if(select){
				var length=select.length;
				for (j=0;j<=length;j++) {
					select.remove(select.selectedIndex);
				}
			}
		var products=data.split("-");
		for(k=0;k<products.length;k++)
		{
		var opt = document.createElement("option");
		if(document.getElementById("item"+i)){
		document.getElementById("item"+i).options.add(opt);
		opt.text =products[k];
		opt.value = products[k];
		}
		 }
	} 
});
 }
	 }
	 
	 function crt_amt(obj){
			var tot_amt=document.getElementById("total").value;
			var sch_disc_amt=document.getElementById("sch_disc_amt").value;
			var sch_disc_amt1=tot_amt-sch_disc_amt;
			var sch_disc=(sch_disc_amt*100/tot_amt);
			document.getElementById("sch_disc").value=sch_disc.toFixed(2);
			var cash_disc_amt=document.getElementById("cash_disc_amt").value;
			var cash_disc_amt1=sch_disc_amt1-cash_disc_amt;
			var cash_disc=(cash_disc_amt*100/sch_disc_amt1);
			document.getElementById("cash_disc").value=cash_disc.toFixed(2);
			var vat_amt=document.getElementById("vat_amt").value;
			var vat_amt1=cash_disc_amt1+vat_amt;
			var vat=(vat_amt*100/cash_disc_amt1);
			document.getElementById("vat").value=vat.toFixed(2);
			var others=document.getElementById("other_amt").value;
			var grand_tot=+tot_amt - +sch_disc_amt- +cash_disc_amt+ +vat_amt+ +others;
			document.getElementById("grnd_tot").value=grand_tot.toFixed(2);
		
		 } 

	 
	 function edit_page_cur_amt(){
			var cnt=updatepop.document.getElementById("count").value;
			for(j=1;j<=cnt;j++){
			var prod=updatepop.document.getElementById("item"+j).value;
			
			if(prod!='default'){
			var rate=updatepop.document.getElementById("rate"+j).value;
			var qty=updatepop.document.getElementById("qty"+j).value;
			var val=rate*qty;
			updatepop.document.getElementById("amt"+j).value=val.toFixed(3);
			}
			else{
				updatepop.document.getElementById("amt"+j).value=0;
				updatepop.document.getElementById("rate"+j).value=0;
				updatepop.document.getElementById("qty"+j).value=0;
			}
			}
			var tot_amt=0;
			for(i=1;i<=cnt;i++){
				temp=updatepop.document.getElementById("amt"+i).value;
				tot_amt= +tot_amt + +temp;
			}
			updatepop.document.getElementById("total").value=tot_amt.toFixed(2);
			var sch_disc_amt=updatepop.document.getElementById("sch_disc_amt").value;
			var sch_disc_amt1=tot_amt-sch_disc_amt;
			var sch_disc=(sch_disc_amt*100/tot_amt);
			updatepop.document.getElementById("sch_disc").value=sch_disc.toFixed(2);
			var cash_disc_amt=updatepop.document.getElementById("cash_disc_amt").value;
			var cash_disc_amt1=sch_disc_amt1-cash_disc_amt;
			var cash_disc=(cash_disc_amt*100/sch_disc_amt1);
			updatepop.document.getElementById("cash_disc").value=cash_disc.toFixed(2);
			var vat_amt=updatepop.document.getElementById("vat_amt").value;
			var vat_amt1=cash_disc_amt1+vat_amt;
			var vat=(vat_amt*100/cash_disc_amt1);
			updatepop.document.getElementById("vat").value=vat.toFixed(2);
			var others=updatepop.document.getElementById("other_amt").value;
			var grand_tot=+tot_amt - +sch_disc_amt- +cash_disc_amt+ +vat_amt+ +others;
			updatepop.document.getElementById("grnd_tot").value=grand_tot.toFixed(2);

		}
 
	 
	