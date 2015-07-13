/**
 * 
 */
//$pump_no,$prod_name,$tank_no,$status,$count_no
/*(document.onkeydown = function(e){
	 e = e || window.event;
	    var key = e.which || e.keyCode;
	    if (e.keyCode == 86 && e.ctrlKey)
	    	{
	    	alert(e.clipboardData.getData('text/plain'));
	    	isFloatKey(e);
	    	}
};
*/
$("#indent_dob").datepicker({
	dateFormat: 'yy-mm-dd',maxDate: '+0d',onClose:function(selectedDate){$("#end_date").datepicker("option","minDate",selectedDate);},		
	defaultDate: new Date()		
});
/*$("#indent_dob").datepicker({
	dateFormat: 'yy-mm-dd', maxDate: '+0d',		
	defaultDate: new Date()		
});*/


$(document).ready(function() {
    $("#initial_deposit").bind('paste', function (e){
        $(e.target).keyup(getInput);
    });

    function getInput(e){
        var inputText = $(e.target).val();
        if(isNaN(inputText)){
        $(e.target).val('');
        }
        $(e.target).unbind('keyup');
        
    }
});

function isFloatKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    		
    if (charCode > 31 && charCode!=46 && (charCode < 48 || charCode > 57 ))
        return false;
    return true;
}

function pump_form()
{
	var pump_no=document.getElementById("pump_no").value;
	var prod_name=document.getElementById("prod_name").value;
	var tank_no=document.getElementById("tank_no").value;
	var status=document.getElementById("status").value;
	var count_no=document.getElementById("count_no").value;
	if(pump_no=="")
		{
		alert("Please Enter pump number");
		}else if(prod_name==""){
		alert("Please Select Product name");
		}
		else if(tank_no=="")
	   {
			alert("Please Select tank number");
	   }else if(status==""){
		   alert("Please Select status of the Pump");
	   }else if(count_no=="")
	   {
		   alert("Please Select counter number");
		}
	   else
		{
		document.forms['pumpform'].submit();
		alert("Pump  "+ pump_no+ " has successfully registered");
		}
	
}

function check_pump(){
	var pump_no =document.getElementById("pump_no").value;
	
	$.get(site_url + "/master/check_pump/"+pump_no,function(data) {

		if(data=='E'|| pump_no==''){
			document.getElementById('correct').style.display='none';
			document.getElementById('incorrect').style.display='';
			document.getElementById("button").style.display='none';
		}
		else{
			document.getElementById('incorrect').style.display='none';
			document.getElementById('correct').style.display='';	
			document.getElementById("button").style.display='';
		}

	});
}
function tank_form()
{
	var capacity=document.getElementById("capacity").value;
	var prod_name=document.getElementById("prod_name").value;
	var tank_no=document.getElementById("tank_no").value;
	var status=document.getElementById("status").value;
	
	if(tank_no=="")
	{
	alert("Please Enter tank number");
	}else if(capacity=="" ){				
	alert("Please Enter Capacity");
	}
	else if(isNaN(capacity))
	   {
		alert("Please Check capacity");
   }
	else if(status=="")
   {
		alert("Please Select status");
   }else if(prod_name==""){
	   alert("Please Select Product name");
   }
   else
	{
	document.forms['tankform'].submit();
	alert("Tank " + tank_no+ " has successfully registered");
	}
}


function prod_master_dwnld(){
	var downloadurl=site_url+"/master/prod_master_dwnld/";
	window.location=downloadurl;
	
}

function check_tank(){
	var tank_no =document.getElementById("tank_no").value;
	
	$.get(site_url + "/master/check_tank/"+tank_no,function(data) {

		if(data=='E'|| tank_no==''){
			document.getElementById('correct').style.display='none';
			document.getElementById('incorrect').style.display='';
			document.getElementById("button").style.display='none';
		}
		else{
			document.getElementById('incorrect').style.display='none';
			document.getElementById('correct').style.display='';	           
			document.getElementById("button").style.display='';
		}

	});
}
function product_form()
{
	var prod_rate=document.getElementById("prod_rate").value;
	var prod_name=document.getElementById("prod_name").value;
	var category=document.getElementById("category").value;
	var status=document.getElementById("status").value;
	var stock=document.getElementById("stock").value;
	
	if(prod_name=="")
	{
	alert("Please Enter Product name");
	}
	else if(prod_rate=="" ){
	alert("Please Enter Product Rate");
	}
	else if(isNaN(prod_rate))
	   {
			alert("Please Check Product rate");
	   }
	else if(status=="")
	   {
			alert("Please Select status");
	   }
	else if(category != 'FUEL' && stock == ""){
	   alert("Please Enter stock");
		}
	else
		{
		document.forms['productform'].submit();
		alert("Product " + prod_name+ " has successfully registered");
		}
}
function check_product(){
	var prod_name =document.getElementById("prod_name").value;
	 
	$.get(site_url + "/master/check_product/"+prod_name,function(data) {

		if(data=='E'|| prod_name=='' || (/\s/.test(prod_name)) || prod_name.match(/\\/) || prod_name.match(/\//) || prod_name.match(/\(/)|| prod_name.match(/\)/) ){
			document.getElementById('correct').style.display='none';
			document.getElementById('incorrect').style.display='';
			document.getElementById("button").style.display='none';
		}
		else{
			document.getElementById('incorrect').style.display='none';
			document.getElementById('correct').style.display='';	           
			document.getElementById("button").style.display='';
		}

	});
}
String.prototype.trim = function()
{return ((this.replace(/^[\s\xA0]+/, "")).replace(/[\s\xA0]+$/, ""));};

String.prototype.startsWith = function(str)
{return (this.match(str)==str);};

String.prototype.endsWith = function(str)
{return (this.match(str+"$")==str);};

function sortproduct()
{
var product=document.getElementById('product').value;
filterTableByproduct(product);
}
function sorttank()
{
var tank=document.getElementById('tank').value;
filterTableBytank(tank);

}
function sortcounter()
{ 
var counter=document.getElementById('counter').value;
filterTableBycounter(counter);
}
function sortcategory()
{
var category=document.getElementById('category').value;
filterTableBycategory(category);
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



function searchbysuppliername()
{
	var supplier=document.getElementById('supplier').value;
	filterTableBysuppliername(supplier);
}
function filterTableBysuppliername(str){
	
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

function searchbyvehicleno(){
	var vehicle_no=document.getElementById('vehicle_no').value;
	filterTableByVehicle_no(vehicle_no);
}

function filterTableByVehicle_no(str){
	str.trim();
	 var rowid, colid, rowc,vbid;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="veh_no"+i;
	    var lstr=(str.toString()).toLowerCase();
	    displayRowStartsWith(rowid,colid,lstr);
	  }
	
}


function filterTableByproduct(str){
	  str.trim();
	  var rowid, colid, rowc,vbid;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="prod"+i;
	    var lstr=(str.toString()).toLowerCase();
	    displayRowStartsWith(rowid,colid,lstr);
	  }
	}
function filterTableBytank(str){
	  str.trim();
	  var rowid, colid, rowc,vbid;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="tank_no"+i;
	    var lstr=(str.toString()).toLowerCase();
	    displayRowStartsWith(rowid,colid,lstr);
	  }
	}
function filterTableBycounter(str){
	  str.trim();
	  var rowid, colid, rowc,vbid;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="count"+i;
	    var lstr=(str.toString()).toLowerCase();
	    displayRowStartsWith(rowid,colid,lstr);
	  }
	}
function filterTableBycategory(str){
	  str.trim();
	  var rowid, colid, rowc,vbid;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="category"+i;
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

function updatetank(tank_no)
{
	
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=400, height=300,toolbar=no,addressbar=yes");
	var generatedContent="<html><head><title>Update Tank Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /></head>"+
	 "<body background='' bgcolor=''><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:0px solid black ;border-radius:0px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Tank Information </span></p>"+
"<hr width='100%'>"+
"<div id='mytank' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:100px;margin-bottom:30px'><input type=\"button\" id='update' value='Update' style='margin-right:25px;' class='button' onclick='opener.updatetankFinish()'/><input type=\"button\" id='close' value='Close' class='button' onclick='javascript:self.close()'/></div></body</html>";
	 updatepop.document.write(generatedContent);   
	 $.get(site_url + "/master/fetch_tank_info/"+tank_no,function(data){	
		 updatepop.document.getElementById('mytank').innerHTML=data;
		}); 
}

function updatetankFinish(){
	
	var tank_no=updatepop.document.getElementById("tank_no").value;		
	var capacity=updatepop.document.getElementById("capacity").value;
	var status=updatepop.document.getElementById("status").value;
	var prod_name=updatepop.document.getElementById("prod_name").value;
	if(capacity=='' || capacity==0){
		updatepop.alert("Please Enter Tank Capacity");
		return false;
	}
	var collect={};
	collect["tank_no"]=tank_no;
	collect["capacity"]=capacity;
	collect["status"]=status;
	collect["prod_name"]=prod_name;
	   $.post(site_url+"/master/tank_info_update",collect,function(data){
		   updatepop.document.getElementById('mytank').innerHTML=data;
		   updatepop.document.getElementById('update').style.display="none";
		   updatepop.document.getElementById('close').style.marginLeft="30px";
		   window.location.reload();	
	    });
  }

function updatepump(pump_no)
{
	
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=400, height=350,toolbar=no,addressbar=yes");
	var generatedContent="<html><head><title>Update Pump Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /></head>"+
	 "<body background='' bgcolor=''><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:0px solid black ;border-radius:0px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Pump Information </span></p>"+
"<hr width='100%'>"+
"<div id='mypump' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:100px;margin-bottom:30px'><input style='margin-right:25px;' class='button' type=\"button\" id='update' value='Update' onclick='opener.updatepumpFinish()'/><input class='button' type=\"button\" id='close' value='Close' onclick='javascript:self.close()'/></div></body</html>";
	 updatepop.document.write(generatedContent);   
	 $.get(site_url + "/master/fetch_pump_info/"+pump_no,function(data){	
		 updatepop.document.getElementById('mypump').innerHTML=data;
		}); 
}

function updatepumpFinish(){
	var pump_no=updatepop.document.getElementById("pump_no").value;		
	var counter=updatepop.document.getElementById("counter").value;
	var status=updatepop.document.getElementById("status").value;
	var tank_no=updatepop.document.getElementById("tank_no").value;
	var prod_name=updatepop.document.getElementById("prod_name").value;
	if(prod_name==''){
		updatepop.alert("Please Enter Product Name");
		return false;
	}
	var collect={};
	collect["tank_no"]=tank_no;
	collect["counter"]=counter;
	collect["status"]=status;
	collect["prod_name"]=prod_name;
	collect["pump_no"]=pump_no;
	
	   $.post(site_url+"/master/pump_info_update",collect,function(data){
		   updatepop.document.getElementById('mypump').innerHTML=data;
		   updatepop.document.getElementById('update').style.display="none";
		   updatepop.document.getElementById('close').style.marginLeft="30px";
		   window.location.reload();	
	    });
  }

function updateproduct(prod_name)
{
	
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=500, height=450,toolbar=no,addressbar=yes");
	var generatedContent="<html><head><title>Update Product Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /></head>"+
	 "<body background='' bgcolor=''><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:0px solid black ;border-radius:0px;'><p style='height:20px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Product Information </span></p>"+
"<hr width='100%'>"+
"<div id='myproduct' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:100px;margin-bottom:30px'><input style='margin-right:25px;' class='button' type=\"button\" id='update' value='Update' onclick='opener.updateproductFinish()'/><input class='button' type=\"button\" id='close' value='Close' onclick='javascript:self.close()'/></div></body</html>";
	 updatepop.document.write(generatedContent);   
	 
	 $.get(site_url + "/master/fetch_product_info/"+prod_name,function(data){	
		 updatepop.document.getElementById('myproduct').innerHTML=data;
		}); 
}

function updateproductFinish(){
	
	var prod_rate=updatepop.document.getElementById("prod_rate").value;		
	var category=updatepop.document.getElementById("category").value;
	var status=updatepop.document.getElementById("status").value;
	var tank_product=updatepop.document.getElementById("tank_product").value;
	var prod_name=updatepop.document.getElementById("prod_name").value;
	var stock=updatepop.document.getElementById("stock").value;
	var comm_rate=updatepop.document.getElementById("comm_rate").value;
	if(prod_rate=='' || prod_rate==0){
		updatepop.alert("Please Enter Product's Sales Rate");
		return false;
	}
	else if((stock=='')&&(category!='FUEL') ){
		updatepop.alert("Please Enter Opening Stock");
		return false;
	}
	var collect={};
	collect["prod_rate"]=prod_rate;
	collect["comm_rate"]=comm_rate;
	collect["category"]=category;
	collect["status"]=status;
	collect["prod_name"]=prod_name;
	collect["tank_product"]=tank_product;
	collect["stock"]=stock;
	   $.post(site_url+"/master/product_info_update",collect,function(data){
		   
		   updatepop.document.getElementById('myproduct').innerHTML=data;
		   updatepop.document.getElementById('update').style.display="none";
		   updatepop.document.getElementById('close').style.marginLeft="30px";
		   window.location.reload();	
	    });
  }
function updatecustomer(customer_id)
{
	
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=600, height=520,toolbar=no,addressbar=yes");
	var generatedContent="<html><head><title>Update Customer Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /></head>"+
	 "<body background='' bgcolor=''><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:0px solid black ;border-radius:0px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Indent Customer Information </span></p>"+
"<hr width='100%'>"+
"<div id='mycustomer' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:150px;margin-bottom:30px'><input style='margin-right:25px;' class='button' type=\"button\" id='update' value='Update' onclick='opener.updatecustomerFinish()'/><input class='button' type=\"button\" id='close' value='Close' onclick='javascript:self.close()'/></div></body</html>";
	 updatepop.document.write(generatedContent);   
	 $.get(site_url + "/master/fetch_customer_info/"+customer_id,function(data){	
		 updatepop.document.getElementById('mycustomer').innerHTML=data;
		}); 
}
function updatecustomerFinish(){
	
	var cust_name=updatepop.document.getElementById("cust_name").value;		
	var cust_id=updatepop.document.getElementById("cust_id").value;
	var addr=updatepop.document.getElementById("addr").value;
	var phone_number=updatepop.document.getElementById("phone_number").value;
	var ind_dob=updatepop.document.getElementById("indent_dob").value;
	var tin=updatepop.document.getElementById("tin").value;
	var vehicle_number=updatepop.document.getElementById("vehicle_number").value;
	var indent_start_no=updatepop.document.getElementById("indent_start_no").value;
	var indent_end_no=updatepop.document.getElementById("indent_end_no").value;
	var initial_deposit=updatepop.document.getElementById("initial_deposit").value;
	var indent_limit=updatepop.document.getElementById("indent_limit").value;
	var open_bal=updatepop.document.getElementById("open_bal").value;
	var status=updatepop.document.getElementById("status").value;
	
	var collect={};
	collect["cust_name"]=cust_name;
	collect["cust_id"]=cust_id;
	collect["addr"]=addr;
	collect["phone_number"]=phone_number;
	
	collect["tin"]=tin;
	collect["indent_dob"]=ind_dob;
	collect["vehicle_number"]=vehicle_number;
	collect["indent_start_no"]=indent_start_no;
	collect["indent_end_no"]=indent_end_no;
	collect["initial_deposit"]=initial_deposit;
	collect["indent_limit"]=indent_limit;
	collect["open_bal"]=open_bal;
	collect["status"]=status;
	   $.post(site_url+"/master/check_vehicle_no_upd",{veh_no:vehicle_number,custid:cust_id},function(data){
		   
		   if(data!='0'){
			   	   updatepop.alert("The following Vehicles are already in the List"+data);
		   }
		   else{
			   $.post(site_url+"/master/customer_info_update",collect,function(data){
				   updatepop.document.getElementById('mycustomer').innerHTML=data;
				   updatepop.document.getElementById('update').style.display="none";
				   updatepop.document.getElementById('close').style.marginLeft="30px";
				   window.location.reload();	
			    });
		   }
	    });
	
	   
  }

function customer_form()
{
	
	var cust_name=document.getElementById("cust_name").value;
	var addr=document.getElementById("addr").value;
	var ph_num=document.getElementById("ph_num").value;
	
	var tin=document.getElementById("tin").value;
	var ind_dob=document.getElementById("indent_dob").value;
	var vehicle=document.getElementById("vehicle").value;
	var indent_no_start=document.getElementById("indent_no_start").value;
	var indent_no_end=document.getElementById("indent_no_end").value;
	var open_bal=document.getElementById("open_bal").value;
	var indent_limit=document.getElementById("indent_limit").value;
	var initial_deposit=document.getElementById("initial_deposit").value;
	var status=document.getElementById("status").value;
	
	//alert(data);
	if(cust_name.trim()=="")
		{
		alert("Please Enter customer name");
		}else if(addr.trim()==""){
		alert("Please Enter address");
		}
		else if(vehicle.trim()=="")
	   {
		   alert("Please Enter vehicle number");
		}
	   else if(indent_no_start.trim()=="")
	   {
		   alert("Please Enter indent starting number");
		}
	   else if(isNaN(indent_no_start))
	   {
		   alert("Please Check indent starting number");
		}
	   else if(indent_no_end.trim()=="")
	   {
		   alert("Please Enter indent ending number");
		}
	   else if(isNaN(indent_no_end))
	   {
		   alert("Please Check indent ending number");
		}
	   else if(isNaN(initial_deposit))
	   {
		   alert("Please Check Initial Deposit");
		}
	   else if(addr.match(/\'/)||addr.match(/\"/)){
		alert("Customer Address should not contain special characters like \',\" ");
		document.getElementById("addr").focus();
	   }
	   else if(cust_name.match(/\'/)||cust_name.match(/\"/)){
			alert("Customer Name should not contain special characters like \',\" ");
			document.getElementById("addr").focus();
		}
	   else if(open_bal.trim()=="")
	   {
		   alert("Please Enter Opening Balance");
		}
	   else if(isNaN(open_bal))
	   {
		   alert("Please Check Opening Balance");
		}
	   else if(indent_limit.trim()=="")
	   {
		   alert("Please Enter Opening Balance");
		}
	   else if(isNaN(indent_limit))
	   {
		   alert("Please Check Opening Balance");
		}
	   else
		{
		   $.post(site_url+"/master/check_vehicle_no",{veh_no:vehicle},function(data){
			  
			   if(data!='0'){
				   	   alert("The Following Vehicles are already in list"+data);
				   	   return false;
			   }
			   else{
				   document.forms['customerform'].submit();
				   alert("customer  " +   cust_name+ " has successfully registered");
				   //alert(ind_dob);
				   
			   }
		    });
		
		}
	
}

function supplier_form()
{
	
	var supp_name=document.getElementById("supp_name").value;
	var addr=document.getElementById("addr").value;
	var ph_num=document.getElementById("ph_num").value;
	var tin=document.getElementById("tin").value;
	var supp_pdts=document.getElementById("supp_pdts").value;
	
		if(supp_name.trim()=="")
		{
		alert("Please Enter Supplier name");
		}
		else if(addr.trim()==""){
		alert("Please Enter address");
		}
		else
		{
		document.forms['supplierform'].submit();
		alert("Supplier  " +supp_name+ " has successfully registered");
		}
	
}
function updatesupplier(supplier_id)
{
	
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=600, height=520,toolbar=no,addressbar=yes");
	var generatedContent="<html><head><title>Update Supplier Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /></head>"+
	 "<body background='' bgcolor=''><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:0px solid black ;border-radius:0px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Supplier Information </span></p>"+
"<hr width='100%'>"+
"<div id='mysupplier' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:100px;margin-bottom:30px'><input style='margin-right:25px;' class='button' type=\"button\" id='update' value='Update' onclick='opener.updatesupplierFinish()'/><input class='button' type=\"button\" id='close' value='Close' onclick='javascript:self.close()'/></div></body</html>";
	 updatepop.document.write(generatedContent);   
	 $.get(site_url + "/master/fetch_supplier_info/"+supplier_id,function(data){	
		 updatepop.document.getElementById('mysupplier').innerHTML=data;
		}); 
}

function updatesupplierFinish(){
	
	var supp_name=updatepop.document.getElementById("supp_name").value;		
	var supp_id=updatepop.document.getElementById("supp_id").value;
	var addr=updatepop.document.getElementById("addr").value;
	var phone_number=updatepop.document.getElementById("phone_number").value;
	var tin=updatepop.document.getElementById("tin").value;
	var products=updatepop.document.getElementById("products").value;
	
	
	var collect={};
	collect["supp_name"]=supp_name;
	collect["supp_id"]=supp_id;
	collect["addr"]=addr;
	collect["phone_number"]=phone_number;
	collect["tin"]=tin;
	collect["products"]=products;
	
	   $.post(site_url+"/master/supplier_info_update",collect,function(data){
		 
		   updatepop.document.getElementById('mysupplier').innerHTML=data;
		   updatepop.document.getElementById('update').style.display="none";
		   updatepop.document.getElementById('close').style.marginLeft="30px";
		  
		   window.location.reload();	
	    });
  }

function check_customer(){
	var cust_name =document.getElementById("cust_name").value;
	if(cust_name.match(/\'/)||cust_name.match(/\"/)){
		alert("Customer name should not contain special characters like \',\" ");
		document.getElementById("cust_name").focus();
		return false;
	}
	$.get(site_url + "/master/check_customer/",{custname:cust_name},function(data) {

		if(data=='E'|| cust_name==''){
			document.getElementById('correct').style.display='none';
			document.getElementById('incorrect').style.display='';
			document.getElementById("button").style.display='none';
		}
		else{
			document.getElementById('incorrect').style.display='none';
			document.getElementById('correct').style.display='';	
			document.getElementById("button").style.display='';
		}

	});
	
}
function check_address(){
	var cust_addrs =document.getElementById("addr").value;
	if(cust_addrs.match(/\'/)||cust_addrs.match(/\"/)){
		alert("Customer Address should not contain special characters like \',\" ");
		document.getElementById("addr").focus();
	}
}
function check_supplier(){
	var supp_name =document.getElementById("supp_name").value;
	
	$.get(site_url + "/master/check_supplier/"+supp_name,function(data) {

		if(data=='E'|| supp_name==''){
			document.getElementById('correct').style.display='none';
			document.getElementById('incorrect').style.display='';
			document.getElementById("button").style.display='none';
		}
		else{
			document.getElementById('incorrect').style.display='none';
			document.getElementById('correct').style.display='';	
			document.getElementById("button").style.display='';
		}

	});
	
}


function enterstock()
{
var category=document.getElementById("category").value;	
if(category == 'FUEL')
		{
	
		document.getElementById("stock_row").style.display='none';
		}else
			{
			document.getElementById("stock_row").style.display='';
			}
}
function enterstock_pop()
{
var category=updatepop.document.getElementById("category").value;	
if(category == 'FUEL')
		{
	
		updatepop.document.getElementById("stock_row").style.display='none';
		}else
			{
			updatepop.document.getElementById("stock_row").style.display='';
			}
}
function tank_product(tank_no)
{
	if(tank_no != 'default')
		{
	 $.get(site_url + "/master/get_tankproduct_list/"+tank_no,function(data){	
		 document.getElementById("prod_name").value=data;
		});
		}
	else
		{
		document.getElementById("prod_name").value='';
		}
}
function tank_product_pop(tank_no)
{
	 $.get(site_url + "/master/get_tankproduct_list/"+tank_no,function(data){	
		 updatepop.document.getElementById("prod_name").value=data;
		});
	
}
function tank_master_dwnld(){
	var downloadurl=site_url+"/master/tank_master_dwnld/";
	window.location=downloadurl;
	
}
function pump_master_dwnld(){
	var downloadurl=site_url+"/master/pump_master_dwnld/";
	window.location=downloadurl;
	
}
function cust_master_dwnld(){
	var downloadurl=site_url+"/master/cust_master_dwnld/";
	window.location=downloadurl;
	
}
function supp_master_dwnld(){
	var downloadurl=site_url+"/master/supp_master_dwnld/";
	window.location=downloadurl;
	
}

function rfid_vehicles_dwnld(){
	var downloadurl=site_url+"/master/rfid_vehicles_dwnld/";
	window.location=downloadurl;
}

function change_sms_bill_opt(obj){
	$.post(site_url + "/master/change_sms_bill_opt/",{status:obj},function(data){	
		window.location.reload();
		});
}

function remove_rfid_details(veh_no){
	var reason=prompt("Reason for Cancelling Bill. Bill No:"+veh_no,"Wrong Entry");
	if(reason != null && reason != "")
		{
		var collect={};
		collect["veh_no"]= veh_no;
		collect["reason"]=reason;
		$.post(site_url+"/master/remove_rfid_details/",collect,function(data){
			//alert("Bill Cancelled Successfully");
			window.location.reload();
			   });
		
		}else if (reason == ""){
		alert("Please Enter the Reason");
		}else{
			//alert("Operation Interrupted");
			//document.getElementById("cancel_msg").style.display='none';
		}
	

}


function updateretailcustomer(cust_id){
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=600, height=520,toolbar=no,addressbar=yes");
	var generatedContent="<html><head><title>Update Customer Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /></head>"+
	 "<body background='' bgcolor=''><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:0px solid black ;border-radius:0px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>Retail Customer Information </span></p>"+
"<hr width='100%'>"+
"<div id='mycustomer' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:150px;margin-bottom:30px'><input style='margin-right:25px;' class='button' type=\"button\" id='update' value='Update' onclick='opener.updateretailcustomerFinish()'/><input class='button' type=\"button\" id='close' value='Close' onclick='javascript:self.close()'/></div></body</html>";
	 updatepop.document.write(generatedContent);   
	 $.get(site_url + "/master/fetch_retail_customer_info/"+cust_id,function(data){	
		 updatepop.document.getElementById('mycustomer').innerHTML=data;
		}); 
}

function updateretailcustomerFinish(){
	var cust_name=updatepop.document.getElementById("cust_name").value;		
	var cust_id=updatepop.document.getElementById("cust_id").value;
	var mobile_number=updatepop.document.getElementById("mobile_number").value;
	var vehicle_number=updatepop.document.getElementById("vehicle_number").value;
	var reference_no=updatepop.document.getElementById("reference_no").value;
	var status=updatepop.document.getElementById("status").value;
	
	var collect={};
	collect["cust_name"]=cust_name;
	collect["cust_id"]=cust_id;
	collect["mobile_number"]=mobile_number;
	collect["vehicle_number"]=vehicle_number;
	collect["reference_no"]=reference_no;
	collect["status"]=status;
	  	   $.post(site_url+"/master/retail_customer_info_update",collect,function(data){
				   updatepop.document.getElementById('mycustomer').innerHTML=data;
				   updatepop.document.getElementById('update').style.display="none";
				   updatepop.document.getElementById('close').style.marginLeft="30px";
				   window.location.reload();	
			    });
		
}

function retail_cust_dwnld(){
	var downloadurl=site_url+"/master/retail_cust_dwnld/";
	window.location=downloadurl;
	
}
	
