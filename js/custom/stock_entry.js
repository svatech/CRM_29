/**
 * 
 */
$("#acct_date").datepicker({
	dateFormat: 'yy-mm-dd',	maxDate: '+0d',	
	defaultDate: new Date()	
});
$('#acct_date').datepicker().datepicker('setDate',new Date());

function isFloatKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    		
    if (charCode > 31 && charCode!=46 && (charCode < 48 || charCode > 57 ))
        return false;
    return true;
}

function get_product(tank_no)
{
	if(tank_no != ""){
	$.get(site_url + "/stock/get_product/"+tank_no,function(data) {
		document.getElementById("product").value=data;
	
	}); 
	var acct_date=document.getElementById("acct_date").value;
	
	
	$.get(site_url + "/stock/check_tank",{act_date:acct_date,tank:tank_no},function(result) {
		if(result != 0){
			alert("Stock Entry already updated for this tank. do u want to continue");
			document.getElementById("count").value=result;
		}else{
		document.getElementById("count").value=result;
		}
		//alert(result);
	}); 
	}
	else
		{
		document.getElementById("product").value='';
		}
}
	function tank_details_validation()
	{
		var tank_no=document.getElementById("tank_no").value;
		var acct_date=document.getElementById("acct_date").value;
		var product=document.getElementById("product").value;
		var volume=document.getElementById("volume").value;
		var dip_level=document.getElementById("dip_level").value;
		var water_level=document.getElementById("water_level").value;
		var density=document.getElementById("density").value;
		var act_density=document.getElementById("act_density").value;
		var act_temp=document.getElementById("act_temp").value;
		
			if(tank_no=="")
			{
				alert("Please Select tank number");
			}
			else if(product=="")
			{
				alert("No product");
			}
			else if(acct_date=="")
			{
				alert("Please Select a Date");
			}
			else if(volume=="")
		    {
				alert("Please Enter Volume");
		    }
			else if(isNaN(volume.trim()))
		    {
				alert("Volume should contain digits only");
				document.getElementById("volume").focus();
				return false;
		    }
			else if(isNaN(dip_level.trim()) && dip_level.trim()!=''){
				alert("Dip Level should contain digits only");
				document.getElementById("dip_level").focus();
				return false;
			}
			else if(isNaN(water_level.trim()) && water_level.trim()!=''){
				alert("Water Level should contain digits only");
				document.getElementById("water_level").focus();
				return false;
			}
			else if(isNaN(density.trim()) && density.trim()!=''){
				alert("Density should contain digits only");
				document.getElementById("density").focus();
				return false;
			}
			else if(isNaN(act_density.trim()) && act_density.trim()!=''){
				alert("Actual Density should contain digits only");
				document.getElementById("act_density").focus();
				return false;
			}
			else if(isNaN(act_temp.trim()) && act_temp.trim()!=''){
				alert("Actual Temperature should contain digits only");
				document.getElementById("act_temp").focus();
				return false;
			}
		    else
			{
				document.forms['tank_stock_form'].submit();
				alert("Volume has updated for the tank "+ tank_no);
			}
		
	}